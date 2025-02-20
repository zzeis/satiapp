<?php

namespace App\Http\Controllers;

use App\Models\Manutencao;
use App\Models\Equipamento;
use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitacaoManutencao;
use App\Models\Movimentacoes;
use Illuminate\Support\Facades\DB;

class ManutencaoController extends Controller
{
    public function index(Request $request)
    {
        // Query base
        $query = Manutencao::query();
    
        // Filtro por status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
    
        // Pesquisa por número de série
        if ($request->has('numero_serie') && $request->numero_serie != '') {
            $query->whereHas('equipamento', function ($q) use ($request) {
                $q->where('numero_serie', 'like', '%' . $request->numero_serie . '%');
            });
        }
    
        // Paginação
        $manutencoes = $query->paginate(10);
    
        return view('manutencao.index', compact('manutencoes'));
    }

    public function create()
    {
        return view('manutencao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|exists:equipamentos,numero_serie',
            'descricao_problema' => 'required|string',
            'local' => 'nullable|string',
            'observacoes' => 'nullable|string',
        ]);

        // Busca o equipamento pelo número de série
        $equipamento = Equipamento::where('numero_serie', $request->numero_serie)->first();

        // Cria a manutenção
        $manutencao = Manutencao::create([
            'equipamento_id' => $equipamento->id,
            'user_id' => auth()->id(),
            'secretaria_id' => $equipamento->secretaria_id,
            'local' => $request->local,
            'descricao_problema' => $request->descricao_problema,
            'status' => 'aberto',
            'data_abertura' => now(),
            'observacoes' => $request->observacoes,
        ]);

        // Envia e-mail para a empresa terceirizada
        Mail::to('posygame@gmail.com')->send(new SolicitacaoManutencao($manutencao));

        return redirect()->route('manutencao.index')->with('success', 'Chamado aberto com sucesso!');
    }

    public function update(Request $request, Manutencao $manutencao)
    {
        $request->validate([
            'status' => 'required|in:aberto,em_andamento,concluido,cancelado',
            'data_visita' => 'nullable|date',
            'data_conclusao' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $manutencao->update($request->only('status', 'data_visita', 'data_conclusao', 'observacoes'));

        return redirect()->route('manutencao.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function registrarRetirada(Request $request, Manutencao $manutencao)
    {
        $request->validate([
            'data' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        // Registra a retirada do equipamento
        Movimentacoes::create([
            'manutencao_id' => $manutencao->id,
            'equipamento_id' => $manutencao->equipamento_id,
            'user_id' => auth()->id(),
            'tipo' => 'retirada',
            'data' => $request->data,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('manutencoes.index')->with('success', 'Retirada do equipamento registrada com sucesso!');
    }

    public function destroy(Manutencao $manutencao)
    {
        $manutencao->delete();
        return redirect()->route('manutencao.index')->with('success', 'Chamado excluído com sucesso!');
    }
}

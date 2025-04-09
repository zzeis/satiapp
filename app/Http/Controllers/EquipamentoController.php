<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Logs;
use App\Models\Movimentacoes;
use App\Models\Pessoa;
use App\Models\Secretaria;
use App\Models\TipoEquipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EquipamentoController extends Controller
{
    public function index(Request $request)
    {
        // Filtros
        $secretariaId = $request->input('secretaria');
        $tipoId = $request->input('tipo'); // Novo filtro
        $search = $request->input('search');
        $status = $request->input('status');

        // Consulta
        $equipamentos = Equipamento::with(['responsavel', 'user', 'secretaria', 'tipo', 'anotacoes']) // Adicionado 'tipo' ao with
            ->when($secretariaId, function ($query, $secretariaId) {
                return $query->where('secretaria_id', $secretariaId);
            })
            ->when($tipoId, function ($query, $tipoId) { // Novo filtro por tipo
                return $query->where('tipo_id', $tipoId);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->whereHas('responsavel', function ($subquery) use ($search) {
                        $subquery->where('nome', 'like', "%{$search}%")
                            ->orWhere('cpf', 'like', "%{$search}%");
                    })
                        ->orWhere('numero_serie', 'like', "%{$search}%")
                        ->orWhere('modelo', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->except('page')); // Mantém os filtros ao navegar pelas páginas

        $secretarias = Secretaria::all();
        $tipos = TipoEquipamento::all();

       
        return view('equipamentos.index', compact('equipamentos', 'secretarias', 'tipos'));
    }

    public function create()
    {
        $secretarias = Secretaria::all();

        $tipos = TipoEquipamento::all();

        $pessoas = Pessoa::all();
        return view('equipamentos.create', compact('pessoas', 'secretarias', 'tipos'));
    }

    public function store(Request $request)
    {


        $request->merge([
            'secretaria_id' => 9,  // ID da SATI
            'responsavel_id' => null,
            'data_saida' => null,
            'status' => 'estoque',
        ]);

        $validator = Validator::make($request->all(), [
            'secretaria_id' => 'required|exists:secretarias,id',
            'responsavel_id' => 'nullable|exists:pessoas,id',
            'status' => 'required|in:manutencao,em_uso,estoque,descartado',
            'tipo_id' => 'required|string|max:255',
            'tipo_propriedade' => 'required|string|max:255',
            'numero_serie' => ['required', 'string', Rule::unique('equipamentos')->whereNull('deleted_at')],
            'modelo' => 'required|string|max:255',
            'especificacoes' => 'nullable|string',
            'data_chegada' => 'nullable|date',
            'data_ultima_manutencao' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }



        // Armazena o equipamento criado em uma variável
        $equipamento = Equipamento::create($request->all());

        // Agora você pode usar $equipamento->id
        Movimentacoes::create([
            'equipamento_id' => $equipamento->id,
            'data' => now(),
            'acao' => 'cadastro_equipamento',
            'user_id' => auth()->id(),
            'descricao' => 'Adicionando novo equipamento ao sistema',
        ]);

        return redirect()
            ->route('equipamentos.create')
            ->with('success', 'Equipamento cadastrado com sucesso!');
    }

    public function show(Equipamento $equipamento)
    {
        return view('equipamentos.show', compact('equipamento'));
    }

    // Função para exibir detalhes da manutenção
    public function detalhes(Equipamento $equipamento)
    {


        // Carrega as relações necessárias
        $equipamento->load([
            'manutencoes', // Novo equipamento (se houver)
            'movimentacoes', // Movimentações relacionadas
            'movimentacoes.user', // Usuário que realizou a movimentação
            'user',
            'anotacoes.user',
        ]);



        return view('equipamentos.detalhes', compact('equipamento'));
    }

    public function edit(Equipamento $equipamento)
    {
        $secretarias = Secretaria::all();

        $tiposEquipamento = TipoEquipamento::all();

        $pessoas = Pessoa::all();
        return view('equipamentos.edit', compact('equipamento', 'tiposEquipamento', 'secretarias', 'pessoas'));
    }

    public function update(Request $request, Equipamento $equipamento)
    {
        $validator = Validator::make($request->all(), [

            'tipo_id' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:equipamentos,numero_serie,' . $equipamento->id,
            'modelo' => 'required|string|max:255',

            'data_chegada' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Logs::create([
            'acao' => 'Atualização de Equipamento',
            'detalhes' => "Equipamento #{$equipamento->id}: " . implode(', ', $request->all()),
            'user_id' => auth()->id()
        ]);
        $equipamento->update($request->all());

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento atualizado com sucesso!');
    }

    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento removido com sucesso!');
    }

    public function trashed()
    {
        $equipamentos = Equipamento::onlyTrashed()
            ->with(['secretaria', 'responsavel'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('equipamentos.trashed', compact('equipamentos'));
    }

    public function restore($id)
    {
        $equipamento = Equipamento::onlyTrashed()->findOrFail($id);
        $equipamento->restore();

        return redirect()
            ->route('equipamentos.trashed')
            ->with('success', 'Equipamento restaurado com sucesso!');
    }

    public function forceDelete($id)
    {
        $equipamento = Equipamento::onlyTrashed()->findOrFail($id);
        $equipamento->forceDelete();

        return redirect()
            ->route('equipamentos.trashed')
            ->with('success', 'Equipamento excluído permanentemente!');
    }

    public function buscarPorSerial(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string',
        ]);

        // Busca o equipamento pelo número de série
        $equipamento = Equipamento::with('tipo')
            ->where('numero_serie', $request->serial_number)
            ->first();

        if ($equipamento) {
            // Verifica se o equipamento está em estoque
            if ($equipamento->status === 'estoque') {
                return response()->json([
                    'equipamento' => $equipamento,
                    'message' => 'Equipamento encontrado.',
                ]);
            } else {
                // Retorna o status do equipamento se não estiver em estoque
                return response()->json([
                    'equipamento' => null,
                    'message' => 'Equipamento já está em uso.',
                    'status' => $equipamento->status,
                ], 200); // Código 200 para indicar que a requisição foi bem-sucedida, mas o equipamento não está disponível
            }
        } else {
            // Equipamento não encontrado
            return response()->json([
                'equipamento' => null,
                'message' => 'Equipamento não encontrado.',
            ], 404); // Código 404 para indicar que o equipamento não foi encontrado
        }
    }

    public function filtrar(Request $request)
    {
        $query = Equipamento::query();

        if ($request->numero_serie) {
            $query->where('numero_serie', 'like', '%' . $request->numero_serie . '%');
        }


        if ($request->tipo_id) {
            $query->where('tipo_id', $request->tipo_id);
        }

        if ($request->tipo_propriedade) {
            $query->where('tipo_propriedade', $request->tipo_propriedade);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->secretaria_id) {
            $query->where('secretaria_id', $request->secretaria_id);
        }

        $equipamentos = $query->with('tipo')->paginate(10, ['id', 'numero_serie', 'modelo', 'tipo_id', 'status', 'tipo_propriedade']);

        return response()->json($equipamentos);
    }
}

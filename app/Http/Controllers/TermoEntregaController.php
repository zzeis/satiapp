<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Movimentacoes;
use App\Models\Pessoa;
use App\Models\Secretaria;
use App\Models\TermoEntrega;
use App\Models\TermoEquipamento;
use App\Models\TipoEquipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Adicionando o import do Str
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TermoEntregaController extends Controller
{
    public function index(Request $request)
    {
        // Filtros
        $secretariaId = $request->input('secretaria');
        $search = $request->input('search');
        $status = $request->input('status'); // Novo filtro por status

        // Consulta
        $termos = TermoEntrega::with(['responsavel', 'usuario', 'secretaria', 'equipamentos'])
            ->when($secretariaId, function ($query, $secretariaId) {
                return $query->where('secretaria_id', $secretariaId);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->whereHas('responsavel', function ($q) use ($search) {
                        $q->where('nome', 'like', "%{$search}%")
                            ->orWhere('cpf', 'like', "%{$search}%");
                    })
                        ->orWhereHas('equipamentos', function ($q) use ($search) {
                            $q->where('numero_serie', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('data_entrega', 'desc')
            ->paginate(10);

        // Secretarias para o filtro
        $secretarias = Secretaria::all();

        return view('TermoEntrega.index', compact('termos', 'secretarias'));
    }

    public function create()
    {

        $tipos = TipoEquipamento::all();

        $secretarias = Secretaria::all();

        return view('TermoEntrega.create', compact('tipos', 'secretarias'));
    }

    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'equipamento_id' => 'required|array', // Array com IDs dos equipamentos selecionados
            'cpf' => 'required|string|max:14',
            'nome' => 'required|string|max:255',
            'secretaria_id' => 'required|exists:secretarias,id',
            'observacoes' => 'nullable|string',
            'arquivo_path' => 'nullable|string',
        ]);

        // Iniciar transação
        DB::beginTransaction();

        try {
            // Verificar se a pessoa já existe pelo CPF ou criar nova
            $pessoa = Pessoa::firstOrCreate(
                ['cpf' => $request->cpf],
                [
                    'nome' => $request->nome,
                    'secretaria_id' => $request->secretaria_id
                ]
            );

            // Obter os equipamentos selecionados
            $equipamentos = Equipamento::whereIn('id', $request->equipamento_id)->get();

            // Gerar o PDF
            $pdf = $this->gerarPdfTermo($pessoa, $equipamentos);

            // Definir o nome do arquivo
            $nomeArquivo = 'termo_' . Str::slug($pessoa->nome) . '_' . date('dmY_His') . '.pdf';
            $caminho = 'termos/' . $nomeArquivo;

            // Salvar o PDF em storage
            Storage::put('public/' . $caminho, $pdf->output());
            $arquivo_path = 'storage/' . $caminho;

            // Criar o Termo de Entrega
            $termoEntrega = TermoEntrega::create([
                'responsavel_id' => $pessoa->id,
                'user_id' => auth()->id(), // Usuário logado
                'secretaria_id' => $request->secretaria_id,
                'arquivo_path' => $arquivo_path,
                'observacoes' => $request->observacoes,
                'data_entrega' => Date::now()
            ]);

            // Agrupar equipamentos por tipo para calcular quantidade
            $equipamentosPorTipo = [];
            foreach ($request->equipamento_id as $equipamentoId) {
                $equipamento = Equipamento::findOrFail($equipamentoId);

                if (!isset($equipamentosPorTipo[$equipamento->tipo->id])) {
                    $equipamentosPorTipo[$equipamento->tipo->id] = [
                        'count' => 0,
                        'ids' => []
                    ];
                }

                $equipamentosPorTipo[$equipamento->tipo->id]['count']++;
                $equipamentosPorTipo[$equipamento->tipo->id]['ids'][] = $equipamentoId;

                // Atualizar status do equipamento
                $equipamento->update([
                    'responsavel_id' => $pessoa->id,
                    'status' => 'em_uso',
                    'secretaria_id' => $pessoa->secretaria_id
                ]);

                Movimentacoes::create([
                    'equipamento_id' => $equipamento->id,
                    'descricao' => 'Equipamento entregue para ' . $pessoa->nome,
                    'data' => now(),
                    'acao' => 'entrega',
                    'user_id' => auth()->id(),
                    'termo_id' => $termoEntrega->id
                ]);
            }

            // Criar registros na tabela TermoEquipamento agrupados por tipo
            foreach ($equipamentosPorTipo as $tipo => $dados) {
                foreach ($dados['ids'] as $equipamentoId) {
                    TermoEquipamento::create([
                        'termo_id' => $termoEntrega->id,
                        'equipamento_id' => $equipamentoId,
                        'quantidade' => $dados['count'] // Quantidade total deste tipo
                    ]);
                }
            }

            DB::commit();

            // Redirecionar para a view de exibição do termo criado
            return redirect()->route('termo.show', $termoEntrega->id)
                ->with('success', 'Termo de Entrega criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao criar Termo de Entrega: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Gera o PDF do Termo de Responsabilidade
     * 
     * @param Pessoa $pessoa
     * @param Collection $equipamentos
     * @return \Barryvdh\DomPDF\PDF
     */
    private function gerarPdfTermo(Pessoa $pessoa, $equipamentos)
    {
        // Você precisará ter o pacote barryvdh/laravel-dompdf instalado
        // composer require barryvdh/laravel-dompdf

        $logoPath = public_path('images/brasao.png');
        $logoBase64 = '';

        if (file_exists($logoPath)) {
            $logoBase64 = base64_encode(file_get_contents($logoPath));
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('TermoEntrega.pdf', [
            'pessoa' => $pessoa,
            'equipamentos' => $equipamentos,
            'data' => now()->format('d/m/Y'),
            'logoBase64' => $logoBase64
        ]);

        return $pdf;
    }

    /**
     * Processa a devolução dos equipamentos de um termo
     * 
     * @param TermoEntrega $termoEntrega
     * @return \Illuminate\Http\RedirectResponse
     */
    public function devolucao(TermoEntrega $termoEntrega, Request $request)
    {
        // Validar dados da devolução
        $request->validate([
            'observacoes_devolucao' => 'nullable|string',
        ]);

        // Iniciar transação
        DB::beginTransaction();

        try {
            // Buscar todos os equipamentos associados a este termo
            $termoEquipamentos = TermoEquipamento::where('termo_id', $termoEntrega->id)->get();

            // Atualizar o status de cada equipamento
            foreach ($termoEquipamentos as $termoEquipamento) {
                $equipamento = Equipamento::findOrFail($termoEquipamento->equipamento_id);

                // Atualizar status do equipamento para estoque e remover responsável
                $equipamento->update([
                    'status' => 'estoque',
                    'responsavel_id' => null
                ]);

                // Registrar movimentação de devolução
                Movimentacoes::create([
                    'equipamento_id' => $equipamento->id,
                    'descricao' => 'Equipamento devolvido por ' . $termoEntrega->responsavel->nome,
                    'data' => now(),
                    'acao' => 'devolucao',
                    'user_id' => auth()->id(),
                    'termo_id' => $termoEntrega->id
                ]);
            }

            // Atualizar o termo de entrega
            $termoEntrega->update([
                'status' => false,
                'data_devolucao' => now(),
                'observacoes' => $request->observacoes_devolucao,
                'user_devolucao_id' => auth()->id() // Usuário que registrou a devolução
            ]);

            DB::commit();

            return redirect()->route('termo.show', $termoEntrega->id)
                ->with('success', 'Devolução registrada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao registrar devolução: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(TermoEntrega $termoEntrega)
    {
        if (!$termoEntrega) {
            dd($termoEntrega);
        }



        // Carregar os relacionamentos necessários
        // Usando with() antes da consulta é mais eficiente que load() depois
        $termoEntrega = TermoEntrega::with([
            'responsavel',
            'usuario',
            'secretaria',
            'equipamentos',
            'usuarioDevolucao'
        ])
            ->findOrFail($termoEntrega->id);

        // Para debug - descomente se precisar verificar os dados
        // dd($termoEntrega->toArray());

        return view('TermoEntrega.show', compact('termoEntrega'));
    }

    public function previewPDF()
    {



        return view('TermoEntrega.pdf2');
    }
}

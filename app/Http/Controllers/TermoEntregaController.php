<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessarPdfTermo;
use App\Models\Equipamento;
use App\Models\Log;
use App\Models\Logs;
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

        $tiposEquipamento = TipoEquipamento::all();

        $secretarias = Secretaria::all();

        return view('TermoEntrega.create', compact('tiposEquipamento', 'secretarias'));
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

            // Criar o Termo de Entrega (sem arquivo_path inicialmente)
            $termoEntrega = TermoEntrega::create([
                'responsavel_id' => $pessoa->id,
                'user_id' => auth()->id(), // Usuário logado
                'secretaria_id' => $request->secretaria_id,
                'observacoes' => $request->observacoes,
                'data_entrega' => now(),
                'arquivo_path' => 'processando',
                'processado' => false // Novo campo para controlar se o PDF foi processado
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

            // Disparar o job para processar o PDF em segundo plano
            ProcessarPdfTermo::dispatch($termoEntrega->id)->onQueue('redis');

            DB::commit();

            // Redirecionar para a view de exibição do termo criado
            return redirect()->route('termo.show', $termoEntrega->id)
                ->with('success', 'Termo de Entrega criado com sucesso! O PDF está sendo gerado e estará disponível em breve.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao criar Termo de Entrega: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Verifica o status de processamento do PDF e atualiza se necessário
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verificarProcessamento(TermoEntrega $termoEntrega)
    {
        return response()->json([
            'processado' => $termoEntrega->processado,
            'arquivo_path' => asset($termoEntrega->arquivo_path),
        ]);
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

            // Remover o registro da tabela termo_equipamentos
            $termoEquipamento->delete();

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

    /**
     * Show the form for editing the specified term.
     *
     * @param  \App\Models\TermoEntrega  $termoEntrega
     * @return \Illuminate\Http\Response
     */
    public function edit(TermoEntrega $termoEntrega)
    {
        // Fetch related data needed for the form
        $secretarias = Secretaria::all();

        // Get all equipments associated with this term
        $equipamentosAssociados = $termoEntrega->equipamentos()
            ->whereNull('termo_equipamentos.deleted_at')
            ->with('tipo')
            ->get();

        // Get available equipment types for selection
        $tiposEquipamento = TipoEquipamento::all();

        return view('TermoEntrega.edit', compact('termoEntrega', 'secretarias', 'equipamentosAssociados', 'tiposEquipamento'));
    }

    /**
     * Update the specified term in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermoEntrega  $termoEntrega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermoEntrega $termoEntrega)
    {
        // Validate the form data
        $request->validate([
            'cpf' => 'required|string|max:14',
            'nome' => 'required|string|max:255',
            'secretaria_id' => 'required|exists:secretarias,id',
            'observacoes' => 'nullable|string',
            'equipamentos_atuais' => 'nullable|array',
            'equipamentos_novos' => 'nullable|array',
        ]);

        // Start transaction
        DB::beginTransaction();

        try {
            // Salvar valores originais para depois comparar o que foi alterado
            $originalPessoa = null;
            if ($termoEntrega->responsavel) {
                $originalPessoa = collect([
                    'nome' => $termoEntrega->responsavel->nome,
                    'secretaria_id' => $termoEntrega->responsavel->secretaria_id,
                    'cpf' => $termoEntrega->responsavel->cpf,
                ]);
            }

            $originalObservacoes = $termoEntrega->observacoes;

            // Update or create the person
            $pessoa = Pessoa::updateOrCreate(
                ['cpf' => $request->cpf],
                [
                    'nome' => $request->nome,
                    'secretaria_id' => $request->secretaria_id
                ]
            );

            // Update the term
            $termoEntrega->update([
                'responsavel_id' => $pessoa->id,
                'secretaria_id' => $request->secretaria_id,
                'observacoes' => $request->observacoes,
                'arquivo_path' => 'processando', // Will be updated by the job
                'processado' => false // Mark as not processed to regenerate PDF
            ]);

            // Registrar log SOMENTE de alteração de dados da pessoa ou do termo
            $alteracoes = [];

            // Verificar alterações nos dados da pessoa
            if ($originalPessoa) {
                if ($originalPessoa['nome'] != $request->nome) {
                    $alteracoes[] = "Nome alterado de '{$originalPessoa['nome']}' para '{$request->nome}'";
                }

                if ($originalPessoa['secretaria_id'] != $request->secretaria_id) {
                    $secretariaOriginal = Secretaria::find($originalPessoa['secretaria_id'])->nome ?? 'Desconhecida';
                    $secretariaNova = Secretaria::find($request->secretaria_id)->nome ?? 'Desconhecida';
                    $alteracoes[] = "Secretaria alterada de '{$secretariaOriginal}' para '{$secretariaNova}'";
                }

                if ($originalPessoa['cpf'] != $request->cpf) {
                    $alteracoes[] = "CPF alterado de '{$originalPessoa['cpf']}' para '{$request->cpf}'";
                }
            } else {
                $alteracoes[] = "Novo responsável: {$pessoa->nome}";
            }

            // Verificar alteração nas observações
            if ($originalObservacoes != $request->observacoes) {
                $alteracoes[] = "Observações atualizadas";
            }

            // Se houve alterações nos dados da pessoa ou do termo, registrar no log
            if (count($alteracoes) > 0) {
                Logs::create([
                    'acao' => 'Atualização de Termo',
                    'detalhes' => "Termo #{$termoEntrega->id}: " . implode(', ', $alteracoes),
                    'user_id' => auth()->id()
                ]);
            }

            // Handle equipment changes

            // 1. Remove equipment marked for removal
            if ($request->has('equipamentos_atuais')) {
                $currentEquipmentIds = TermoEquipamento::where('termo_id', $termoEntrega->id)
                    ->pluck('equipamento_id')
                    ->toArray();

                $keptEquipmentIds = array_keys($request->equipamentos_atuais);
                $equipmentToRemove = array_diff($currentEquipmentIds, $keptEquipmentIds);

                foreach ($equipmentToRemove as $equipamentoId) {
                    $equipamento = Equipamento::findOrFail($equipamentoId);
                    $equipamento->update([
                        'status' => 'estoque',
                        'responsavel_id' => null
                    ]);

                    // Remove the term-equipment association
                    TermoEquipamento::where('termo_id', $termoEntrega->id)
                        ->where('equipamento_id', $equipamentoId)
                        ->delete();

                    // Log the equipment removal - usando a tabela Movimentacoes
                    Movimentacoes::create([
                        'equipamento_id' => $equipamento->id,
                        'descricao' => 'Equipamento removido do termo ' . $termoEntrega->id,
                        'data' => now(),
                        'acao' => 'remocao',
                        'user_id' => auth()->id(),
                        'termo_id' => $termoEntrega->id
                    ]);
                }
            }

            // 2. Add new equipment
            if ($request->has('equipamentos_novos')) {
                $equipamentosPorTipo = [];

                foreach ($request->equipamentos_novos as $equipamentoId) {
                    if (empty($equipamentoId)) continue;

                    $equipamento = Equipamento::findOrFail($equipamentoId);

                    if (!isset($equipamentosPorTipo[$equipamento->tipo->id])) {
                        $equipamentosPorTipo[$equipamento->tipo->id] = [
                            'count' => 0,
                            'ids' => []
                        ];
                    }

                    $equipamentosPorTipo[$equipamento->tipo->id]['count']++;
                    $equipamentosPorTipo[$equipamento->tipo->id]['ids'][] = $equipamentoId;

                    // Update equipment status
                    $equipamento->update([
                        'responsavel_id' => $pessoa->id,
                        'status' => 'em_uso',
                        'secretaria_id' => $pessoa->secretaria_id
                    ]);

                    // Log the equipment addition - usando a tabela Movimentacoes
                    Movimentacoes::create([
                        'equipamento_id' => $equipamento->id,
                        'descricao' => 'Equipamento adicionado ao termo para ' . $pessoa->nome,
                        'data' => now(),
                        'acao' => 'adicao',
                        'user_id' => auth()->id(),
                        'termo_id' => $termoEntrega->id
                    ]);

                    // Create records in TermoEquipamento for new equipment
                    TermoEquipamento::create([
                        'termo_id' => $termoEntrega->id,
                        'equipamento_id' => $equipamentoId,
                        'quantidade' => 1 // Individual equipment
                    ]);
                }
            }

            // Dispatch job to process PDF in background
            ProcessarPdfTermo::dispatch($termoEntrega->id)->onQueue('redis');

            DB::commit();

            // Redirect to the term view
            return redirect()->route('termo.show', $termoEntrega->id)
                ->with('success', 'Termo de Entrega atualizado com sucesso! O PDF está sendo regenerado e estará disponível em breve.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao atualizar Termo de Entrega: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Search for equipment by different criteria
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchEquipment(Request $request)
    {
        $query = Equipamento::query();

        // Filter by type if provided
        if ($request->has('tipo_id') && !empty($request->tipo_id)) {
            $query->where('tipo_id', $request->tipo_id);
        }

        // Filter by status (usually 'estoque')
        $query->where('status', 'estoque');

        // Filter by patrimônio if provided
        if ($request->has('patrimonio') && !empty($request->patrimonio)) {
            $query->where('patrimonio', 'like', '%' . $request->patrimonio . '%');
        }

        // Filter by marca/modelo if provided
        if ($request->has('marca_modelo') && !empty($request->marca_modelo)) {
            $search = $request->marca_modelo;
            $query->where(function ($q) use ($search) {
                $q->where('marca', 'like', '%' . $search . '%')
                    ->orWhere('modelo', 'like', '%' . $search . '%');
            });
        }

        // Get results with pagination
        $equipamentos = $query->with('tipo')->paginate(10);

        return response()->json($equipamentos);
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
            'equipamentos' => function ($query) {
                $query->whereNull('termo_equipamentos.deleted_at'); // Ignora registros deletados
            },
            'usuarioDevolucao',

        ])
            ->findOrFail($termoEntrega->id);

        // Para debug - descomente se precisar verificar os dados
        // dd($termoEntrega->toArray());


        return view('TermoEntrega.show', compact('termoEntrega'));
    }
}

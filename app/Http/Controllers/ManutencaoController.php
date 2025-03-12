<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessarTrocaEquipamento;
use App\Models\Manutencao;
use App\Models\Equipamento;
use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitacaoManutencao;
use App\Models\Movimentacoes;
use Illuminate\Support\Str; // Adicionando o import do Str

use App\Models\Pessoa;
use App\Models\Secretaria;
use App\Models\TermoEntrega;
use App\Models\TipoEquipamento;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManutencaoController extends Controller
{
    public function index(Request $request)
    {
        // Query base
        $query = Manutencao::with(['equipamento', 'equipamentoNovo']);

        // Filtro por status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);

            // Quando há filtro de status, ordenar por data mais recente
            $query->orderBy('created_at', 'desc');
        } else {
            // Quando não há filtro, priorizar status 'aberto' e depois ordenar por data
            $query->orderByRaw("CASE WHEN status = 'aberto' THEN 0 ELSE 1 END")
                ->orderBy('created_at', 'desc');
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

        $tiposEquipamentos = TipoEquipamento::all();
        $secretarias = Secretaria::all();

        return view('manutencao.create', compact('tiposEquipamentos', 'secretarias'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|exists:equipamentos,numero_serie',
            'descricao_problema' => 'required|string',
            'local' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        // Busca o equipamento pelo número de série
        $equipamento = Equipamento::where('numero_serie', $request->numero_serie)->first();
        // Registra a movimentação de conclusão
        Movimentacoes::create([

            'equipamento_id' => $equipamento->id,
            'data' => Date::now(),
            'acao' => 'abertura_manutencao',
            'data_conclusao' => Date::now(),
            'descricao' => 'Solicitação de manutenção.',
        ]);
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
        Mail::to('posygame@gmail.com')->queue(
            (new SolicitacaoManutencao($manutencao))->onQueue('redis')
        );
        return redirect()->route('manutencao.index')->with('success', 'Chamado aberto com sucesso!');
    }

    // Método para concluir a manutenção
    public function concluir(Manutencao $manutencao, Request $request)
    {

        // Atualiza o status e registra a conclusão
        $manutencao->status = 'concluido';
        $manutencao->observacoes = $request->input('observacoes');
        $manutencao->save();

        // Registra a movimentação de conclusão
        Movimentacoes::create([
            'manutencao_id' => $manutencao->id,
            'equipamento_id' => $manutencao->equipamento->id,
            'data' => Date::now(),
            'acao' => 'concluido',
            'data_conclusao' => Date::now(),
            'descricao' => 'Manutenção concluída.',
        ]);

        return redirect()->route('manutencao.index')->with('success', 'Manutenção concluída com sucesso.');
    }

    // Método para retirar o equipamento para manutenção
    public function retirar(Manutencao $manutencao, Request $request)
    {
        // Validação
        if ($manutencao->status !== 'aberto') {
            return redirect()->back()->with('error', 'A manutenção não está aberta.');
        }

        // Atualiza o status para "em andamento"
        $manutencao->status = 'em_andamento';
        $manutencao->save();

        // Registra a movimentação de retirada
        Movimentacoes::create([
            'manutencao_id' => $manutencao->id,
            'equipamento_id' => $manutencao->equipamento->id,
            'data' => Date::now(),
            'acao' => 'retirada',
            'descricao' => 'Equipamento retirado para manutenção.',
        ]);



        return redirect()->route('manutencao.index')->with('success', 'Equipamento retirado para manutenção.');
    }


    public function trocar(Manutencao $manutencao, Request $request)
    {
        // Validação dos dados da requisição
        $validated = $request->validate([
            'numero_serie' => 'required|string',
            'modelo' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Obtém o equipamento antigo com seus relacionamentos
            $equipamentoAntigo = Equipamento::with(['tipo', 'responsavel', 'secretaria'])
                ->findOrFail($manutencao->equipamento_id);

            // Verifica se os dados do equipamento antigo estão completos
            if (!$equipamentoAntigo->tipo_id || !$equipamentoAntigo->secretaria_id) {
                throw new \Exception('Dados incompletos no equipamento original. Verifique tipo, responsável e secretaria.');
            }

            // Salva os dados do equipamento antigo para referência
            $dadosEquipamentoAntigo = [
                'id' => $equipamentoAntigo->id,
                'numero_serie' => $equipamentoAntigo->numero_serie,
                'modelo' => $equipamentoAntigo->modelo,
                'tipo_nome' => $equipamentoAntigo->tipo->nome ?? 'N/A',
            ];

            $jsonDadosAntigos = json_encode($dadosEquipamentoAntigo, JSON_UNESCAPED_UNICODE);
            if ($jsonDadosAntigos === false) {
                throw new \Exception('Erro ao codificar dados do equipamento antigo: ' . json_last_error_msg());
            }

            // Verifica se já existe um equipamento com este número de série
            $equipamentoExistente = Equipamento::where('numero_serie', $validated['numero_serie'])->first();

            if ($equipamentoExistente) {
                // Usa o equipamento existente
                $novoEquipamento = $equipamentoExistente;

                // Atualiza alguns dados do equipamento existente se necessário
                $novoEquipamento->update([
                    'modelo' => $validated['modelo'],
                    'local' => $equipamentoAntigo->local,
                    'tipo_id' => $equipamentoAntigo->tipo_id,
                    'responsavel_id' => $equipamentoAntigo->responsavel_id,
                    'secretaria_id' => $equipamentoAntigo->secretaria_id,
                    'status' => 'em_uso',
                ]);
            } else {
                // Cria o novo equipamento com os dados do antigo
                $novoEquipamento = new Equipamento([
                    'numero_serie' => $validated['numero_serie'],
                    'modelo' => $validated['modelo'],
                    'data_chegada' => Date::now(),
                    'local' => $equipamentoAntigo->local,
                    'tipo_id' => $equipamentoAntigo->tipo_id,
                    'responsavel_id' => $equipamentoAntigo->responsavel_id,
                    'secretaria_id' => $equipamentoAntigo->secretaria_id,
                    'status' => 'em_uso',
                ]);

                // Salva o novo equipamento e verifica se foi criado com sucesso
                if (!$novoEquipamento->save()) {
                    throw new \Exception('Falha ao salvar o novo equipamento.');
                }
            }

            // Carrega os relacionamentos para usar nos logs
            $novoEquipamento->load(['tipo', 'responsavel', 'secretaria']);

            // Encontra o termo de entrega que contém o equipamento antigo
            $termoEquipamento = DB::table('termo_equipamentos')
                ->where('equipamento_id', $equipamentoAntigo->id)
                ->whereNull('deleted_at')
                ->first();

            // Se o equipamento estiver associado a um termo de entrega
            if ($termoEquipamento) {
                // Soft delete do registro antigo
                DB::table('termo_equipamentos')
                    ->where('id', $termoEquipamento->id)
                    ->update([
                        'deleted_at' => now()
                    ]);

                // Adiciona o novo equipamento ao termo
                DB::table('termo_equipamentos')->insert([
                    'termo_id' => $termoEquipamento->termo_id,
                    'equipamento_id' => $novoEquipamento->id,
                    'quantidade' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Envia para a fila o processamento da atualização do PDF do termo

                try {
                    Log::info('Tentando despachar job', [
                        'termo_id' => $termoEquipamento->termo_id,
                        'novo_equipamento_id' => $novoEquipamento->id
                    ]);

                    ProcessarTrocaEquipamento::dispatch($termoEquipamento->termo_id, $novoEquipamento->id)->onQueue('redis');

                    Log::info('Job despachada com sucesso');
                } catch (\Exception $e) {
                    Log::error('Erro ao despachar job', [
                        'erro' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }


            // Registra a movimentação da troca
            $movimentacao = new Movimentacoes([
                'manutencao_id' => $manutencao->id,
                'equipamento_id' => $equipamentoAntigo->id,
                'equipamento_novo_id' => $novoEquipamento->id,
                'tipo' => 'troca',
                'acao' => 'troca',
                'data' => Date::now(),
                'descricao' => sprintf(
                    'Equipamento %s (Série: %s) substituído por %s (Série: %s). Tipo: %s, Responsável: %s, Secretaria: %s',
                    $equipamentoAntigo->modelo,
                    $equipamentoAntigo->numero_serie,
                    $novoEquipamento->modelo,
                    $novoEquipamento->numero_serie,
                    $equipamentoAntigo->tipo->nome ?? 'N/A',
                    $equipamentoAntigo->responsavel->nome ?? 'N/A',
                    $equipamentoAntigo->secretaria->nome ?? 'N/A'
                )
            ]);

            // Salva a movimentação e verifica se foi criada com sucesso
            if (!$movimentacao->save()) {
                throw new \Exception('Falha ao registrar a movimentação.');
            }

            // Atualiza a manutenção como concluída
            $observacaoCompleta = sprintf(
                "Manutenção concluída com troca de equipamento.\nEquipamento anterior: %s (Série: %s)\nNovo equipamento: %s (Série: %s)\nTipo: %s\nResponsável: %s\nSecretaria: %s\nObservações adicionais: %s",
                $equipamentoAntigo->modelo,
                $equipamentoAntigo->numero_serie,
                $novoEquipamento->modelo,
                $novoEquipamento->numero_serie,
                $equipamentoAntigo->tipo->nome ?? 'N/A',
                $equipamentoAntigo->responsavel->nome ?? 'N/A',
                $equipamentoAntigo->secretaria->nome ?? 'N/A',
                $validated['observacoes'] ?? 'Nenhuma'
            );

            // Preparando os dados para atualização
            $dadosAtualizacao = [
                'status' => 'concluido',
                'data_conclusao' => Date::now(),
                'observacoes' => $observacaoCompleta,
                'equipamento_novo_id' => $novoEquipamento->id,
                'dados_equipamento_antigo' => $jsonDadosAntigos
            ];

            // Atualiza a manutenção com os dados restantes
            if (!$manutencao->update($dadosAtualizacao)) {
                throw new \Exception('Falha ao atualizar o status da manutenção.');
            }

            // Soft delete do equipamento antigo
            if (!$equipamentoAntigo->delete()) {
                throw new \Exception('Falha ao realizar o soft delete do equipamento antigo.');
            }

            DB::commit();
            return redirect()
                ->route('manutencao.index')
                ->with('success', 'Equipamento trocado com sucesso. O termo de entrega será atualizado em breve.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Erro ao realizar a troca do equipamento: ' . $e->getMessage());
        }
    }


    public function update(Manutencao $manutencao, Request $request)
    {



        if (!$manutencao) {
            return redirect()->back()->with('error', 'Manutenção não encontrada.');
        }

        // Atualiza o status e as observações
        $manutencao->status = 'concluido'; // Ou outro status conforme a ação
        $manutencao->observacoes = $request->input('observacoes');
        $manutencao->save();

        // Se a ação for "troca", desativa o equipamento
        if ($request->input('action') === 'troca') {
            $equipamento = $manutencao->equipamento;
            $equipamento->ativo = false;
            $equipamento->save();
        }

        return redirect()->route('manutencao.index')->with('success', 'Manutenção atualizada com sucesso.');
    }

    public function registrarRetirada(Request $request, Manutencao $manutencao)
    {
        $request->validate([
            'data' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        dd($request);
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

    // Método para retornar detalhes da manutenção
    public function detalhes(Manutencao $manutencao)
    {


        if (!$manutencao) {
            return response()->json(['error' => 'Manutenção não encontrada'], 404);
        }

        // Remova o dd() em produção - ele é só para debug
        // dd($manutencao);

        // Verifica se existe um equipamento novo associado
        $equipamento = $manutencao->equipamento_novo_id
            ? Equipamento::find($manutencao->equipamento_novo_id)
            : $manutencao->equipamento;

        // Se não encontrar nenhum equipamento
        if (!$equipamento) {
            return response()->json(['error' => 'Equipamento não encontrado'], 404);
        }

        // Retorna os dados em JSON
        return response()->json([
            'local' => $manutencao->local,
            'tipo_equipamento' => $equipamento->tipo->nome,
            'descricao_defeito' => $manutencao->descricao_problema,
            'secretaria' => $manutencao->secretaria->nome,
        ]);
    }
    // Função para exibir detalhes da manutenção
    public function informacoes(Manutencao $manutencao)
    {
        // Carrega as relações necessárias
        // Carrega as relações necessárias, incluindo registros excluídos (soft deleted)
        $manutencao->load([
            'equipamento' => function ($query) {
                $query->withTrashed(); // Inclui equipamentos excluídos
            },
            'equipamento.responsavel',
            'equipamentoNovo' => function ($query) {
                $query->withTrashed(); // Inclui equipamentos novos excluídos
            },
            'movimentacoes',
            // 'movimentacoes.equipamento' => function ($query){
            //     $query->withTrashed();
            // },
            'movimentacoes.user',
            'user',
        ]);

        return view('manutencao.informacoes', compact('manutencao'));
    }
}

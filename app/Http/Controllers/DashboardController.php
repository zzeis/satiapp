<?php

namespace App\Http\Controllers;

use App\Exports\DashboardFullExport;

use App\Models\Equipamento;
use App\Models\Manutencao;
use App\Models\Movimentacoes;
use App\Models\Secretaria;
use App\Models\TipoEquipamento;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de equipamentos
        $totalEquipamentos = Equipamento::count();

        // Equipamentos em estoque
        $equipamentosEstoque = Equipamento::where('status', 'estoque')->count();

        // Equipamentos em uso
        $equipamentosEmUso = Equipamento::where('status', 'em_uso')->count();

        // Manutenções abertas
        $manutencoesAbertas = Manutencao::where('status', 'aberto')->count();

        // Equipamentos por secretaria
        $secretarias = Secretaria::withCount('equipamentos')->get();

        // Distribuição por tipo de equipamento
        $distribuicaoPorTipo = TipoEquipamento::withCount('equipamentos')->get();

        // Status dos equipamentos
        $statusEquipamentos = [

            'em_uso' => Equipamento::where('status', 'em_uso')->count(),
            'estoque' => Equipamento::where('status', 'estoque')->count(),
        ];


        // Atividades recentes - Modificação para incluir equipamentos soft deleted
        $atividadesRecentes = Movimentacoes::with(['equipamento' => function ($query) {
            $query->withTrashed(); // Inclui equipamentos que foram soft deleted
        }])
            ->latest()
            ->take(5)
            ->get();


        // Minhas Movimentações
        $minhasMovimentacoes = Movimentacoes::where('user_id', auth()->id())->count();

        return view('dashboard.index', compact(
            'totalEquipamentos',
            'equipamentosEstoque',
            'equipamentosEmUso',
            'manutencoesAbertas',
            'secretarias',
            'distribuicaoPorTipo',
            'statusEquipamentos',
            'atividadesRecentes',
            'minhasMovimentacoes'
        ));
    }

    /**
     * Mostra os dados de relatório + botão de exportação
     */
    public function showReport()
    {
        // Verifica se o usuário é admin
        if (!in_array(auth()->user()->nivel, [2, 3])) {
            abort(403, 'Acesso não autorizado');
        }

        // 1. Equipamentos por secretaria (computadores e notebooks)
        $equipamentosPorSecretaria = Secretaria::withCount([
            'equipamentos as computadores_count' => function ($query) {
                $query->where('tipo_id', 1); // ID 1 = computadores
            },
            'equipamentos as notebooks_count' => function ($query) {
                $query->where('tipo_id', 7); // ID 7 = notebooks
            },
            'equipamentos as impressoras_count' => function ($query) {
                $query->where('tipo_id', 6); // ID 6 = impressoras
            },
            'manutencoes'
        ])->with(['ultimaManutencao' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        // 2. Estatísticas de manutenção
        $manutencoesPorMes = Manutencao::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $mesAtualMaisManutencoes = $manutencoesPorMes->sortByDesc('total')->first();

        // 3. Secretaria com mais manutenções
        $secretariaMaisManutencoes = $equipamentosPorSecretaria->sortByDesc('manutencoes_count')->first();

        // 4. Tempo médio de resolução
        $tempoMedioDias = Manutencao::whereNotNull('data_conclusao')
            ->selectRaw('ROUND(AVG(DATEDIFF(data_conclusao, DATE(created_at))),2) as dias')
            ->first()->dias ?? 0;

        // Totais para os cards
        $totalComputadores = $equipamentosPorSecretaria->sum('computadores_count');
        $totalNotebooks = $equipamentosPorSecretaria->sum('notebooks_count');
        $totalImpressoras = $equipamentosPorSecretaria->sum('impressoras_count');


        return view('dashboard.report', compact(
            'equipamentosPorSecretaria',
            'manutencoesPorMes',
            'mesAtualMaisManutencoes',
            'secretariaMaisManutencoes',
            'tempoMedioDias',
            'totalComputadores',
            'totalNotebooks',
            'totalImpressoras'
        ));
    }

    /**
     * Exporta os dados para Excel
     */
    public function exportReport()
    {
        return Excel::download(new DashboardFullExport(), 'relatorio_ti.xlsx');
    }
}

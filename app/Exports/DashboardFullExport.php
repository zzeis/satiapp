<?php

namespace App\Exports;

use App\Models\Secretaria;
use App\Models\Manutencao;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardFullExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Resumo Geral' => new SummarySheet(),
            'Equipamentos por Secretaria' => new EquipmentsSheet(),
            'Métricas de Manutenção' => new MaintenanceSheet(),
        ];
    }
}

class SummarySheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function collection()
    {
        // Totais de equipamentos
        $totals = Secretaria::selectRaw('
            SUM(CASE WHEN tipo_id = 1 THEN 1 ELSE 0 END) as computadores,
            SUM(CASE WHEN tipo_id = 7 THEN 1 ELSE 0 END) as notebooks,
            SUM(CASE WHEN tipo_id = 6 THEN 1 ELSE 0 END) as impressoras
        ')
        ->join('equipamentos', 'secretarias.id', '=', 'equipamentos.secretaria_id')
        ->first();

        // Métricas de manutenção (agora só em dias)
        $maintenanceMetrics = Manutencao::selectRaw('
            COUNT(*) as total_manutencoes,
            AVG(DATEDIFF(data_conclusao, DATE(created_at))) as tempo_medio_dias
        ')
        ->whereNotNull('data_conclusao')
        ->first();

        return collect([
            ['Métrica', 'Valor'],
            ['Total de Computadores', $totals->computadores ?? 0],
            ['Total de Notebooks', $totals->notebooks ?? 0],
            ['Total de Impressoras', $totals->impressoras ?? 0],
            ['Tempo Médio de Resolução (dias)', round($maintenanceMetrics->tempo_medio_dias ?? 0, 1)],
            ['Total de Manutenções', $maintenanceMetrics->total_manutencoes ?? 0],
            
            // Adicionando métricas adicionais
            ['Secretaria com mais computadores', $this->getSecretariaComMaisEquipamentos(1)],
            ['Secretaria com mais notebooks', $this->getSecretariaComMaisEquipamentos(7)],
            ['Mês com mais manutenções', $this->getMesComMaisManutencoes()],
        ]);
    }

    protected function getSecretariaComMaisEquipamentos($tipoId)
    {
        $secretaria = Secretaria::select('secretarias.nome')
            ->selectRaw('COUNT(equipamentos.id) as total')
            ->join('equipamentos', 'secretarias.id', '=', 'equipamentos.secretaria_id')
            ->where('equipamentos.tipo_id', $tipoId)
            ->groupBy('secretarias.id', 'secretarias.nome')
            ->orderByDesc('total')
            ->first();

        return $secretaria ? "{$secretaria->nome} ({$secretaria->total})" : 'N/A';
    }

    protected function getMesComMaisManutencoes()
    {
        $mes = Manutencao::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->orderByDesc('total')
            ->first();

        $meses = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];

        return $mes ? "{$meses[$mes->mes]} ({$mes->total})" : 'N/A';
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return 'Resumo Geral';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Cabeçalho em negrito
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'EFEFEF']
                ]
            ],
            
            // Linhas de totais em negrito
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            4 => ['font' => ['bold' => true]],
            
            // Formatação condicional para métricas importantes
            'B5' => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'E74C3C']
                ]
            ],
            
            // Borda inferior após os totais
            5 => [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ]
        ];
    }
}

class EquipmentsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function collection()
    {
        return Secretaria::withCount([
            'equipamentos as computadores_count' => fn($q) => $q->where('tipo_id', 1),
            'equipamentos as notebooks_count' => fn($q) => $q->where('tipo_id', 7),
            'equipamentos as impressoras_count' => fn($q) => $q->where('tipo_id', 6),
            'manutencoes'
        ])
            ->orderBy('nome')
            ->get()
            ->map(function ($secretaria) {
                return [
                    'Secretaria' => $secretaria->nome,
                    'Computadores' => $secretaria->computadores_count,
                    'Notebooks' => $secretaria->notebooks_count,
                    'Impressoras' => $secretaria->impressoras_count,
                    'Total de Equipamentos' => $secretaria->computadores_count +
                        $secretaria->notebooks_count +
                        $secretaria->impressoras_count,
                    'Manutenções' => $secretaria->manutencoes_count
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Secretaria',
            'Computadores',
            'Notebooks',
            'Impressoras',
            'Total de Equipamentos',
            'Manutenções'
        ];
    }

    public function title(): string
    {
        return 'Equipamentos por Secretaria';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

class MaintenanceSheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function collection()
    {
        // Média por secretaria EM DIAS
        $secretarias = Secretaria::select(['secretarias.id', 'secretarias.nome'])
            ->selectRaw('COUNT(manutencaos.id) as total_manutencaos')
            ->selectRaw('AVG(DATEDIFF(manutencaos.data_conclusao, DATE(manutencaos.created_at))) as tempo_medio_dias')
            ->join('manutencaos', 'manutencaos.secretaria_id', '=', 'secretarias.id')
            ->whereNotNull('manutencaos.data_conclusao')
            ->groupBy('secretarias.id', 'secretarias.nome')
            ->orderBy('secretarias.nome')
            ->get()
            ->map(function ($secretaria) {
                return [
                    'Secretaria' => $secretaria->nome,
                    'Manutenções' => $secretaria->total_manutencoes,
                    'Tempo Médio (dias)' => round($secretaria->tempo_medio_dias, 2)
                ];
            });

        // Média geral
        $geral = DB::table('manutencaos')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(DATEDIFF(data_conclusao, DATE(created_at))) as tempo_medio_dias')
            ->whereNotNull('data_conclusao')
            ->first();

        $secretarias->push([
            'Secretaria' => 'GERAL',
            'Manutenções' => $geral->total ?? 0,
            'Tempo Médio (dias)' => round($geral->tempo_medio_dias ?? 0, 2)
        ]);

        return $secretarias;
    }

    public function headings(): array
    {
        return [
            'Secretaria',
            'Total de Manutenções',
            'Tempo Médio (dias)'
        ];
    }
    public function title(): string
    {
        return 'Métricas de Manutenção';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A' . ($sheet->getHighestRow()) => ['font' => ['bold' => true]],
        ];
    }
}

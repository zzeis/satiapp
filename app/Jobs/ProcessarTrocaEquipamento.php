<?php

namespace App\Jobs;

use App\Models\Equipamento;
use App\Models\TermoEntrega;
use App\Models\Pessoa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessarTrocaEquipamento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $termoId;
    protected $novoEquipamentoId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($termoId, $novoEquipamentoId)
    {
        $this->termoId = $termoId;
        $this->novoEquipamentoId = $novoEquipamentoId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Localiza o termo associado para atualizar o PDF

        Log::info('Iniciando processamento da troca de equipamento', [
            'termo_id' => $this->termoId,
            'novo_equipamento_id' => $this->novoEquipamentoId
        ]);
        $termo = TermoEntrega::find($this->termoId);
        
        if (!$termo) {
            return;
        }
        
        // Busca os equipamentos associados ao termo para gerar o PDF
        $equipamentosDoTermo = Equipamento::whereHas('termos', function ($query) use ($termo) {
            $query->where('termo_id', $termo->id)
                ->whereNull('deleted_at');
        })->get();

        // Busca a pessoa responsável pelo termo
        $pessoaResponsavel = $termo->responsavel;

        // Gera o PDF do termo com os dados corretos
        $pdf = $this->gerarPdfTermo($pessoaResponsavel, $equipamentosDoTermo);

        // Definir o nome do arquivo
        $nomeArquivo = 'termo_' . Str::slug($pessoaResponsavel->nome) . '_' . date('dmY_His') . '.pdf';
        $caminho = 'termos/' . $nomeArquivo;

        // Salvar o PDF em storage
        Storage::put('public/' . $caminho, $pdf->output());
        $arquivo_path = 'storage/' . $caminho;

        // Atualiza o caminho do PDF no registro do termo
        $termo->update(['arquivo_path' => $arquivo_path]);
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
}
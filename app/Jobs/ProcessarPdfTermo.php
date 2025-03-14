<?php

namespace App\Jobs;

use App\Models\Pessoa;
use App\Models\Equipamento;
use App\Models\TermoEntrega;
use App\Models\TermoEquipamento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ProcessarPdfTermo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $termoId;

 
    public $timeout = 300; // 5 minutos
    public $tries = 3; // Número máximo de tentativas
    public $backoff = [30, 60, 120]; 
    /**
     * Create a new job instance.
     *
     * @param int $termoId
     * @return void
     */
    public function __construct(string $termoId)
    {
        $this->termoId = $termoId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        ini_set('memory_limit', '512M');
        // Buscar o termo de entrega

        Log::info('Iniciando geração de PDF para termo: ' . $this->termoId);
        $termoEntrega = TermoEntrega::findOrFail($this->termoId);
        $pessoa = Pessoa::findOrFail($termoEntrega->responsavel_id);
        
        // Buscar os equipamentos associados ao termo
        $equipamentosIds = TermoEquipamento::where('termo_id', $this->termoId)
            ->pluck('equipamento_id')
            ->toArray();
        
        $equipamentos = Equipamento::whereIn('id', $equipamentosIds)->get();
        
        // Gerar o PDF
        $pdf = $this->gerarPdfTermo($pessoa, $equipamentos);

        // Definir o nome do arquivo
        $nomeArquivo = 'termo_' . Str::slug($pessoa->nome) . '_' . date('dmY_His') . '.pdf';
        $caminho = 'termos/' . $nomeArquivo;

        // Salvar o PDF em storage
        Storage::put('public/' . $caminho, $pdf->output());
        $arquivo_path = 'storage/' . $caminho;

        // Atualizar o caminho do arquivo no termo de entrega
        $termoEntrega->update([
            'arquivo_path' => $arquivo_path,
            'processado' => true
        ]);
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

        $pdf = Pdf::loadView('TermoEntrega.pdf', [
            'pessoa' => $pessoa,
            'equipamentos' => $equipamentos,
            'data' => now()->format('d/m/Y'),
            'logoBase64' => $logoBase64
        ]);

        return $pdf;
    }
}
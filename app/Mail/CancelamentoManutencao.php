<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Manutencao;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelamentoManutencao extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $manutencao;

    public function __construct(Manutencao $manutencao)
    {
        $this->manutencao = $manutencao;
    }

    public function build()
    {
        return $this->subject('Cancelamento de Manutenção')
            ->view('emails.cancelamento_manutencao'); // View que criaremos
    }
}

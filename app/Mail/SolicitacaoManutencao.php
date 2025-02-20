<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Manutencao;

class SolicitacaoManutencao extends Mailable
{
    use Queueable, SerializesModels;

    public $manutencao;

    public function __construct(Manutencao $manutencao)
    {
        $this->manutencao = $manutencao;
    }

    public function build()
    {
        return $this->subject('Solicitação de Manutenção')
                    ->view('emails.solicitacao_manutencao');
    }
}
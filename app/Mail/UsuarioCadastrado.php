<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioCadastrado extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private User $user
    ) {
    }

    public function build()
    {
        return $this
            ->subject('Bem Vindo(a) ao E-Diaristas')
            ->from('nao-responda@e-diaristas.com.br', "E-Diaristas")
            ->view('email.mensagens.cadastro', [
                'usuario' => $this->user
            ]);
    }
}

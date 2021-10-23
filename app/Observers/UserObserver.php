<?php

namespace App\Observers;

use App\Mail\UsuarioCadastrado;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    // Define a reputação antes de criar o Usuário;
    public function creating(User $user): void
    {
        if (User::count() === 0) {
            $user->reputacao = 5;

            return;
        }

        $user->reputacao = User::avg('reputacao');
    }

    // Envio do E-mail de boas vindas para o Usuário 
    public function created(User $user): void
    {
        Mail::to($user->email)->send(new UsuarioCadastrado($user));
    }
}

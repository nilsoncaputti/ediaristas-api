<?php

namespace App\Checkers\Diaria;

use App\Models\Diaria;
use Illuminate\Validation\ValidationException;

class ValidaStatusDiaria
{
    // Verifica o status de uma diária   
    public function executar(Diaria $diaria, int $status): void
    {
        if ($diaria->status != $status) {
            throw ValidationException::withMessages([
                'status-diaria' => "Só é possível executar essa ação com diarias com status $status"
            ]);
        }
    }
}

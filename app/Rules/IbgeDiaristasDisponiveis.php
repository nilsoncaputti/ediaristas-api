<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class IbgeDiaristasDisponiveis implements Rule
{
    public function passes($attribute, $value)
    {
        $diaristas = User::diaristasDisponivelCidade($value);

        return $diaristas->isNotEmpty();
    }

    public function message()
    {
        return 'Não existem diaristas que atendem a essa localidade';
    }
}

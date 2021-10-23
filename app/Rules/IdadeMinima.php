<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdadeMinima implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $hoje = new \DateTime;
        $quantidadeAnos = $hoje->diff(new \DateTime($value))->y;

        return $quantidadeAnos >= 18;
    }

    public function message()
    {
        return 'É necessário ter mais de 18 anos para se cadstrar na plataforma.';
    }
}

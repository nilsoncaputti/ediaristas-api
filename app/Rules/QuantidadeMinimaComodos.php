<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class QuantidadeMinimaComodos implements Rule
{
    public function __construct(
        private Request $request
    ) {
    }

    public function passes($attribute, $value)
    {
        $totalComodos = 0;

        $totalComodos += $this->request->quantidade_quartos;
        $totalComodos += $this->request->quantidade_salas;
        $totalComodos += $this->request->quantidade_cozinhas;
        $totalComodos += $this->request->quantidade_banheiros;
        $totalComodos += $this->request->quantidade_quintais;
        $totalComodos += $this->request->quantidade_outros;

        return $totalComodos > 0;
    }

    public function message()
    {
        return 'A diária deve ter ao menos 1 cômodo selecionado';
    }
}

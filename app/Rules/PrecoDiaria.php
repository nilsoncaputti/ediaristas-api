<?php

namespace App\Rules;

use App\Models\Servico;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class PrecoDiaria implements Rule
{
    public function __construct(
        private Request $request
    ) {
    }

    public function passes($attribute, $value)
    {
        $servico = Servico::find($this->request->servico);

        if (!$servico) {
            return false;
        }

        $total = 0;
        $total += $this->request->quantidade_salas * $servico->valor_sala;
        $total += $this->request->quantidade_quartos * $servico->valor_quarto;
        $total += $this->request->quantidade_cozinhas * $servico->valor_cozinha;
        $total += $this->request->quantidade_banheiros * $servico->valor_banheiro;
        $total += $this->request->quantidade_quintais * $servico->valor_quintal;
        $total += $this->request->quantidade_outros * $servico->valor_outros;

        if ($value == $servico->valor_minimo && $total < $servico->valor_minimo) {
            return true;
        }

        return $total === $value;
    }

    public function message()
    {
        return 'O preço informado para a diária está incorreto para o tipo do serviço';
    }
}

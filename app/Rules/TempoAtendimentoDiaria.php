<?php

namespace App\Rules;

use App\Models\Servico;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class TempoAtendimentoDiaria implements Rule
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
        $total += $this->request->quantidade_salas * $servico->horas_sala;
        $total += $this->request->quantidade_quartos * $servico->horas_quarto;
        $total += $this->request->quantidade_cozinhas * $servico->horas_cozinha;
        $total += $this->request->quantidade_banheiros * $servico->horas_banheiro;
        $total += $this->request->quantidade_quintais * $servico->horas_quintal;
        $total += $this->request->quantidade_outros * $servico->horas_outros;

        return $total === $value;
    }

    public function message()
    {
        return 'O tempo de atendimneto informado para a diária está incorreto para o tipo de serviço';
    }
}

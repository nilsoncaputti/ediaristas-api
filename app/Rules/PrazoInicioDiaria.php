<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class PrazoInicioDiaria implements Rule
{
    public function passes($attribute, $value)
    {
        $dataHoraInicioDiaria = Carbon::parse($value);
        $dataInicioMinima = Carbon::now()->addHours(48);

        return $dataHoraInicioDiaria > $dataInicioMinima;
    }

    public function message()
    {
        return 'A data de atendimento deve ser maior que 48 horas da data atual';
    }
}

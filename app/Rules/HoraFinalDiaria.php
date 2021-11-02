<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class HoraFinalDiaria implements Rule
{
    public function __construct(
        private Request $request
    ) {
    }

    public function passes($attribute, $value)
    {
        $inicioAtendimento = CarbonImmutable::parse($this->request->data_atendimento);

        $finalAtendimento = $inicioAtendimento->addHours($value);

        $limiteHorarioParaAtendimento = $inicioAtendimento->setHour(22)->setMinute(0);

        return $finalAtendimento <= $limiteHorarioParaAtendimento;
    }

    public function message()
    {
        return 'A hora de fim da diária deve ser antes das 22:00pm';
    }
}

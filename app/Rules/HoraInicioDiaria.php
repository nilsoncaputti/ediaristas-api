<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class HoraInicioDiaria implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $hora = Carbon::parse($value)->hour;

        return $hora >= 6;
    }

    public function message()
    {
        return 'A hora de início deve ser maior ou igual a 06:00am';
    }
}

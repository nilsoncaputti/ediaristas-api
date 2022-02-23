<?php

namespace App\Actions\Diaria;

use Carbon\Carbon;
use App\Models\Diaria;
use Illuminate\Support\Facades\Gate;
use App\Checkers\Diaria\ValidaStatusDiaria;
use Illuminate\Validation\ValidationException;

class ConfirmarPresenca
{
    function __construct(
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    // Confirma a presença do(a) diarista no local de atendimento na data correta
    public function executar(Diaria $diaria): bool
    {
        Gate::authorize('tipo-cliente');
        Gate::authorize('dono-diaria', $diaria);
        $this->validaStatusDiaria->executar($diaria, 3);

        $this->validaDataAtendimento($diaria);

        $diaria->status = 4;
        return $diaria->save();
    }

    // Valida se a data atual é menor do que a data de atendimento 
    private function validaDataAtendimento(Diaria $diario): void
    {
        $dataAtendimento = Carbon::parse($diario->data_atendimento);
        $agora = Carbon::now();

        if ($agora < $dataAtendimento) {
            throw ValidationException::withMessages([
                'data_atendimento' => 'Só é possível confirmar a presença após a data de atendimento'
            ]);
        }
    }
}

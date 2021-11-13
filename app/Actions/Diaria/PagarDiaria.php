<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PagarDiaria
{
    // Executa o pagamento da diária
    public function executar(Diaria $diaria, string $cardHash): bool
    {
        $this->validaStatusDiaria($diaria);
        Gate::authorize('tipo-cliente');
        Gate::authorize('dono-diaria', $diaria);

        //integração com gateway de pagamento

        return $diaria->pagar();
    }

    // Valida se o status da diária é igual a 1
    private function validaStatusDiaria(Diaria $diaria): void
    {
        if ($diaria->status != 1) {
            throw ValidationException::withMessages([
                'status-diaria' => 'Só é possível executar essa ação com diarias com status 1'
            ]);
        }
    }
}

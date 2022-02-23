<?php

namespace App\Http\Controllers\Diaria;

use App\Models\Diaria;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diaria\ConfirmarPresenca;

class ConfirmaPresenca extends Controller
{
    function __construct(
        private ConfirmarPresenca $confirmaPresenca
    ) {
    }

    // Confirma a presença do(a) diarista no local de atendimento na data correta
    public function __invoke(Diaria $diaria): JsonResponse
    {
        $this->confirmaPresenca->executar($diaria);

        return resposta_padrao('Presença do(a) diarista confirmada com sucesso', 'success', 200);
    }
}

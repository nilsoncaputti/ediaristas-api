<?php

namespace App\Http\Controllers\Diaria;

use App\Models\Diaria;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diaria\EscolheDiarista\CandidatarDiarista;

class CandidataDiarista extends Controller
{
    public function __construct(
        private CandidatarDiarista $candidatarDiarista
    ) {
    }

    // Candaidata um diarista para realizar uma diária
    public function __invoke(Diaria $diaria): JsonResponse
    {
        $this->candidatarDiarista->executar($diaria);

        return resposta_padrao('Ação executada com sucesso!', 'success', 200);
    }
}

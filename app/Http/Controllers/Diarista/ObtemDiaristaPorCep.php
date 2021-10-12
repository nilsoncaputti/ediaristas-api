<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Requests\CepRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Http\Resources\DiaristaPublicoCollection;

class ObtemDiaristaPorCep extends Controller
{
    public function __construct(
        private ObterDiaristasPorCEP $obterDiaristasPorCEP
    ) {
    }

    // Busca diaristas pelo CEP
    public function __invoke(CepRequest $request): DiaristaPublicoCollection|JsonResponse
    {
        [$diaristasCollection, $quantidadeDiaristas] = $this->obterDiaristasPorCEP->executar($request->cep);

        return new DiaristaPublicoCollection(
            $diaristasCollection,
            $quantidadeDiaristas
        );
    }
}

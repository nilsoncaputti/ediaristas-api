<?php

namespace App\Http\Controllers\Diarista;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Http\Resources\DiaristaPublicoCollection;

class ObtemDiaristaPorCep extends Controller
{
    // Busca diaristas pelo CEP
    public function __invoke(Request $request, ConsultaCEPInterface $servicoCEP): DiaristaPublicoCollection|JsonResponse
    {
        $dados = $servicoCEP->buscar($request->cep ?? '');

        if ($dados === false) {
            return response()->json(['erro' => 'CEP Inválido!'], 400);
        }

        return new DiaristaPublicoCollection(
            User::diaristasDisponivelCidade($dados->ibge),
            User::diaristasDisponivelCidadeTotal($dados->ibge)
        );
    }
}

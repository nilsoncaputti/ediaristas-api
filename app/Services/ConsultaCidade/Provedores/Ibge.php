<?php

namespace App\Services\ConsultaCidade\Provedores;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Services\ConsultaCidade\CidadeResponse;
use App\Services\ConsultaCidade\ConsultaCidadeInterface;

class Ibge implements ConsultaCidadeInterface
{
    // Busca um código do IBGE na API
    public function codigoIBGE(int $codigo): CidadeResponse
    {
        $url = sprintf(
            "https://servicodados.ibge.gov.br/api/v1/localidades/municipios/%s",
            $codigo,
        );

        $response = Http::get($url)->throw();
        $dados = $response->json();

        if ($dados === []) {
            throw ValidationException::withMessages([
                'codigo_ibge' => 'Código do IBGE inválido'
            ]);
        }

        return $this->populaCidadeResponse($dados);
    }

    // Define os dados no objeto de cidade
    private function populaCidadeResponse(array $dados): CidadeResponse
    {
        return new CidadeResponse(
            $dados['id'],
            $dados['nome'],
            $dados['microrregiao']['mesorregiao']['UF']['sigla']
        );
    }
}

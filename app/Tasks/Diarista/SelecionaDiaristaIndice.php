<?php

namespace App\Tasks\Diarista;

use App\Models\Diaria;
use App\Services\ConsultaDistancia\ConsultaDistanciaInterface;

class SelecionaDiaristaIndice
{
    public function __construct(
        private ConsultaDistanciaInterface $consultaDistancia
    ) {
    }

    public function executar(Diaria $diaria): int
    {
        $maiorIndice = 0;

        // Retorna o ID da melhor candidata para a diária
        foreach ($diaria->candidatas as $candidata) {
            try {
                //a distancia entre a casa do candidato e a casa do cliente
                $distancia = $this->consultaDistancia->distanciaEntreDoisCeps(
                    $candidata->candidata->enderecoDiarista->cep,
                    $diaria->cep
                );
            } catch (\Throwable $th) {
                continue;
            }

            //a reputação do candidato
            $reputacao = $candidata->candidata->reputacao;

            //fazer o calculo do indice do melhor candidato
            $indiceCandidataAtual = ($reputacao - ($distancia->distanciaEmQuilometros / 10)) / 2;

            if ($indiceCandidataAtual > $maiorIndice) {
                $diaristaEscolhidaId = $candidata->candidata->id;
                $maiorIndice = $indiceCandidataAtual;
            }
        }

        return $diaristaEscolhidaId;
    }
}

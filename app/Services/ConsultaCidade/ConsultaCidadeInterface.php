<?php

namespace App\Services\ConsultaCidade;

interface ConsultaCidadeInterface
{
    // Busca um código do IBGE na API
    public function codigoIBGE(int $codigo): CidadeResponse;
}

<?php

namespace App\Services\ConsultaCidade;

class CidadeResponse
{
    // Define as propriedades e os dados da classe 
    function __construct(
        public int $codigoIbge,
        public string $nome,
        public string $estado
    ) {
    }
}

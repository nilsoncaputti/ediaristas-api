<?php

namespace App\Services\ConsultaDistancia;

class EnderecoNaoEncontratoException extends \Exception
{
    function __construct()
    {
        parent::__construct('Endereço não encontrado na hora do cálculo', 1);
    }
}

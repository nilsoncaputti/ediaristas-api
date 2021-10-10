<?php

namespace App\Services\ConsultaCEP;

interface ConsultaCEPInterface
{
    // Define o padrão para o serviço para buscade endereço a partir do CEP 
    public function buscar(string $cep): false|EnderecoResponse;
}

<?php

namespace App\Actions\Diarista;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Services\ConsultaCEP\ConsultaCEPInterface;

class ObterDiaristasPorCEP
{
    public function __construct(
        private ConsultaCEPInterface $servicoCEP
    ) {
    }

    // Busca diaristas a partir de um CEP
    public function executar(string $cep): array
    {
        $dados = $this->servicoCEP->buscar($cep);

        if ($dados === false) {
            throw ValidationException::withMessages(['cep' => 'Cep não encontrado']);
        }

        return [
            User::diaristasDisponivelCidade($dados->ibge),
            User::diaristasDisponivelCidadeTotal($dados->ibge)
        ];
    }
}

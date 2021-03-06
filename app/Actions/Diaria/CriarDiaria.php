<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\ConsultaCidade\ConsultaCidadeInterface;

class CriarDiaria
{
    function __construct(
        private ConsultaCidadeInterface $consultaCidade
    ) {
    }

    // Cria a diária no banco de dados
    public function executar(array $dados): Diaria
    {
        Gate::authorize('tipo-cliente');

        $this->consultaCidade->codigoIBGE($dados['codigo_ibge']);

        $dados['status'] = 1;
        $dados['servico_id'] = $dados['servico'];
        $dados['valor_comissao'] = $this->calculaComissao($dados);
        $dados['cliente_id'] = Auth::user()->id;

        return Diaria::create($dados);
    }

    // Calcula o valor da comissão da plataforma
    private function calculaComissao(array $dados): float
    {
        $servico = Servico::find($dados['servico_id']);

        $porcentagem = $servico->porcentagem / 100;

        return $dados['preco'] * $porcentagem;
    }
}

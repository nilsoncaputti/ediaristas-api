<?php

namespace App\Http\Hateoas;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Diaria extends HateoasBase implements HateoasInterface
{
    // Retorna os links do Hateoas para a diária
    public function links(?Model $diaria): array
    {
        $this->adicionaLink('GET', 'self', 'diarias.show', ['diaria' => $diaria->id]);

        $this->linkPagar($diaria);
        $this->linkConfirmar($diaria);

        return $this->links;
    }

    // Adiciona o link de pagamento na diária
    private function linkPagar(Model $diaria): void
    {
        if ($diaria->status == 1) {
            $this->adicionaLink(
                'POST',
                'pagar_diaria',
                'diarias.pagar',
                ['diaria' => $diaria->id]
            );
        }
    }

    // Confirmar a presença do(a) diarista
    private function linkConfirmar(Model $diaria): void
    {
        $depoisDataAtendimento = Carbon::now() > Carbon::parse($diaria->data_atendimento);
        $diariaConfirmada = $diaria->status == 3;
        $usuarioTipoCliente = Auth::user()->tipo_usuario == 1;

        if ($depoisDataAtendimento && $diariaConfirmada && $usuarioTipoCliente) {
            $this->adicionaLink('PATCH', 'confirmar_diarista', 'diarias.confirmar', [
                'diaria' => $diaria->id
            ]);
        }
    }
}

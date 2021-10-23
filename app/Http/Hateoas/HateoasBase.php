<?php

namespace App\Http\Hateoas;

class HateoasBase
{
    // Links do hateoas
    protected array $links = [];

    // Adiciona um link no hateoas
    protected function adicionaLink(
        string $metodo,
        string $descricao,
        string $nomeRota,
        array $parametrosRota = []
    ) {
        $this->links[] = [
            "type" => $metodo,
            "rel" => $descricao,
            "uri" => route($nomeRota, $parametrosRota)
        ];
    }
}

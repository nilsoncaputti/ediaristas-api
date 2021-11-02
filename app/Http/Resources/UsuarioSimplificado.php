<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioSimplificado extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "nome_completo" => $this->nome_completo,
            "nascimento" => $this->nascimento,
            "telefone" => $this->telefone,
            "reputacao" => $this->reputacao,
            "tipo_usuario" => $this->tipo_usuario,
            "foto_usuario" => ''
        ];
    }
}

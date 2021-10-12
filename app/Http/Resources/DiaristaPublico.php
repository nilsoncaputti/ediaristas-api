<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiaristaPublico extends JsonResource
{
    // Define os dados retornados para cada diarista
    public function toArray($request): array
    {
        return [
            'nome_completo' => $this->nome_completo,
            'reputacao' => $this->reputacao,
            'foto_usuario' => $this->foto_usuario,
            'cidade' => 'São Paulo',
        ];
    }
}

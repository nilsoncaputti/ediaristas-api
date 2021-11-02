<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends HateoasBase implements HateoasInterface
{
    // Retorna os links do Hateoas para o Usuário
    public function links(?Model $usuario): array
    {
        if ($usuario->tipo_usuario === 1) {
            $this->adicionaLink('POST', 'cadastrar_diaria', 'diarias.store');
        }

        return $this->links;
    }
}

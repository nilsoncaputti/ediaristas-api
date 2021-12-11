<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends HateoasBase implements HateoasInterface
{
    // Retorna os links do Hateoas para o Usuário
    public function links(?Model $usuario): array
    {
        $this->adicionaLink('GET', 'lista_diarias', 'diarias.index');

        $this->linksDoCliente($usuario);

        return $this->links;
    }

    // Adiciona os links específicos do usuário do tipo cliente
    private function linksDoCliente(Model $usuario): void
    {
        if ($usuario->tipo_usuario === 1) {
            $this->adicionaLink('POST', 'cadastrar_diaria', 'diarias.store');
        }
    }
}

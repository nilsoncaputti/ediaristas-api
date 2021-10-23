<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServicoCollection extends ResourceCollection
{
    // Define a coleção de serviços
    public function toArray($request)
    {
        return $this->collection;
    }
}

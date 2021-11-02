<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\CriarDiaria;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiariaRequest;
use App\Http\Resources\Diaria;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index()
    {
        //
    }

    // Grava uma nova diária no banco de dados 
    public function store(DiariaRequest $request, CriarDiaria $criarDiaria)
    {
        $diaria = $criarDiaria->executar($request->all());

        return response(new Diaria($diaria), 201);
    }

    public function show($id)
    {
        //
    }
}

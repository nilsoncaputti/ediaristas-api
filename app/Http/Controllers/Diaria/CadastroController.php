<?php

namespace App\Http\Controllers\Diaria;

use App\Http\Resources\Diaria;
use App\Actions\Diaria\CriarDiaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiariaRequest;
use App\Models\Diaria as ModelDiaria;
use App\Http\Resources\DiariaCollection;

class CadastroController extends Controller
{
    // Lista as diárias do usuário logado
    public function index()
    {
        $usuario = Auth::user();

        $diarias = ModelDiaria::todasDoUsuario($usuario);

        return new DiariaCollection($diarias);
    }

    // Grava uma nova diária no banco de dados 
    public function store(DiariaRequest $request, CriarDiaria $criarDiaria)
    {
        $diaria = $criarDiaria->executar($request->all());

        return response(new Diaria($diaria), 201);
    }

    // Mostra uma diária por ID
    public function show(ModelDiaria $diaria)
    {
        Gate::authorize('dono-diaria', $diaria);

        return new Diaria($diaria);
    }
}

<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Collection;

class PegarOportunidades
{
    // Obtém a lista de oportunidades para o diarista logado
    public function executar(): Collection
    {
        Gate::authorize('tipo-diarista');

        $diarista = Auth::user();

        return Diaria::oportunidadesPorCidade($diarista);
    }
}

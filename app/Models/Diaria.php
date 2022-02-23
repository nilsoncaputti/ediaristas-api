<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection as SupportCollection;

class Diaria extends Model
{
    use HasFactory;

    // Campos bloqueados na definição de dados em massa 
    protected $guarded = ['motivo_cancelamento', 'created_at', 'updated_at'];

    // Define a relação com serviço
    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }

    // Define a relação com cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // Define a relação com diarista
    public function diarista(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diarista_id');
    }

    // Define a relação com os candidatos a realizar a diária
    public function candidatas()
    {
        return $this->hasMany(CandidatasDiaria::class);
    }

    // Define o status da Diária como pago
    public function pagar(): bool
    {
        $this->status = 2;

        return $this->save();
    }

    // Retornas as diárias do usuário
    static public function todasDoUsuario(User $usuario): Collection
    {
        return self::when($usuario->tipo_usuario === 1, function ($q) use ($usuario) {
            $q->where('cliente_id', $usuario->id);
        })
            ->when($usuario->tipo_usuario === 2, function ($q) use ($usuario) {
                $q->where('diarista_id', $usuario->id);
            })
            ->get();
    }

    // Define um candidato(a) para a diária
    public function defineCandidato(int $diaristaId)
    {
        return $this->candidatas()->create([
            'diarista_id' => $diaristaId
        ]);
    }

    // Define o diarista para realizar a diária e confirma e muda o status da diária para confirmado
    public function confirmar(int $diaristaId): bool
    {
        $this->diarista_id = $diaristaId;
        $this->status = '3';

        return $this->save();
    }

    // Retorna a lista de oportunidade para o diarista
    static public function oportunidadesPorCidade(User $diarista): SupportCollection
    {
        $cidadesAtendidasPeloDiarista = $diarista->cidadesAtendidasDiarista();

        return self::where('status', '2')
            ->whereIn('codigo_ibge', $cidadesAtendidasPeloDiarista)
            ->has('candidatas', '<', 3)
            ->whereDoesntHave('candidatas', function (Builder $query) use ($diarista) {
                $query->where('diarista_id', $diarista->id);
            })
            ->get();
    }

    // Retorna todas as diárias pagas com mais de 24 horas de criação 
    static public function pagasComMaisDe24Horas(): Collection
    {
        return self::where('status', 2)
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->with('candidatas', 'candidatas.candidata.enderecoDiarista')
            ->withCount('candidatas')
            ->get();
    }
}

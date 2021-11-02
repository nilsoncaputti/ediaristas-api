<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nome_completo',
        'cpf',
        'nascimento',
        'foto_documento',
        'telefone',
        'tipo_usuario',
        'chave_pix',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tipo_usuario' => 'int'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //Define a relação com as cidades atendidas pelo(a) diarista.
    public function cidadesAtendidas(): BelongsToMany
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    // Escopo que filtra os(as) diaristas
    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario', 2);
    }

    // Escopo que filtra os(as) diaristas por código do IBGE
    public function scopeDiaristasAtendeCidade(Builder $query, int $codigoIbge): Builder
    {
        return $query->diarista()->whereHas('cidadesAtendidas', function ($q) use ($codigoIbge) {
            $q->where('codigo_ibge', $codigoIbge);
        });
    }

    // Busca 6 diaristas por código do IBGE
    static public function diaristasDisponivelCidade(int $codigoIbge): Collection
    {
        return User::diaristasAtendeCidade($codigoIbge)->limit(6)->get();
    }

    // Retorna a quantidade de diaristas por código do IBGE
    static public function diaristasDisponivelCidadeTotal(int $codigoIbge): int
    {
        return User::diaristasAtendeCidade($codigoIbge)->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidatasDiaria extends Model
{
    use HasFactory;

    // Define os campos permitidos na definição de dados em massa
    protected $fillable = ['diarista_id', 'diaria_id'];

    // Define o nome da tabela do Model
    protected $table = 'candidatas_diaria';

    // Define a relação com o Candidato para realizar a Diária
    public function candidata()
    {
        return $this->belongsTo(User::class, 'diarista_id');
    }
}

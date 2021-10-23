<?php

namespace App\Http\Requests;

use App\Rules\IdadeMinima;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioCadastroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $regras = [
            "nome_completo" => ["required", "min:5", "max:255"],
            "cpf" => ["required", "unique:users,cpf", "cpf"],
            "nascimento" => ["required", "date", new IdadeMinima],
            "foto_documento" => ["required", "image"],
            "telefone" => ["required", 'size:11'],
            "tipo_usuario" => ["required", Rule::in([1, 2])],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed"],
            "password_confirmation" => ["required"]
        ];

        $regraPix = [];

        if ($this->tipo_usuario == 2) {
            $regraPix = ['chave_pix' => ['required', 'min:4', 'string']];
        }

        return $regras + $regraPix;
    }
}
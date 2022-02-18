<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoDiaristaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'logradouro' => ['required', 'min:3', 'max:255'],
            'numero' => ['required'],
            'complemento' => ['required', 'min:3', 'max:255'],
            'bairro' => ['required', 'min:3', 'max:255'],
            'cidade' => ['required', 'min:3', 'max:255'],
            'estado' => ['required', 'size:2'],
            'cep' => ['required', 'size:8']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CidadesAtendidasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "cidades.*.codigo_ibge" => ['required'],
            "cidades.*.cidade" => ['required']
        ];
    }
}

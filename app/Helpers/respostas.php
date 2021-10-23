<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

//Retorna uma reposta padronizada para API
if (!function_exists('resposta_padrao')) {
    function resposta_padrao(
        string $message,
        string $code,
        int $statusCode,
        array $adicionais = []
    ): JsonResponse {
        return response()->json([
            "status" => $statusCode,
            "code" => $code,
            "menssage" => $message,
        ] + $adicionais, $statusCode);
    }
}

if (!function_exists('resposta_token')) {

    // Retorna uma resposta padrão para os tokens de autenticação
    function resposta_token(string $token): JsonResponse
    {
        return response()->json([
            'access' => $token,
            'refresh' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}

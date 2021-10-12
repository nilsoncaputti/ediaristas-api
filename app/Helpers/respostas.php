<?php

use Illuminate\Http\JsonResponse;

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

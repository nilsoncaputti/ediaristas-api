<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait ApiHandler
{
    //Trata as exceções da nossa API
    protected function getJsonException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        return $this->genericException($e);
    }

    // Retorna uma reposta para erro de validação
    protected function validationException(ValidationException $e): JsonResponse
    {
        return resposta_padrao("Erro de validação dos dados enviados", "validation_error", 400, $e->errors());
    }

    // Retorna uma resposta para erro genérico
    protected function genericException(\Throwable $e): JsonResponse
    {
        return resposta_padrao("Erro interno no servidor", "internal_error", 500);
    }
}

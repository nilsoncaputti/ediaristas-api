<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

trait ApiHandler
{
    //Trata as exceções da nossa API
    protected function getJsonException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        if ($e instanceof AuthenticationException) {
            return $this->authenticationException($e);
        }

        if ($e instanceof TokenBlacklistedException) {
            return $this->authenticationException($e);
        }

        if ($e instanceof AuthorizationException) {
            return $this->authorizationException($e);
        }

        return $this->genericException($e);
    }

    // Retorna uma reposta para erro de validação
    protected function validationException(ValidationException $e): JsonResponse
    {
        return resposta_padrao(
            "Erro de validação dos dados enviados",
            "validation_error",
            400,
            $e->errors()
        );
    }

    // Retorna uma resposta para o erro de autenticação
    protected function authenticationException(AuthenticationException|TokenBlacklistedException $e): JsonResponse
    {
        return resposta_padrao(
            $e->getMessage(),
            "token_not_valid",
            401
        );
    }

    // Retorna uma resposta para o erro de autorização
    protected function authorizationException(AuthorizationException $e): JsonResponse
    {
        return resposta_padrao(
            $e->getMessage(),
            'authorizarion_error',
            401
        );
    }

    // Retorna uma resposta para erro genérico
    protected function genericException(\Throwable $e): JsonResponse
    {

        dd($e->getMessage());
        return resposta_padrao("Erro interno no servidor", "internal_error", 500);
    }
}

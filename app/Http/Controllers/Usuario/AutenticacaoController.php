<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Resources\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AutenticacaoController extends Controller
{
    // Realiza o login a partir do e-mail e senha
    public function login(Request $request): JsonResponse
    {
        $credenciais = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credenciais)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return resposta_token($token);
    }

    // Retorna os dados do usuário logado atualmente
    public function me(): Usuario
    {
        return new Usuario(Auth::user());
    }

    // Invalida o token passado no Header
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'message' => "Successfully logged out"
        ]);
    }

    // Renova o token enviadono Header
    public function refresh(): JsonResponse
    {
        return resposta_token(Auth::refresh());
    }
}

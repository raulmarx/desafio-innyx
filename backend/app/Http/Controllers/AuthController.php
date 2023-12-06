<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();

        if ($token = Auth::attempt($credentials)) {
            $user = Auth::user();
            
            return response()->json(['token' => $token, 'user' => $user]);
        }

        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas são inválidas.'],
        ]);
    }

    public function logout()
    { 
        auth()->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
    
}

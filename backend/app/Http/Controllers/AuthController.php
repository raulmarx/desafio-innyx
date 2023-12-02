<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('JWT')->plainTextToken;

            return response()->json(['token' => $token, 'user' => $user]);
        }

        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas são inválidas.'],
        ]);
    }

    public function logout()
    { 
        auth()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}

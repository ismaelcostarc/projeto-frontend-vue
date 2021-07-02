<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customers;
use App\Models\Attendents;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //A action de login é a mesma independente se for cliente ou atendente,
    //porém deve ser enviado um campo no body contendo o profile desejado
    //1 - Cliente
    //2 - Atendente
    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required|size:11',
            'password' => 'required',
            'profile' => 'required|integer|between:1,2'
        ]);

        if ($request->profile == 1) {
            $user = Customers::where('cpf', $request->cpf)->first();
        } else {
            $user = Attendents::where('cpf', $request->cpf)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.'
            ], 401);
        }

        return response()->json([
            'bearer_token' => $user->createToken($request->cpf)->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Tokens Revoked'
        ]);
    }
}

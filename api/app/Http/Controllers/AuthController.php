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
    //1 - Atendente
    //2 - Cliente
    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'password' => 'required',
            'profile' => 'required'
        ]);

        if ($request->profile == 1) {
            $user = Customers::where('cpf', $request->cpf)->first();
        } elseif($request->profile == 2) {
            $user = Attendents::where('cpf', $request->cpf)->first();
        } else {
            //Prevenção de erros
            return response()->json([
                'error' => 'The profile is incorrect.'
            ], 400);
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
}

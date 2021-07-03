<?php

namespace App\Http\Controllers;

use App\Models\Attendents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendentsController extends Controller
{
    public function show()
    {
        //Autorização
        //Apenas atendentes podem visualizar seus dados
        //Caso seja um cliente criado por ele, o cliente pode visualizar o nome do atendente
        $model = get_class(Auth::user());
        if ($model != Attendents::class) {
            //dd(Auth::user());
            $attendent = Attendents::find(Auth::user()->attendent_id);
            return response()->json($attendent->name);
        } else {
            return response()->json([], 401);
        }
        $attendent = Attendents::find(Auth::user()->id);
        return response()->json($attendent);
    }
}

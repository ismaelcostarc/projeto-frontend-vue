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
        //Apenas atendentes podem atualizar seus próprios dados
        $model = get_class(Auth::user());

        if ($model != Attendents::class)
            return response()->json([], 401);
        $attendent = Attendents::find(Auth::user()->id);
        return response()->json($attendent);
    }
}

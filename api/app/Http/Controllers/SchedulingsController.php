<?php

namespace App\Http\Controllers;

use App\Models\Schedulings;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchedulingsController extends Controller
{
    //R
    public function index()
    {
        $model = get_class(Auth::user());
        if ($model == Customers::class) {
            $schedulings = Schedulings::where('customer_id', Auth::user()->id)->get();
            return response()->json($schedulings);
        }

        $scheduling = Schedulings::all();
        if ($scheduling->count() == 0) {
            return response()->json([], 204);
        }
        return response()->json($scheduling);
    }

    //C
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'hour' => 'required',
            'health_insurance' => 'required|max:200',
            'place' => 'required|max:200',
            'exam' => 'required|max:200',
            'customer_id' => 'required|integer'
        ]);
        //dd($request->all());
        //O cliente só pode criar agendamentos para ele mesmo
        $model = get_class(Auth::user());
        if ($model == Customers::class && $request->customer_id !== Auth::user()->id) {
            return response()->json([], 401);
        }

        $scheduling = new Schedulings();
        $scheduling->fill($request->all());
        $scheduling->save();
        return response()->json($scheduling, 201);
    }

    //U
    public function update(Request $request, $id)
    {
        $scheduling = Schedulings::find($id);

        if (!$scheduling) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $model = get_class(Auth::user());
        if ($model == Customers::class && $scheduling->customer_id !== Auth::user()->id) {
            return response()->json([], 401);
        }

        //Validações
        $request->validate([
            'date' => 'date_format:Y-m-d',
            'health_insurance' => 'max:200',
            'place' => 'max:200',
            'exam' => 'max:200',
            'customer_id' => 'integer'
        ]);

        $scheduling->fill($request->all());
        $scheduling->save();

        return response()->json($scheduling);
    }

    //D
    public function destroy($id)
    {
        $scheduling = Schedulings::find($id);

        if (!$scheduling) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $model = get_class(Auth::user());
        if ($model == Customers::class && $scheduling->customer_id !== Auth::user()->id) {
            return response()->json([], 401);
        }

        $scheduling->delete();
    }
}

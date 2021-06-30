<?php

namespace App\Http\Controllers;

use App\Models\Schedulings;
use Illuminate\Http\Request;

class SchedulingsController extends Controller
{
    public function index()
    {
        $scheduling = Schedulings::all();
        if($scheduling->count() == 0) {
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

        $scheduling = new Schedulings();
        $scheduling->fill($request->all());
        $scheduling->save();
        return response()->json($scheduling, 201);
    }

    //R
    public function show($id)
    {
        $scheduling = Schedulings::find($id);
        if(!$scheduling) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($scheduling);
    }

    public function destroy($id)
    {
        $scheduling = Schedulings::find($id);

        if(!$scheduling) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $scheduling->delete();
    }
}

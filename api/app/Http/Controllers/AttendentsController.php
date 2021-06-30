<?php

namespace App\Http\Controllers;

use App\Models\Attendents;
use Illuminate\Http\Request;

class AttendentsController extends Controller
{
    public function show($id)
    {
        $attendent = Attendents::find($id);
        if (!$attendent) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($attendent);
    }
}

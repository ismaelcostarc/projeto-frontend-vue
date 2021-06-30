<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    /**
     * Checa se o cliente existe a partir do CPF
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $cpf = $request->query('cpf');
        $customer = Customers::where('cpf', $cpf)->get()->count();
        if($customer) {
            $cpfIsRegistered = true;
        } else {
            $cpfIsRegistered = false;
        }

        return response()->json(['cpfIsRegistered' => $cpfIsRegistered]);
        //dd($customer);
    }

    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'password' => 'required'
        ]);

        $customer = Customers::where('cpf', $request->cpf)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.'
            ], 401);
        }

        return response()->json([
            'bearer_token' => $customer->createToken($request->cpf)->plainTextToken
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customers();
        //Observacao: o cpf já precisa vir como string
        $customer->fill($request->all());
        $customer->save();
        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers)
    {
        //
    }
}

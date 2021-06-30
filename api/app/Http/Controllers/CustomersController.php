<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
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
        if ($customer) {
            $cpfIsRegistered = true;
        } else {
            $cpfIsRegistered = false;
        }

        return response()->json(['cpfIsRegistered' => $cpfIsRegistered]);
    }

    public function index()
    {
        //Autorização
        //Caso o usuário autenticado seja um atendente, o index() retorna todos os clientes;
        //Caso o usuário seja um cliente, index retorna apenas os dados dele
        $model = Auth::user()::class;

        //Cliente
        if ($model == Customers::class) {
            $customer = Customers::find(Auth::user()->id);
            return response()->json($customer);
        }

        //Atendente
        $customers = Customers::all();
        if ($customers->count() == 0) {
            return response()->json([], 204);
        }
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        //Validações
        $request->validate([
            'cpf' => 'required|size:11',
            'password' => 'required|max:128',
            'name' => 'required|max:200',
            'email' => 'required|max:200',
            'phone' => 'required|max:20',
            'birthday' => 'required|date_format:Y-m-d',
            'zipcode' => 'size:10',
            'state' => 'size:2',
            'city' => 'max:20',
            'attendent_id' => 'integer'
        ]);

        $customer = Customers::create([
            'cpf' => $request->cpf,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'city' => $request->city,
            'attendent_id' => $request->attendent_id
        ]);
        return response()->json([
            'bearer_token' => $customer->createToken($request->cpf)->plainTextToken
        ], 201);
    }

    public function show($id)
    {
        //Autorização
        //Apenas atendentes podem ver dados de um cliente em específico
        $model = Auth::user()::class;

        if ($model == Customers::class)
            return response()->json([], 401);

        $customer = Customers::find($id);
        if (!$customer) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        //Validações
        $request->validate([
            'cpf' => 'size:11',
            'password' => 'max:128',
            'name' => 'max:200',
            'email' => 'max:200',
            'phone' => 'max:20',
            'birthday' => 'date',
            'zipcode' => 'size:10',
            'state' => 'size:2',
            'city' => 'max:20',
            'attendent_id' => 'prohibited'
        ]);

        $customer = Customers::find($id);

        if (!$customer) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $customer->fill($request->all());
        $customer->save();

        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customers::find($id);

        if (!$customer) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $customer->delete();
    }
}

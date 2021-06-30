<?php

use App\Http\Controllers\AttendentsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SchedulingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Ações que não requerem autorização
Route::get('/', CustomersController::class . '@check')->name('check');

Route::post('/attendants/login', AttendentsController::class . '@login')->name('attendants.login');
Route::prefix('/customers')->name('customers.')->group(function () {
    Route::post('/login', CustomersController::class . '@login')->name('login');
    Route::post('/register', CustomersController::class . '@register')->name('register');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    //Rotas para atendentes
    Route::get('/attendants/{attendant}', AttendentsController::class . '@show')->name('attendentes.show');

    //Rotas para clientes
    Route::resource('/customers', CustomersController::class);
    //Rotas para agendamentos
    Route::resource('/schedulings', SchedulingsController::class);

    //logout
    Route::post('/attendant/logout', AttendentsController::class . '@logout');
    Route::post('/customers/logout', CustomersController::class . '@logout');
});

<?php

use App\Http\Controllers\AttendentsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SchedulingsController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', AuthController::class . '@login')->name('login');
Route::post('/customers', CustomersController::class . '@store')->name('customers.store');

Route::group(['middleware' => ['auth:sanctum']], function () {
    //Rotas para atendentes
    //R
    Route::get('/attendents/{attendent}', AttendentsController::class . '@show')->name('attendents.show');

    //Rotas para clientes
    Route::prefix('/customers')->name('customers.')->group(function () {
        Route::get('/', CustomersController::class . '@index')->name('index');
        //R
        Route::get('/{customer}', CustomersController::class . '@show')->name('show');
        //U
        Route::patch('/{customer}', CustomersController::class . '@update')->name('update');
        //D
        Route::delete('/{customer}', CustomersController::class . '@destroy')->name('destroy');
    });
    //Rotas para agendamentos
    Route::prefix('/schedulings')->name('schedulings.')->group(function () {
        Route::get('/', SchedulingsController::class . '@index')->name('index');
        //C
        Route::post('/', SchedulingsController::class . '@store')->name('store');
        //R
        Route::get('/{scheduling}', SchedulingsController::class . '@show')->name('show');
        //U
        Route::patch('/{scheduling}', SchedulingsController::class . '@update')->name('update');
        //D
        Route::delete('/{scheduling}', SchedulingsController::class . '@destroy')->name('destroy');
    });

    //logout
    Route::post('/attendent/logout', AttendentsController::class . '@logout')->name('attendents.logout');
    Route::post('/customers/logout', CustomersController::class . '@logout')->name('customers.logout');
});

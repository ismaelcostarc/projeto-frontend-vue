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
    Route::get('/attendents/{id}', AttendentsController::class . '@show')->name('attendents.show');

    //Rotas para clientes
    Route::prefix('/customers')->name('customers.')->group(function () {
        //Atendentes podem acessar qualquer recurso
        Route::get('/', CustomersController::class . '@index')->name('index');
        //R
        Route::get('/{id}', CustomersController::class . '@show')->name('show');

        /*************************** AUTORIZAÇÃO NÃO FEITA AINDA *****************************/
        //U
        Route::patch('/{id}', CustomersController::class . '@update')->name('update');
        //D
        Route::delete('/{id}', CustomersController::class . '@destroy')->name('destroy');

        //Clientes só podem acessar seu recurso
        //U
        Route::patch('/', CustomersController::class . '@update')->name('update');
        //D
        Route::delete('/', CustomersController::class . '@destroy')->name('destroy');
        /***************************************************************************************/ 
    });
    //Rotas para agendamentos
    Route::prefix('/schedulings')->name('schedulings.')->group(function () {
        Route::get('/', SchedulingsController::class . '@index')->name('index');
        //C
        Route::post('/', SchedulingsController::class . '@store')->name('store');
        //R
        Route::get('/{id}', SchedulingsController::class . '@show')->name('show');
        //U
        Route::patch('/{id}', SchedulingsController::class . '@update')->name('update');
        //D
        Route::delete('/{id}', SchedulingsController::class . '@destroy')->name('destroy');
    });

    //logout
    Route::post('/logout', AuthController::class . '@logout')->name('logout');
});

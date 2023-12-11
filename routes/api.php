<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PizzaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function () {

    // http://127.0.0.1:8000/api/persona
    Route::get("/persona", function(){
        return ["nombre"=>"Nombre de Prueba", "edad"=>40];
    });

    Route::apiResource("ingredient", IngredientController::class);
    Route::apiResource("pizza", PizzaController::class);

    //Route::get('/test', 'TestController@getTest');
    
    //Route::post('/traerLicitaciones', 'App\Http\Controllers\LicitacionController@traerLicitaciones');
    
});


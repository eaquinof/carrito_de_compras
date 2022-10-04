<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('test', [AuthController::class, 'test']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*EndPoints Categoria */
Route::get('categoria', 'CategoriaController@index');
Route::get('categoria/{id}', 'CategoriaController@show');
Route::post('categoria', 'CategoriaController@store');
Route::put('categoria/{id}', 'CategoriaController@update');
Route::put('categoria/{id}', 'CategoriaController@destroy');

/*EndPoints Producto */
Route::get('producto', 'ProductoController@index');
Route::get('producto/{id}', 'ProductoController@show');
Route::post('producto', 'ProductoController@store');
Route::put('producto/{id}', 'ProductoController@update');
Route::put('producto/{id}', 'ProductoController@destroy');

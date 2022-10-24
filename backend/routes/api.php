<?php

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
Route::put('modCategoria/{id}', 'CategoriaController@update');
Route::put('delCategoria/{id}', 'CategoriaController@destroy');

/*EndPoints Producto */
Route::get('producto', 'ProductoController@index');
Route::get('producto/{id}', 'ProductoController@show');
Route::post('producto', 'ProductoController@store');
Route::put('modProducto/{id}', 'ProductoController@update');
Route::put('delProducto/{id}', 'ProductoController@destroy');

#Ruta para agregar un elemento al carrito
Route::middleware('auth:api')->post('/addCart','CartDetailController@store');
#Ruta para eliminar un elemento al carrito
Route::delete('/delCart','CartDetailController@destroy');
# Ruta para convertir el carrito en un pedido
Route::post('/order','CartController@update');
#Ruta para eliminar un pedido
Route::delete('/order','CartController@destroy');
#Ruta para cambiar el status de un pedido
Route::post('/order/status','CartController@updateStatus');

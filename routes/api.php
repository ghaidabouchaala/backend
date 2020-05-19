<?php

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
Route::post('products/add','ProductController@addProduct');
Route::get('products/all','ProductController@getAllProducts');
Route::delete('products/delete/{id}','ProductController@deleteProductById');

Route::get('products/{product_id}','ProductController@getProductById');

Route::post('buy/{product_id}', 'OrderController@buy');
Route::get('test', 'UserController@test');

Route::get('users/all','UserController@getAllUsers');
Route::delete('users/delete/{id}','UserController@deleteUserById');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::post('register','UserController@register');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

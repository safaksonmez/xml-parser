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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mock1.xml', 'XmlController@mock1');
Route::get('/mock2.xml', 'XmlController@mock2');

Route::get('/products', 'ProductController@index');
Route::get('/products/id', 'ProductController@show');
Route::post('/products', 'ProductController@store');
Route::put('/products/id', 'ProductController@update');
Route::delete('/products/id', 'ProductController@delete');

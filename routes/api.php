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
//Categories

Route::post('category/store', 'CategoryController@store');
Route::post('category/update', 'CategoryController@update');
Route::get('categories/get', 'CategoryController@get');
Route::delete('category/delete/{id}', 'CategoryController@delete');

//Blogs



//Tags

Route::post('tag/store', 'TagController@store');
Route::get('tags/get', 'TagController@get');

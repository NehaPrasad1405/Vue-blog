<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Category

Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('/computed', 'CategoryController@computed')->name('categories.computed');

//Tag

Route::get('tags', 'TagController@index')->name('tags.index');

<?php

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

Route::get('todos','TodoController@index');
Route::post('todos/post','TodoController@store')->name('todo.store');
Route::get('todos/delete/{id}','TodoController@destory')->name('todo.delete');
Route::post('ajax/get/{id}','TodoController@ajaxGet')->name('ajax.get');

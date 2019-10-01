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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', function () {
    return view('sistema.user.users');
});

//Rutas de usuarios
Route::post('/user', 'UserController@store');
Route::put('/user/edit', 'UserController@update');
Route::post('/user/delete/{id}', 'UserController@destroy');
Route::post('/user/{id}', 'UserController@show');

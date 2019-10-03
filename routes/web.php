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


// Vistas
Route::get('/user', function () {
    return view('sistema.user.users');
});

Route::get('/client', function () {
    return view('sistema.client.clients');
});

Route::get('/supplier', function () {
    return view('sistema.suplidor.supplies');
});

Route::get('/composition', function () {
    return view('sistema.composicion.compositions');
});

// Fin vistas

//Rutas de usuarios
Route::post('/user', 'UserController@store');
Route::put('/user/edit', 'UserController@update');
Route::post('/user/delete/{id}', 'UserController@destroy');
Route::post('/user/{id}', 'UserController@show');


//Rutas composition
Route::post('/composition', 'CompositionController@store');
Route::post('/composition/{id}', 'CompositionController@show');
Route::put('/composition/edit', 'CompositionController@update');
Route::post('/composition/delete/{id}', 'CompositionController@destroy');

//Rutas suplidor
Route::post('/supplier', 'SupplierController@store');
Route::post('/supplier/{id}', 'SupplierController@show');
Route::put('/supplier/edit', 'SupplierController@update');
Route::post('/supplier/delete/{id}', 'SupplierController@destroy');

//Rutas clientes
Route::post('/client', 'ClientController@store');
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

Route::get('/branch', function () {
    return view('sistema.branch.branch');
});

Route::get('/supplier', function () {
    return view('sistema.suplidor.supplies');
});

Route::get('/composition', function () {
    return view('sistema.composicion.compositions');
});

Route::get('/cloth', function () {
    return view('sistema.cloth.cloth');
});

Route::get('/rollos', function () {
    return view('sistema.rollos.rollos');
});

Route::get('/product', function () {
    return view('sistema.product.product');
});

Route::get('/corte', function () {
    return view('sistema.corte.corte');
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
Route::post('/client/{id}', 'ClientController@show');
Route::put('/client/edit', 'ClientController@update');
Route::post('/client/delete/{id}', 'ClientController@destroy');

//Sucursales
Route::get('clients', 'ClientBranchController@select');
Route::post('/client-branch', 'ClientBranchController@store');
Route::post('/client-branch/{id}', 'ClientBranchController@show');
Route::put('/client-branch/edit', 'ClientBranchController@update');
Route::post('/client-branch/delete/{id}', 'ClientBranchController@destroy');

//Rutas telas/cloth
Route::post('/cloth', 'ClothController@store');
Route::get('suplidores', 'ClothController@selectSuplidor');
Route::get('compositions', 'ClothController@selectComposition');
Route::post('/cloth/{id}', 'ClothController@show');
Route::put('/cloth/edit', 'ClothController@update');
Route::post('/cloth/delete/{id}', 'ClothController@destroy');

//Rutas rollos
Route::get('cloths', 'RollosController@selectCloth');
Route::post('/rollos', 'RollosController@store');
Route::post('/rollo/{id}', 'RollosController@show');
Route::put('/rollo/edit', 'RollosController@update');
Route::post('/rollo/delete/{id}', 'RollosController@destroy');

//Rutas productos
Route::get('product/lastdigit', 'ProductController@getDigits');
Route::post('/product', 'ProductController@store');
Route::post('/product/{id}', 'ProductController@show');
Route::put('/product/edit', 'ProductController@update');
Route::post('/product/delete/{id}', 'ProductController@destroy');
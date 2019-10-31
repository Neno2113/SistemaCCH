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

Route::get('/sku', function () {
    return view('sistema.sku.sku');
});

Route::get('/corte-consulta', function () {
    return view('sistema.corte.consulta');
});

Route::get('/lavanderia', function () {
    return view('sistema.lavanderia.lavanderia');
});

Route::get('/recepcion', function () {
    return view('sistema.recepcion.recepcion');
});

Route::get('/perdida', function () {
    return view('sistema.perdidas.perdida');
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
// Route::get('/text', 'CompositionController@test_page');
// Route::get('/text-read', 'CompositionController@read_test');

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
Route::post('/product_ref', 'ProductController@guardarReferencias');
Route::post('/product/{id}', 'ProductController@show');
Route::put('/product/edit', 'ProductController@update');
Route::post('/product/delete/{id}', 'ProductController@destroy');
Route::post('sku', 'ProductController@asignarSKU');

//SKU
Route::Post('/text-read', 'SKUController@read_file');

//Corte
Route::get('corte/lastdigit', 'CorteController@getDigits');
Route::get('products', 'CorteController@selectProduct');
Route::post('/asignar/{id}', 'CorteController@asignar');
Route::post('/corte', 'CorteController@store');
Route::post('/corte/{id}', 'CorteController@show');
Route::put('/corte/edit', 'CorteController@update');
Route::post('/corte/delete/{id}', 'CorteController@destroy');
Route::get('cortes', 'CorteController@selectCorte');

//Talla
Route::post('/talla', 'TallaController@store');
Route::get('/talla/search/{id}', 'TallaController@show');

//Lavanderia
Route::get('lavanderia/lastdigit', 'LavanderiaController@getDigits');
Route::post('/lavanderia', 'LavanderiaController@store');
Route::post('/lavanderia/{id}', 'LavanderiaController@show');
Route::get('suplidores_lav', 'LavanderiaController@selectSuplidor');
Route::get('producto_env', 'LavanderiaController@selectProducto');
Route::get('producto_env_edit', 'LavanderiaController@selectProductoEdit');
Route::get('cortes', 'LavanderiaController@selectCorte');
Route::get('cortes_edit', 'LavanderiaController@selectCorteEdit');
Route::get('/imprimir/conduce/{id}', 'LavanderiaController@imprimir')->name('print');
Route::put('/lavanderia/edit', 'LavanderiaController@update');
Route::post('/lavanderia/delete/{id}', 'LavanderiaController@destroy');
Route::get('/conduce/{id}', 'LavanderiaController@Agregar');
Route::post('/cantidades', 'LavanderiaController@cantidad');


//Recepcion o Terminacion
Route::get('cortes_rec', 'RecepcionController@selectCorte');
Route::get('corte_rec_edit', 'RecepcionController@selectCorteEdit');
Route::get('lavanderia_rec', 'RecepcionController@selectLavanderia');
Route::get('lavanderia_rec_edit', 'RecepcionController@selectLavanderiaEdit');
Route::post('/recepcion', 'RecepcionController@store');
Route::get('/recepcion/{id}', 'RecepcionController@show');
Route::put('/recepcion/edit', 'RecepcionController@update');
Route::post('/recepcion/delete/{id}', 'RecepcionController@destroy');


//Perdida
Route::get('cortes_perd', 'PerdidaController@selectCorte');
Route::get('perdida/lastdigit', 'PerdidaController@getDigits');
Route::get('segunda/lastdigit', 'PerdidaController@getSegundaDigits');
Route::post('/perdida', 'PerdidaController@store');
Route::post('/perdida_tallas', 'PerdidaController@storeTalla');
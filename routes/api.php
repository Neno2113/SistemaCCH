<?php

use App\Cloth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

Route::get('users', 'UserController@users');

Route::get('compositions','CompositionController@compositions');

Route::get('suppliers', 'SupplierController@suppliers');

Route::get('clients', 'ClientController@clients');

Route::get('branches', 'ClientBranchController@branches');

Route::get('cloths', 'ClothController@cloths');

Route::get('rollos', 'RollosController@rollos');

Route::get('rollos_corte', 'CorteController@rollos');

Route::get('products', 'ProductController@products');

Route::get('skus', 'SKUController@skus');

Route::get('cortes', 'CorteController@cortes');

Route::get('lavanderias', 'LavanderiaController@lavanderias');

Route::get('lavanderia-envio', 'LavanderiaController@lavanderiaEnvio');

Route::get('recepciones', 'RecepcionController@recepciones');

Route::get('perdidas', 'PerdidaController@perdidas');

Route::get('almacenes', 'AlmacenController@almacenes');

Route::get('producto-terminado', 'ProductController@productoTerminado');

Route::get('ordenes', 'OrdenPedidoController@ordenes');

Route::get('ordenes_aprobacion', 'OrdenPedidoController@ordenesAprobacion');

Route::get('ordenes_aprobacion_empaque', 'OrdenEmpaqueController@ordenesAprobacion');

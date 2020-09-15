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

Route::post('users', 'UserController@users');

Route::get('compositions','CompositionController@compositions');

Route::post('suppliers', 'SupplierController@suppliers');

Route::post('clients', 'ClientController@clients');

Route::post('branches', 'ClientBranchController@branches');

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

Route::post('almacenes/atributos', 'AlmacenController@atributoAlmacen');

Route::get('producto-terminado', 'ProductController@productoTerminado');

Route::post('ordenes', 'OrdenPedidoController@ordenes');

Route::get('ordenes_aprobacion', 'OrdenPedidoController@ordenesAprobacion');

Route::get('ordenes_proceso', 'OrdenPedidoController@ordenesProceso');

Route::get('ordenes_aprobacion_empaque', 'OrdenEmpaqueController@ordenesAprobacion');

Route::get('ordenes_empaque', 'OrdenEmpaqueController@ordenesAprobacionImpresion');

Route::get('ordenes_redistribucion', 'OrdenPedidoController@ordenesRedistribucion');

Route::get('orden_detalle/{id}', 'OrdenEmpaqueController@empaqueDetalle');

Route::get('empaque_detalle/{id}', 'OrdenFacturacionController@empaqueDetail');

Route::get('facturacion_detail', 'OrdenFacturacionController@facturacionDetail');

Route::get('orden_facturacion', 'FacturaController@orden_facturacion');

Route::get('factura_detalle/{id}', 'FacturaController@facturaDetalle');

Route::get('facturas', 'FacturaController@facturas');

Route::get('listarorden/{id}', 'ordenPedidoController@listarOrden');

Route::get('detalle_corte/{id}', 'AlmacenController@corte_detalle');

Route::get('nota_creditos', 'NotaCreditoController@facturas');

Route::get('fact_detalle/{id}', 'NotaCreditoController@facturacionDetail');

Route::post('empleados', 'EmpleadoController@empleados');

Route::get('listarDetalle/{id}', 'ordenPedidoController@listarOrdenRed');

Route::post('permisos', 'PermisoController@permisos');

Route::get('existencias', 'ExistenciaController@existencias');

Route::get('reporteExistencias', 'ExistenciaController@existenciasPorTallas');

Route::get('existencia/produccion', 'ExistenciaController@existenciasProduccion');

Route::get('existencia/almacen', 'ExistenciaController@existenciasAlmacen');

Route::get('catalogos', 'productController@catalogos');

Route::post('articulos', 'productController@articulos');

Route::get('exportarFacturas', 'ExistenciaController@exportarFactura');

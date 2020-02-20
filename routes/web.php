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
})->middleware('auth', 'admin:Usuarios');

Route::get('/employee', function () {
    return view('sistema.empleado.empleado');
})->middleware('auth', 'admin:Empleados');

Route::get('/permiso', function () {
    return view('sistema.user.permiso');
})->middleware('auth', 'admin:permiso');

Route::get('/client', function () {
    return view('sistema.client.clients');
})->middleware('auth', 'admin:Cliente');

Route::get('/branch', function () {
    return view('sistema.branch.branch');
})->middleware('auth', 'admin:Sucursales');

Route::get('/supplier', function () {
    return view('sistema.suplidor.supplies');
})->middleware('auth', 'admin:Suplidores');

Route::get('/composition', function () {
    return view('sistema.composicion.compositions');
})->middleware('auth', 'admin:Composicion');

Route::get('/cloth', function () {
    return view('sistema.cloth.cloth');
})->middleware('auth', 'admin:Telas');

Route::get('/rollos', function () {
    return view('sistema.rollos.rollos');
})->middleware('auth', 'admin:Rollos');;

Route::get('/product', function () {
    return view('sistema.product.product');
})->middleware('auth', 'admin:Productos');

Route::get('/corte', function () {
    return view('sistema.corte.corte');
})->middleware('auth', 'admin:Corte');

Route::get('/sku', function () {
    return view('sistema.sku.sku');
})->middleware('auth', 'admin:Sku');

Route::get('/corte-consulta', function () {
    return view('sistema.corte.consulta');
})->middleware('auth');

Route::get('/lavanderia', function () {
    return view('sistema.lavanderia.lavanderia');
})->middleware('auth', 'admin:Lavanderia');

Route::get('/devolucion-lavanderia', function () {
    return view('sistema.lavanderia.envioLavanderia');
})->middleware('auth');

Route::get('/recepcion', function () {
    return view('sistema.recepcion.recepcion');
})->middleware('auth', 'admin:Recepcion');

Route::get('/perdida', function () {
    return view('sistema.perdidas.perdida');
})->middleware('auth', 'admin:Perdidas');

Route::get('/almacen', function () {
    return view('sistema.almacen.almacen');
})->middleware('auth', 'admin:Almacen');

Route::get('/producto-terminado', function () {
    return view('sistema.product.terminado');
})->middleware('auth', 'admin:Producto terminado');

Route::get('/existencia', function () {
    return view('sistema.existencia.existencia');
})->middleware('auth', 'admin:existencia');

Route::get('/orden_pedido', function () {
    return view('sistema.ordenPedido.ordenPedido');
})->middleware('auth', 'admin:Ordenes pedido');

Route::get('/ordenes_proceso', function () {
    return view('sistema.ordenPedido.ordenProceso');
})->middleware('auth', 'admin:Ordenes proceso');

Route::get('/orden_aprobacion', function () {
    return view('sistema.ordenPedido.ordenAprobacion');
})->middleware('auth', 'admin:Aprobar y redistribuir');

Route::get('/orden_redistribucion', function () {
    return view('sistema.ordenPedido.ordenRed');
})->middleware('auth', 'admin:orden_redistribucion');

Route::get('/orden_empaque_listar', function () {
    return view('sistema.ordenEmpaque.ordenEmpaqueCreate');
})->middleware('auth', 'admin:Imprimir ordenes empaque');

Route::get('/orden_empaque', function () {
    return view('sistema.ordenEmpaque.ordenEmpaque');
})->middleware('auth', 'admin:Reportar empaque');

Route::get('/orden_facturacion', function () {
    return view('sistema.ordenFacturacion.ordenFacturacion');
})->middleware('auth', 'admin:Facturacion');

Route::get('/facturacion', function () {
    return view('sistema.ordenFacturacion.facturacion');
})->middleware('auth', 'admin:facturacion');

Route::get('/nota_credito', function () {
    return view('sistema.ordenFacturacion.notacredito');
})->middleware('auth', 'admin:Nota credito');
// Fin vistas

//Rutas de usuarios
Route::post('/user', 'UserController@store');
Route::put('/user/edit', 'UserController@update');
Route::post('/user/delete/{id}', 'UserController@destroy');
Route::post('/user/{id}', 'UserController@show');
Route::post('/avatar', 'UserController@upload');
Route::get('/avatar/{filname}', 'UserController@getImage');

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
Route::get('suplidor/select', 'ClothController@supplidorSelect');

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
Route::get('producto/terminado/{filname}', 'ProductController@getImage');
Route::post('producto/validarSku', 'ProductController@validarSku');
Route::post('validar/referencia', 'ProductController@verificarReferencia');

//SKU
Route::Post('/text-read', 'SKUController@read_file');
Route::get('/sku_disp', 'SKUController@sku_disponibles');

//Corte
Route::get('corte/lastdigit', 'CorteController@getDigits');
Route::get('products', 'CorteController@selectProduct');
Route::post('/asignar/{id}', 'CorteController@asignar');
Route::post('/remover/{id}', 'CorteController@remover');
Route::post('/corte', 'CorteController@store');
Route::post('/corte/{id}', 'CorteController@show');
Route::put('/corte/edit', 'CorteController@update');
Route::post('/corte/delete/{id}', 'CorteController@destroy');
Route::get('cortes', 'CorteController@selectCorte');
Route::get('cortes_home', 'CorteController@corte_home');
Route::post('verificacion/corte', 'CorteController@verificarCorte');
Route::post('verificacion/producto', 'CorteController@verificarReferencia');
Route::get('testSelectProduct', 'CorteController@testSelect2');

//Talla
Route::post('/talla', 'TallaController@store');
Route::post('/talla/update', 'TallaController@update');
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
Route::get('recepcion/lastdigit', 'RecepcionController@getDigits');
Route::get('cortes_rec', 'RecepcionController@selectCorte');
Route::get('corte_rec_edit', 'RecepcionController@selectCorteEdit');
Route::get('lavanderia_rec', 'RecepcionController@selectLavanderia');
Route::get('lavanderia_rec_edit', 'RecepcionController@selectLavanderiaEdit');
Route::post('/recepcion', 'RecepcionController@store');
Route::get('/recepcion/{id}', 'RecepcionController@show');
Route::put('/recepcion/edit', 'RecepcionController@update');
Route::post('/recepcion/delete/{id}', 'RecepcionController@destroy');
Route::post('/cantidades_recibidas', 'RecepcionController@cantidad');
Route::get('/imprimir/conduceRecepcion/{id}', 'RecepcionController@imprimir')->name('print');

//Perdida
Route::get('cortes_perd', 'PerdidaController@selectCorte');
Route::get('perdida/lastdigit', 'PerdidaController@getDigits');
Route::get('segunda/lastdigit', 'PerdidaController@getSegundaDigits');
Route::post('/perdida', 'PerdidaController@store');
Route::post('/perdida_tallas', 'PerdidaController@storeTalla');
Route::get('/perdida/{id}', 'PerdidaController@show');
Route::put('/perdida/edit', 'PerdidaController@update');
Route::put('/talla_perdidas/edit', 'PerdidaController@updateTallas');
Route::post('/perdida/delete/{id}', 'PerdidaController@destroy');
Route::post('/perdida/verificar', 'PerdidaController@verificarFecha');
Route::get('/imprimir/perdida/{id}', 'PerdidaController@imprimir');


//Almacen
Route::get('almacen/lastdigit', 'AlmacenController@getDigits');
Route::get('cortes-almacen', 'AlmacenController@selectCorte');
Route::get('productos-almacen', 'AlmacenController@selectProducto');
Route::post('/almacen', 'AlmacenController@store');
Route::post('/almacen/detalle', 'AlmacenController@storeDetalle');
Route::get('almacen/{id}', 'AlmacenController@show');
Route::put('/almacen/edit', 'AlmacenController@update');
Route::post('/almacen/delete/{id}', 'AlmacenController@destroy');
Route::post('/almacen/producto', 'AlmacenController@corteProducto');
Route::post('/almacen/imagen', 'AlmacenController@upload');
Route::post('/show/corte/producto', 'AlmacenController@verificar_ref');
Route::post('/total_recepcion', 'AlmacenController@cantidad');
Route::post('/validar/total', 'AlmacenController@validar');
Route::post('almacen/calcular/total', 'AlmacenController@calcularTotales');
Route::get('/imprimir/DocEA/{id}', 'AlmacenController@imprimir')->name('print');

//Existencia
Route::get('producto_existencia', 'ExistenciaController@selectProduct');
Route::post('existencia/consulta', 'ExistenciaController@show');
Route::post('existencia', 'ExistenciaController@store');

//Orden de pedido
Route::post('ordenPedido/consulta', 'ordenPedidoController@show');
Route::get('selectproducto', 'ordenPedidoController@selectProduct');
Route::get('selectCliente', 'ordenPedidoController@selectCliente');
Route::get('selectSucursal', 'ordenPedidoController@selectSucursal');
Route::post('orden', 'ordenPedidoController@store');
Route::post('orden/detalle', 'ordenPedidoController@storeDetalle');
Route::post('orden-proceso/detalle', 'ordenPedidoController@storeDetalleProceso');
Route::post('orden/proceso', 'ordenPedidoController@storeOrdenProceso');
Route::get('ordenPedido/lastdigit', 'ordenPedidoController@getDigits');
Route::get('/orden/detalle/{id}', 'ordenPedidoController@showOrden');
Route::get('/imprimir_orden/conduce/{id}', 'ordenPedidoController@imprimir');
Route::get('/verificar/{id}', 'ordenPedidoController@verificar');
Route::get('/orden_pedido/{id}', 'ordenPedidoController@mostrar');
Route::post('/orden_pedido/delete/{id}', 'ordenPedidoController@destroy');
Route::post('/orden-aprobacion/{id}', 'ordenPedidoController@aprobar');
Route::post('/orden-cancelacion/{id}', 'ordenPedidoController@cancelar');
Route::post('mostrar/{id}', 'ordenPedidoController@mostrar');
Route::get('orden_all', 'ordenPedidoController@home_orden');
Route::post('validar/orden_pedido', 'ordenPedidoController@validar');
Route::post('cliente/segundas', 'ordenPedidoController@clienteSegunda');
Route::get('vendedores/select', 'ordenPedidoController@vendedores');
Route::get('ver/orden/{id}', 'ordenPedidoController@verRedistribuir');
Route::post('orden/detalle/{id}', 'ordenPedidoController@ajuste');
Route::post('orden/detalle/reajuste/{id}', 'ordenPedidoController@reajuste');
Route::post('producto/sustituto', 'ordenPedidoController@sustituto');
Route::get('ordenPedido/consulta/{id}', 'ordenPedidoController@consultaSustituto');
Route::get('productos/seleccionar', 'ordenPedidoController@Productos');
Route::get('corte/fecha/{id}', 'ordenPedidoController@fechaEntrega');
Route::get('ordenes/empty', 'ordenPedidoController@clearOP');

//orden empaque
Route::get('/imprimir_empaque/{id}', 'ordenEmpaqueController@imprimir');
Route::get('/orden_redistribuir/{id}', 'ordenEmpaqueController@redistibucion');
Route::get('/orden_empaque/{id}', 'ordenEmpaqueController@show');
Route::post('/empaque_detalle/{id}', 'ordenEmpaqueController@empaque');
Route::get('/verificar_empaque/{id}', 'ordenEmpaqueController@verificar');

//orden facturacion
Route::get('ordenfacturacion/lastdigit', 'ordenFacturacionController@getDigits');
Route::get('selectEmpaque', 'ordenFacturacionController@selectEmpaque');
Route::post('empaque/search', 'ordenFacturacionController@empaqueSearch');
Route::post('orden_facturacion', 'ordenFacturacionController@store');
Route::post('factura_detalle', 'ordenFacturacionController@storeDetalle');

//Factura
Route::get('/orden_facturacion/{id}', 'FacturaController@show');
Route::get('factura/lastdigit', 'FacturaController@getDigits');
Route::post('factura', 'FacturaController@store');
Route::get('factura/resumida/{id}', 'FacturaController@imprimir');
Route::get('factura/{id}', 'FacturaController@verificar');
Route::get('factura-vista', 'FacturaController@verificar');


//Home
Route::get('/venta12meses', 'DashboardController@ventas12meses');
Route::get('/venta10dias', 'DashboardController@ventas10dias');
Route::get('/dispVentas', 'DashboardController@totalVenta');
Route::get('/latest_orders', 'DashboardController@latestOrders');
Route::get('/latest_products', 'DashboardController@latestProduct');
Route::get('/latest_cortes', 'DashboardController@latestCortes');

//Nota credito
Route::get('nota_credito/{id}', 'NotaCreditoController@show');
Route::get('nc/lastdigit', 'NotaCreditoController@getDigits');
Route::post('nota-credito', 'NotaCreditoController@store');
Route::post('nota-credito/detalle/{id}', 'NotaCreditoController@storeDetalle');
Route::post('nota-credito/delete/{id}', 'NotaCreditoController@destroy');
Route::get('imprimir_notaCredito/{id}', 'NotaCreditoController@imprimir');

//Empleado
Route::post('empleado', 'EmpleadoController@store');
Route::post('empleado/detalle', 'EmpleadoController@storeDetalle');
Route::get('empleado/{id}', 'EmpleadoController@show');
Route::put('empleado/edit', 'EmpleadoController@update');
Route::post('empleado/delete/{id}', 'EmpleadoController@destroy');

//Permiso
Route::get('usuarios', 'PermisoController@usuarios');
Route::post('permiso', 'PermisoController@store');
Route::post('permiso/delete/{id}', 'PermisoController@destroy');
Route::get('permiso/{id}', 'PermisoController@show');


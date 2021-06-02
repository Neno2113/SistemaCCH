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

Route::get('/home', 'HomeController@index')->middleware('auth', 'FirstLogin');
Route::get('/confirm', 'HomeController@confirm');



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

Route::get('/lavanderia/conduce', function () {
    return view('sistema.lavanderia.conduce');
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

Route::get('/definir-atributo', function () {
    return view('sistema.almacen.definirAtributo');
})->middleware('auth', 'admin:Definir Atributos');

Route::get('/almacen', function () {
    return view('sistema.almacen.almacen');
})->middleware('auth', 'admin:Entrada Almacen');

Route::get('/producto-terminado', function () {
    return view('sistema.product.terminado');
})->middleware('auth', 'admin:Producto terminado');

Route::get('/existencia', function () {
    return view('sistema.existencia.existencia');
})->middleware('auth', 'admin:Existencia Talla');

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

Route::get('/reporte', function () {
    return view('sistema.existencia.reporte');
})->middleware('auth', 'admin:Reporte');

Route::get('/catelogo-cuenta', function () {
    return view('sistema.product.catalogo');
})->middleware('auth', 'admin:Catalogo cuenta');

Route::get('/articulo', function () {
    return view('sistema.product.articulo');
})->middleware('auth', 'admin:Articulos');

Route::get('/exportar-peach', function () {
    return view('sistema.existencia.exportarPeach');
})->middleware('auth', 'admin:ExportarPeach');


// Fin vistas

//Rutas de usuarios
Route::post('/confirm-password', 'UserController@updatePassword');
Route::post('/user', 'UserController@store');
Route::put('/user/edit', 'UserController@update');
Route::post('/user/delete/{id}', 'UserController@destroy');
Route::post('/usercheck/delete/{id}', 'UserController@checkDestroy');
Route::post('/user/{id}', 'UserController@show');
Route::post('/avatar', 'UserController@upload');
Route::get('/avatar/{filname}', 'UserController@getImage');
Route::get('exportar/test', 'ExistenciaController@userExport');


//Rutas composition
Route::post('/composition', 'CompositionController@store');
Route::post('/composition/{id}', 'CompositionController@show');
Route::put('/composition/edit', 'CompositionController@update');
Route::post('/composition/delete/{id}', 'CompositionController@destroy');
Route::post('/compositioncheck/delete/{id}', 'CompositionController@checkDestroy');
// Route::get('/text', 'CompositionController@test_page');
// Route::get('/text-read', 'CompositionController@read_test');

//Rutas suplidor
Route::post('/supplier', 'SupplierController@store');
Route::post('/supplier/{id}', 'SupplierController@show');
Route::put('/supplier/edit', 'SupplierController@update');
Route::post('/supplier/delete/{id}', 'SupplierController@destroy');
Route::post('/suppliercheck/delete/{id}', 'SupplierController@checkDestroy');

//Rutas clientes
Route::post('/client', 'ClientController@store');
Route::post('/client-distribution', 'ClientController@storeDistribution');
Route::post('/distribution-check', 'ClientController@storeDistribution');
Route::post('/client/{id}', 'ClientController@show');
Route::put('/client/edit', 'ClientController@update');
Route::post('/client/delete/{id}', 'ClientController@destroy');
Route::post('clientcheck/delete/{id}', 'ClientController@checkDestroy');
Route::post('/distribution-check', 'ClientController@checkDistribution');
Route::get('/select-product', 'ClientController@Select2Producto');
Route::post('/cliente-distribuciones', 'ClientController@distribucionCLiente');
Route::post('/distribucion/delete/{id}', 'ClientController@destroyDistribucion');

//Sucursales
Route::get('clients', 'ClientBranchController@select');
Route::post('/client-branch', 'ClientBranchController@store');
Route::post('/client-branch/{id}', 'ClientBranchController@show');
Route::put('/client-branch/edit', 'ClientBranchController@update');
Route::post('/client-branch/delete/{id}', 'ClientBranchController@destroy');
Route::post('/branchcheck/delete/{id}', 'ClientBranchController@checkDestroy');

//Rutas telas/cloth
Route::post('/cloth', 'ClothController@store');
Route::get('suplidores', 'ClothController@selectSuplidor');
Route::get('compositions', 'ClothController@selectComposition');
Route::post('/cloth/{id}', 'ClothController@show');
Route::put('/cloth/edit', 'ClothController@update');
Route::post('/cloth/delete/{id}', 'ClothController@destroy');
Route::post('/clothcheck/delete/{id}', 'ClothController@checkDestroy');
Route::get('suplidor/select', 'ClothController@supplidorSelect');

//Rutas rollos
Route::get('cloths', 'RollosController@selectCloth');
Route::get('suppliers', 'RollosController@select');
Route::post('/rollos', 'RollosController@store');
Route::post('/rollo/{id}', 'RollosController@show');
Route::put('/rollo/edit', 'RollosController@update');
Route::post('/rollo/delete/{id}', 'RollosController@destroy');
Route::post('/rollocheck/delete/{id}', 'RollosController@checkDestroy');
Route::post('tela/select', 'RollosController@selectTela');

//Rutas productos
Route::get('product/lastdigit', 'ProductController@getDigits');
Route::post('/product', 'ProductController@store');
Route::post('/product/imagen', 'ProductController@upload');
Route::post('/product_ref', 'ProductController@guardarReferencias');
Route::post('/product/{id}', 'ProductController@show');
Route::post('/product-terminado/{id}', 'ProductController@showTerminado');
Route::put('/product/edit', 'ProductController@update');
Route::post('/product/delete/{id}', 'ProductController@destroy');
Route::post('sku', 'ProductController@asignarSKU');
Route::get('producto/terminado/{filname}', 'ProductController@getImage');
Route::post('producto/validarSku', 'ProductController@validarSku');
Route::post('validar/referencia', 'ProductController@verificarReferencia');
Route::post('/productcheck/delete/{id}', 'ProductController@checkDestroy');

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
Route::post('/cortecheck/delete/{id}', 'CorteController@checkDestroy');
Route::get('cortes', 'CorteController@selectCorte');
Route::get('cortes_home', 'CorteController@corte_home');
Route::post('verificacion/corte', 'CorteController@verificarCorte');
Route::post('verificacion/producto', 'CorteController@verificarReferencia');
Route::get('testSelectProduct', 'CorteController@testSelect2');
Route::post('curva/update', 'CorteController@updateCurva');

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
Route::post('/lavanderiacheck/delete/{id}', 'LavanderiaController@checkDestroy');
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
Route::post('/recepcioncheck/delete/{id}', 'RecepcionController@checkDestroy');
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
Route::post('/perdidacheck/delete/{id}', 'PerdidaController@checkDestroy');
Route::post('/perdida/verificar', 'PerdidaController@verificarFecha');
Route::get('/imprimir/perdida/{id}', 'PerdidaController@imprimir');


//Almacen
Route::get('almacen/lastdigit', 'AlmacenController@getDigits');
Route::get('cortes-almacen', 'AlmacenController@selectCorte');
Route::get('cortes/almacen', 'AlmacenController@corteSelect');
Route::get('productos-almacen', 'AlmacenController@selectProducto');
Route::post('/almacen', 'AlmacenController@store');
Route::post('/almacen/detalle', 'AlmacenController@storeDetalle');
Route::get('almacen/{id}', 'AlmacenController@show');
Route::get('almacen-entrada/{id}', 'AlmacenController@showAlmacen');
Route::put('/almacen/edit', 'AlmacenController@update');
Route::post('/almacen/delete/{id}', 'AlmacenController@destroy');
Route::post('/almacencheck/delete/{id}', 'AlmacenController@checkDestroy');
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
Route::get('/reporte/existencia/{hasta}', 'ExistenciaController@imprimirReporte')->name('print');
Route::post('/reporte/fechas', 'ExistenciaController@imprimirReporte')->name('print');

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
Route::post('/orden_pedidocheck/delete/{id}', 'ordenPedidoController@checkDestroy');
Route::post('/orden-aprobacion/{id}', 'ordenPedidoController@aprobar');
Route::post('/checkAprob/delete/{id}', 'ordenPedidoController@checkAprob');
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
Route::post('sucursal/select', 'ordenPedidoController@selectSucu');
Route::post('/detalle/delete/{id}', 'ordenPedidoController@destroyProduct');


//orden empaque
Route::get('/imprimir_empaque/{id}', 'ordenEmpaqueController@imprimir');
Route::get('/empaque/facturar/{id}', 'ordenEmpaqueController@imprimirConduce');
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
Route::post('secuencia/factura', 'FacturaController@getNoFactura');
Route::get('/orden_facturacion/{id}', 'FacturaController@show');
Route::get('factura/lastdigit', 'FacturaController@getDigits');
Route::post('factura', 'FacturaController@store');
Route::get('factura/resumida/{id}', 'FacturaController@imprimir');
Route::get('factura/{id}', 'FacturaController@verificar');
Route::get('factura-edit/{id}', 'FacturaController@showFactura');
Route::get('factura-vista', 'FacturaController@verificar');
Route::put('/factura/edit', 'FacturaController@updateFactura');
Route::get('/producto/normal', 'FacturaController@productoNormal');
Route::post('factura_manual', 'FacturaController@storeManual');
Route::post('manual_detalle', 'FacturaController@storeDetalle');


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
Route::get('factura/validar/{id}', 'NotaCreditoController@validar');
Route::get('factura-select', 'NotaCreditoController@facturaSelect');

//Empleado
Route::post('empleado', 'EmpleadoController@store');
Route::post('empleado/detalle', 'EmpleadoController@storeDetalle');
Route::get('empleado/{id}', 'EmpleadoController@show');
Route::put('empleado/edit', 'EmpleadoController@update');
Route::post('empleado/delete/{id}', 'EmpleadoController@destroy');
Route::post('empleadocheck/delete/{id}', 'EmpleadoController@checkDestroy');

//Permiso
Route::get('usuarios', 'PermisoController@usuarios');
Route::post('permiso', 'PermisoController@store');
Route::post('permiso/delete/{id}', 'PermisoController@destroy');
Route::post('permiso/user/{id}', 'PermisoController@destroy');
Route::get('permiso/{id}', 'PermisoController@show');
Route::post('permiso-add', 'PermisoController@permisoAdd');
Route::post('permiso-remove', 'PermisoController@permisoRemove');
Route::get('permiso/access/{id}', 'PermisoController@showPermiso');

//Catalogo
Route::post('catalogo', 'ProductController@storeCatalogo');
Route::get('catalogo/{id}', 'ProductController@showCatalogo');
Route::put('catalogo/edit', 'ProductController@updateCatalogo');
Route::post('catalogo/delete/{id}', 'ProductController@destroyCatalogo');
Route::get('catalogo-select', 'ProductController@catalogoSeleccionar');

//articulo
Route::post('articulo', 'ProductController@storeArticulo');
Route::get('articulo/{id}', 'ProductController@showArticulo');
Route::put('articulo/edit', 'ProductController@updateArticulo');
Route::post('articulo/delete/{id}', 'ProductController@destroyArticulo');

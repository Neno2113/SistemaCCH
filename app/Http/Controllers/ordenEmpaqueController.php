<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ordenPedido;
use Yajra\DataTables\Facades\DataTables;
use App\ordenPedidoDetalle;
use App\OrdenFacturacion;
use App\ordenFacturacionDetalle;
use App\ordenEmpaque;
use App\Perdida;
use App\Almacen;
use App\AlmacenDetalle;
use App\Client;
use App\ClientBranch;
use App\ClienteDistribucion;
use App\Corte;
use App\TallasPerdidas;
use App\Talla;
use App\Product;
use App\CurvaProducto;
use App\NotaCreditoDetalle;
use App\ordenEmpaqueDetalle;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;

class ordenEmpaqueController extends Controller
{
    public function ordenesAprobacion()
    {
        $ordenes = DB::table('orden_empaque')
            ->join('orden_pedido', 'orden_empaque.orden_pedido_id', 'orden_pedido.id')
            ->select([
                'orden_pedido.id', 'orden_empaque.no_orden_empaque', 'orden_pedido.sucursal_id',
                'orden_pedido.no_orden_pedido', 'orden_pedido.fecha_entrega', 'orden_empaque.id as empaque_id',
                'orden_pedido.detallada', 'orden_empaque.impreso', 'orden_pedido.cliente_id',
                'orden_pedido.status_orden_pedido', 'orden_empaque.empacado', 'orden_pedido.status_orden_pedido'
            ])->where('status_orden_pedido', 'not like', 'Cancelado');

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('total', function ($orden) {
                $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden->id)->get();

                return $ordenDetalle->sum('total');
            })
            ->addColumn('total_empaque', function ($orden) {
                $ordenDetalle = ordenEmpaqueDetalle::where('orden_empaque_id', $orden->empaque_id)->get();

                return $ordenDetalle->sum('total');
            })
            ->addColumn('cliente', function ($orden) {

                $cliente = Client::find($orden->cliente_id);

                return $cliente->nombre_cliente;
                
            })
            ->addColumn('sucursal', function ($orden) {
                $sucursal = ClientBranch::find($orden->sucursal_id);

                return $sucursal->nombre_sucursal;
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d-m-20y", strtotime($orden->fecha_entrega));
            })
        
            ->editColumn('impreso', function ($orden) {

                if($orden->impreso == 1){
                    return '<span class="badge badge-pill badge-success">impreso</span>';
                } else {
                    
                    return '<span class="badge badge-pill badge-danger">No impreso</span>'; 
                }

            })
            ->addColumn('Opciones', function ($orden) {
                if($orden->empacado == '0' || is_null($orden->empacado == 0)){
                    return '<button id="test" onclick="mostrar(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1"> <i class="fas fa-list-ol"></i></button>';
                } else {
                    return '<button id="test" onclick="mostrar(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1"> <i class="fas fa-list-ol"></i></button>' .
                    '<a href="empaque/facturar/' . $orden->id . '" class="btn btn-dark btn-sm ml-1" > <i class="fas fa-print"></i></a>';
                }
               
            })
            ->rawColumns(['Opciones', 'impreso', 'cliente', 'sucursal'])
            ->make(true);
    }

    public function ordenesAprobacionImpresion()
    {
        $ordenes = DB::table('orden_pedido')->join('users', 'orden_pedido.user_aprobacion', 'users.id')
            ->join('cliente', 'orden_pedido.cliente_id', 'cliente.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', 'cliente_sucursales.id')
            ->select([
                'orden_pedido.id', 'orden_pedido.fecha_aprobacion', 'orden_pedido.empaque_impreso',
                'orden_pedido.no_orden_pedido', 'orden_pedido.fecha_entrega',
                'orden_pedido.detallada', 'cliente.redistribucion_tallas',
                'users.name', 'cliente.nombre_cliente', 'cliente_sucursales.nombre_sucursal',
                'orden_pedido.status_orden_pedido', 'orden_pedido.orden_proceso_impresa'
            ])->where('status_orden_pedido', 'LIKE', 'Vigente');

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('total', function ($orden) {
                $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden->id)->get();

                return $ordenDetalle->sum('total');
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d-m-20y", strtotime($orden->fecha_entrega));
            })
            ->editColumn('fecha_aprobacion', function ($orden) {
                return date("h:i:s d-m", strtotime($orden->fecha_aprobacion));
            })
            ->editColumn('status_orden_pedido', function ($orden) {
                if ($orden->status_orden_pedido == 'Vigente') {
                    return '<span class="badge badge-pill badge-success">Vigente</span>';
                } else if ($orden->status_orden_pedido == 'Cancelado') {
                    return '<span class="badge badge-pill badge-danger">Cancelada</span>';
                } else if ($orden->status_orden_pedido == 'Stanby') {
                    return '<span class="badge badge-pill badge-secondary">Stanby</span>';
                } else if ($orden->status_orden_pedido == 'Despachado') {
                    return '<span class="badge badge-pill badge-info">Stanby</span>';
                }
            })
            ->editColumn('empaque_impreso', function ($orden) {

                if($orden->empaque_impreso == 1){
                    return '<span class="badge badge-pill badge-success">impreso</span>';
                } else {
                    
                    return '<span class="badge badge-pill badge-danger">No impreso</span>'; 
                }

            })
            ->addColumn('Opciones', function ($orden) {
                if ($orden->detallada == '0' && $orden->redistribucion_tallas == '1')
                {
                    return
                    '<a href="imprimir_empaque/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>' .
                    '<button onclick="mostrar(' . $orden->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="far fa-eye fa-lg"></i></button>';

                } else if ($orden->detallada == '0' && $orden->redistribucion_tallas == '0') {

                    return
                    '<a href="imprimir_empaque/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>' .
                    '<button onclick="mostrar(' . $orden->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="far fa-eye fa-lg"></i></button>';

                } else if ($orden->detallada == '1' && $orden->redistribucion_tallas == '1'){

                    return
                        '<a href="imprimir_empaque/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>' .
                        '<button onclick="mostrar(' . $orden->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="far fa-eye fa-lg"></i></button>';
                } else {
                    return '<a href="imprimir_empaque/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>' .
                        '<button onclick="mostrar(' . $orden->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="far fa-eye fa-lg"></i></button>';
                }
            })
            ->rawColumns(['Opciones', 'status_orden_pedido', 'empaque_impreso'])
            ->make(true);
    }

    private function toFixed($number, $decimals) {
        return number_format($number, $decimals, '.', "");
    }

    public function imprimir($id)
    {
        // verificar numero antiguo de la secuencia;
        $numero_antiguo = DB::table('orden_empaque')->latest('sec')->first();

        if (empty($numero_antiguo) || $numero_antiguo == "") {
            $sec = 0.00;
            $id_orden_pedido = 0;
        } else {
            $sec = $numero_antiguo->sec;
        }

        $orden_pedido = ordenEmpaque::where('orden_pedido_id', $id)->get()->first();

        if (empty($orden_pedido) || $orden_pedido == "[]") {
            //Crear nuevo objeto de orden de empaque
            $orden_empaque = new ordenEmpaque();

            $orden_empaque->orden_pedido_id = $id;
            $next_sec = number_format($sec + 0.01, 2);
            $orden_empaque->no_orden_empaque = "OE-" . str_replace('.', '', $next_sec);
            $orden_empaque->fecha = date('Y/m/d h:i:s');
            $orden_empaque->sec = number_format($sec + 0.01, 2);
            // $orden_empaque->impreso = 1;
            $orden_empaque->save();

            // $orden_facturacion = new OrdenFacturacion();

            // $orden_facturacion->no_orden_facturacion = $no_orden_facturacion;
            // $orden_facturacion->orden_empaque_id = $orden_empaque->id;
            // $orden_facturacion->user_id = \auth()->user()->id;
            // $orden_facturacion->fecha = date('Y/m/d h:i:s');
            // $orden_facturacion->impreso = 0;
            // $orden_facturacion->por_transporte = $por_transporte;
            // $orden_facturacion->sec = $sec + 0.01;

            // $orden_facturacion->save();
        } else {
            $orden_empaque = $orden_pedido;
            $orden_empaque->impreso = 0;
            $orden_empaque->save();
        }

        //orden normal
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
            ->load('vendedor')
            ->load('sucursal')
            ->load('producto');

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $productos_id = array();

        $longitudProducto = count($orden_detalle);

        for ($i = 0; $i < $longitudProducto; $i++) {
            array_push($productos_id, $orden_detalle[$i]->producto['id']);
        }

        $productos = Product::whereIn('id', $productos_id)
            ->orderBy('ubicacion', 'asc')
            ->get();

        $orden->empaque_impreso = 1;
        $orden->save();

        $orden->fecha = date("d/m/20y", strtotime($orden->fecha));
        $orden->fecha_entrega = date("d/m/20y", strtotime($orden->fecha_entrega));


        $pdf = \PDF::loadView('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque', 'productos'));
        return $pdf->download('ordenEmpaque.pdf');
        return  View('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque', 'productos'));
    }


    public function imprimirConduce($id)
    {
        
        //orden normal
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
            ->load('vendedor')
            ->load('sucursal')
            ->load('producto');

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $orden_empaque = ordenEmpaque::where('orden_pedido_id', $id)->first();

        $empaque_detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $orden_empaque->id)->get()->load('producto');

        $orden_facturacion = OrdenFacturacion::where('orden_empaque_id', $orden_empaque->id)->get()->last();

        $facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion->id)->get();

        $productos_id = array();

        $longitudProducto = count($orden_detalle);

        for ($i = 0; $i < $longitudProducto; $i++) {
            array_push($productos_id, $orden_detalle[$i]->producto['id']);
        }

        $productos = Product::whereIn('id', $productos_id)
            ->orderBy('ubicacion', 'asc')
            ->get();
        // $empaque_detalle->fecha_empacado = date("d/m h:i:s", strtotime($empaque_detalle->fecha_empacado));

        $orden_empaque->fecha_impresion = date('d/m/20y h:i:s');



        $orden_empaque->impreso = 1;
        $orden_empaque->save();

        $orden->status_orden_pedido = 'Facturado';
        $orden->save();




        $pdf = \PDF::loadView('sistema.ordenEmpaque.conduceFacturacion', 
        \compact('orden', 'empaque_detalle', 'orden_empaque', 'productos', 'orden_facturacion', 'facturacion_detalle'));
        return $pdf->download('conduceFacturacion.pdf');
        return  View('sistema.ordenEmpaque.conduceFacturacion', \compact('orden', 'empaque_detalle', 'orden_empaque', 'productos'));
    }


    

    public function verificar($id)
    {
        //verificar numero antiguo de la secuencia;
        $numero_antiguo = DB::table('orden_empaque')->latest('updated_at')->first();

        if (empty($numero_antiguo) || $numero_antiguo == "") {
            $sec = 0.00;
            $id_orden_pedido = 0;
        } else {
            $sec = $numero_antiguo->sec;
        }

        $orden_pedido = ordenEmpaque::where('orden_pedido_id', $id)->get()->first();

        if (empty($orden_pedido) || $orden_pedido == "[]") {
            //Crear nuevo objeto de orden de empaque
            $orden_empaque = new ordenEmpaque();

            $orden_empaque->orden_pedido_id = $id;
            $next_sec = $sec + 0.01;
            $orden_empaque->no_orden_empaque = "OE - " . str_replace('.', '', $next_sec);
            $orden_empaque->fecha = date('Y/m/d h:i:s');
            $orden_empaque->sec = $sec + 0.01;
            $orden_empaque->save();
        } else {
            $orden_empaque = $orden_pedido;
        }

        //orden normal
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
            ->load('sucursal');

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $productos_id = array();

        $longitudProducto = count($orden_detalle);

        for ($i = 0; $i < $longitudProducto; $i++) {
            array_push($productos_id, $orden_detalle[$i]->producto['id']);
        }

        $productos = Product::whereIn('id', $productos_id)
            ->orderBy('ubicacion', 'asc')
            ->get();


        $data = [
            'code' => 200,
            // 'orden' => $orden,
            // 'orden_detalle' => $orden_detalle,
            // 'orden_empaque' => $orden_empaque,
            // 'orden_pedido' => $orden_pedido,
            // 'id_productos' => $productos_id,
            'productos' => $productos,
            // 'tramo' => $tramo
        ];

        return response()->json($data, $data['code']);
    }



    public function redistibucion($id)
    {

        $ordenDetalle = ordenPedidoDetalle::find($id);
        $orden_id = $ordenDetalle->orden_pedido_id;
        // $ordenDetalle->orden_redistribuida = 1;
        // $ordenDetalle->save();

        $orden = ordenPedido::find($orden_id);
        $orden->detallada = 1;
        $orden->save();
        $producto_curva = $ordenDetalle->producto_id;
        $producto_id = $ordenDetalle->producto_id;


        //cliente
        $clienteId = $orden->cliente_id;
        // $cliente = Client::find($clienteId);
        $clienteDistribucion = ClienteDistribucion::where('cliente_id', $clienteId)
        ->where('producto', $producto_id)->get()->first();

        //producto
        $producto = Product::find($producto_id);
        $ref_f = $producto->referencia_father;

        if(!empty($ref_f)){
            $producto_id = $ref_f;
        }

        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('producto_id', $producto_id)->select('id')->get();

        $perdidas = array();

        $longitudPerdida = count($perdida);

        for ($i = 0; $i < $longitudPerdida; $i++) {
            array_push($perdidas, $perdida[$i]['id']);
        }

        $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get()->load('perdida');

        //SEGUNDA
        $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
            ->where('producto_id', $producto_id)->select('id')->get();

        $segundas = array();

        $longitudSegunda = count($segunda);

        for ($i = 0; $i < $longitudSegunda; $i++) {
            array_push($segundas, $segunda[$i]['id']);
        }

        $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');

        //Corte
        $corte = Corte::where('producto_id', $producto_id)->select('id')->get();

        $cortes = array();

        $longitudCorte = count($corte);

        for ($i = 0; $i < $longitudCorte; $i++) {
            array_push($cortes, $corte[$i]['id']);
        }

        $tallasCorte = Talla::whereIn('corte_id', $cortes)->get();

        //Almacen
        $almacen = AlmacenDetalle::where('producto_id', $producto_id)->select('id')->get();

        $almacenes = array();

        $longitudAlmacen = count($almacen);

        for ($i = 0; $i < $longitudAlmacen; $i++) {
            array_push($almacenes, $almacen[$i]['id']);
        }

        $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)
        ->where('orden_redistribuida', 'LIKE', 1)
        ->get();

        //cantidad
        $cantidad = $ordenDetalle->cant_red;



        $tallasAlmacenCurva = AlmacenDetalle::where('producto_id', $producto_id)->select('id')->get();
        $tallasCurva = AlmacenDetalle::where('producto_id', $producto_id)->get();

        if (\is_object($tallasAlmacenCurva)) {

            // $tallasAlmacenCurva->usado_curva = 1;
            // $tallasAlmacenCurva->save();

            // $curva = Curva::where('producto_id', $producto_id)->get();
            //curva
            $a_curva = $tallasCurva->sum('a') + $tallasCorte->sum('a');
            $b_curva = $tallasCurva->sum('b') + $tallasCorte->sum('b');
            $c_curva = $tallasCurva->sum('c') + $tallasCorte->sum('c');
            $d_curva = $tallasCurva->sum('d') + $tallasCorte->sum('d');
            $e_curva = $tallasCurva->sum('e') + $tallasCorte->sum('e');
            $f_curva = $tallasCurva->sum('f') + $tallasCorte->sum('f');
            $g_curva = $tallasCurva->sum('g') + $tallasCorte->sum('g');
            $h_curva = $tallasCurva->sum('h') + $tallasCorte->sum('h');
            $i_curva = $tallasCurva->sum('i') + $tallasCorte->sum('i');
            $j_curva = $tallasCurva->sum('j') + $tallasCorte->sum('j');
            $k_curva = $tallasCurva->sum('k') + $tallasCorte->sum('k');
            $l_curva = $tallasCurva->sum('l') + $tallasCorte->sum('l');
            $total_curva = $a_curva + $b_curva + $c_curva + $d_curva + $e_curva + $f_curva + $g_curva + $h_curva + $i_curva +
                $j_curva + $k_curva + $l_curva;
        } elseif (!is_object($tallasAlmacenCurva || $tallasAlmacenCurva == null)) {

            "test";
            //curva
            $a_curva = $tallasCurva->sum('a') + $tallasCorte->sum('a') ;
            $b_curva = $tallasCurva->sum('b') + $tallasCorte->sum('b');
            $c_curva = $tallasCurva->sum('c') + $tallasCorte->sum('c');
            $d_curva = $tallasCurva->sum('d') + $tallasCorte->sum('d');
            $e_curva = $tallasCurva->sum('e') + $tallasCorte->sum('e');
            $f_curva = $tallasCurva->sum('f') + $tallasCorte->sum('f');
            $g_curva = $tallasCurva->sum('g') + $tallasCorte->sum('g');
            $h_curva = $tallasCurva->sum('h') + $tallasCorte->sum('h');
            $i_curva = $tallasCurva->sum('i') + $tallasCorte->sum('i');
            $j_curva = $tallasCurva->sum('j') + $tallasCorte->sum('j');
            $k_curva = $tallasCurva->sum('k') + $tallasCorte->sum('k');
            $l_curva = $tallasCurva->sum('l') + $tallasCorte->sum('l');
            $total_curva = $a_curva + $b_curva + $c_curva + $d_curva + $e_curva + $f_curva + $g_curva + $h_curva + $i_curva +
                $j_curva + $k_curva + $l_curva;
        }


        $curva = CurvaProducto::where('producto_id', $producto_curva)->latest()->first();

        //porcentaje curva general
        // $tallas = Talla::

        $a = $curva->a;
        $b = $curva->b;
        $c = $curva->c;
        $d = $curva->d;
        $e = $curva->e;
        $f = $curva->f;
        $g = $curva->g;
        $h = $curva->h;
        $i = $curva->i;
        $j = $curva->j;
        $k = $curva->k;
        $l = $curva->l;

        // $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        //calcular total con perdidas y segundas y ordenes de pedido

        $tallasAlmacen = AlmacenDetalle::where('producto_id', $producto_id)->get();

        $a_alm = $tallasAlmacen->sum('a') - $tallasSegundas->sum('a') - $tallasOrdenes->sum('a');
        $b_alm = $tallasAlmacen->sum('b') - $tallasSegundas->sum('b') - $tallasOrdenes->sum('b');
        $c_alm = $tallasAlmacen->sum('c') - $tallasSegundas->sum('c') - $tallasOrdenes->sum('c');
        $d_alm = $tallasAlmacen->sum('d') - $tallasSegundas->sum('d') - $tallasOrdenes->sum('d');
        $e_alm = $tallasAlmacen->sum('e') - $tallasSegundas->sum('e') - $tallasOrdenes->sum('e');
        $f_alm = $tallasAlmacen->sum('f') - $tallasSegundas->sum('f') - $tallasOrdenes->sum('f');
        $g_alm = $tallasAlmacen->sum('g') - $tallasSegundas->sum('g') - $tallasOrdenes->sum('g');
        $h_alm = $tallasAlmacen->sum('h') - $tallasSegundas->sum('h') - $tallasOrdenes->sum('h');
        $i_alm = $tallasAlmacen->sum('i') - $tallasSegundas->sum('i') - $tallasOrdenes->sum('i');
        $j_alm = $tallasAlmacen->sum('j') - $tallasSegundas->sum('j') - $tallasOrdenes->sum('j');
        $k_alm = $tallasAlmacen->sum('k') - $tallasSegundas->sum('k') - $tallasOrdenes->sum('k');
        $l_alm = $tallasAlmacen->sum('l') - $tallasSegundas->sum('l') - $tallasOrdenes->sum('l');

        $a_alm = ($a_alm <= 0 || empty($a) || $a == 0.00   ? 0 : $a_alm);
        $b_alm = ($b_alm <= 0 || empty($b) || $b == 0.00   ? 0 : $b_alm);
        $c_alm = ($c_alm <= 0 || empty($c) || $c == 0.00   ? 0 : $c_alm);
        $d_alm = ($d_alm <= 0 || empty($d) || $d == 0.00   ? 0 : $d_alm);
        $e_alm = ($e_alm <= 0 || empty($e) || $e == 0.00   ? 0 : $e_alm);
        $f_alm = ($f_alm <= 0 || empty($f) || $f == 0.00   ? 0 : $f_alm);
        $g_alm = ($g_alm <= 0 || empty($g) || $g == 0.00   ? 0 : $g_alm);
        $h_alm = ($h_alm <= 0 || empty($h) || $h == 0.00   ? 0 : $h_alm);
        $i_alm = ($i_alm <= 0 || empty($i) || $i == 0.00   ? 0 : $i_alm);
        $j_alm = ($j_alm <= 0 || empty($j) || $j == 0.00   ? 0 : $j_alm);
        $k_alm = ($k_alm <= 0 || empty($k) || $k == 0.00   ? 0 : $k_alm);
        $l_alm = ($l_alm <= 0 || empty($l) || $l == 0.00   ? 0 : $l_alm);

        $total_alm = $a_alm + $b_alm + $c_alm + $d_alm + $e_alm + $f_alm + $g_alm + $h_alm + $i_alm + $j_alm + $k_alm + $l_alm;

        // echo $e_alm;
        // die();
        //porcentaje alm
        $a_perc = (empty($a)) ? 0 : ($a_alm / $total_alm) * 100;
        $b_perc = (empty($b)) ? 0 : ($b_alm / $total_alm) * 100;
        $c_perc = (empty($c)) ? 0 : ($c_alm / $total_alm) * 100;
        $d_perc = (empty($d)) ? 0 : ($d_alm / $total_alm) * 100;
        $e_perc = (empty($e)) ? 0 : ($e_alm / $total_alm) * 100;
        $f_perc = (empty($f)) ? 0 : ($f_alm / $total_alm) * 100;
        $g_perc = (empty($g)) ? 0 : ($g_alm / $total_alm) * 100;
        $h_perc = (empty($h)) ? 0 : ($h_alm / $total_alm) * 100;
        $i_perc = (empty($i)) ? 0 : ($i_alm / $total_alm) * 100;
        $j_perc = (empty($j)) ? 0 : ($j_alm / $total_alm) * 100;
        $k_perc = (empty($k)) ? 0 : ($k_alm / $total_alm) * 100;
        $l_perc = (empty($l)) ? 0 : ($l_alm / $total_alm) * 100;

        $a_perc = (empty($clienteDistribucion->a) ? $a_perc : $a_perc - $clienteDistribucion->a);
        $b_perc = (empty($clienteDistribucion->b) ? $b_perc : $b_perc - $clienteDistribucion->b);
        $c_perc = (empty($clienteDistribucion->c) ? $c_perc : $c_perc - $clienteDistribucion->c);
        $d_perc = (empty($clienteDistribucion->d) ? $d_perc : $d_perc - $clienteDistribucion->d);
        $e_perc = (empty($clienteDistribucion->e) ? $e_perc : $e_perc - $clienteDistribucion->e);
        $f_perc = (empty($clienteDistribucion->f) ? $f_perc : $f_perc - $clienteDistribucion->f);
        $g_perc = (empty($clienteDistribucion->g) ? $g_perc : $g_perc - $clienteDistribucion->g);
        $h_perc = (empty($clienteDistribucion->h) ? $h_perc : $h_perc - $clienteDistribucion->h);
        $i_perc = (empty($clienteDistribucion->i) ? $i_perc : $i_perc - $clienteDistribucion->i);
        $j_perc = (empty($clienteDistribucion->j) ? $j_perc : $j_perc - $clienteDistribucion->j);
        $k_perc = (empty($clienteDistribucion->k) ? $k_perc : $k_perc - $clienteDistribucion->k);
        $l_perc = (empty($clienteDistribucion->l) ? $l_perc : $l_perc - $clienteDistribucion->l);

        $total_perc = $a_perc + $b_perc + $c_perc + $d_perc + $e_perc + $f_perc + $g_perc + $h_perc +
        $i_perc + $j_perc + $k_perc + $l_perc;

        // echo $curva;
        // die();

        //segundo calculo
        $a_seg = ($a_alm <= 0 || empty($a) || $a == 0.00) ? 0.1 : ($a_perc - $a) / $a;
        $b_seg = ($b_alm == 0 || empty($b) || $b == 0.00) ? 0.1 : ($b_perc - $b) / $b;
        $c_seg = ($c_alm == 0 || empty($c) || $c == 0.00) ? 0.1 : ($c_perc - $c) / $c;
        $d_seg = ($d_alm == 0 || empty($d) || $d == 0.00) ? 0.1 : ($d_perc - $d) / $d;
        $e_seg = ($e_alm == 0 || empty($e) || $e == 0.00) ? 0.1 : ($e_perc - $e) / $e;
        $f_seg = ($f_alm == 0 || empty($f) || $f == 0.00) ? 0.1 : ($f_perc - $f) / $f;
        $g_seg = ($g_alm == 0 || empty($g) || $g == 0.00) ? 0.1 : ($g_perc - $g) / $g;
        $h_seg = ($h_alm == 0 || empty($h) || $h == 0.00) ? 0.1 : ($h_perc - $h) / $h;
        $i_seg = ($i_alm == 0 || empty($i) || $i == 0.00) ? 0.1 : ($i_perc - $i) / $i;
        $j_seg = ($j_alm == 0 || empty($j) || $j == 0.00) ? 0.1 : ($j_perc - $j) / $j;
        $k_seg = ($k_alm == 0 || empty($k) || $k == 0.00) ? 0.1 : ($k_perc - $k) / $k;
        $l_seg = ($l_alm == 0 || empty($l) || $l == 0.00) ? 0.1 : ($l_perc - $l) / $l;

        //tercer calculo
        $a_ter = ($a_seg == 0.1) ? 0 : $a_perc * (1 + $a_seg) / 100;
        $b_ter = ($b_seg == 0.1) ? 0 : $b_perc * (1 + $b_seg) / 100;
        $c_ter = ($c_seg == 0.1) ? 0 : $c_perc * (1 + $c_seg) / 100;
        $d_ter = ($d_seg == 0.1) ? 0 : $d_perc * (1 + $d_seg) / 100;
        $e_ter = ($e_seg == 0.1) ? 0 : $e_perc * (1 + $e_seg) / 100;
        $f_ter = ($f_seg == 0.1) ? 0 : $f_perc * (1 + $f_seg) / 100;
        $g_ter = ($g_seg == 0.1) ? 0 : $g_perc * (1 + $g_seg) / 100;
        $h_ter = ($h_seg == 0.1) ? 0 : $h_perc * (1 + $h_seg) / 100;
        $i_ter = ($i_seg == 0.1) ? 0 : $i_perc * (1 + $i_seg) / 100;
        $j_ter = ($j_seg == 0.1) ? 0 : $j_perc * (1 + $j_seg) / 100;
        $k_ter = ($k_seg == 0.1) ? 0 : $k_perc * (1 + $k_seg) / 100;
        $l_ter = ($l_seg == 0.1) ? 0 : $l_perc * (1 + $l_seg) / 100;

        //redistribuir
        $a_red = round($cantidad * $a_ter);
        $b_red = round($cantidad * $b_ter);
        $c_red = round($cantidad * $c_ter);
        $d_red = round($cantidad * $d_ter);
        $e_red = round($cantidad * $e_ter);
        $f_red = round($cantidad * $f_ter);
        $g_red = round($cantidad * $g_ter);
        $h_red = round($cantidad * $h_ter);
        $i_red = round($cantidad * $i_ter);
        $j_red = round($cantidad * $j_ter);
        $k_red = round($cantidad * $k_ter);
        $l_red = round($cantidad * $l_ter);
        
        $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        // $cant_total = round($cant_total);

        // $cantidad_pedida = $ordenDetalle->cantidad;
        // $diferencia_distri = $cantidad_pedida - $cant_total; 

        // $diferencia = abs($diferencia_distri);

        // if($cant_total != $cantidad_pedida){

        
        //     if($cant_total > $cantidad_pedida){
        //         $a_round = round($cantidad * $a_ter, 2);
        //         $b_round = round($cantidad * $b_ter, 2);
        //         $c_round = round($cantidad * $c_ter, 2);
        //         $d_round = round($cantidad * $d_ter, 2);
        //         $e_round = round($cantidad * $e_ter, 2);
        //         $f_round = round($cantidad * $f_ter, 2);
        //         $g_round = round($cantidad * $g_ter, 2);
        //         $h_round = round($cantidad * $h_ter, 2);
        //         $i_round = round($cantidad * $i_ter, 2);
        //         $j_round = round($cantidad * $j_ter, 2);
        //         $k_round = round($cantidad * $k_ter, 2);
        //         $l_round = round($cantidad * $l_ter, 2);
        
        //         $total_round = $a_round + $b_round + $c_round + $d_round + $e_round + $f_round + $g_round + $h_round +
        //         $i_round + $j_round + $k_round + $l_round;
        //         //Cambios a la redistribucion para corregir problema de total mayor o menos

        //         $count = 0;
        //         while($count <= $diferencia){

                 
        //             //Resta de lo redondeado y el resultado
        //             $dif_red_a = $a_round - $a_red; 
        //             $dif_red_b = $b_round - $b_red;
        //             $dif_red_c = $c_round - $c_red;
        //             $dif_red_d = $d_round - $d_red;
        //             $dif_red_e = $e_round - $e_red;
        //             $dif_red_f = $f_round - $f_red;
        //             $dif_red_g = $g_round - $g_red;
        //             $dif_red_h = $h_round - $h_red;
        //             $dif_red_i = $i_round - $i_red;
        //             $dif_red_j = $j_round - $j_red;
        //             $dif_red_k = $k_round - $k_red;
        //             $dif_red_l = $l_round - $l_red;
            
        //             $total_dif = $dif_red_a + $dif_red_b + $dif_red_c + $dif_red_d + $dif_red_e + $dif_red_f + $dif_red_g +
        //             $dif_red_h + $dif_red_i + $dif_red_j + $dif_red_k + $dif_red_l;
                
        //             //Absoluto
        //             $a_abs = abs($dif_red_a);
        //             $b_abs = abs($dif_red_b);
        //             $c_abs = abs($dif_red_c);
        //             $d_abs = abs($dif_red_d);
        //             $e_abs = abs($dif_red_e);
        //             $f_abs = abs($dif_red_f);
        //             $g_abs = abs($dif_red_g);
        //             $h_abs = abs($dif_red_h);
        //             $i_abs = abs($dif_red_i);
        //             $j_abs = abs($dif_red_j);
        //             $k_abs = abs($dif_red_k);
        //             $l_abs = abs($dif_red_l);
            
        //             //max Value of the ABS
        //             $max_abs = max($a_abs, $b_abs, $c_abs, $d_abs, $e_abs, $f_abs, $g_abs, 
        //             $h_abs, $i_abs, $j_abs, $k_abs, $l_abs);
            
            
        //             // $a_abs_equal = ($a_abs == $max_abs) ? $max_abs : 0;
        //             // $b_abs_equal = ($b_abs == $max_abs) ? $max_abs : 0;
        //             // $c_abs_equal = ($c_abs == $max_abs) ? $max_abs : 0;
        //             // $d_abs_equal = ($d_abs == $max_abs) ? $max_abs : 0;
        //             // $e_abs_equal = ($e_abs == $max_abs) ? $max_abs : 0;
        //             // $f_abs_equal = ($f_abs == $max_abs) ? $max_abs : 0;
        //             // $g_abs_equal = ($g_abs == $max_abs) ? $max_abs : 0;
        //             // $h_abs_equal = ($h_abs == $max_abs) ? $max_abs : 0;
        //             // $i_abs_equal = ($i_abs == $max_abs) ? $max_abs : 0;
        //             // $j_abs_equal = ($j_abs == $max_abs) ? $max_abs : 0;
        //             // $k_abs_equal = ($k_abs == $max_abs) ? $max_abs : 0;
        //             // $l_abs_equal = ($l_abs == $max_abs) ? $max_abs : 0;
            
        //             $a_equal = ($a_abs == $max_abs) ? 1 : 0;
        //             $b_equal = ($b_abs == $max_abs) ? 1 : 0;
        //             $c_equal = ($c_abs == $max_abs) ? 1 : 0;
        //             $d_equal = ($d_abs == $max_abs) ? 1 : 0;
        //             $e_equal = ($e_abs == $max_abs) ? 1 : 0;
        //             $f_equal = ($f_abs == $max_abs) ? 1 : 0;
        //             $g_equal = ($g_abs == $max_abs) ? 1 : 0;
        //             $h_equal = ($h_abs == $max_abs) ? 1 : 0;
        //             $i_equal = ($i_abs == $max_abs) ? 1 : 0;
        //             $j_equal = ($j_abs == $max_abs) ? 1 : 0;
        //             $k_equal = ($k_abs == $max_abs) ? 1 : 0;
        //             $l_equal = ($l_abs == $max_abs) ? 1 : 0;

        //             $a_red = $a_red - $a_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $b_red = $b_red - $b_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
                    
        //             $c_red = $c_red - $c_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $d_red = $d_red - $d_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $e_red = $e_red - $e_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $f_red = $f_red - $f_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $g_red = $g_red - $g_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $h_red = $h_red - $h_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $i_red = $i_red - $i_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $j_red = $j_red - $j_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $k_red = $k_red - $k_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $l_red = $l_red - $l_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $count++;
        //         }
        //     }  
            
        //     if($cant_total < $cantidad_pedida){

        //         $a_round = round($cantidad * $a_ter, 2);
        //         $b_round = round($cantidad * $b_ter, 2);
        //         $c_round = round($cantidad * $c_ter, 2);
        //         $d_round = round($cantidad * $d_ter, 2);
        //         $e_round = round($cantidad * $e_ter, 2);
        //         $f_round = round($cantidad * $f_ter, 2);
        //         $g_round = round($cantidad * $g_ter, 2);
        //         $h_round = round($cantidad * $h_ter, 2);
        //         $i_round = round($cantidad * $i_ter, 2);
        //         $j_round = round($cantidad * $j_ter, 2);
        //         $k_round = round($cantidad * $k_ter, 2);
        //         $l_round = round($cantidad * $l_ter, 2);
        
        //         $total_round = $a_round + $b_round + $c_round + $d_round + $e_round + $f_round + $g_round + $h_round +
        //         $i_round + $j_round + $k_round + $l_round;
        //         //Cambios a la redistribucion para corregir problema de total mayor o menos
        //         $count = 0;
        //         while($count <= $diferencia){

                   
                    
        //             //Resta de lo redondeado y el resultado
        //             $dif_red_a = $a_round - $a_red ; 
        //             $dif_red_b = $b_round - $b_red;
        //             $dif_red_c = $c_round - $c_red;
        //             $dif_red_d = $d_round - $d_red;
        //             $dif_red_e = $e_round - $e_red;
        //             $dif_red_f = $f_round - $f_red;
        //             $dif_red_g = $g_round - $g_red;
        //             $dif_red_h = $h_round - $h_red;
        //             $dif_red_i = $i_round - $i_red;
        //             $dif_red_j = $j_round - $j_red;
        //             $dif_red_k = $k_round - $k_red;
        //             $dif_red_l = $l_round - $l_red;
            
        //             $total_dif = $dif_red_a + $dif_red_b + $dif_red_c + $dif_red_d + $dif_red_e + $dif_red_f + $dif_red_g +
        //             $dif_red_h + $dif_red_i + $dif_red_j + $dif_red_k + $dif_red_l;
                    
        //             //Absoluto
        //             $a_abs = abs($dif_red_a);
        //             $b_abs = abs($dif_red_b);
        //             $c_abs = abs($dif_red_c);
        //             $d_abs = abs($dif_red_d);
        //             $e_abs = abs($dif_red_e);
        //             $f_abs = abs($dif_red_f);
        //             $g_abs = abs($dif_red_g);
        //             $h_abs = abs($dif_red_h);
        //             $i_abs = abs($dif_red_i);
        //             $j_abs = abs($dif_red_j);
        //             $k_abs = abs($dif_red_k);
        //             $l_abs = abs($dif_red_l);
            
        //             //max Value of the ABS
        //             $max_abs = max($a_abs, $b_abs, $c_abs, $d_abs, $e_abs, $f_abs, $g_abs, 
        //             $h_abs, $i_abs, $j_abs, $k_abs, $l_abs);
            
            
        //             // $a_abs_equal = ($a_abs == $max_abs) ? $max_abs : 0;
        //             // $b_abs_equal = ($b_abs == $max_abs) ? $max_abs : 0;
        //             // $c_abs_equal = ($c_abs == $max_abs) ? $max_abs : 0;
        //             // $d_abs_equal = ($d_abs == $max_abs) ? $max_abs : 0;
        //             // $e_abs_equal = ($e_abs == $max_abs) ? $max_abs : 0;
        //             // $f_abs_equal = ($f_abs == $max_abs) ? $max_abs : 0;
        //             // $g_abs_equal = ($g_abs == $max_abs) ? $max_abs : 0;
        //             // $h_abs_equal = ($h_abs == $max_abs) ? $max_abs : 0;
        //             // $i_abs_equal = ($i_abs == $max_abs) ? $max_abs : 0;
        //             // $j_abs_equal = ($j_abs == $max_abs) ? $max_abs : 0;
        //             // $k_abs_equal = ($k_abs == $max_abs) ? $max_abs : 0;
        //             // $l_abs_equal = ($l_abs == $max_abs) ? $max_abs : 0;
            
        //             $a_equal = ($a_abs == $max_abs) ? 1 : 0;
        //             $b_equal = ($b_abs == $max_abs) ? 1 : 0;
        //             $c_equal = ($c_abs == $max_abs) ? 1 : 0;
        //             $d_equal = ($d_abs == $max_abs) ? 1 : 0;
        //             $e_equal = ($e_abs == $max_abs) ? 1 : 0;
        //             $f_equal = ($f_abs == $max_abs) ? 1 : 0;
        //             $g_equal = ($g_abs == $max_abs) ? 1 : 0;
        //             $h_equal = ($h_abs == $max_abs) ? 1 : 0;
        //             $i_equal = ($i_abs == $max_abs) ? 1 : 0;
        //             $j_equal = ($j_abs == $max_abs) ? 1 : 0;
        //             $k_equal = ($k_abs == $max_abs) ? 1 : 0;
        //             $l_equal = ($l_abs == $max_abs) ? 1 : 0;

        //             $a_red = $a_red + $a_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $b_red = $b_red + $b_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
                    
        //             $c_red = $c_red + $c_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $d_red = $d_red + $d_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $e_red = $e_red + $e_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $f_red = $f_red + $f_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $g_red = $g_red + $g_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $h_red = $h_red + $h_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $i_red = $i_red + $i_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $j_red = $j_red + $j_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $k_red = $k_red + $k_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $l_red = $l_red + $l_equal;
        //             $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //             if($cant_total == $cantidad_pedida){
        //                 break;
        //             }
        //             $count++;
        //         }
        //     }

        // }

            

        //     if($cant_total > $cantidad_pedida){
        //         $a_red = $a_red - $a_equal;
        //         $b_red = $b_red - $b_equal;
        //         $c_red = $c_red - $c_equal;
        //         $d_red = $d_red - $d_equal;
        //         $e_red = $e_red - $e_equal;
        //         $f_red = $f_red - $f_equal;
        //         $g_red = $g_red - $g_equal;
        //         $h_red = $h_red - $h_equal;
        //         $i_red = $i_red - $i_equal;
        //         $j_red = $j_red - $j_equal;
        //         $k_red = $k_red - $k_equal;
        //         $l_red = $l_red - $l_equal;
        //         $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //         // $cant_total = round($cant_total);
        //     } else if($cant_total < $cantidad_pedida){
        //         $a_red = $a_red + $a_equal;
        //         $b_red = $b_red + $b_equal;
        //         $c_red = $c_red + $c_equal;
        //         $d_red = $d_red + $d_equal;
        //         $e_red = $e_red + $e_equal;
        //         $f_red = $f_red + $f_equal;
        //         $g_red = $g_red + $g_equal;
        //         $h_red = $h_red + $h_equal;
        //         $i_red = $i_red + $i_equal;
        //         $j_red = $j_red + $j_equal;
        //         $k_red = $k_red + $k_equal;
        //         $l_red = $l_red + $l_equal;
        //         $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //     }
        // }

        // if($cant_total != $cantidad_pedida){ 
        //     //segundo Mayor absoluto
        //     $a_abs2 = $a_abs - $a_abs_equal;
        //     $b_abs2 = $b_abs - $b_abs_equal;  
        //     $c_abs2 = $c_abs - $c_abs_equal;  
        //     $d_abs2 = $d_abs - $d_abs_equal;  
        //     $e_abs2 = $e_abs - $e_abs_equal;  
        //     $f_abs2 = $f_abs - $f_abs_equal;  
        //     $g_abs2 = $g_abs - $g_abs_equal;  
        //     $h_abs2 = $h_abs - $h_abs_equal;  
        //     $i_abs2 = $i_abs - $i_abs_equal;  
        //     $j_abs2 = $j_abs - $j_abs_equal;  
        //     $k_abs2 = $k_abs - $k_abs_equal;  
        //     $l_abs2 = $l_abs - $l_abs_equal; 
            
        //     $max_abs2 = max($a_abs2, $b_abs2, $c_abs2, $d_abs2, $e_abs2, $f_abs2, $g_abs2, 
        //     $h_abs2, $i_abs2, $j_abs2, $k_abs2, $l_abs2);

        //     $a_abs2_equal = ($a_abs == $max_abs2) ? $max_abs2 : 0;
        //     $b_abs2_equal = ($b_abs == $max_abs2) ? $max_abs2 : 0;
        //     $c_abs2_equal = ($c_abs == $max_abs2) ? $max_abs2 : 0;
        //     $d_abs2_equal = ($d_abs == $max_abs2) ? $max_abs2 : 0;
        //     $e_abs2_equal = ($e_abs == $max_abs2) ? $max_abs2 : 0;
        //     $f_abs2_equal = ($f_abs == $max_abs2) ? $max_abs2 : 0;
        //     $g_abs2_equal = ($g_abs == $max_abs2) ? $max_abs2 : 0;
        //     $h_abs2_equal = ($h_abs == $max_abs2) ? $max_abs2 : 0;
        //     $i_abs2_equal = ($i_abs == $max_abs2) ? $max_abs2 : 0;
        //     $j_abs2_equal = ($j_abs == $max_abs2) ? $max_abs2 : 0;
        //     $k_abs2_equal = ($k_abs == $max_abs2) ? $max_abs2 : 0;
        //     $l_abs2_equal = ($l_abs == $max_abs2) ? $max_abs2 : 0;


        //     $a_equal2 = ($a_abs == $max_abs2) ? 1 : 0;
        //     $b_equal2 = ($b_abs == $max_abs2) ? 1 : 0;
        //     $c_equal2 = ($c_abs == $max_abs2) ? 1 : 0;
        //     $d_equal2 = ($d_abs == $max_abs2) ? 1 : 0;
        //     $e_equal2 = ($e_abs == $max_abs2) ? 1 : 0;
        //     $f_equal2 = ($f_abs == $max_abs2) ? 1 : 0;
        //     $g_equal2 = ($g_abs == $max_abs2) ? 1 : 0;
        //     $h_equal2 = ($h_abs == $max_abs2) ? 1 : 0;
        //     $i_equal2 = ($i_abs == $max_abs2) ? 1 : 0;
        //     $j_equal2 = ($j_abs == $max_abs2) ? 1 : 0;
        //     $k_equal2 = ($k_abs == $max_abs2) ? 1 : 0;
        //     $l_equal2 = ($l_abs == $max_abs2) ? 1 : 0;

        //     if($cant_total > $cantidad_pedida){
        //         $a_red = $a_red - $a_equal2;
        //         $b_red = $b_red - $b_equal2;
        //         $c_red = $c_red - $c_equal2;
        //         $d_red = $d_red - $d_equal2;
        //         $e_red = $e_red - $e_equal2;
        //         $f_red = $f_red - $f_equal2;
        //         $g_red = $g_red - $g_equal2;
        //         $h_red = $h_red - $h_equal2;
        //         $i_red = $i_red - $i_equal2;
        //         $j_red = $j_red - $j_equal2;
        //         $k_red = $k_red - $k_equal2;
        //         $l_red = $l_red - $l_equal2;
        //         $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //         // $cant_total = round($cant_total);
        //     } else if($cant_total < $cantidad_pedida){
        //         $a_red = $a_red + $a_equal2;
        //         $b_red = $b_red + $b_equal2;
        //         $c_red = $c_red + $c_equal2;
        //         $d_red = $d_red + $d_equal2;
        //         $e_red = $e_red + $e_equal2;
        //         $f_red = $f_red + $f_equal2;
        //         $g_red = $g_red + $g_equal2;
        //         $h_red = $h_red + $h_equal2;
        //         $i_red = $i_red + $i_equal2;
        //         $j_red = $j_red + $j_equal2;
        //         $k_red = $k_red + $k_equal2;
        //         $l_red = $l_red + $l_equal2;
        //         $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        //     }
        // }
      

        // $result_a = $a_equal2 + $a_equal;
        // $result_b = $b_equal2 + $b_equal;
        // $result_c = $c_equal2 + $c_equal;
        // $result_d = $d_equal2 + $d_equal;
        // $result_e = $e_equal2 + $e_equal;
        // $result_f = $f_equal2 + $f_equal;
        // $result_g = $g_equal2 + $g_equal;
        // $result_h = $h_equal2 + $h_equal;
        // $result_i = $i_equal2 + $i_equal;
        // $result_j = $j_equal2 + $j_equal;
        // $result_k = $k_equal2 + $k_equal;
        // $result_l = $l_equal2 + $l_equal;

    
        
        // if($cantidad_pedida != $cant_total){
        //     if($cant_total > $cantidad_pedida){
        //         $a_red = $a_red - $result_a;
        //     }else {

        //     }
        // }

        // $a_red_rounded = round($a_red);
        // $b_red_rounded = round($b_red);
        // $c_red_rounded = round($c_red);
        // $d_red_rounded = round($d_red);
        // $e_red_rounded = round($e_red);
        // $f_red_rounded = round($f_red);
        // $g_red_rounded = round($g_red);
        // $h_red_rounded = round($h_red);
        // $i_red_rounded = round($i_red);
        // $j_red_rounded = round($j_red);
        // $k_red_rounded = round($k_red);
        // $l_red_rounded = round($l_red);

        $referencia_producto = $producto->referencia_producto;
        $referencia_producto = substr($referencia_producto, 2, 1);


        // if ($cant_total > $cantidad) {
        //     $cant_dif = 0.2;

        //     while($cant_total > $cantidad){
        //         $a_red = $a_red - $cant_dif < 0 ? 0 : $a_red - $cant_dif;
        //         $b_red = $b_red - $cant_dif < 0 ? 0 : $b_red - $cant_dif;
        //         $c_red = $c_red - $cant_dif < 0 ? 0 : $c_red - $cant_dif;
        //         $d_red = $d_red - $cant_dif < 0 ? 0 : $d_red - $cant_dif;
        //         $e_red = $e_red - $cant_dif < 0 ? 0 : $e_red - $cant_dif;
        //         $f_red = $f_red - $cant_dif < 0 ? 0 : $f_red - $cant_dif;
        //         $g_red = $g_red - $cant_dif < 0 ? 0 : $g_red - $cant_dif;
        //         $h_red = $h_red - $cant_dif < 0 ? 0 : $h_red - $cant_dif;
        //         $i_red = $i_red - $cant_dif < 0 ? 0 : $i_red - $cant_dif;
        //         $j_red = $j_red - $cant_dif < 0 ? 0 : $j_red - $cant_dif;
        //         $k_red = $k_red - $cant_dif < 0 ? 0 : $k_red - $cant_dif;
        //         $l_red = $l_red - $cant_dif < 0 ? 0 : $l_red - $cant_dif;
        //         $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;

        //         $cant_dif+=0.1;
        //     }

        // }

        // if($cant_total < $cantidad){
        //     $cant_dif = 0.1;

        //     while($cant_total < $cantidad){
        //         $a_red = $a_red + $cant_dif < 0 ? 0 : $a_red + $cant_dif;
        //         $b_red = $b_red + $cant_dif < 0 ? 0 : $b_red + $cant_dif;
        //         $c_red = $c_red + $cant_dif < 0 ? 0 : $c_red + $cant_dif;
        //         $d_red = $d_red + $cant_dif < 0 ? 0 : $d_red + $cant_dif;
        //         $e_red = $e_red + $cant_dif < 0 ? 0 : $e_red + $cant_dif;
        //         $f_red = $f_red + $cant_dif < 0 ? 0 : $f_red + $cant_dif;
        //         $g_red = $g_red + $cant_dif < 0 ? 0 : $g_red + $cant_dif;
        //         $h_red = $h_red + $cant_dif < 0 ? 0 : $h_red + $cant_dif;
        //         $i_red = $i_red + $cant_dif < 0 ? 0 : $i_red + $cant_dif;
        //         $j_red = $j_red + $cant_dif < 0 ? 0 : $j_red + $cant_dif;
        //         $k_red = $k_red + $cant_dif < 0 ? 0 : $k_red + $cant_dif;
        //         $l_red = $l_red + $cant_dif < 0 ? 0 : $l_red + $cant_dif;
        //         $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;

        //         $cant_dif+=0.1;
        //     }
        // }

        //validacion
        // $a_red = ($a_red < 1 ? 0 : $a_red);
        // $b_red = ($b_red < 1 ? 0 : $b_red);
        // $c_red = ($c_red < 1 ? 0 : $c_red);
        // $d_red = ($d_red < 1 ? 0 : $d_red);
        // $e_red = ($e_red < 1 ? 0 : $e_red);
        // $f_red = ($f_red < 1 ? 0 : $f_red);
        // $g_red = ($g_red < 1 ? 0 : $g_red);
        // $h_red = ($h_red < 1 ? 0 : $h_red);
        // $i_red = ($i_red < 1 ? 0 : $i_red);
        // $j_red = ($j_red < 1 ? 0 : $j_red);
        // $k_red = ($k_red < 1 ? 0 : $k_red);
        // $l_red = ($l_red < 1 ? 0 : $l_red);

        // $a_red = round($a_red);
        // $b_red = round($b_red);
        // $c_red = round($c_red);
        // $d_red = round($d_red);
        // $e_red = round($e_red);
        // $f_red = round($f_red);
        // $g_red = round($g_red);
        // $h_red = round($h_red);
        // $i_red = round($i_red);
        // $j_red = round($j_red);
        // $k_red = round($k_red);
        // $l_red = round($l_red);
        // $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;


        $orden_pedido_detalle = ordenPedidoDetalle::where('id', $id)
        ->where('orden_pedido_id', $orden_id)
        ->where('cant_red', $cantidad)->get()->first();

        if (\is_object($orden_pedido_detalle)) {
            $orden_pedido_detalle->a = ($a_red < 0 ? 0 : $a_red);
            $orden_pedido_detalle->b = ($b_red < 0 ? 0 : $b_red);
            $orden_pedido_detalle->c = ($c_red < 0 ? 0 : $c_red);
            $orden_pedido_detalle->d = ($d_red < 0 ? 0 : $d_red);
            $orden_pedido_detalle->e = ($e_red < 0 ? 0 : $e_red);
            $orden_pedido_detalle->f = ($f_red < 0 ? 0 : $f_red);
            $orden_pedido_detalle->g = ($g_red < 0 ? 0 : $g_red);
            $orden_pedido_detalle->h = ($h_red < 0 ? 0 : $h_red);
            $orden_pedido_detalle->i = ($i_red < 0 ? 0 : $i_red);
            $orden_pedido_detalle->j = ($j_red < 0 ? 0 : $j_red);
            $orden_pedido_detalle->k = ($k_red < 0 ? 0 : $k_red);
            $orden_pedido_detalle->l = ($l_red < 0 ? 0 : $l_red);
            $orden_pedido_detalle->total = $cant_total;
            $orden_pedido_detalle->save();
        }

        //verificar numero antiguo de la secuencia;
        $numero_antiguo = DB::table('orden_empaque')->latest('updated_at')->first();

        if (empty($numero_antiguo) || $numero_antiguo == "") {
            $sec = 0.00;
        } else {
            $sec = $numero_antiguo->sec;
        }

        // $orden_pedido = ordenEmpaque::where('orden_pedido_id', $orden_id)->get()->first();

        // if (empty($orden_pedido) || $orden_pedido == "[]") {
        //     //Crear nuevo objeto de orden de empaque
        //     $orden_empaque = new ordenEmpaque();

        //     $orden_empaque->orden_pedido_id = $orden_id;
        //     $next_sec = $sec + 0.01;
        //     $orden_empaque->no_orden_empaque = "OE - " . str_replace('.', '', $next_sec);
        //     $orden_empaque->fecha = date('Y/m/d h:i:s');
        //     $orden_empaque->sec = $sec + 0.01;
        //     $orden_empaque->a = ($a_red < 0 ? 0 : $a_red);
        //     $orden_empaque->b = ($b_red < 0 ? 0 : $b_red);
        //     $orden_empaque->c = ($c_red < 0 ? 0 : $c_red);
        //     $orden_empaque->d = ($d_red < 0 ? 0 : $d_red);
        //     $orden_empaque->e = ($e_red < 0 ? 0 : $e_red);
        //     $orden_empaque->f = ($f_red < 0 ? 0 : $f_red);
        //     $orden_empaque->g = ($g_red < 0 ? 0 : $g_red);
        //     $orden_empaque->h = ($h_red < 0 ? 0 : $h_red);
        //     $orden_empaque->i = ($i_red < 0 ? 0 : $i_red);
        //     $orden_empaque->j = ($j_red < 0 ? 0 : $j_red);
        //     $orden_empaque->k = ($k_red < 0 ? 0 : $k_red);
        //     $orden_empaque->l = ($l_red < 0 ? 0 : $l_red);
        //     $orden_empaque->save();
        // }

        $data = [
            'code' => 200,
            'status' => 'success',
            // 'orden' => $orden,
            // 'cantidad' => $orden_pedido_detalle,
            'almacen' => 'almacen',
            'a_alm' => $a_alm,
            'b_alm' => $b_alm,
            'c_alm' => $c_alm,
            'd_alm' => $d_alm,
            'e_alm' => $e_alm,
            'f_alm' => $f_alm,
            'g_alm' => $g_alm,
            'h_alm' => $h_alm,
            'i_alm' => $i_alm,
            'j_alm' => $j_alm,
            'k_alm' => $k_alm,
            'l_alm' => $l_alm,
            'total_alm'=> $total_alm,
            'curva' => 'Curva',
            'a_%_alm' => $a_perc,
            'b_%_alm' => $b_perc,
            'c_%_alm' => $c_perc,
            'd_%_alm' => $d_perc,
            'e_%_alm' => $e_perc,
            'f_%_alm' => $f_perc,
            'g_%_alm' => $g_perc,
            'h_%_alm' => $h_perc,
            'i_%_alm' => $i_perc,
            'j_%_alm' => $j_perc,
            'k_%_alm' => $k_perc,
            'l_%_alm' => $l_perc,
            'total_%_curva' => $total_perc,
            'porcentaje' => 'porcentaje',
            'a_%_curva' => $a,
            'b_%_curva' => $b,
            'c_%_curva' => $c,
            'd_%_curva' => $d,
            'e_%_curva' => $e,
            'f_%_curva' => $f,
            'g_%_curva' => $g,
            'h_%_curva' => $h,
            'i_%_curva' => $i,
            'j_%_curva' => $j,
            'k_%_curva' => $k,
            'l_%_curva' => $l,
      
            'segundo' => 'Seg calculo',
            'a_seg' => $a_seg,
            'b_seg' => $b_seg,
            'c_seg' => $c_seg,
            'd_seg' => $d_seg,
            'e_seg' => $e_seg,
            'f_seg' => $f_seg,
            'g_seg' => $g_seg,
            'h_seg' => $h_seg,
            'i_seg' => $i_seg,
            'j_seg' => $j_seg,
            'k_seg' => $k_seg,
            'l_seg' => $l_seg,
            'tercero' => 'Ter calculo',
            'a_ter' => $a_ter,
            'b_ter' => $b_ter,
            'c_ter' => $c_ter,
            'd_ter' => $d_ter,
            'e_ter' => $e_ter,
            'f_ter' => $f_ter,
            'g_ter' => $g_ter,
            'h_ter' => $h_ter,
            'i_ter' => $i_ter,
            'j_ter' => $j_ter,
            'k_ter' => $k_seg,
            'l_ter' => $l_seg,
            'redistribuido' => 'Redistribuido',
            'a_red' => $a_red,
            'b_red' => $b_red,
            'c_red' => $c_red,
            'd_red' => $d_red,
            'e_red' => $e_red,
            'f_red' => $f_red,
            'g_red' => $g_red,
            'h_red' => $h_red,
            'i_red' => $i_red,
            'j_red' => $j_red,
            'k_red' => $k_red,
            'l_red' => $l_red,
            'total_red' => $cant_total,
            // 'pedido' => $cantidad_pedida,
            'redistribuido y redondeo' => 'Redistribuido redondeado',
            // 'a_round' => $a_round,
            // 'b_round' => $b_round,
            // 'c_round' => $c_round,
            // 'd_round' => $d_round,
            // 'e_round' => $e_round,
            // 'f_round' => $f_round,
            // 'g_round' => $g_round,
            // 'h_round' => $h_round,
            // 'i_round' => $i_round,
            // 'j_round' => $j_round,
            // 'k_round' => $k_round,
            // 'l_round' => $l_round,
            // 'total_round' => $total_round,
            // 'Diferencia' => $diferencia,
            // 'a_dif' => $dif_red_a,
            // 'b_dif' => $dif_red_b,
            // 'c_dif' => $dif_red_c,
            // 'd_dif' => $dif_red_d,
            // 'e_dif' => $dif_red_e,
            // 'f_dif' => $dif_red_f,
            // 'g_dif' => $dif_red_g,
            // 'h_dif' => $dif_red_h,
            // 'i_dif' => $dif_red_i,
            // 'j_dif' => $dif_red_j,
            // 'k_dif' => $dif_red_k,
            // 'l_dif' => $dif_red_l,
            // 'Absoluto' => 'Absoluto',
            // 'a_abs' => $a_abs,
            // 'b_abs' => $b_abs,
            // 'c_abs' => $c_abs,
            // 'd_abs' => $d_abs,
            // 'e_abs' => $e_abs,
            // 'f_abs' => $f_abs,
            // 'g_abs' => $g_abs,
            // 'h_abs' => $h_abs,
            // 'i_abs' => $i_abs,
            // 'j_abs' => $j_abs,
            // 'k_abs' => $k_abs,
            // 'l_abs' => $l_abs,
            // 'max_Abs' => $max_abs,
            // 'igual_al_abs' => 'igual_al_abs',
            // 'a_abs_equal' => $a_abs_equal,
            // 'b_abs_equal' => $b_abs_equal,
            // 'c_abs_equal' => $c_abs_equal,
            // 'd_abs_equal' => $d_abs_equal,
            // 'e_abs_equal' => $e_abs_equal,
            // 'f_abs_equal' => $f_abs_equal,
            // 'g_abs_equal' => $g_abs_equal,
            // 'h_abs_equal' => $h_abs_equal,
            // 'i_abs_equal' => $i_abs_equal,
            // 'j_abs_equal' => $j_abs_equal,
            // 'k_abs_equal' => $k_abs_equal,
            // 'l_abs_equal' => $l_abs_equal,
            // 'Equal' => 'ver coincidencia',
            // 'a_equal' => $a_equal,
            // 'b_equal' => $b_equal,
            // 'c_equal' => $c_equal,
            // 'd_equal' => $d_equal,
            // 'e_equal' => $e_equal,
            // 'f_equal' => $f_equal,
            // 'g_equal' => $g_equal,
            // 'h_equal' => $h_equal,
            // 'i_equal' => $i_equal,
            // 'j_equal' => $j_equal,
            // 'k_equal' => $k_equal,
            // 'l_equal' => $l_equal,
            // 'segundo Mayor absoluto',  
            // 'a_abs2' => $a_abs2,
            // 'b_abs2' => $b_abs2,
            // 'c_abs2' => $c_abs2,
            // 'd_abs2' => $d_abs2,
            // 'e_abs2' => $e_abs2,
            // 'f_abs2' => $f_abs2,
            // 'g_abs2' => $g_abs2,
            // 'h_abs2' => $h_abs2,
            // 'i_abs2' => $i_abs2,
            // 'j_abs2' => $j_abs2,
            // 'k_abs2' => $k_abs2,
            // 'l_abs2' => $l_abs2,
            // 'segun mayor' => $max_abs2,
            // 'a_abs2_equal' => $a_abs2_equal,
            // 'b_abs2_equal' => $b_abs2_equal,
            // 'c_abs2_equal' => $c_abs2_equal,
            // 'd_abs2_equal' => $d_abs2_equal,
            // 'e_abs2_equal' => $e_abs2_equal,
            // 'f_abs2_equal' => $f_abs2_equal,
            // 'g_abs2_equal' => $g_abs2_equal,
            // 'h_abs2_equal' => $h_abs2_equal,
            // 'i_abs2_equal' => $i_abs2_equal,
            // 'j_abs2_equal' => $j_abs2_equal,
            // 'k_abs2_equal' => $k_abs2_equal,
            // 'l_abs2_equal' => $l_abs2_equal,
            // 'second_mayor',
            // 'a_equal2' => $a_equal2,
            // 'b_equal2' => $b_equal2,
            // 'c_equal2' => $c_equal2,
            // 'd_equal2' => $d_equal2,
            // 'e_equal2' => $e_equal2,
            // 'f_equal2' => $f_equal2,
            // 'g_equal2' => $g_equal2,
            // 'h_equal2' => $h_equal2,
            // 'i_equal2' => $i_equal2,
            // 'j_equal2' => $j_equal2,
            // 'k_equal2' => $k_equal2,
            // 'l_equal2' => $l_equal2,
            // 'cant-detalle' => $cantidad,
          
            // 'detalle' => $orden_pedido_detalle,
            // 'genero' => $referencia_producto,
            // 'a_orden' => $tallasOrdenes->sum('a'),
            // 'b_orden' => $tallasOrdenes->sum('b'),
            // 'c_orden' => $tallasOrdenes->sum('c'),
            // 'd_orden' => $tallasOrdenes->sum('d'),
            // 'e_orden' => $tallasOrdenes->sum('e'),
            // 'f_orden' => $tallasOrdenes->sum('f'),
            // 'g_orden' => $tallasOrdenes->sum('g'),
            // 'h_orden' => $tallasOrdenes->sum('h'),
            // 'i_orden' => $tallasOrdenes->sum('i'),
            // 'j_orden' => $tallasOrdenes->sum('j'),
            // 'k_orden' => $tallasOrdenes->sum('k'),
            // 'l_orden' => $tallasOrdenes->sum('l'),
        ];


        return response()->json($data, $data['code']);
    }


    public function empaqueCompletar(Request $request){

        $orden_id = $request->input('orden');
        $orden_empaque_id = $request->input('orden_empaque');

        $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden_id)->get();

        $empaqueDetalle = ordenEmpaqueDetalle::where('orden_empaque_id', $orden_empaque_id)->get();

        for ($i=0; $i < count($ordenDetalle) ; $i++) { 
            if($ordenDetalle[$i]->producto_id == $empaqueDetalle[$i]->producto_id){
                $ordenDetalle[$i]->a = $empaqueDetalle[$i]->a;
                $ordenDetalle[$i]->b = $empaqueDetalle[$i]->b;
                $ordenDetalle[$i]->c = $empaqueDetalle[$i]->c;
                $ordenDetalle[$i]->d = $empaqueDetalle[$i]->d;
                $ordenDetalle[$i]->e = $empaqueDetalle[$i]->e;
                $ordenDetalle[$i]->f = $empaqueDetalle[$i]->f;
                $ordenDetalle[$i]->g = $empaqueDetalle[$i]->g;
                $ordenDetalle[$i]->h = $empaqueDetalle[$i]->h;
                $ordenDetalle[$i]->i = $empaqueDetalle[$i]->i;
                $ordenDetalle[$i]->j = $empaqueDetalle[$i]->j;
                $ordenDetalle[$i]->k = $empaqueDetalle[$i]->k;
                $ordenDetalle[$i]->l = $empaqueDetalle[$i]->l;
                $ordenDetalle[$i]->total = $empaqueDetalle[$i]->total;
                $ordenDetalle[$i]->save();
            }
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'ordenDetalle' => $ordenDetalle,
            'ordenEmpaque' => $empaqueDetalle
         
        ];

        return response()->json($data, $data['code']);
    }

    public function editarEmpaque(Request $request){


        $orden_id = $request->input('orden');
        $orden_empaque_id = $request->input('orden_empaque');

        $ordenes_facturacion = ordenFacturacion::where('orden_empaque_id', $orden_empaque_id)->get();

        for ($i=0; $i < count($ordenes_facturacion) ; $i++) { 
            $ordenes_facturacion[$i]->delete();
        }


        $ordenes_facturacion_detalle = ordenFacturacionDetalle::where('orden_pedido_id', $orden_id)->get();

        for ($i=0; $i < count($ordenes_facturacion_detalle) ; $i++) { 
            $ordenes_facturacion_detalle[$i]->delete();
        }

        $detalle_empaque = ordenEmpaqueDetalle::where('orden_empaque_id', $orden_empaque_id)->get();

        for ($i=0; $i < count($detalle_empaque) ; $i++) { 
            $detalle_empaque[$i]->delete();
        }

        $empaque = ordenEmpaque::find($orden_empaque_id);

        $empaque->empacado = 0;
        $empaque->impreso = 0;
        $empaque->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'ordenes_facturacion' => $ordenes_facturacion,
            'ordenes_facturacion_detalle' => $ordenes_facturacion_detalle,
            'detalle_empaque' => $detalle_empaque
         
        ];

        return response()->json($data, $data['code']);

    
    }


    // public function validarCantidades(Request $request){

    //     $a = $request->input('a');
    //     $b = $request->input('b');
    //     $c = $request->input('c');
    //     $d = $request->input('d');
    //     $e = $request->input('e');
    //     $f = $request->input('f');
    //     $g = $request->input('g');
    //     $h = $request->input('h');
    //     $i = $request->input('i');
    //     $j = $request->input('j');
    //     $k = $request->input('k');
    //     $l = $request->input('l');
    //     $total = $request->input('total');
    // }

    public function show($id)
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Usuarios')
        ->first();
        if(Auth::user()->role != 'Administrador'){
            if($user_login->modificar == 0 || $user_login->modificar == null){
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
    
        }
        
        $orden_pedido = ordenPedido::find($id);
        $orden_id = $orden_pedido->id;

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $orden_id)->get()->load('producto');

        $cliente_id = $orden_pedido->cliente_id;
        $cliente = Client::find($cliente_id);

        $sucursal_id = $orden_pedido->sucursal_id;
        $sucursal = ClientBranch::find($sucursal_id);

        $orden_empaque = ordenEmpaque::where('orden_pedido_id', $orden_id)->get()->first();
        $empaque_id = $orden_empaque->id;


        // Eliminar detalle de empaque en caso de darle de nuevo al boton de mostrar
        $empaque_detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque_id)->get();

        //Orden facturacion
        $orden_facturacion = OrdenFacturacion::where('orden_empaque_id', $empaque_id)->first();

        if(!empty($empaque_detalle)){
            
            for ($i = 0; $i < count($empaque_detalle); $i++) {

                if($orden_detalle[$i]->producto_id == $empaque_detalle[$i]->producto_id){
                    

                    $orden_detalle[$i]->a = $orden_detalle[$i]->a - $empaque_detalle[$i]->a;
                    $orden_detalle[$i]->b = $orden_detalle[$i]->b - $empaque_detalle[$i]->b;
                    $orden_detalle[$i]->c = $orden_detalle[$i]->c - $empaque_detalle[$i]->c;
                    $orden_detalle[$i]->d = $orden_detalle[$i]->d - $empaque_detalle[$i]->d;
                    $orden_detalle[$i]->e = $orden_detalle[$i]->e - $empaque_detalle[$i]->e;
                    $orden_detalle[$i]->f = $orden_detalle[$i]->f - $empaque_detalle[$i]->f;
                    $orden_detalle[$i]->g = $orden_detalle[$i]->g - $empaque_detalle[$i]->g;
                    $orden_detalle[$i]->h = $orden_detalle[$i]->h - $empaque_detalle[$i]->h;
                    $orden_detalle[$i]->i = $orden_detalle[$i]->i - $empaque_detalle[$i]->i;
                    $orden_detalle[$i]->j = $orden_detalle[$i]->j - $empaque_detalle[$i]->j;
                    $orden_detalle[$i]->k = $orden_detalle[$i]->k - $empaque_detalle[$i]->k;
                    $orden_detalle[$i]->l = $orden_detalle[$i]->l - $empaque_detalle[$i]->l;

                    $orden_detalle[$i]->total = $orden_detalle[$i]->total - $empaque_detalle[$i]->total; 
                    
                    $orden_detalle[$i]->total = abs($orden_detalle[$i]->total);
                }
             
            }
            
            
        }

        $productos = array();

        $longitudProducto = count($orden_detalle);

        for ($i = 0; $i < $longitudProducto; $i++) {
            array_push($productos, $orden_detalle[$i]['producto_id']);
        }

        $producto = Product::whereIn('id', $productos)->select('referencia_producto')->get()->first();

        for ($i = 0; $i < $longitudProducto; $i++) {
            $producto_ref = $producto[$i]['referencia_producto'];
        }


        if (is_object($orden_pedido)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_empaque' => $orden_empaque,
                'orden_pedido' => $orden_pedido,
                'orden_detalle' => $orden_detalle->load('producto'),
                'empaque_detalle' => $empaque_detalle,
                'cliente' => $cliente,
                'sucursal' => $sucursal,
                'orden_facturacion' => $orden_facturacion
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No existe el usuario'
            ];
        }

        return response()->json($data, $data['code']);
    }

   

    public function empaque($id, Request $request)
    {

        $validar = $request->validate([
            'cantidad' => 'required',
        ]);

        if(empty($validar)){ 
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Debe digitar la cantidad de bultos'
            ];
        } else {
            $orden_detalle = ordenPedidoDetalle::find($id);
            $orden_detalle->orden_empacada = 1;
          

            $empaque_id = $request->input('id');
            $cant_bultos = $request->input('cantidad');
    
            $a = $request->input('a');
            $b = $request->input('b');
            $c = $request->input('c');
            $d = $request->input('d');
            $e = $request->input('e');
            $f = $request->input('f');
            $g = $request->input('g');
            $h = $request->input('h');
            $i = $request->input('i');
            $j = $request->input('j');
            $k = $request->input('k');
            $l = $request->input('l');
            $producto = $request->input('producto');
            $orden_facturacion_id = $request->input('facturacion_id');
            $transporte = $request->input('por_transporte');
            $totalEmpacar = $request->input('total');
            $cantidad = $orden_detalle->cant_red;
            $total = $orden_detalle->total;
    
            $sumEmpaque = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
    
            if($sumEmpaque > $totalEmpacar){
                $data = [
                    'code' => 200,
                    'status' => 'mayor',
                    'message' => 'La cantidad digitada es mayor a la que puede empacar'
                ];
            } else {
            
                if (\is_object($orden_detalle)) {
                    $orden_detalle->save();

                    $empaqueDetalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque_id)
                    ->where('producto_id', $producto)->first();

                    // $ordenFacturacion = OrdenFacturacion::find($orden_facturacion_id);

                    // $ordenFacturacion->por_transporte = $transporte;
                    // $ordenFacturacion->save();

                    if(is_object($empaqueDetalle)){
                        $empaqueDetalle->a = $empaqueDetalle->a + $a;
                        $empaqueDetalle->b = $empaqueDetalle->b + $b;
                        $empaqueDetalle->c = $empaqueDetalle->c + $c;
                        $empaqueDetalle->d = $empaqueDetalle->d + $d;
                        $empaqueDetalle->e = $empaqueDetalle->e + $e;
                        $empaqueDetalle->f = $empaqueDetalle->f + $f;
                        $empaqueDetalle->g = $empaqueDetalle->g + $g;
                        $empaqueDetalle->h = $empaqueDetalle->h + $h;
                        $empaqueDetalle->i = $empaqueDetalle->i + $i;
                        $empaqueDetalle->j = $empaqueDetalle->j + $j;
                        $empaqueDetalle->k = $empaqueDetalle->k + $k;
                        $empaqueDetalle->l = $empaqueDetalle->l + $l;
                        $empaqueDetalle->total = $empaqueDetalle->total + $sumEmpaque;
                        $empaqueDetalle->save();

                        $orden_empaque = ordenEmpaque::find($empaque_id);

                        if(empty($orden_facturacion_id)){
                            // verificar numero antiguo de la secuencia;
                            $numero_antiguo = DB::table('orden_facturacion')->latest('updated_at')->first();
        
                            if (empty($numero_antiguo) || $numero_antiguo == "") {
                                $sec = 0.00;
                            } else {
                                $sec = $numero_antiguo->sec;
                            }
        
                            $orden_facturacion = new OrdenFacturacion();
        
                            $next_sec = number_format($sec + 0.01, 2);
                            $orden_facturacion->no_orden_facturacion = "OF-" . str_replace('.', '', $next_sec);;
                            $orden_facturacion->orden_empaque_id = $empaque_id;
                            $orden_facturacion->user_id = \auth()->user()->id;
                            $orden_facturacion->fecha = date('Y/m/d h:i:s');
                            $orden_facturacion->impreso = 0;
                            $orden_facturacion->por_transporte = $transporte;
                            $orden_facturacion->sec = number_format($sec + 0.01, 2);
        
                            $orden_facturacion->save();

                            $data = [
                                'code' => 200,
                                'status' => 'success',
                                'orden_empaque_detalle' => $empaqueDetalle,
                                'orden_empaque' => $orden_empaque,
                                'orden' => $orden_detalle,
                                'orden_facturacion' => $orden_facturacion
                               
                            ];
                        } else {
                            $data = [
                                'code' => 200,
                                'status' => 'success',
                                'orden_empaque_detalle' => $empaqueDetalle,
                                'orden_empaque' => $orden_empaque,
                                'orden' => $orden_detalle,
                               
                            ];
                        }

                    } else {

                
                        $orden_empaque_detalle = new ordenEmpaqueDetalle();
                        $orden_empaque_detalle->orden_empaque_id = $empaque_id;
                        $orden_empaque_detalle->producto_id = $orden_detalle->producto_id;
                        $orden_empaque_detalle->user_id = \auth()->user()->id;
                        $orden_empaque_detalle->a = $a;
                        $orden_empaque_detalle->b = $b;
                        $orden_empaque_detalle->c = $c;
                        $orden_empaque_detalle->d = $d;
                        $orden_empaque_detalle->e = $e;
                        $orden_empaque_detalle->f = $f;
                        $orden_empaque_detalle->g = $g;
                        $orden_empaque_detalle->h = $h;
                        $orden_empaque_detalle->i = $i;
                        $orden_empaque_detalle->j = $j;
                        $orden_empaque_detalle->k = $k;
                        $orden_empaque_detalle->l = $l;
                        $orden_empaque_detalle->cantidad = $cantidad;
                        $orden_empaque_detalle->precio = $orden_detalle->precio;
                        $orden_empaque_detalle->cant_bulto = $cant_bultos;
                        $orden_empaque_detalle->total = $sumEmpaque;
                        $orden_empaque_detalle->fecha_empacado = date('Y/m/d h:i:s');
                        // $orden_empaque_detalle->empacado = 1;
                        $orden_empaque_detalle->facturado = 0;
                        $orden_empaque_detalle->save();
            
                        $orden_empaque = ordenEmpaque::find($empaque_id);

                        if(empty($orden_facturacion_id)){
                            // verificar numero antiguo de la secuencia;
                            $numero_antiguo = DB::table('orden_facturacion')->latest('updated_at')->first();
        
                            if (empty($numero_antiguo) || $numero_antiguo == "") {
                                $sec = 0.00;
                            } else {
                                $sec = $numero_antiguo->sec;
                            }
        
                            $orden_facturacion = new OrdenFacturacion();
        
                            $next_sec = number_format($sec + 0.01, 2);
                            $orden_facturacion->no_orden_facturacion = "OF-" . str_replace('.', '', $next_sec);;
                            $orden_facturacion->orden_empaque_id = $empaque_id;
                            $orden_facturacion->user_id = \auth()->user()->id;
                            $orden_facturacion->fecha = date('Y/m/d h:i:s');
                            $orden_facturacion->impreso = 0;
                            $orden_facturacion->por_transporte = $transporte;
                            $orden_facturacion->sec = number_format($sec + 0.01, 2);
        
                            $orden_facturacion->save();

                            $data = [
                                'code' => 200,
                                'status' => 'success',
                                'orden_empaque_detalle' => $orden_empaque_detalle,
                                'orden_empaque' => $orden_empaque,
                                'suma' => $sumEmpaque,
                                'orden' => $orden_detalle,
                                'orden_facturacion' => $orden_facturacion
                            ];
                        } else {
                            $data = [
                                'code' => 200,
                                'status' => 'success',
                                'orden_empaque_detalle' => $orden_empaque_detalle,
                                'orden_empaque' => $orden_empaque,
                                'suma' => $sumEmpaque,
                                'orden' => $orden_detalle,
                            ];
                        }
                    }
                } else {
                    $data = [
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'No se encontro la orden'
                    ];
                }
            }
        }
       

       

        return response()->json($data, $data['code']);
    }

    public function empaqueDetalle($id)
    {
        $ordenes = DB::table('orden_pedido_detalle')
            ->join('producto', 'orden_pedido_detalle.producto_id', 'producto.id')
            ->select([
                'orden_pedido_detalle.id', 'orden_pedido_detalle.a', 'orden_pedido_detalle.orden_pedido_id',
                'orden_pedido_detalle.b', 'orden_pedido_detalle.c', 'orden_pedido_detalle.d',
                'orden_pedido_detalle.e', 'orden_pedido_detalle.f', 'orden_pedido_detalle.f',
                'orden_pedido_detalle.g', 'orden_pedido_detalle.h', 'orden_pedido_detalle.i',
                'orden_pedido_detalle.j', 'orden_pedido_detalle.k', 'orden_pedido_detalle.l',
                'orden_pedido_detalle.total', 'producto.referencia_producto', 'orden_pedido_detalle.orden_empacada'
            ])->where('orden_pedido_id', 'LIKE', $id);

        return DataTables::of($ordenes)
        ->editColumn('a', function ($orden) {
          
            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();

            if( $orden->a <= 0 ){
                return '<input type="text" id="a' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="a' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->a . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="a' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->a - $detalle->a . '>';
            } else {
                return '<input type="number"  id="a' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->a . '>';
            }
           
            
        })
        ->editColumn('b', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
         
            if($orden->b <= 0){
                return '<input type="text" id="b' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="b' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->b . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="b' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->b - $detalle->b . '>';
            } else {
                return '<input type="number"  id="b' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->b . '>';
            }
            
        })
        ->editColumn('c', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->first();
        
            if($orden->c <= 0 ){
                return '<input type="text" id="c' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="c' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->c . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="c' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->c - $detalle->c . '>';
            } else {
                return '<input type="number"  id="c' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->c . '>';
            }
            
        })
        ->editColumn('d', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
         
            if($orden->d <= 0){
                return '<input type="text" id="d' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="d' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->d . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="d' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->d - $detalle->d . '>';
            } else {
                return '<input type="number"  id="d' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->d . '>';
            }
            
        })
        ->editColumn('e', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
           
            if($orden->e <= 0){
                return '<input type="text" id="e' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="e' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->e . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="e' . $orden->id . '" name="e"  class="form-control red" value=' . $orden->e - $detalle->e . '>';
            } else {
                return '<input type="number"  id="e' . $orden->id . '" name="e"  class="form-control red" value=' . $orden->e . '>';
            }
            
        })
        ->editColumn('f', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
          
            if($orden->f <= 0 ){
                return '<input type="text" id="f' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="f' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->f . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="f' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->f - $detalle->f . '>';
            } else {
                return '<input type="number"  id="f' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->f . '>';
            }
            
        })
        ->editColumn('g', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
         
            if($orden->g <= 0 ){
                return '<input type="text" id="g' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="g' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->g . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="g' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->g - $detalle->g . '>';
            } else {
                return '<input type="number"  id="g' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->g . '>';
            }
            
        })
        ->editColumn('h', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
         
            if($orden->h <= 0 ){
                return '<input type="text" id="h' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="h' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->h . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="h' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->h - $detalle->h . '>';
            } else {
                return '<input type="number"  id="h' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->h . '>';
            }
            
        })
        ->editColumn('i', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
     
            if($orden->i <= 0 ){
                return '<input type="text" id="i' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="i' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->i . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="i' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->i - $detalle->i . '>';
            } else {
                return '<input type="number"  id="i' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->i . '>';
            }
            
            
        })
        ->editColumn('j', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
          
            if($orden->j <= 0 ){
                return '<input type="text" id="j' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="j' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->j . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="j' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->j - $detalle->j . '>';
            } else {
                return '<input type="number"  id="j' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->j . '>';
            }
            
        })
        ->editColumn('k', function ($orden) {
            
            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
          
       
            if($orden->k <= 0 ){
                return '<input type="text" id="k' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="k' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->k . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="k' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->k - $detalle->k . '>';
            } else {
                return '<input type="number"  id="k' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->k . '>';
            }
            
            
        })
        ->editColumn('l', function ($orden) {

            $empaque = ordenEmpaque::where('orden_pedido_id', $orden->orden_pedido_id)->first();
            $detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $empaque->id)->get();
         
            if($orden->l <= 0  ){
                return '<input type="text" id="l' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . 0 . '>';
            } elseif($orden->orden_empacada == 1) {
                return '<input type="text" id="l' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->l . '>';
            // } elseif(count($detalle) > 0) {
            //     return '<input type="number"  id="l' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->l - $detalle->l . '>';
            } else {
                return '<input type="number"  id="l' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->l . '>';
            }
            
        })
            ->addColumn('cantidad', function ($orden) {
                return ($orden->orden_empacada == 1) ? 
                '<input type="text" id="cantidad'.$orden->id.'" name="cantidad" class="cantidad  form-control red text-center" disabled>'
                :'<input type="text" id="cantidad'.$orden->id.'" name="cantidad" class="cantidad form-control red text-center" >';
            })
            ->addColumn('Opciones', function ($orden) {
                return ($orden->orden_empacada == 1) ? '<span id="empacado_listo" class="badge badge-success">Empacado <i class="fas fa-check"></i> </span>':
                '<a onclick="test(' . $orden->id . ')" id="guardar" class="btn btn-primary btn-sm ml-1 text-white"> <i class="far fa-save"></i></a>';
            })
            ->addColumn('records', function ($orden) {
                return ;
            })
            ->rawColumns(['Opciones', 'cantidad',
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'
            ])
            ->make(true);
    }

    public function OrdenProductos($id){

        $detalle = OrdenPedidoDetalle::where('orden_pedido_id', $id)->get();


        $data = [
            'code' => 200,
            'status' => 'success',
            'detalle' => $detalle->load('producto')
        ];

        return response()->json($data, $data['code']);
    }


    public function curvas(Request $request){

        $producto = $request->input('producto');
        $pedido = $request->input('pedido');

        $ref = Product::find($producto);

        $curva_producto = CurvaProducto::where('producto_id', $producto)->first();

    
        if(is_object($curva_producto)){
            $curva_producto->a = round($curva_producto->a, 2);
            $curva_producto->b = round($curva_producto->b, 2);
            $curva_producto->c = round($curva_producto->c, 2);
            $curva_producto->d = round($curva_producto->d, 2);
            $curva_producto->e = round($curva_producto->e, 2);
            $curva_producto->f = round($curva_producto->f, 2);
            $curva_producto->g = round($curva_producto->g, 2);
            $curva_producto->h = round($curva_producto->h, 2);
            $curva_producto->i = round($curva_producto->i, 2);
            $curva_producto->j = round($curva_producto->j, 2);
            $curva_producto->k = round($curva_producto->k, 2);
            $curva_producto->l = round($curva_producto->l, 2);

            $total_curva_producto = $curva_producto->a + $curva_producto->b + $curva_producto->c + $curva_producto->d + 
            $curva_producto->e + $curva_producto->f + $curva_producto->g + $curva_producto->h + $curva_producto->i +
            $curva_producto->j + $curva_producto->k + $curva_producto->l;

            $tallasAlmacen = AlmacenDetalle::where('producto_id', $producto)->get();

            $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto)
            ->where('venta_segunda', '0')
            ->where('orden_empacada', '1')
            ->get();
            
            $ventasSegundas = ordenPedidoDetalle::where('producto_id', $producto)
            ->where('venta_segunda', '1')
            ->get();


            $genero = $ref->genero;

            if($genero == 3 || $genero == 4){
                if(count($tallasAlmacen) <= 0){
                    $producto_f = Product::find($producto);
                    $min = $producto_f->min;
                    $max = $producto_f->max;
                    $ref_father = $producto_f->referencia_father;
                    $almacen = AlmacenDetalle::where('producto_id', $ref_father)
                    ->select('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')
                    ->get();
                    $tallasOrdenes_f = ordenPedidoDetalle::where('referencia_father', $ref_father)
                    ->where('orden_empacada', '1')
                    ->where('venta_segunda', '0')->get();
                    $tallasCredito_f = NotaCreditoDetalle::where('referencia_father', $ref_father)->get();
    
                    $a = $almacen->sum('a');
                    $b = $almacen->sum('b');
                    $c = $almacen->sum('c');
                    $d = $almacen->sum('d');
                    $e = $almacen->sum('e');
                    $f = $almacen->sum('f');
                    $g = $almacen->sum('g');
                    $h = $almacen->sum('h');
                    $i = $almacen->sum('i');
                    $j = $almacen->sum('j');
                    $k = $almacen->sum('k');
                    $l = $almacen->sum('l');
                    $array = array("a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e, "f" => $f, "g" => $g, "h" => $h, "i" => $i, "j" => $j, "k" => $k, "l" => $l);
                    $res = array_keys($array);
                    $result = array_search($min, $res);
                    $result2 = array_search($max, $res);
                    $tallas = array_slice($array, $result, $result2);
                    $a_ref2 = (array_key_exists("a", $tallas) ? $tallas['a'] : 0);
                    $b_ref2 = (array_key_exists("b", $tallas) ? $tallas['b'] : 0);
                    $c_ref2 = (array_key_exists("c", $tallas) ? $tallas['c'] : 0);
                    $d_ref2 = (array_key_exists("d", $tallas) ? $tallas['d'] : 0);
                    $e_ref2 = (array_key_exists("e", $tallas) ? $tallas['e'] : 0);
                    $f_ref2 = (array_key_exists("f", $tallas) ? $tallas['f'] : 0);
                    $g_ref2 = (array_key_exists("g", $tallas) ? $tallas['g'] : 0);
                    $h_ref2 = (array_key_exists("h", $tallas) ? $tallas['h'] : 0);
                    $i_ref2 = (array_key_exists("i", $tallas) ? $tallas['i'] : 0);
                    $j_ref2 = (array_key_exists("j", $tallas) ? $tallas['j'] : 0);
                    $k_ref2 = (array_key_exists("k", $tallas) ? $tallas['k'] : 0);
                    $l_ref2 = (array_key_exists("l", $tallas) ? $tallas['l'] : 0);
    
                    //calcular total real
                    $a_ref2 = $a_ref2 - $ventasSegundas->sum('a') - $tallasOrdenes_f->sum('a') + $tallasCredito_f->sum('a');
                    $b_ref2 = $b_ref2 - $ventasSegundas->sum('b') - $tallasOrdenes_f->sum('b') + $tallasCredito_f->sum('b');
                    $c_ref2 = $c_ref2 - $ventasSegundas->sum('c') - $tallasOrdenes_f->sum('c') + $tallasCredito_f->sum('c');
                    $d_ref2 = $d_ref2 - $ventasSegundas->sum('d') - $tallasOrdenes_f->sum('d') + $tallasCredito_f->sum('d');
                    $e_ref2 = $e_ref2 - $ventasSegundas->sum('e') - $tallasOrdenes_f->sum('e') + $tallasCredito_f->sum('e');
                    $f_ref2 = $f_ref2 - $ventasSegundas->sum('f') - $tallasOrdenes_f->sum('f') + $tallasCredito_f->sum('f');
                    $g_ref2 = $g_ref2 - $ventasSegundas->sum('g') - $tallasOrdenes_f->sum('g') + $tallasCredito_f->sum('g');
                    $h_ref2 = $h_ref2 - $ventasSegundas->sum('h') - $tallasOrdenes_f->sum('h') + $tallasCredito_f->sum('h');
                    $i_ref2 = $i_ref2 - $ventasSegundas->sum('i') - $tallasOrdenes_f->sum('i') + $tallasCredito_f->sum('i');
                    $j_ref2 = $j_ref2 - $ventasSegundas->sum('j') - $tallasOrdenes_f->sum('j') + $tallasCredito_f->sum('j');
                    $k_ref2 = $k_ref2 - $ventasSegundas->sum('k') - $tallasOrdenes_f->sum('k') + $tallasCredito_f->sum('k');
                    $l_ref2 = $l_ref2 - $ventasSegundas->sum('l') - $tallasOrdenes_f->sum('l') + $tallasCredito_f->sum('l');
    
                    $cantidad_ordenadas = $tallasOrdenes_f->sum('cantidad');
                    $total_real = $a_ref2 + $b_ref2 + $c_ref2 + $d_ref2 + $e_ref2 + $f_ref2 + $g_ref2 + $h_ref2 + $i_ref2 + $j_ref2 + $k_ref2 + $l_ref2;
                    
                    $a_ref2 = ($a_ref2 < 0 ? 0 : $a_ref2);
                    $b_ref2 = ($b_ref2 < 0 ? 0 : $b_ref2);
                    $c_ref2 = ($c_ref2 < 0 ? 0 : $c_ref2);
                    $d_ref2 = ($d_ref2 < 0 ? 0 : $d_ref2);
                    $e_ref2 = ($e_ref2 < 0 ? 0 : $e_ref2);
                    $f_ref2 = ($f_ref2 < 0 ? 0 : $f_ref2);
                    $g_ref2 = ($g_ref2 < 0 ? 0 : $g_ref2);
                    $h_ref2 = ($h_ref2 < 0 ? 0 : $h_ref2);
                    $i_ref2 = ($i_ref2 < 0 ? 0 : $i_ref2);
                    $j_ref2 = ($j_ref2 < 0 ? 0 : $j_ref2);
                    $k_ref2 = ($k_ref2 < 0 ? 0 : $k_ref2);
                    $l_ref2 = ($l_ref2 < 0 ? 0 : $l_ref2);

                    $a_perc = ($a_ref2 / $total_real) * 100;
                    $b_perc = ($b_ref2 / $total_real) * 100;
                    $c_perc = ($c_ref2 / $total_real) * 100;
                    $d_perc = ($d_ref2 / $total_real) * 100;
                    $e_perc = ($e_ref2 / $total_real) * 100;
                    $f_perc = ($f_ref2 / $total_real) * 100;
                    $g_perc = ($g_ref2 / $total_real) * 100;
                    $h_perc = ($h_ref2 / $total_real) * 100;
                    $i_perc = ($i_ref2 / $total_real) * 100;
                    $j_perc = ($j_ref2 / $total_real) * 100;
                    $k_perc = ($k_ref2 / $total_real) * 100;
                    $l_perc = ($l_ref2 / $total_real) * 100;
    
                    $total_perc_alm = $a_perc + $b_perc + $c_perc + $d_perc + $e_perc + $f_perc + $g_perc + $h_perc +
                    $i_perc + $j_perc + $k_perc + $l_perc;

                        //Pedido y detalle
                    $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $pedido)
                    ->where('producto_id', $producto)->first();



                    $data = [
                        'code' => 200,
                        'status' => 'success',
                        // 'tallas' => $tallas,
                        'producto' => $ref,
                        'almacen' => $tallasAlmacen,
                        'ordenesPrimera' => $orden_detalle,
                        'ordenesSegunda' => $ventasSegundas,
                        'curva_producto' => $curva_producto,
                        'total_curva_producto' => $total_curva_producto,
                        'orden_detalle' => $orden_detalle,
                        'a_alm' => $a_ref2,
                        'b_alm' => $b_ref2,
                        'c_alm' => $c_ref2,
                        'd_alm' => $d_ref2,
                        'e_alm' => $e_ref2,
                        'f_alm' => $f_ref2,
                        'g_alm' => $g_ref2,
                        'h_alm' => $h_ref2,
                        'i_alm' => $i_ref2,
                        'j_alm' => $j_ref2,
                        'k_alm' => $k_ref2,
                        'l_alm' => $l_ref2,
                        'total_alm' => $total_real,
                        'a_perc' => round($a_perc, 2),
                        'b_perc' => round($b_perc, 2),
                        'c_perc' => round($c_perc, 2),
                        'd_perc' => round($d_perc, 2),
                        'e_perc' => round($e_perc, 2),
                        'f_perc' => round($f_perc, 2),
                        'g_perc' => round($g_perc, 2),
                        'h_perc' => round($h_perc, 2),
                        'i_perc' => round($i_perc, 2),
                        'j_perc' => round($j_perc, 2),
                        'k_perc' => round($k_perc, 2),
                        'l_perc' => round($l_perc, 2),
                        'total_perc_alm' => round($total_perc_alm)
                    ];
                } else {
                    $producto_f = Product::find($producto);
                    $min = $producto_f->min;
                    $max = $producto_f->max;
                    $ref_father = $producto_f->id;
                    $almacen = AlmacenDetalle::where('producto_id', $ref_father)
                        ->select('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')
                        ->get();
                    $tallasOrdenes_f = ordenPedidoDetalle::where('producto_id', $ref_father)
                    ->where('orden_empacada', '1')
                    ->where('venta_segunda', '0')->get();
                    $tallasCredito_f = NotaCreditoDetalle::where('producto_id', $ref_father)->get();
    
                    $a = $almacen->sum('a');
                    $b = $almacen->sum('b');
                    $c = $almacen->sum('c');
                    $d = $almacen->sum('d');
                    $e = $almacen->sum('e');
                    $f = $almacen->sum('f');
                    $g = $almacen->sum('g');
                    $h = $almacen->sum('h');
                    $i = $almacen->sum('i');
                    $j = $almacen->sum('j');
                    $k = $almacen->sum('k');
                    $l = $almacen->sum('l');
                    $array = array("a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e, "f" => $f, "g" => $g, "h" => $h, "i" => $i, "j" => $j, "k" => $k, "l" => $l);
                    $res = array_keys($array);
                    $result = array_search($min, $res);
                    $result2 = array_search($max, $res);
                    $tallas = array_slice($array, 0, $result);
                    $a_ref2 = (array_key_exists("a", $tallas) ? $tallas['a'] : 0);
                    $b_ref2 = (array_key_exists("b", $tallas) ? $tallas['b'] : 0);
                    $c_ref2 = (array_key_exists("c", $tallas) ? $tallas['c'] : 0);
                    $d_ref2 = (array_key_exists("d", $tallas) ? $tallas['d'] : 0);
                    $e_ref2 = (array_key_exists("e", $tallas) ? $tallas['e'] : 0);
                    $f_ref2 = (array_key_exists("f", $tallas) ? $tallas['f'] : 0);
                    $g_ref2 = (array_key_exists("g", $tallas) ? $tallas['g'] : 0);
                    $h_ref2 = (array_key_exists("h", $tallas) ? $tallas['h'] : 0);
                    $i_ref2 = (array_key_exists("i", $tallas) ? $tallas['i'] : 0);
                    $j_ref2 = (array_key_exists("j", $tallas) ? $tallas['j'] : 0);
                    $k_ref2 = (array_key_exists("k", $tallas) ? $tallas['k'] : 0);
                    $l_ref2 = (array_key_exists("l", $tallas) ? $tallas['l'] : 0);
    
                    //calcular total real
                    $a_ref2 = $a_ref2 - $ventasSegundas->sum('a') - $tallasOrdenes_f->sum('a') + $tallasCredito_f->sum('a');
                    $b_ref2 = $b_ref2 - $ventasSegundas->sum('b') - $tallasOrdenes_f->sum('b') + $tallasCredito_f->sum('b');
                    $c_ref2 = $c_ref2 - $ventasSegundas->sum('c') - $tallasOrdenes_f->sum('c') + $tallasCredito_f->sum('c');
                    $d_ref2 = $d_ref2 - $ventasSegundas->sum('d') - $tallasOrdenes_f->sum('d') + $tallasCredito_f->sum('d');
                    $e_ref2 = $e_ref2 - $ventasSegundas->sum('e') - $tallasOrdenes_f->sum('e') + $tallasCredito_f->sum('e');
                    $f_ref2 = $f_ref2 - $ventasSegundas->sum('f') - $tallasOrdenes_f->sum('f') + $tallasCredito_f->sum('f');
                    $g_ref2 = $g_ref2 - $ventasSegundas->sum('g') - $tallasOrdenes_f->sum('g') + $tallasCredito_f->sum('g');
                    $h_ref2 = $h_ref2 - $ventasSegundas->sum('h') - $tallasOrdenes_f->sum('h') + $tallasCredito_f->sum('h');
                    $i_ref2 = $i_ref2 - $ventasSegundas->sum('i') - $tallasOrdenes_f->sum('i') + $tallasCredito_f->sum('i');
                    $j_ref2 = $j_ref2 - $ventasSegundas->sum('j') - $tallasOrdenes_f->sum('j') + $tallasCredito_f->sum('j');
                    $k_ref2 = $k_ref2 - $ventasSegundas->sum('k') - $tallasOrdenes_f->sum('k') + $tallasCredito_f->sum('k');
                    $l_ref2 = $l_ref2 - $ventasSegundas->sum('l') - $tallasOrdenes_f->sum('l') + $tallasCredito_f->sum('l');
                    // print_r($tallas);
                    // die();
                    $cantidad_ordenadas = $tallasOrdenes_f->sum('cantidad');
                    $total_real = $a_ref2 + $b_ref2 + $c_ref2 + $d_ref2 + $e_ref2 + $f_ref2 + $g_ref2 + $h_ref2 + $i_ref2 + $j_ref2 + $k_ref2 + $l_ref2 ;
                    
                    $a_ref2 = ($a_ref2 < 0 ? 0 : $a_ref2);
                    $b_ref2 = ($b_ref2 < 0 ? 0 : $b_ref2);
                    $c_ref2 = ($c_ref2 < 0 ? 0 : $c_ref2);
                    $d_ref2 = ($d_ref2 < 0 ? 0 : $d_ref2);
                    $e_ref2 = ($e_ref2 < 0 ? 0 : $e_ref2);
                    $f_ref2 = ($f_ref2 < 0 ? 0 : $f_ref2);
                    $g_ref2 = ($g_ref2 < 0 ? 0 : $g_ref2);
                    $h_ref2 = ($h_ref2 < 0 ? 0 : $h_ref2);
                    $i_ref2 = ($i_ref2 < 0 ? 0 : $i_ref2);
                    $j_ref2 = ($j_ref2 < 0 ? 0 : $j_ref2);
                    $k_ref2 = ($k_ref2 < 0 ? 0 : $k_ref2);
                    $l_ref2 = ($l_ref2 < 0 ? 0 : $l_ref2);

                    $a_perc = ($a_ref2 / $total_real) * 100;
                    $b_perc = ($b_ref2 / $total_real) * 100;
                    $c_perc = ($c_ref2 / $total_real) * 100;
                    $d_perc = ($d_ref2 / $total_real) * 100;
                    $e_perc = ($e_ref2 / $total_real) * 100;
                    $f_perc = ($f_ref2 / $total_real) * 100;
                    $g_perc = ($g_ref2 / $total_real) * 100;
                    $h_perc = ($h_ref2 / $total_real) * 100;
                    $i_perc = ($i_ref2 / $total_real) * 100;
                    $j_perc = ($j_ref2 / $total_real) * 100;
                    $k_perc = ($k_ref2 / $total_real) * 100;
                    $l_perc = ($l_ref2 / $total_real) * 100;
    
                    $total_perc_alm = $a_perc + $b_perc + $c_perc + $d_perc + $e_perc + $f_perc + $g_perc + $h_perc +
                    $i_perc + $j_perc + $k_perc + $l_perc;

                        //Pedido y detalle
                    $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $pedido)
                    ->where('producto_id', $producto)->first();
                     
                    $data = [
                        'code' => 200,
                        'status' => 'success',
                        // 'tallas' => $tallas,
                        'producto' => $ref,
                        'almacen' => $tallasAlmacen,
                        'ordenesPrimera' => $orden_detalle,
                        'ordenesSegunda' => $ventasSegundas,
                        'curva_producto' => $curva_producto,
                        'total_curva_producto' => $total_curva_producto,
                        'orden_detalle' => $orden_detalle,
                        'a_alm' => $a_ref2,
                        'b_alm' => $b_ref2,
                        'c_alm' => $c_ref2,
                        'd_alm' => $d_ref2,
                        'e_alm' => $e_ref2,
                        'f_alm' => $f_ref2,
                        'g_alm' => $g_ref2,
                        'h_alm' => $h_ref2,
                        'i_alm' => $i_ref2,
                        'j_alm' => $j_ref2,
                        'k_alm' => $k_ref2,
                        'l_alm' => $l_ref2,
                        'total_alm' => $total_real,
                        'a_perc' => round($a_perc, 2),
                        'b_perc' => round($b_perc, 2),
                        'c_perc' => round($c_perc, 2),
                        'd_perc' => round($d_perc, 2),
                        'e_perc' => round($e_perc, 2),
                        'f_perc' => round($f_perc, 2),
                        'g_perc' => round($g_perc, 2),
                        'h_perc' => round($h_perc, 2),
                        'i_perc' => round($i_perc, 2),
                        'j_perc' => round($j_perc, 2),
                        'k_perc' => round($k_perc, 2),
                        'l_perc' => round($l_perc, 2),
                        'total_perc_alm' => round($total_perc_alm)
                    ];
                }
               
            } else {

                $a_alm = $tallasAlmacen->sum('a') - $ventasSegundas->sum('a') - $tallasOrdenes->sum('a');
                $b_alm = $tallasAlmacen->sum('b') - $ventasSegundas->sum('b') - $tallasOrdenes->sum('b');
                $c_alm = $tallasAlmacen->sum('c') - $ventasSegundas->sum('c') - $tallasOrdenes->sum('c');
                $d_alm = $tallasAlmacen->sum('d') - $ventasSegundas->sum('d') - $tallasOrdenes->sum('d');
                $e_alm = $tallasAlmacen->sum('e') - $ventasSegundas->sum('e') - $tallasOrdenes->sum('e');
                $f_alm = $tallasAlmacen->sum('f') - $ventasSegundas->sum('f') - $tallasOrdenes->sum('f');
                $g_alm = $tallasAlmacen->sum('g') - $ventasSegundas->sum('g') - $tallasOrdenes->sum('g');
                $h_alm = $tallasAlmacen->sum('h') - $ventasSegundas->sum('h') - $tallasOrdenes->sum('h');
                $i_alm = $tallasAlmacen->sum('i') - $ventasSegundas->sum('i') - $tallasOrdenes->sum('i');
                $j_alm = $tallasAlmacen->sum('j') - $ventasSegundas->sum('j') - $tallasOrdenes->sum('j');
                $k_alm = $tallasAlmacen->sum('k') - $ventasSegundas->sum('k') - $tallasOrdenes->sum('k');
                $l_alm = $tallasAlmacen->sum('l') - $ventasSegundas->sum('l') - $tallasOrdenes->sum('l');

                $a_alm = ($a_alm <= 0 ? 0 : $a_alm);
                $b_alm = ($b_alm <= 0 ? 0 : $b_alm);
                $c_alm = ($c_alm <= 0 ? 0 : $c_alm);
                $d_alm = ($d_alm <= 0 ? 0 : $d_alm);
                $e_alm = ($e_alm <= 0 ? 0 : $e_alm);
                $f_alm = ($f_alm <= 0 ? 0 : $f_alm);
                $g_alm = ($g_alm <= 0 ? 0 : $g_alm);
                $h_alm = ($h_alm <= 0 ? 0 : $h_alm);
                $i_alm = ($i_alm <= 0 ? 0 : $i_alm);
                $j_alm = ($j_alm <= 0 ? 0 : $j_alm);
                $k_alm = ($k_alm <= 0 ? 0 : $k_alm);
                $l_alm = ($l_alm <= 0 ? 0 : $l_alm);

                $total_alm = $a_alm + $b_alm + $c_alm + $d_alm + $e_alm + $f_alm + $g_alm + $h_alm + $i_alm + $j_alm + $k_alm + $l_alm;


                $a_perc = ($a_alm / $total_alm) * 100;
                $b_perc = ($b_alm / $total_alm) * 100;
                $c_perc = ($c_alm / $total_alm) * 100;
                $d_perc = ($d_alm / $total_alm) * 100;
                $e_perc = ($e_alm / $total_alm) * 100;
                $f_perc = ($f_alm / $total_alm) * 100;
                $g_perc = ($g_alm / $total_alm) * 100;
                $h_perc = ($h_alm / $total_alm) * 100;
                $i_perc = ($i_alm / $total_alm) * 100;
                $j_perc = ($j_alm / $total_alm) * 100;
                $k_perc = ($k_alm / $total_alm) * 100;
                $l_perc = ($l_alm / $total_alm) * 100;

                $total_perc_alm = $a_perc + $b_perc + $c_perc + $d_perc + $e_perc + $f_perc + $g_perc + $h_perc +
                $i_perc + $j_perc + $k_perc + $l_perc;


                //Pedido y detalle
                $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $pedido)
                ->where('producto_id', $producto)->first();
                
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    // 'tallas' => $tallas,
                    'producto' => $ref,
                    'almacen' => $tallasAlmacen,
                    'ordenesPrimera' => $tallasOrdenes,
                    'ordenesSegunda' => $ventasSegundas,
                    'curva_producto' => $curva_producto,
                    'total_curva_producto' => $total_curva_producto,
                    'orden_detalle' => $orden_detalle,
                    'a_alm' => $a_alm,
                    'b_alm' => $b_alm,
                    'c_alm' => $c_alm,
                    'd_alm' => $d_alm,
                    'e_alm' => $e_alm,
                    'f_alm' => $f_alm,
                    'g_alm' => $g_alm,
                    'h_alm' => $h_alm,
                    'i_alm' => $i_alm,
                    'j_alm' => $j_alm,
                    'k_alm' => $k_alm,
                    'l_alm' => $l_alm,
                    'total_alm' => $total_alm,
                    'a_perc' => round($a_perc, 2),
                    'b_perc' => round($b_perc, 2),
                    'c_perc' => round($c_perc, 2),
                    'd_perc' => round($d_perc, 2),
                    'e_perc' => round($e_perc, 2),
                    'f_perc' => round($f_perc, 2),
                    'g_perc' => round($g_perc, 2),
                    'h_perc' => round($h_perc, 2),
                    'i_perc' => round($i_perc, 2),
                    'j_perc' => round($j_perc, 2),
                    'k_perc' => round($k_perc, 2),
                    'l_perc' => round($l_perc, 2),
                    'total_perc_alm' => round($total_perc_alm)
                ];
            }

            

            
        }
        return response()->json($data, $data['code']);
        
    }


    public function distribucion(Request $request){
    
        $producto = $request->input('producto');
        $pedido = $request->input('pedido');
        $cantidad = $request->input('cantidad');
        $a = $request->input('a');
        $b = $request->input('b');
        $c = $request->input('c');
        $d = $request->input('d');
        $e = $request->input('e');
        $f = $request->input('f');
        $g = $request->input('g');
        $h = $request->input('h');
        $i = $request->input('i');
        $j = $request->input('j');
        $k = $request->input('k');
        $l = $request->input('l');


        $sum_cant = $a + $b + $c + $d + $e +$f + $g + $h + $i + $j + $k + $l;

        if($sum_cant > $cantidad){
            $data = [
                'code' => 200,
                'status' => 'validation',
                'message' => 'La cantidad total digitada es mayor a la cantidad pedida'
            ];
        } elseif($sum_cant < $cantidad){
            $data = [
                'code' => 200,
                'status' => 'validation',
                'message' => 'La cantidad total digitada es menor a la cantidad pedida'
            ];

        } else {
            $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $pedido)
            ->where('producto_id', $producto)->first();

            $orden_detalle->a = $a;
            $orden_detalle->b = $b;
            $orden_detalle->c = $c;
            $orden_detalle->d = $d;
            $orden_detalle->e = $e;
            $orden_detalle->f = $f;
            $orden_detalle->g = $g;
            $orden_detalle->h = $h;
            $orden_detalle->i = $i;
            $orden_detalle->j = $j;
            $orden_detalle->k = $k;
            $orden_detalle->l = $l;
            $orden_detalle->total = $sum_cant;

            $orden_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'detalle' => $orden_detalle
            ];
        }


  

        return response()->json($data, $data['code']);
    }



}

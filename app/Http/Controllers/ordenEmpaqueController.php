<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ordenPedido;
use Yajra\DataTables\Facades\DataTables;
use App\ordenPedidoDetalle;
use App\ordenEmpaque;
use App\Perdida;
use App\Almacen;
use App\Client;
use App\ClientBranch;
use App\TallasPerdidas;
use App\Product;
use App\Curva;
use App\ordenEmpaqueDetalle;

class ordenEmpaqueController extends Controller
{
    public function ordenesAprobacion()
    {
        $ordenes = DB::table('orden_pedido')->join('users', 'orden_pedido.user_aprobacion', 'users.id')
            ->join('cliente', 'orden_pedido.cliente_id', 'cliente.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', 'cliente_sucursales.id')
            ->select([
                'orden_pedido.id', 'orden_pedido.fecha_aprobacion',
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
            ->addColumn('Opciones', function ($orden) {
                return '<button id="test" onclick="mostrar(' . $orden->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="fas fa-edit"></i></button>';
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function ordenesAprobacionImpresion()
    {
        $ordenes = DB::table('orden_pedido')->join('users', 'orden_pedido.user_aprobacion', 'users.id')
            ->join('cliente', 'orden_pedido.cliente_id', 'cliente.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', 'cliente_sucursales.id')
            ->select([
                'orden_pedido.id', 'orden_pedido.fecha_aprobacion',
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
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    private function toFixed($number, $decimals) {
        return number_format($number, $decimals, '.', "");
    }

    public function imprimir($id)
    {
        // verificar numero antiguo de la secuencia;
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
            $next_sec = number_format($sec + 0.01, 2);
            $orden_empaque->no_orden_empaque = "OE-" . str_replace('.', '', $next_sec);
            $orden_empaque->fecha = date('Y/m/d h:i:s');
            $orden_empaque->sec = number_format($sec + 0.01, 2);
            $orden_empaque->save();
        } else {
            $orden_empaque = $orden_pedido;
        }

        //orden normal
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
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


        $pdf = \PDF::loadView('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque', 'productos'));
        return $pdf->download('conduce.pdf');
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
        $ordenDetalle->orden_redistribuida = 1;
        $ordenDetalle->save();

        $orden = ordenPedido::find($orden_id);
        $orden->detallada = 1;
        $orden->save();

        $producto_id = $ordenDetalle->producto_id;

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


        //Almacen
        $almacen = Almacen::where('producto_id', $producto_id)->select('id')->get();

        $almacenes = array();

        $longitudAlmacen = count($almacen);

        for ($i = 0; $i < $longitudAlmacen; $i++) {
            array_push($almacenes, $almacen[$i]['id']);
        }

        $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)->get();

        //cantidad
        $cantidad = $ordenDetalle->cant_red;


        //producto
        $producto = Product::find($producto_id);

        $tallasAlmacenCurva = Almacen::whereIn('id', $almacenes)->where('usado_curva', 'LIKE', 0)->get()->first();
        $tallasCurva = Almacen::whereIn('id', $almacenes)->where('usado_curva', 'LIKE', 1)->get();

        if (\is_object($tallasAlmacenCurva)) {

            $tallasAlmacenCurva->usado_curva = 1;
            $tallasAlmacenCurva->save();

            // $curva = Curva::where('producto_id', $producto_id)->get();

            //curva
            $a_curva = $tallasCurva->sum('a');
            $b_curva = $tallasCurva->sum('b');
            $c_curva = $tallasCurva->sum('c');
            $d_curva = $tallasCurva->sum('d');
            $e_curva = $tallasCurva->sum('e');
            $f_curva = $tallasCurva->sum('f');
            $g_curva = $tallasCurva->sum('g');
            $h_curva = $tallasCurva->sum('h');
            $i_curva = $tallasCurva->sum('i');
            $j_curva = $tallasCurva->sum('j');
            $k_curva = $tallasCurva->sum('k');
            $l_curva = $tallasCurva->sum('l');
            $total_curva = $a_curva + $b_curva + $c_curva + $d_curva + $e_curva + $f_curva + $g_curva + $h_curva + $i_curva +
                $j_curva + $k_curva + $l_curva;
        } elseif (!is_object($tallasAlmacenCurva || $tallasAlmacenCurva == null)) {

            "test";
            //curva
            $a_curva = $tallasCurva->sum('a');
            $b_curva = $tallasCurva->sum('b');
            $c_curva = $tallasCurva->sum('c');
            $d_curva = $tallasCurva->sum('d');
            $e_curva = $tallasCurva->sum('e');
            $f_curva = $tallasCurva->sum('f');
            $g_curva = $tallasCurva->sum('g');
            $h_curva = $tallasCurva->sum('h');
            $i_curva = $tallasCurva->sum('i');
            $j_curva = $tallasCurva->sum('j');
            $k_curva = $tallasCurva->sum('k');
            $l_curva = $tallasCurva->sum('l');
            $total_curva = $a_curva + $b_curva + $c_curva + $d_curva + $e_curva + $f_curva + $g_curva + $h_curva + $i_curva +
                $j_curva + $k_curva + $l_curva;
        }

        //porcentaje total almacen
        $a = ($a_curva / $total_curva) * 100;
        $b = ($b_curva / $total_curva) * 100;
        $c = ($c_curva / $total_curva) * 100;
        $d = ($d_curva / $total_curva) * 100;
        $e = ($e_curva / $total_curva) * 100;
        $f = ($f_curva / $total_curva) * 100;
        $g = ($g_curva / $total_curva) * 100;
        $h = ($h_curva / $total_curva) * 100;
        $i = ($i_curva / $total_curva) * 100;
        $j = ($j_curva / $total_curva) * 100;
        $k = ($k_curva / $total_curva) * 100;
        $l = ($l_curva / $total_curva) * 100;
        $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        //calcular total con perdidas y segundas y ordenes de pedido

        $tallasAlmacen = Almacen::whereIn('id', $almacenes)->get();

        $a_alm = $tallasAlmacen->sum('a') - $tallasPerdidas->sum('a') - $tallasSegundas->sum('a');
        $b_alm = $tallasAlmacen->sum('b') - $tallasPerdidas->sum('b') - $tallasSegundas->sum('b');
        $c_alm = $tallasAlmacen->sum('c') - $tallasPerdidas->sum('c') - $tallasSegundas->sum('c');
        $d_alm = $tallasAlmacen->sum('d') - $tallasPerdidas->sum('d') - $tallasSegundas->sum('d');
        $e_alm = $tallasAlmacen->sum('e') - $tallasPerdidas->sum('e') - $tallasSegundas->sum('e');
        $f_alm = $tallasAlmacen->sum('f') - $tallasPerdidas->sum('f') - $tallasSegundas->sum('f');
        $g_alm = $tallasAlmacen->sum('g') - $tallasPerdidas->sum('g') - $tallasSegundas->sum('g');
        $h_alm = $tallasAlmacen->sum('h') - $tallasPerdidas->sum('h') - $tallasSegundas->sum('h');
        $i_alm = $tallasAlmacen->sum('i') - $tallasPerdidas->sum('i') - $tallasSegundas->sum('i');
        $j_alm = $tallasAlmacen->sum('j') - $tallasPerdidas->sum('j') - $tallasSegundas->sum('j');
        $k_alm = $tallasAlmacen->sum('k') - $tallasPerdidas->sum('k') - $tallasSegundas->sum('k');
        $l_alm = $tallasAlmacen->sum('l') - $tallasPerdidas->sum('l') - $tallasSegundas->sum('l');

        $a_alm = ($a_alm < 0 ? 0 : $a_alm);
        $b_alm = ($b_alm < 0 ? 0 : $b_alm);
        $c_alm = ($c_alm < 0 ? 0 : $c_alm);
        $d_alm = ($d_alm < 0 ? 0 : $d_alm);
        $e_alm = ($e_alm < 0 ? 0 : $e_alm);
        $f_alm = ($f_alm < 0 ? 0 : $f_alm);
        $g_alm = ($g_alm < 0 ? 0 : $g_alm);
        $h_alm = ($h_alm < 0 ? 0 : $h_alm);
        $i_alm = ($i_alm < 0 ? 0 : $i_alm);
        $j_alm = ($j_alm < 0 ? 0 : $j_alm);
        $k_alm = ($k_alm < 0 ? 0 : $k_alm);
        $l_alm = ($l_alm < 0 ? 0 : $l_alm);

        $total_alm = $a_alm + $b_alm + $c_alm + $d_alm + $e_alm + $f_alm + $g_alm + $h_alm + $i_alm + $j_alm + $k_alm + $l_alm;

        //porcentaje alm
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

        $total_perc = $a_perc + $b_perc + $c_perc + $d_perc + $e_perc + $f_perc + $g_perc + $h_perc +
            $i_perc + $j_perc + $k_perc + $l_perc;

        //segundo calculo
        $a_seg = ($a_alm == 0) ? 0.1 : ($a_perc - $a) / $a;
        $b_seg = ($b_alm == 0) ? 0.1 : ($b_perc - $b) / $b;
        $c_seg = ($c_alm == 0) ? 0.1 : ($c_perc - $c) / $c;
        $d_seg = ($d_alm == 0) ? 0.1 : ($d_perc - $d) / $d;
        $e_seg = ($e_alm == 0) ? 0.1 : ($e_perc - $e) / $e;
        $f_seg = ($f_perc - $f) / $f;
        $g_seg = ($g_perc - $g) / $g;
        $h_seg = ($h_perc - $h) / $h;
        $i_seg = ($i_perc - $i) / $i;
        $j_seg = ($j_perc - $j) / $j;
        $k_seg = ($k_alm == 0) ?  0.1  : ($k_alm - $k) / $k;
        $l_seg = ($l_alm == 0) ? 0.1 : ($l_alm - $l) / $l;

        //tercer calculo
        $a_ter = $a_perc * (1 + $a_seg) / 100;
        $b_ter = $b_perc * (1 + $b_seg) / 100;
        $c_ter = $c_perc * (1 + $c_seg) / 100;
        $d_ter = $d_perc * (1 + $d_seg) / 100;
        $e_ter = $e_perc * (1 + $e_seg) / 100;
        $f_ter = $f_perc * (1 + $f_seg) / 100;
        $g_ter = $g_perc * (1 + $g_seg) / 100;
        $h_ter = $h_perc * (1 + $h_seg) / 100;
        $i_ter = $i_perc * (1 + $i_seg) / 100;
        $j_ter = $j_perc * (1 + $j_seg) / 100;
        $k_ter = $k_perc * (1 + $k_seg) / 100;
        $l_ter = $l_perc * (1 + $l_seg) / 100;

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
        $k_red = round(round($cantidad * $k_ter, 1));
        $l_red = round(round($cantidad * $l_ter, 1));
        $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        $cant_total = round($cant_total);

        $referencia_producto = $producto->referencia_producto;
        $referencia_producto = substr($referencia_producto, 2, 1);

        // $arreglo = [ $a_red, $b_red, $c_red, $d_red, $e_red, $f_red, $g_red,
        // $h_red, $i_red, $j_red, $k_red, $l_red ];

        // $longitud = count($arreglo);

        // for ($i=0; $i < $longitud ; $i++) { 
        //     $myarray = array_map('round', $arreglo);
        // }

        // print_r($arreglo);
        // print_r(array_sum($arreglo));
        // print_r($myarray);

        // die();

        if ($cant_total > $cantidad) {
            $a_red = $a_red - 1;
            $b_red = $b_red - 0.1;
            $c_red = $c_red - 0.1;
            $d_red = $d_red - 0.3;
            $e_red = $e_red - 0.1;
            $f_red = $f_red - 0.1;
            $g_red = $g_red - 0.1;
            $h_red = $h_red - 0.1;
            $i_red = $i_red - 0.1;
            $j_red = $j_red - 0.1;
            $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
            $cant_total = round($cant_total);
        } else {
            $a_red = $a_red + 0.5;
            $b_red = $b_red + 0.1;
            $c_red = $c_red + 0.1;
            $d_red = $d_red + 0.1;
            $e_red = $e_red + 0.1;
            $f_red = $f_red + 0.1;
            $g_red = $g_red + 0.1;
            $h_red = $h_red + 0.1;
            $i_red = $i_red + 0.1;
            $j_red = $j_red + 0.1;
            $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
            $cant_total = round($cant_total);
        }


        $orden_pedido_detalle = ordenPedidoDetalle::where('orden_pedido_id', $orden_id)
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

        $orden_pedido = ordenEmpaque::where('orden_pedido_id', $orden_id)->get()->first();

        if (empty($orden_pedido) || $orden_pedido == "[]") {
            //Crear nuevo objeto de orden de empaque
            $orden_empaque = new ordenEmpaque();

            $orden_empaque->orden_pedido_id = $orden_id;
            $next_sec = $sec + 0.01;
            $orden_empaque->no_orden_empaque = "OE - " . str_replace('.', '', $next_sec);
            $orden_empaque->fecha = date('Y/m/d h:i:s');
            $orden_empaque->sec = $sec + 0.01;
            $orden_empaque->a = ($a_red < 0 ? 0 : $a_red);
            $orden_empaque->b = ($b_red < 0 ? 0 : $b_red);
            $orden_empaque->c = ($c_red < 0 ? 0 : $c_red);
            $orden_empaque->d = ($d_red < 0 ? 0 : $d_red);
            $orden_empaque->e = ($e_red < 0 ? 0 : $e_red);
            $orden_empaque->f = ($f_red < 0 ? 0 : $f_red);
            $orden_empaque->g = ($g_red < 0 ? 0 : $g_red);
            $orden_empaque->h = ($h_red < 0 ? 0 : $h_red);
            $orden_empaque->i = ($i_red < 0 ? 0 : $i_red);
            $orden_empaque->j = ($j_red < 0 ? 0 : $j_red);
            $orden_empaque->k = ($k_red < 0 ? 0 : $k_red);
            $orden_empaque->l = ($l_red < 0 ? 0 : $l_red);
            $orden_empaque->save();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden,
            'cantidad' => $ordenDetalle,
            'curva' => 'Curva',
            'a_curva' => $a_curva,
            'b_curva' => $b_curva,
            'c_curva' => $c_curva,
            'd_curva' => $d_curva,
            'e_curva' => $e_curva,
            'f_curva' => $f_curva,
            'g_curva' => $g_curva,
            'h_curva' => $h_curva,
            'i_curva' => $i_curva,
            'j_curva' => $j_curva,
            'k_curva' => $k_curva,
            'l_curva' => $l_curva,
            'porcentaje' => 'porcentaje',
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
            'e' => $e,
            'f' => $f,
            'g' => $g,
            'h' => $h,
            'i' => $i,
            'j' => $j,
            'k' => $k,
            'l' => $l,
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
            'k' => $k,
            'l' => $l,
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
            'k' => $k,
            'l' => $l,
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
            'cant-detalle' => $cantidad,
            'detalle' => $orden_pedido_detalle,
            'genero' => $referencia_producto
        ];


        return response()->json($data, $data['code']);
    }

    public function show($id)
    {
        $orden_pedido = ordenPedido::find($id);
        $orden_id = $orden_pedido->id;

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $orden_id)->get()->load('producto');

        $cliente_id = $orden_pedido->cliente_id;
        $cliente = Client::find($cliente_id);

        $sucursal_id = $orden_pedido->sucursal_id;
        $sucursal = ClientBranch::find($sucursal_id);

        $orden_empaque = ordenEmpaque::where('orden_pedido_id', $orden_id)->get()->first();
        $empaque_id = $orden_empaque->id;

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
                'orden_detalle' => $orden_detalle,
                'cliente' => $cliente,
                'sucursal' => $sucursal,
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
        $orden_detalle = ordenPedidoDetalle::find($id);
     
        $empaque_id = $request->input('id');
        $cant_bultos = $request->input('cantidad');

        $a = $orden_detalle->a;
        $b = $orden_detalle->b;
        $c = $orden_detalle->c;
        $d = $orden_detalle->d;
        $e = $orden_detalle->e;
        $f = $orden_detalle->f;
        $g = $orden_detalle->g;
        $h = $orden_detalle->h;
        $i = $orden_detalle->i;
        $j = $orden_detalle->j;
        $k = $orden_detalle->k;
        $l = $orden_detalle->l;
        $cantidad = $orden_detalle->cant_red;
        $total = $orden_detalle->total;

        if (\is_object($orden_detalle)) {
            $orden_detalle->orden_empacada = 1;
            $orden_detalle->save();

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
            $orden_empaque_detalle->total = $total;
            $orden_empaque_detalle->fecha_empacado = date('Y/m/d h:i:s');
            $orden_empaque_detalle->empacado = 1;
            $orden_empaque_detalle->facturado = 0;
            $orden_empaque_detalle->save();

            $orden_empaque = ordenEmpaque::find($empaque_id);


            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_empaque_detalle' => $orden_empaque_detalle,
                'orden_empaque' => $orden_empaque
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se encontro la orden'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function empaqueDetalle($id)
    {
        $ordenes = DB::table('orden_pedido_detalle')
            ->join('producto', 'orden_pedido_detalle.producto_id', 'producto.id')
            ->select([
                'orden_pedido_detalle.id', 'orden_pedido_detalle.a',
                'orden_pedido_detalle.b', 'orden_pedido_detalle.c', 'orden_pedido_detalle.d',
                'orden_pedido_detalle.e', 'orden_pedido_detalle.f', 'orden_pedido_detalle.f',
                'orden_pedido_detalle.g', 'orden_pedido_detalle.h', 'orden_pedido_detalle.i',
                'orden_pedido_detalle.j', 'orden_pedido_detalle.k', 'orden_pedido_detalle.l',
                'orden_pedido_detalle.total', 'producto.referencia_producto', 'orden_pedido_detalle.orden_empacada'
            ])->where('orden_pedido_id', 'LIKE', $id);

        return DataTables::of($ordenes)
            ->addColumn('cantidad', function ($orden) {
                return ($orden->orden_empacada == 1) ? '<input type="text" id="cantidad'.$orden->id.'" name="cantidad" class="cantidad form-control-sm text-center" disabled>'
                :'<input type="text" id="cantidad'.$orden->id.'" name="cantidad" class="cantidad form-control-sm text-center" >';
            })
            ->addColumn('Opciones', function ($orden) {
                return ($orden->orden_empacada == 1) ? '<span id="empacado_listo" class="badge badge-success">Empacado <i class="fas fa-check"></i> </span>': 
                '<a onclick="test(' . $orden->id . ')" id="guardar" class="btn btn-primary btn-sm ml-1"> <i class="far fa-save"></i></a>';
            })
            ->addColumn('records', function ($orden) {
                return ;
            })
            ->rawColumns(['Opciones', 'cantidad'])
            ->make(true);
    }
}

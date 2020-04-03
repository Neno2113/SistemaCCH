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
use App\AlmacenDetalle;
use App\Client;
use App\ClientBranch;
use App\Corte;
use App\TallasPerdidas;
use App\Talla;
use App\Product;
use App\CurvaProducto;
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
            ])->where('status_orden_pedido', 'LIKE', 'Vigente');;

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

        $orden->fecha = date("d/m/20y", strtotime($orden->fecha));
        $orden->fecha_entrega = date("d/m/20y", strtotime($orden->fecha_entrega));


        $pdf = \PDF::loadView('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque', 'productos'));
        return $pdf->download('ordenEmpaque.pdf');
        return  View('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque', 'productos'));
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
        $producto_curva = $ordenDetalle->producto_id;
        $producto_id = $ordenDetalle->producto_id;

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
        $cant_total = round($cant_total);

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
            'total_%_curva' => $total_perc,
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
            // 'diferencia' => $cant_dif,
            'cant-detalle' => $cantidad,
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
                '<a onclick="test(' . $orden->id . ')" id="guardar" class="btn btn-primary btn-sm ml-1 text-white"> <i class="far fa-save"></i></a>';
            })
            ->addColumn('records', function ($orden) {
                return ;
            })
            ->rawColumns(['Opciones', 'cantidad'])
            ->make(true);
    }
}

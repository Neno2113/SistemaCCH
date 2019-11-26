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
use App\TallasPerdidas;
use App\Product;

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
                'orden_pedido.detallada',
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
                return ($orden->detallada == '1') ?
                    '<a href="imprimir_empaque/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>' : '<button onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1" id="btn-status"> <i class="fas fa-random"></i></button>';
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function imprimir($id)
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
            ->load('sucursal')
            ->load('producto');

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $pdf = \PDF::loadView('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque'));
        return $pdf->download('conduce.pdf');
    }


    public function redistibucion($id)
    {

        $orden = ordenPedido::find($id);

        $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->first();

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
        $cantidad = $ordenDetalle->sum('cantidad');

        //producto
        $producto = Product::find($producto_id);

        $tallasAlmacenCurva = Almacen::whereIn('id', $almacenes)->where('usado_curva', 'LIKE', 0)->get()->first();
        $tallasCurva = Almacen::whereIn('id', $almacenes)->where('usado_curva', 'LIKE', 1)->get();

        if (!$tallasCurva->count()) {
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
        } else {
            //curva
            $a_curva = $tallasAlmacenCurva->sum('a');
            $b_curva = $tallasAlmacenCurva->sum('b');
            $c_curva = $tallasAlmacenCurva->sum('c');
            $d_curva = $tallasAlmacenCurva->sum('d');
            $e_curva = $tallasAlmacenCurva->sum('e');
            $f_curva = $tallasAlmacenCurva->sum('f');
            $g_curva = $tallasAlmacenCurva->sum('g');
            $h_curva = $tallasAlmacenCurva->sum('h');
            $i_curva = $tallasAlmacenCurva->sum('i');
            $j_curva = $tallasAlmacenCurva->sum('j');
            $k_curva = $tallasAlmacenCurva->sum('k');
            $l_curva = $tallasAlmacenCurva->sum('l');
            $total_curva = $a_curva + $b_curva + $c_curva + $d_curva + $e_curva + $f_curva + $g_curva + $h_curva + $i_curva +
                $j_curva + $k_curva + $l_curva;

            $tallasAlmacenCurva->usado_curva = 1;
            $tallasAlmacenCurva->save();
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
        $a_seg = ($a_perc - $a) / $a;
        $b_seg = ($b_perc - $b) / $b;
        $c_seg = ($c_perc - $c) / $c;
        $d_seg = ($d_perc - $d) / $d;
        $e_seg = ($e_perc - $e) / $e;
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
        $a_red = round(round($cantidad * $a_ter, 1));
        $b_red = round(round($cantidad * $b_ter, 1));
        $c_red = round(round($cantidad * $c_ter, 1));
        $d_red = round(round($cantidad * $d_ter, 1));
        $e_red = round(round($cantidad * $e_ter, 1));
        $f_red = round(round($cantidad * $f_ter, 1));
        $g_red = round(round($cantidad * $g_ter, 1));
        $h_red = round(round($cantidad * $h_ter, 1));
        $i_red = round(round($cantidad * $i_ter, 1));
        $j_red = round(round($cantidad * $j_ter, 1));
        $k_red = round(round($cantidad * $k_ter, 1));
        $l_red = round(round($cantidad * $l_ter, 1));
        $cant_total = $a_red + $b_red + $c_red + $d_red + $e_red + $f_red + $g_red + $h_red + $i_red + $j_red + $k_red + $l_red;
        $cant_total = round($cant_total);



        $orden_empaque = new ordenEmpaque();

        //verificar numero antiguo de la secuencia;
        $numero_antiguo = DB::table('orden_empaque')->latest('updated_at')->first();

        if (empty($numero_antiguo) || $numero_antiguo == "") {
            $sec = 0.00;
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
            $orden_empaque->a = $a_red;
            $orden_empaque->b = $b_red;
            $orden_empaque->c = $c_red;
            $orden_empaque->d = $d_red;
            $orden_empaque->e = $e_red;
            $orden_empaque->f = $f_red;
            $orden_empaque->g = $g_red;
            $orden_empaque->h = $h_red;
            $orden_empaque->i = $i_red;
            $orden_empaque->j = $j_red;
            $orden_empaque->k = $k_red;
            $orden_empaque->l = $l_red;
            $orden_empaque->save();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden,
            'cantidad' => $ordenDetalle->sum('cantidad'),
            'message' => 'Redistribucion',
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
            'cant' => $cant_total,
            'tallasAlmacen' => $tallasAlmacenCurva,
            'tallasCurva' => $tallasCurva


        ];


        return response()->json($data, $data['code']);
    }
}

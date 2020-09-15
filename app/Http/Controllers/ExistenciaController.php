<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Product;
use App\Talla;
use App\Client;
use App\Perdida;
use App\TallasPerdidas;
use App\Almacen;
use App\AlmacenDetalle;
use App\Existencia;
use App\ordenPedidoDetalle;
use App\NotaCredito;
use App\NotaCreditoDetalle;
use App\Factura;
use App\CatalogoCuenta;
use App\Lavanderia;
use App\ordenEmpaque;
use App\OrdenFacturacion;
use App\ordenFacturacionDetalle;
use App\Recepcion;
use App\ordenPedido;
use App\SKU;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExistenciaController extends Controller
{

    public function show(Request $request)
    {
        //Recoger datos por la request
        $producto_id = $request->input('producto_id');
        $referencia_producto = $request->input('referencia_producto');

        //buscar cortes con la misma referencia producto
        $corte = Corte::where('producto_id', $producto_id)->select('id')->get();

        $cortes = array();

        $longitud = count($corte);


        for ($i = 0; $i < $longitud; $i++) {
            array_push($cortes, $corte[$i]['id']);
        }
        //buscar cantidades de tallas con el array de id de cortes
        $tallas = Talla::whereIn('corte_id', $cortes)->get()->load('corte');


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
        // $almacen = AlmacenDetalle::where('producto_id', $producto_id)->get();

        // $almacenes = array();

        // $longitudAlmacen = count($almacen);

        // for ($i=0; $i < $longitudAlmacen ; $i++) {
        //     array_push($almacenes, $almacen[$i]['id']);
        // }

        $tallasAlmacen = AlmacenDetalle::where('producto_id', $producto_id)->get();


        //ordenes
        $orden_pedido = ordenPedido::where('status_orden_pedido', 'LIKE', 'Vigente')
        ->select('id')
        ->get();

        $ordenes = array();

        for ($i = 0; $i < count($orden_pedido); $i++) {
            array_push($ordenes, $orden_pedido[$i]['id']);
        }

        //Ordenes
        $tallasOrdenes = ordenPedidoDetalle::whereIn('orden_pedido_id', $ordenes)
        ->where('referencia_father', $producto_id)
            // ->where('orden_empacada' , 'LIKE', '0')
            ->get()->load('ordenPedido');

        //nota de credito
        $tallasNC = NotaCreditoDetalle::where('referencia_father', $producto_id)
            ->get()->load('notaCredito');

        //orden facturacion
        $tallasfacturacion = ordenFacturacionDetalle::where('referencia_father', $producto_id)
            ->get();

        //Existencia
        $a = $tallasAlmacen->sum('a') - $tallasfacturacion->sum('a')  + $tallasSegundas->sum('a') + $tallasNC->sum('a');
        $b = $tallasAlmacen->sum('b') - $tallasfacturacion->sum('b')  + $tallasSegundas->sum('a') + $tallasNC->sum('b');
        $c = $tallasAlmacen->sum('c') - $tallasfacturacion->sum('c')  + $tallasSegundas->sum('a') + $tallasNC->sum('c');
        $d = $tallasAlmacen->sum('d') - $tallasfacturacion->sum('d')  + $tallasSegundas->sum('a') + $tallasNC->sum('d');
        $e = $tallasAlmacen->sum('e') - $tallasfacturacion->sum('e')  + $tallasSegundas->sum('a') + $tallasNC->sum('e');
        $f = $tallasAlmacen->sum('f') - $tallasfacturacion->sum('f')  + $tallasSegundas->sum('a') + $tallasNC->sum('f');
        $g = $tallasAlmacen->sum('g') - $tallasfacturacion->sum('g')  +  $tallasSegundas->sum('a') + $tallasNC->sum('g');
        $h = $tallasAlmacen->sum('h') - $tallasfacturacion->sum('h')  +  $tallasSegundas->sum('a') + $tallasNC->sum('h');
        $i = $tallasAlmacen->sum('i') - $tallasfacturacion->sum('i')  +  $tallasSegundas->sum('a') + $tallasNC->sum('i');
        $j = $tallasAlmacen->sum('j') - $tallasfacturacion->sum('j')  +  $tallasSegundas->sum('a') + $tallasNC->sum('j');
        $k = $tallasAlmacen->sum('k') - $tallasfacturacion->sum('k')  +  $tallasSegundas->sum('a') + $tallasNC->sum('k');
        $l = $tallasAlmacen->sum('l') - $tallasfacturacion->sum('l')  +  $tallasSegundas->sum('a') + $tallasNC->sum('l');
        $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        //disponible para la venta
        $a_disp = $a - $tallasOrdenes->sum('a') - $tallasSegundas->sum('a');
        $b_disp = $b - $tallasOrdenes->sum('b') - $tallasSegundas->sum('b');
        $c_disp = $c - $tallasOrdenes->sum('c') - $tallasSegundas->sum('c');
        $d_disp = $d - $tallasOrdenes->sum('d') - $tallasSegundas->sum('d');
        $e_disp = $e - $tallasOrdenes->sum('e') - $tallasSegundas->sum('e');
        $f_disp = $f - $tallasOrdenes->sum('f') - $tallasSegundas->sum('f');
        $g_disp = $g - $tallasOrdenes->sum('g') - $tallasSegundas->sum('g');
        $h_disp = $h - $tallasOrdenes->sum('h') - $tallasSegundas->sum('h');
        $i_disp = $i - $tallasOrdenes->sum('i') - $tallasSegundas->sum('i');
        $j_disp = $j - $tallasOrdenes->sum('j') - $tallasSegundas->sum('j');
        $k_disp = $k - $tallasOrdenes->sum('k') - $tallasSegundas->sum('k');
        $l_disp = $l - $tallasOrdenes->sum('l') - $tallasSegundas->sum('l');
        $total_disp = $a_disp + $b_disp + $c_disp + $d_disp + $e_disp + $f_disp + $g_disp + $h_disp
            + $i_disp + $j_disp + $k_disp + $l_disp;

        $a_op = $tallasOrdenes->sum('a');
        $b_op = $tallasOrdenes->sum('b');
        $c_op = $tallasOrdenes->sum('c');
        $d_op = $tallasOrdenes->sum('d');
        $e_op = $tallasOrdenes->sum('e');
        $f_op = $tallasOrdenes->sum('f');
        $g_op = $tallasOrdenes->sum('g');
        $h_op = $tallasOrdenes->sum('h');
        $i_op = $tallasOrdenes->sum('i');
        $j_op = $tallasOrdenes->sum('j');
        $k_op = $tallasOrdenes->sum('k');
        $l_op = $tallasOrdenes->sum('l');
        $total_op = $a_op + $b_op + $c_op + $d_op + $e_op + $f_op + $g_op + $h_op +
            $i_op + $j_op + $k_op + $l_op;

        //respuesta
        $data = [
            'code' => 200,
            'status' => 'success',
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
            'total' => $total,
            'a_disp' => $a_disp,
            'b_disp' => $b_disp,
            'c_disp' => $c_disp,
            'd_disp' => $d_disp,
            'e_disp' => $e_disp,
            'f_disp' => $f_disp,
            'g_disp' => $g_disp,
            'h_disp' => $h_disp,
            'i_disp' => $i_disp,
            'j_disp' => $j_disp,
            'k_disp' => $k_disp,
            'l_disp' => $l_disp,
            'total_disp' => $total_disp,
            'tallas' => $tallas,
            'a_corte' => $tallas->sum('a'),
            'b_corte' => $tallas->sum('b'),
            'c_corte' => $tallas->sum('c'),
            'd_corte' => $tallas->sum('d'),
            'e_corte' => $tallas->sum('e'),
            'f_corte' => $tallas->sum('f'),
            'g_corte' => $tallas->sum('g'),
            'h_corte' => $tallas->sum('h'),
            'i_corte' => $tallas->sum('i'),
            'j_corte' => $tallas->sum('j'),
            'k_corte' => $tallas->sum('k'),
            'l_corte' => $tallas->sum('l'),
            'total_corte' => $tallas->sum('total'),
            'tallasPerdidas' => $tallasPerdidas,
            'a_perd' => $tallasPerdidas->sum('a'),
            'b_perd' => $tallasPerdidas->sum('b'),
            'c_perd' => $tallasPerdidas->sum('c'),
            'd_perd' => $tallasPerdidas->sum('d'),
            'e_perd' => $tallasPerdidas->sum('e'),
            'f_perd' => $tallasPerdidas->sum('f'),
            'g_perd' => $tallasPerdidas->sum('g'),
            'h_perd' => $tallasPerdidas->sum('h'),
            'i_perd' => $tallasPerdidas->sum('i'),
            'j_perd' => $tallasPerdidas->sum('j'),
            'k_perd' => $tallasPerdidas->sum('k'),
            'l_perd' => $tallasPerdidas->sum('l'),
            'x_perd' => $tallasPerdidas->sum('talla_x'),
            'total_perd' => $tallasPerdidas->sum('total'),
            'tallaSegundas' => $tallasSegundas,
            'a_seg' => $tallasSegundas->sum('a'),
            'b_seg' => $tallasSegundas->sum('b'),
            'c_seg' => $tallasSegundas->sum('c'),
            'd_seg' => $tallasSegundas->sum('d'),
            'e_seg' => $tallasSegundas->sum('e'),
            'f_seg' => $tallasSegundas->sum('f'),
            'g_seg' => $tallasSegundas->sum('g'),
            'h_seg' => $tallasSegundas->sum('h'),
            'i_seg' => $tallasSegundas->sum('i'),
            'j_seg' => $tallasSegundas->sum('j'),
            'k_seg' => $tallasSegundas->sum('k'),
            'l_seg' => $tallasSegundas->sum('l'),
            'x_seg' => $tallasSegundas->sum('talla_x'),
            'total_seg' => $tallasSegundas->sum('total'),
            'tallasAlmacen' => $tallasAlmacen,
            'a_alm' => $tallasAlmacen->sum('a'),
            'b_alm' => $tallasAlmacen->sum('b'),
            'c_alm' => $tallasAlmacen->sum('c'),
            'd_alm' => $tallasAlmacen->sum('d'),
            'e_alm' => $tallasAlmacen->sum('e'),
            'f_alm' => $tallasAlmacen->sum('f'),
            'g_alm' => $tallasAlmacen->sum('g'),
            'h_alm' => $tallasAlmacen->sum('h'),
            'i_alm' => $tallasAlmacen->sum('i'),
            'j_alm' => $tallasAlmacen->sum('j'),
            'k_alm' => $tallasAlmacen->sum('k'),
            'l_alm' => $tallasAlmacen->sum('l'),
            'total_alm' => $tallasAlmacen->sum('total'),
            'tallasOrdenes' => $tallasOrdenes,
            'a_op' => $tallasOrdenes->sum('a'),
            'b_op' => $tallasOrdenes->sum('b'),
            'c_op' => $tallasOrdenes->sum('c'),
            'd_op' => $tallasOrdenes->sum('d'),
            'e_op' => $tallasOrdenes->sum('e'),
            'f_op' => $tallasOrdenes->sum('f'),
            'g_op' => $tallasOrdenes->sum('g'),
            'h_op' => $tallasOrdenes->sum('h'),
            'i_op' => $tallasOrdenes->sum('i'),
            'j_op' => $tallasOrdenes->sum('j'),
            'k_op' => $tallasOrdenes->sum('k'),
            'l_op' => $tallasOrdenes->sum('l'),
            'total_op' => $total_op,
            'tallasNC' => $tallasNC,
            'a_nc' => $tallasNC->sum('a'),
            'b_nc' => $tallasNC->sum('b'),
            'c_nc' => $tallasNC->sum('c'),
            'd_nc' => $tallasNC->sum('d'),
            'e_nc' => $tallasNC->sum('e'),
            'f_nc' => $tallasNC->sum('f'),
            'g_nc' => $tallasNC->sum('g'),
            'h_nc' => $tallasNC->sum('h'),
            'i_nc' => $tallasNC->sum('i'),
            'j_nc' => $tallasNC->sum('j'),
            'k_nc' => $tallasNC->sum('k'),
            'l_nc' => $tallasNC->sum('l'),
            'total_nc' => $tallasNC->sum('total'),
            'tallasFactura' => $tallasfacturacion,
            'a_fb' => $tallasfacturacion->sum('a'),
            'b_fb' => $tallasfacturacion->sum('b'),
            'c_fb' => $tallasfacturacion->sum('c'),
            'd_fb' => $tallasfacturacion->sum('d'),
            'e_fb' => $tallasfacturacion->sum('e'),
            'f_fb' => $tallasfacturacion->sum('f'),
            'g_fb' => $tallasfacturacion->sum('g'),
            'h_fb' => $tallasfacturacion->sum('h'),
            'i_fb' => $tallasfacturacion->sum('i'),
            'j_fb' => $tallasfacturacion->sum('j'),
            'k_fb' => $tallasfacturacion->sum('k'),
            'l_fb' => $tallasfacturacion->sum('l'),
            'total_fb' => $tallasfacturacion->sum('total'),
        ];


        return \response()->json($data, $data['code']);
    }

    public function store(Request $request)
    {

        $validar = $request->validate([
            'producto_id' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $producto_id = $request->input('producto_id');

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

            $existencia = new Existencia();

            $existencia->producto_id = $producto_id;
            $existencia->a = $a;
            $existencia->b = $b;
            $existencia->c = $c;
            $existencia->d = $d;
            $existencia->e = $e;
            $existencia->f = $f;
            $existencia->g = $g;
            $existencia->h = $h;
            $existencia->i = $i;
            $existencia->j = $j;
            $existencia->k = $k;
            $existencia->l = $l;
            $existencia->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

            $existencia->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'existencia' => $existencia
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function selectProduct(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select("id", "referencia_producto")
                ->where('referencia_father', NUll)
                ->where('referencia_producto', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function existenciasPorTallas()
    {
        $existencias = DB::table('corte')->join('producto', 'corte.producto_id', 'producto.id')
            ->join('tallas', 'tallas.corte_id', 'corte.id')
            ->join('recepcion', 'recepcion.corte_id', 'corte.id')
            ->join('lavanderia', 'lavanderia.corte_id', 'corte.id')
            ->join('almacen_detalle', 'almacen_detalle.producto_id', 'producto.id')
            ->select([
                'corte.id as corte_id', 'producto.id as producto_id', 'producto.referencia_producto', 'producto.marca', 'tallas.a', 'tallas.b',
                'tallas.c', 'tallas.d', 'tallas.e', 'tallas.f', 'tallas.g', 'tallas.h', 'tallas.i',
                'tallas.j', 'tallas.k', 'tallas.l', 'corte.fase', 'recepcion.total_recibido as total_terminacion ',
                'recepcion.pendiente as pendiente_lavanderia', 'lavanderia.cantidad as enviado_lavanderia', 'lavanderia.total_enviado',
                'almacen_detalle.a as a_alm', 'almacen_detalle.b as b_alm', 'almacen_detalle.c as c_alm', 'almacen_detalle.d as d_alm',
                'almacen_detalle.e as e_alm', 'almacen_detalle.f as f_alm', 'almacen_detalle.g as g_alm', 'almacen_detalle.h as h_alm',
                'almacen_detalle.i as i_alm', 'almacen_detalle.j as j_alm', 'almacen_detalle.k as k_alm', 'almacen_detalle.l as l_alm',
                DB::raw(
                    'SUM(almacen_detalle.a ) as a_sub, SUM(almacen_detalle.b ) as b_sub, SUM(almacen_detalle.c) as c_sub, SUM(almacen_detalle.d ) as d_sub
                , SUM(almacen_detalle.e) as e_sub, SUM(almacen_detalle.f) as f_sub, SUM(almacen_detalle.g ) as g_sub, SUM(almacen_detalle.h ) as h_sub, SUM(almacen_detalle.i) as i_sub, SUM(almacen_detalle.j ) as j_sub,
                SUM(almacen_detalle.k ) as k_sub, SUM(almacen_detalle.l) as l_sub'
                )
            ])->groupBy('fase', 'marca', 'referencia_producto');

        return DataTables::of($existencias)
            ->addColumn('Expandir', function () {
                return "";
            })
            // ->addColumn('total_almacen', function ($existencia) {
            //     $total = $existencia->a_sub + $existencia->b_sub + $existencia->c_sub + $existencia->d_sub + $existencia->e_sub
            //     + $existencia->f_sub + $existencia->g_sub + $existencia->h_sub + $existencia->i_sub + $existencia->j_sub + $existencia->k_sub
            //     + $existencia->l_sub;
            //     return $total;
            // })
            // ->editColumn('generado_internamente', function ($orden) {
            //     return ($orden->generado_internamente == 1 ? 'Si' : 'No');
            // })
            // ->editColumn('detallada', function ($orden) {
            //     return ($orden->detallada == 1 ? 'Si' : 'No');
            // })
            // ->editColumn('fecha_entrega', function ($orden) {
            //     return date("d-m-20y", strtotime($orden->fecha_entrega));
            // })
            // ->editColumn('fecha', function ($orden) {
            //     return date("h:i:s  d-m", strtotime($orden->fecha));
            // })
            // ->editColumn('fecha_aprobacion', function ($orden) {
            //     return date("h:i d-m", strtotime($orden->fecha_aprobacion));
            // })
            // ->editColumn('status_orden_pedido', function ($orden) {
            //     if ($orden->status_orden_pedido == 'Vigente') {
            //         return '<span class="badge badge-pill badge-success">Vigente</span>';
            //     } else if ($orden->status_orden_pedido == 'Cancelado') {
            //         return '<span class="badge badge-pill badge-danger">Cancelada</span>';
            //     } else if ($orden->status_orden_pedido == 'Stanby') {
            //         return '<span class="badge badge-pill badge-secondary">Stanby</span>';
            //     } else if ($orden->status_orden_pedido == 'Despachado') {
            //         return '<span class="badge badge-pill badge-info">Despachado</span>';
            //     } else if ($orden->status_orden_pedido == 'Facturado') {
            //         return '<span class="badge badge-pill badge-dark">Facturado</span>';
            //     }
            // })
            ->addColumn('Opciones', function ($existencia) {
                return  '<a href="reporte/existencias/" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function existenciasProduccion()
    {
        $existencias = DB::table('corte')->join('producto', 'corte.producto_id', 'producto.id')
            ->join('tallas', 'tallas.corte_id', 'corte.id')
            ->select([
                'corte.id as corte_id', 'producto.id as producto_id', 'producto.referencia_producto', 'producto.marca', 'tallas.a', 'tallas.b',
                'tallas.c', 'tallas.d', 'tallas.e', 'tallas.f', 'tallas.g', 'tallas.h', 'tallas.i',
                'tallas.j', 'tallas.k', 'tallas.l', 'corte.fase', DB::raw(
                    'SUM(a) as a_sub, SUM(b) as b_sub, SUM(c) as c_sub, SUM(d) as d_sub
                , SUM(e) as e_sub, SUM(f) as f_sub, SUM(g) as g_sub, SUM(h) as h_sub, SUM(i) as i_sub, SUM(j) as j_sub, SUM(k) as k_sub, SUM(l) as l_sub'
                )

            ])->where('fase', 'LIKE', 'Produccion')

            ->groupBy('fase', 'marca', 'referencia_producto');

        return DataTables::of($existencias)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function existenciasAlmacen()
    {
        $existencias = DB::table('corte')->join('producto', 'corte.producto_id', 'producto.id')
            ->join('almacen_detalle', 'almacen_detalle.producto_id', 'producto.id')
            ->select([
                'corte.id as corte_id', 'producto.id as producto_id', 'producto.referencia_producto', 'producto.marca',
                'almacen_detalle.a', 'almacen_detalle.b', 'almacen_detalle.c', 'almacen_detalle.d',
                'almacen_detalle.e', 'almacen_detalle.f', 'almacen_detalle.g', 'almacen_detalle.h',
                'almacen_detalle.i', 'almacen_detalle.j', 'almacen_detalle.k', 'almacen_detalle.l',
                DB::raw('SUM(a) as a_alm, SUM(b) as b_alm, SUM(c) as c_alm, SUM(d) as d_alm ,SUM(e) as e_alm, SUM(f) as f_alm, SUM(g) as g_alm,
            SUM(h) as h_alm, SUM(i) as i_alm, SUM(j) as j_alm, SUM(k) as k_alm, SUM(l) as l_alm')

            ])->where('fase', 'LIKE', 'Almacen')
            ->groupBy('fase', 'marca', 'referencia_producto');

        return DataTables::of($existencias)
            ->addColumn('Expandir', function () {
                return "";
            })

            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function existencias()
    {
        $existencias = DB::table('producto')->join('corte', 'corte.producto_id', 'producto.id')
            ->select([
                'corte.id as corte_id', 'producto.id as producto_id', 'producto.referencia_producto', 'producto.marca',
                'corte.fase as fase'

            ])
            ->groupBy('referencia_producto');

        return DataTables::of($existencias)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('total_alm', function ($existencia) {
                $almacen = AlmacenDetalle::where('producto_id', $existencia->producto_id)->get();

                //SEGUNDA
                $segunda = Perdida::where('producto_id', $existencia->producto_id)
                    ->where('tipo_perdida', 'LIKE', 'Segundas')
                    ->get();

                $segundas = array();

                $longitudSegunda = count($segunda);

                for ($i = 0; $i < $longitudSegunda; $i++) {
                    array_push($segundas, $segunda[$i]['id']);
                }


                //pedido
                $orden_pedido = ordenPedido::where('status_orden_pedido', 'LIKE', 'Vigente')
                    ->select('id')
                    ->get();

                $ordenes = array();

                for ($i = 0; $i < count($orden_pedido); $i++) {
                    array_push($ordenes, $orden_pedido[$i]['id']);
                }


                $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get();
                $facturado = ordenFacturacionDetalle::where('producto_id', $existencia->producto_id)->get();
                $orden = ordenPedidoDetalle::where('producto_id', $existencia->producto_id)
                    ->whereIn('orden_pedido_id', $ordenes)->get();


                $exist = $almacen->sum('total') - $facturado->sum('total') + $tallasSegundas->sum('total');
                $dispVenta = $exist - $orden->sum('total') - $tallasSegundas->sum('total');

                if ($existencia->fase != "Almacen") {
                    return 0;
                } else {
                    return $dispVenta;
                }
            })
            ->addColumn('total_produccion', function ($existencia) {
                $corte = Corte::where('producto_id', $existencia->producto_id)
                    ->where('fase', 'LIKE', 'produccion')
                    ->select('id')
                    ->get();

                $cortes = array();

                $longitudCorte = count($corte);

                for ($i = 0; $i < $longitudCorte; $i++) {
                    array_push($cortes, $corte[$i]['id']);
                }
                $tallasCorte = Talla::whereIn('corte_id', $cortes)->get();

                $perdidas = Perdida::where('producto_id', $existencia->producto_id)
                    ->where('tipo_perdida', 'LIKE', 'Normal')
                    ->whereIn('fase', ['Produccion', 'Procesos secos'])
                    ->get();

                $perdidas = array();

                $longitudSegunda = count($perdidas);

                for ($i = 0; $i < $longitudSegunda; $i++) {
                    array_push($perdidas, $perdidas[$i]['id']);
                }
                $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();

                $dispo = $tallasCorte->sum('total') - $tallasPerdidas->sum('total');

                // if($existencia->fase != "Produccion"){
                //     return 0;
                // }else{
                return $dispo;
            })
            ->addColumn('total_lavanderia', function ($existencia) {
                $corte = Corte::where('producto_id', $existencia->producto_id)
                    ->where('fase', 'LIKE', 'Lavanderia')
                    ->select('id')
                    ->get();

                $cortes = array();

                $longitudCorte = count($corte);

                for ($i = 0; $i < $longitudCorte; $i++) {
                    array_push($cortes, $corte[$i]['id']);
                }
                $lavanderia = Lavanderia::whereIn('corte_id', $cortes)->get();

                $dispo = $lavanderia->sum('total_enviado');

                // if($existencia->fase != "Lavanderia"){
                //     return 0;
                // }else{
                return $dispo;
            })
            ->addColumn('total_recepcion', function ($existencia) {
                $corte = Corte::where('producto_id', $existencia->producto_id)
                    ->where('fase', 'LIKE', 'Recepcion')
                    ->select('id')
                    ->get();

                $cortes = array();

                $longitudCorte = count($corte);

                for ($i = 0; $i < $longitudCorte; $i++) {
                    array_push($cortes, $corte[$i]['id']);
                }
                $recepcion = Recepcion::whereIn('corte_id', $cortes)->get();

                $dispo = $recepcion->sum('total_recibido');

                // if($existencia->fase != "Recepcion"){
                //     return 0;
                // }else{
                return $dispo;
            })
            // ->addColumn('Opciones', function ($orden) {
            //     return
            //         '<a href="reporte/existencia" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
            // })

            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function imprimirReporte($hasta)
    {
        // echo $desde ."<br>";
        // echo $hasta ."<br>";

        //producto Produccion Mythos
        $producction_mythos = Product::where('marca', 'LIKE', 'Mythos')->select('id')->get();

        $product_mythos = array();

        for ($i = 0; $i < count($producction_mythos); $i++) {
            array_push($product_mythos, $producction_mythos[$i]['id']);
        }

        $corte_pro_myhtos = Corte::where('fase', 'LIKE', 'produccion')
        ->where('updated_at', '<', $hasta)
            ->whereIn('producto_id', $product_mythos)
            ->get();

        $cortes_pro_mythos = array();

        for ($i = 0; $i < count($corte_pro_myhtos); $i++) {
            array_push($cortes_pro_mythos, $corte_pro_myhtos[$i]['id']);
        }
        $tallasCorte = Talla::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_pro_mythos)->get()->load('producto');

        $a_sub_my = $tallasCorte->sum('a');
        $b_sub_my = $tallasCorte->sum('b');
        $c_sub_my = $tallasCorte->sum('c');
        $d_sub_my = $tallasCorte->sum('d');
        $e_sub_my = $tallasCorte->sum('e');
        $f_sub_my = $tallasCorte->sum('f');
        $g_sub_my = $tallasCorte->sum('g');
        $h_sub_my = $tallasCorte->sum('h');
        $i_sub_my = $tallasCorte->sum('i');
        $j_sub_my = $tallasCorte->sum('j');
        $k_sub_my = $tallasCorte->sum('k');
        $l_sub_my = $tallasCorte->sum('l');
        $total_sub_my = $a_sub_my + $b_sub_my + $c_sub_my + $d_sub_my + $e_sub_my + $f_sub_my + $g_sub_my +
            $h_sub_my + $i_sub_my + $j_sub_my + $k_sub_my + $l_sub_my;

        //producto Produccion Lavish
        $producction_lavish = Product::where('marca', 'LIKE', 'Lavish')->select('id')->get();

        $product_lavish = array();

        for ($i = 0; $i < count($producction_lavish); $i++) {
            array_push($product_lavish, $producction_lavish[$i]['id']);
        }

        $corte_pro_lavish = Corte::where('fase', 'LIKE', 'produccion')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_lavish)
            ->get();

        $cortes_pro_lavish = array();

        for ($i = 0; $i < count($corte_pro_lavish); $i++) {
            array_push($cortes_pro_lavish, $corte_pro_lavish[$i]['id']);
        }

        $tallasCorteLavish = Talla::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_pro_lavish)->get()->load('producto');

        $a_sub_lav = $tallasCorteLavish->sum('a');
        $b_sub_lav = $tallasCorteLavish->sum('b');
        $c_sub_lav = $tallasCorteLavish->sum('c');
        $d_sub_lav = $tallasCorteLavish->sum('d');
        $e_sub_lav = $tallasCorteLavish->sum('e');
        $f_sub_lav = $tallasCorteLavish->sum('f');
        $g_sub_lav = $tallasCorteLavish->sum('g');
        $h_sub_lav = $tallasCorteLavish->sum('h');
        $i_sub_lav = $tallasCorteLavish->sum('i');
        $j_sub_lav = $tallasCorteLavish->sum('j');
        $k_sub_lav = $tallasCorteLavish->sum('k');
        $l_sub_lav = $tallasCorteLavish->sum('l');
        $total_sub_lav = $a_sub_lav + $b_sub_lav + $c_sub_lav + $d_sub_lav + $e_sub_lav + $f_sub_lav + $g_sub_lav +
            $h_sub_lav + $i_sub_lav + $j_sub_lav + $k_sub_lav + $l_sub_lav;

        //producto Produccion Lavish
        $producction_genius = Product::where('marca', 'LIKE', 'Genius')->select('id')->get();

        $product_genius = array();

        for ($i = 0; $i < count($producction_genius); $i++) {
            array_push($product_genius, $producction_genius[$i]['id']);
        }

        $corte_pro_geniu = Corte::where('fase', 'LIKE', 'produccion')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_genius)
            ->get();

        $cortes_pro_genius = array();

        for ($i = 0; $i < count($corte_pro_geniu); $i++) {
            array_push($cortes_pro_genius, $corte_pro_geniu[$i]['id']);
        }

        $tallasCorteGenius = Talla::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_pro_genius)->get()->load('producto');

        $a_sub_gen = $tallasCorteGenius->sum('a');
        $b_sub_gen = $tallasCorteGenius->sum('b');
        $c_sub_gen = $tallasCorteGenius->sum('c');
        $d_sub_gen = $tallasCorteGenius->sum('d');
        $e_sub_gen = $tallasCorteGenius->sum('e');
        $f_sub_gen = $tallasCorteGenius->sum('f');
        $g_sub_gen = $tallasCorteGenius->sum('g');
        $h_sub_gen = $tallasCorteGenius->sum('h');
        $i_sub_gen = $tallasCorteGenius->sum('i');
        $j_sub_gen = $tallasCorteGenius->sum('j');
        $k_sub_gen = $tallasCorteGenius->sum('k');
        $l_sub_gen = $tallasCorteLavish->sum('l');
        $total_sub_gen = $a_sub_gen + $b_sub_gen + $c_sub_gen + $d_sub_gen + $e_sub_gen + $f_sub_gen + $g_sub_gen +
            $h_sub_gen + $i_sub_gen + $j_sub_gen + $k_sub_gen + $l_sub_lav;

        //resultado Prod
        $a_sub_prod = $a_sub_my + $a_sub_lav + $a_sub_gen;
        $b_sub_prod = $b_sub_my + $b_sub_lav + $b_sub_gen;
        $c_sub_prod = $c_sub_my + $c_sub_lav + $c_sub_gen;
        $d_sub_prod = $d_sub_my + $d_sub_lav + $d_sub_gen;
        $e_sub_prod = $e_sub_my + $e_sub_lav + $e_sub_gen;
        $f_sub_prod = $f_sub_my + $f_sub_lav + $f_sub_gen;
        $g_sub_prod = $g_sub_my + $g_sub_lav + $g_sub_gen;
        $h_sub_prod = $h_sub_my + $h_sub_lav + $h_sub_gen;
        $i_sub_prod = $i_sub_my + $i_sub_lav + $i_sub_gen;
        $j_sub_prod = $j_sub_my + $j_sub_lav + $j_sub_gen;
        $k_sub_prod = $k_sub_my + $k_sub_lav + $k_sub_gen;
        $l_sub_prod = $l_sub_my + $l_sub_lav + $l_sub_gen;
        $total_sub_prod = $a_sub_prod + $b_sub_prod + $c_sub_prod + $d_sub_prod + $e_sub_prod + $f_sub_prod + $g_sub_prod +
            $h_sub_prod + $i_sub_prod + $j_sub_prod + $k_sub_prod + $l_sub_lav;

        $perdidas = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->whereIn('fase', ['Produccion', 'Procesos secos'])
            ->get();

        $perdidas = array();

        $longitudSegunda = count($perdidas);

        for ($i = 0; $i < $longitudSegunda; $i++) {
            array_push($perdidas, $perdidas[$i]['id']);
        }
        $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();


        $dispo = $tallasCorte->sum('total') - $tallasPerdidas->sum('total');

        //Lavanderia Mythos

        $corte_lav = Corte::where('fase', 'LIKE', 'Lavanderia')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_mythos)
            ->select('id')
            ->get();

        $cortes_lav = array();

        for ($i = 0; $i < count($corte_lav); $i++) {
            array_push($cortes_lav, $corte_lav[$i]['id']);
        }

        $lavanderia = Lavanderia::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_lav)->get()->load('producto');
        $sub_lav_m = $lavanderia->sum('total_enviado');

        //Lavanderia Lavish

        $corte_lav_lav = Corte::where('fase', 'LIKE', 'Lavanderia')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_lavish)
            ->select('id')
            ->get();

        $cortes_lav_lav = array();

        for ($i = 0; $i < count($corte_lav_lav); $i++) {
            array_push($cortes_lav_lav, $corte_lav_lav[$i]['id']);
        }

        $lavanderia_lavish = Lavanderia::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_lav_lav)->get()->load('producto');
        $sub_lav_l = $lavanderia_lavish->sum('total_enviado');


        //Lavanderia Genius

        $corte_lav_gen = Corte::where('fase', 'LIKE', 'Lavanderia')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_genius)
            ->select('id')
            ->get();

        $cortes_lav_gens = array();

        for ($i = 0; $i < count($corte_lav_gen); $i++) {
            array_push($cortes_lav_gens, $corte_lav_gen[$i]['id']);
        }

        $lavanderia_genius = Lavanderia::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_lav_gens)->get()->load('producto');
        $sub_lav_g = $lavanderia_genius->sum('total_enviado');

        $sub_total_lav = $sub_lav_m + $sub_lav_l + $sub_lav_g;
        //Recepcion Mythos

        $corte_rec_mythos = Corte::where('fase', 'LIKE', 'Recepcion')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_mythos)
            ->select('id')
            ->get();

        $cortes_rec_mythos = array();

        for ($i = 0; $i < count($corte_rec_mythos); $i++) {
            array_push($cortes_rec_mythos, $corte_rec_mythos[$i]['id']);
        }

        $recepcion_mythos = Recepcion::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_rec_mythos)->get()->load('producto');
        $sub_rec_m = $recepcion_mythos->sum('total_recibido');
        //Recepcion Lavish

        $corte_rec_lavish = Corte::where('fase', 'LIKE', 'Recepcion')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_lavish)
            ->select('id')
            ->get();

        $cortes_rec_lavish = array();

        for ($i = 0; $i < count($corte_rec_lavish); $i++) {
            array_push($cortes_rec_lavish, $corte_rec_lavish[$i]['id']);
        }

        $recepcion_lavish = Recepcion::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_rec_lavish)->get()->load('producto');
        $sub_rec_l = $recepcion_lavish->sum('total_recibido');

        //Recepcion Genius

        $corte_rec_genius = Corte::where('fase', 'LIKE', 'Recepcion')
        ->where('updated_at', '<',  $hasta)
            ->whereIn('producto_id', $product_genius)
            ->select('id')
            ->get();

        $cortes_rec_genius = array();

        for ($i = 0; $i < count($corte_rec_genius); $i++) {
            array_push($cortes_rec_genius, $corte_rec_genius[$i]['id']);
        }

        $recepcion_genius = Recepcion::where('updated_at', '<',  $hasta)
        ->whereIn('corte_id', $cortes_rec_genius)->get()->load('producto');
        $sub_rec_g = $recepcion_genius->sum('total_recibido');

        //subtotal recepcion
        $sub_total_rec = $sub_rec_m + $sub_rec_l + $sub_rec_g;

        //Almacen Mythos
        $almacen_mythos = DB::table('almacen_detalle')
            ->join('producto', 'almacen_detalle.producto_id', 'producto.id')
            ->selectRaw(' almacen_detalle.updated_at, almacen_detalle.fecha_entrada, producto.referencia_producto, producto.id as producto_id  ,SUM(almacen_detalle.a) as a, SUM(almacen_detalle.b) as b, SUM(almacen_detalle.c) as c, SUM(almacen_detalle.d) as d, SUM(almacen_detalle.e) as e, SUM(almacen_detalle.f) as f, SUM(almacen_detalle.g) as g, SUM(almacen_detalle.h) as h, SUM(almacen_detalle.i) as i,
        SUM(almacen_detalle.j) as j, SUM(almacen_detalle.k) as k, SUM(almacen_detalle.l) as l,SUM(almacen_detalle.total) as total')
        ->whereIn('producto_id', $product_mythos)
        ->where('almacen_detalle.updated_at', '<', $hasta)
        ->groupBy('producto_id')
            ->get();
        // echo $almacen_mythos;
        // die();

        //ordenes
        $orden_pedido = ordenPedido::where('status_orden_pedido', 'LIKE', 'Vigente')
            ->select('id')
            ->get();

        $ordenes = array();

        for ($i = 0; $i < count($orden_pedido); $i++) {
            array_push($ordenes, $orden_pedido[$i]['id']);
        }

        $orden_m = DB::table('orden_pedido_detalle')
            ->selectRaw('orden_pedido_detalle.referencia_father, SUM(orden_pedido_detalle.a) as a, SUM(orden_pedido_detalle.b) as b, SUM(orden_pedido_detalle.c) as c, SUM(orden_pedido_detalle.d) as d, SUM(orden_pedido_detalle.e) as e, SUM(orden_pedido_detalle.f) as f, SUM(orden_pedido_detalle.g) as g, SUM(orden_pedido_detalle.h) as h, SUM(orden_pedido_detalle.i) as i,
        SUM(orden_pedido_detalle.j) as j, SUM(orden_pedido_detalle.k) as k, SUM(orden_pedido_detalle.l) as l,SUM(orden_pedido_detalle.total) as total')
            ->whereIn('orden_pedido_id', $ordenes)
            ->whereIn('producto_id', $product_mythos)
            ->groupBy('referencia_father')
            ->get();

        $facturado_m = DB::table('orden_facturacion_detalle')
            ->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->selectRaw('orden_facturacion_detalle.updated_at, orden_facturacion_detalle.referencia_father, producto.referencia_producto, producto.id as producto_id ,SUM(orden_facturacion_detalle.a) as a, SUM(orden_facturacion_detalle.b) as b, SUM(orden_facturacion_detalle.c) as c, SUM(orden_facturacion_detalle.d) as d, SUM(orden_facturacion_detalle.e) as e, SUM(orden_facturacion_detalle.f) as f, SUM(orden_facturacion_detalle.g) as g, SUM(orden_facturacion_detalle.h) as h, SUM(orden_facturacion_detalle.i) as i,
        SUM(orden_facturacion_detalle.j) as j, SUM(orden_facturacion_detalle.k) as k, SUM(orden_facturacion_detalle.l) as l,SUM(orden_facturacion_detalle.total) as total')
        ->where('orden_facturacion_detalle.updated_at',  '<',  $hasta)
        ->whereIn('producto_id', $product_mythos)
            ->groupBy('referencia_father')
            ->get();

        $nota_credito_m = DB::table('nota_credito_detalle')
        ->join('producto', 'nota_credito_detalle.producto_id', 'producto.id')
        ->selectRaw('nota_credito_detalle.updated_at, nota_credito_detalle.referencia_father, producto.referencia_producto, producto.id as producto_id ,SUM(nota_credito_detalle.a) as a, SUM(nota_credito_detalle.b) as b, SUM(nota_credito_detalle.c) as c, SUM(nota_credito_detalle.d) as d, SUM(nota_credito_detalle.e) as e, SUM(nota_credito_detalle.f) as f, SUM(nota_credito_detalle.g) as g, SUM(nota_credito_detalle.h) as h, SUM(nota_credito_detalle.i) as i,
        SUM(nota_credito_detalle.j) as j, SUM(nota_credito_detalle.k) as k, SUM(nota_credito_detalle.l) as l,SUM(nota_credito_detalle.total) as total')
        ->where('nota_credito_detalle.updated_at',  '<',  $hasta)
        ->whereIn('producto_id', $product_mythos)
            ->groupBy('referencia_father')
            ->get();

        // echo $nota_credito_m;
        // die();

        $a_alm_m = ($almacen_mythos->sum('a') - $facturado_m->sum('a') <= 0) ? 0 :$almacen_mythos->sum('a') - $facturado_m->sum('a') + $nota_credito_m->sum('a');
        $b_alm_m = ($almacen_mythos->sum('b') - $facturado_m->sum('b') <= 0) ? 0 :$almacen_mythos->sum('b') - $facturado_m->sum('b') + $nota_credito_m->sum('b');
        $c_alm_m = ($almacen_mythos->sum('c') - $facturado_m->sum('c') <= 0) ? 0 :$almacen_mythos->sum('c') - $facturado_m->sum('c') + $nota_credito_m->sum('c');
        $d_alm_m = ($almacen_mythos->sum('d') - $facturado_m->sum('d') <= 0) ? 0 :$almacen_mythos->sum('d') - $facturado_m->sum('d') + $nota_credito_m->sum('d');
        $e_alm_m = ($almacen_mythos->sum('e') - $facturado_m->sum('e') <= 0) ? 0 :$almacen_mythos->sum('e') - $facturado_m->sum('e') + $nota_credito_m->sum('e');
        $f_alm_m = ($almacen_mythos->sum('f') - $facturado_m->sum('f') <= 0) ? 0 :$almacen_mythos->sum('f') - $facturado_m->sum('f') + $nota_credito_m->sum('f');
        $g_alm_m = ($almacen_mythos->sum('g') - $facturado_m->sum('g') <= 0) ? 0 :$almacen_mythos->sum('g') - $facturado_m->sum('g') + $nota_credito_m->sum('g');
        $h_alm_m = ($almacen_mythos->sum('h') - $facturado_m->sum('h') <= 0) ? 0 :$almacen_mythos->sum('h') - $facturado_m->sum('h') + $nota_credito_m->sum('h');
        $i_alm_m = ($almacen_mythos->sum('i') - $facturado_m->sum('i') <= 0) ? 0 :$almacen_mythos->sum('i') - $facturado_m->sum('i') + $nota_credito_m->sum('i');
        $j_alm_m = ($almacen_mythos->sum('j') - $facturado_m->sum('j') <= 0) ? 0 :$almacen_mythos->sum('j') - $facturado_m->sum('j') + $nota_credito_m->sum('j');
        $k_alm_m = ($almacen_mythos->sum('k') - $facturado_m->sum('k') <= 0) ? 0 :$almacen_mythos->sum('k') - $facturado_m->sum('k') + $nota_credito_m->sum('k');
        $l_alm_m = ($almacen_mythos->sum('l') - $facturado_m->sum('l') <= 0) ? 0 :$almacen_mythos->sum('l') - $facturado_m->sum('l') + $nota_credito_m->sum('l');
        $total_alm_m = $a_alm_m + $b_alm_m + $c_alm_m + $d_alm_m + $e_alm_m + $f_alm_m + $g_alm_m + $h_alm_m
            + $i_alm_m + $j_alm_m + $k_alm_m + $k_alm_m;

        //Almacen Lavish
        $almacen_lavish = DB::table('almacen_detalle')
            ->join('producto', 'almacen_detalle.producto_id', 'producto.id')
            ->selectRaw('almacen_detalle.updated_at, producto.referencia_producto, producto.id as producto_id  ,SUM(almacen_detalle.a) as a, SUM(almacen_detalle.b) as b, SUM(almacen_detalle.c) as c, SUM(almacen_detalle.d) as d, SUM(almacen_detalle.e) as e, SUM(almacen_detalle.f) as f, SUM(almacen_detalle.g) as g, SUM(almacen_detalle.h) as h, SUM(almacen_detalle.i) as i,
            SUM(almacen_detalle.j) as j, SUM(almacen_detalle.k) as k, SUM(almacen_detalle.l) as l,SUM(almacen_detalle.total) as total')
            ->where('almacen_detalle.updated_at', '<',  $hasta)
            ->whereIn('almacen_detalle.producto_id', $product_lavish)
            ->groupBy('producto_id')
            ->get();


        $orden_l = DB::table('orden_pedido_detalle')
            ->selectRaw('orden_pedido_detalle.referencia_father, SUM(orden_pedido_detalle.a) as a, SUM(orden_pedido_detalle.b) as b, SUM(orden_pedido_detalle.c) as c, SUM(orden_pedido_detalle.d) as d, SUM(orden_pedido_detalle.e) as e, SUM(orden_pedido_detalle.f) as f, SUM(orden_pedido_detalle.g) as g, SUM(orden_pedido_detalle.h) as h, SUM(orden_pedido_detalle.i) as i,
        SUM(orden_pedido_detalle.j) as j, SUM(orden_pedido_detalle.k) as k, SUM(orden_pedido_detalle.l) as l,SUM(orden_pedido_detalle.total) as total')
            ->whereIn('orden_pedido_id', $ordenes)
            ->whereIn('producto_id', $product_lavish)
            ->groupBy('referencia_father')
            ->get();


        $facturado_l = DB::table('orden_facturacion_detalle')
            ->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->selectRaw('orden_facturacion_detalle.updated_at, orden_facturacion_detalle.referencia_father, producto.referencia_producto, producto.id as producto_id ,SUM(orden_facturacion_detalle.a) as a, SUM(orden_facturacion_detalle.b) as b, SUM(orden_facturacion_detalle.c) as c, SUM(orden_facturacion_detalle.d) as d, SUM(orden_facturacion_detalle.e) as e, SUM(orden_facturacion_detalle.f) as f, SUM(orden_facturacion_detalle.g) as g, SUM(orden_facturacion_detalle.h) as h, SUM(orden_facturacion_detalle.i) as i,
        SUM(orden_facturacion_detalle.j) as j, SUM(orden_facturacion_detalle.k) as k, SUM(orden_facturacion_detalle.l) as l,SUM(orden_facturacion_detalle.total) as total')
        ->where('orden_facturacion_detalle.updated_at',  '<',  $hasta)
        ->whereIn('producto_id', $product_lavish)
            ->groupBy('referencia_father')
            ->get();


        $nota_credito_l = DB::table('nota_credito_detalle')
        ->join('producto', 'nota_credito_detalle.producto_id', 'producto.id')
        ->selectRaw('nota_credito_detalle.updated_at, nota_credito_detalle.referencia_father, producto.referencia_producto, producto.id as producto_id ,SUM(nota_credito_detalle.a) as a, SUM(nota_credito_detalle.b) as b, SUM(nota_credito_detalle.c) as c, SUM(nota_credito_detalle.d) as d, SUM(nota_credito_detalle.e) as e, SUM(nota_credito_detalle.f) as f, SUM(nota_credito_detalle.g) as g, SUM(nota_credito_detalle.h) as h, SUM(nota_credito_detalle.i) as i,
        SUM(nota_credito_detalle.j) as j, SUM(nota_credito_detalle.k) as k, SUM(nota_credito_detalle.l) as l,SUM(nota_credito_detalle.total) as total')
        ->where('nota_credito_detalle.updated_at',  '<',  $hasta)
        ->whereIn('producto_id', $product_lavish)
            ->groupBy('referencia_father')
            ->get();

        // echo $nota_credito_l;
        // die();

        $a_alm_l = $almacen_lavish->sum('a') - $facturado_l->sum('a') + $nota_credito_l->sum('a');
        $b_alm_l = $almacen_lavish->sum('b') - $facturado_l->sum('b') + $nota_credito_l->sum('b');
        $c_alm_l = $almacen_lavish->sum('c') - $facturado_l->sum('c') + $nota_credito_l->sum('c');
        $d_alm_l = $almacen_lavish->sum('d') - $facturado_l->sum('d') + $nota_credito_l->sum('d');
        $e_alm_l = $almacen_lavish->sum('e') - $facturado_l->sum('e') + $nota_credito_l->sum('e');
        $f_alm_l = $almacen_lavish->sum('f') - $facturado_l->sum('f') + $nota_credito_l->sum('f');
        $g_alm_l = $almacen_lavish->sum('g') - $facturado_l->sum('g') + $nota_credito_l->sum('g');
        $h_alm_l = $almacen_lavish->sum('h') - $facturado_l->sum('h') + $nota_credito_l->sum('h');
        $i_alm_l = $almacen_lavish->sum('i') - $facturado_l->sum('i') + $nota_credito_l->sum('i');
        $j_alm_l = $almacen_lavish->sum('j') - $facturado_l->sum('j') + $nota_credito_l->sum('j');
        $k_alm_l = $almacen_lavish->sum('k') - $facturado_l->sum('k') + $nota_credito_l->sum('k');
        $l_alm_l = $almacen_lavish->sum('l') - $facturado_l->sum('l') + $nota_credito_l->sum('l');
        // $ref_alm_l = $almacen_lavish[0]['referencia_producto'];
        $total_alm_l = $a_alm_l + $b_alm_l + $c_alm_l + $d_alm_l + $e_alm_l + $f_alm_l + $g_alm_l + $h_alm_l
            + $i_alm_l + $j_alm_l + $k_alm_l + $k_alm_l;

        //Almacen Genius
        $almacen_genius = DB::table('almacen_detalle')
            ->join('producto', 'almacen_detalle.producto_id', 'producto.id')

            ->selectRaw('almacen_detalle.updated_at, producto.referencia_producto, producto.id as producto_id  ,SUM(almacen_detalle.a) as a, SUM(almacen_detalle.b) as b, SUM(almacen_detalle.c) as c, SUM(almacen_detalle.d) as d, SUM(almacen_detalle.e) as e, SUM(almacen_detalle.f) as f, SUM(almacen_detalle.g) as g, SUM(almacen_detalle.h) as h, SUM(almacen_detalle.i) as i,
          SUM(almacen_detalle.j) as j, SUM(almacen_detalle.k) as k, SUM(almacen_detalle.l) as l,SUM(almacen_detalle.total) as total')

            // ->selectRaw('SUM(orden_facturacion_detalle.a) as a, SUM(orden_facturacion_detalle.b) as b, SUM(orden_facturacion_detalle.c) as c, SUM(orden_facturacion_detalle.d) as d, SUM(orden_facturacion_detalle.e) as e, SUM(orden_facturacion_detalle.f) as f, SUM(orden_facturacion_detalle.g) as g, SUM(orden_facturacion_detalle.h) as h, SUM(orden_facturacion_detalle.i) as i,
            // SUM(orden_facturacion_detalle.j) as j, SUM(orden_facturacion_detalle.k) as k, SUM(orden_facturacion_detalle.l) as l,SUM(orden_facturacion_detalle.total) as total')
            ->where('almacen_detalle.updated_at', '<', $hasta)
            ->whereIn('almacen_detalle.producto_id', $product_genius)
            ->groupBy('producto_id')
            // ->join('orden_facturacion_detalle', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->get();
        // ->load('producto');

        $orden_g = DB::table('orden_pedido_detalle')
            ->selectRaw('orden_pedido_detalle.referencia_father, SUM(orden_pedido_detalle.a) as a, SUM(orden_pedido_detalle.b) as b, SUM(orden_pedido_detalle.c) as c, SUM(orden_pedido_detalle.d) as d, SUM(orden_pedido_detalle.e) as e, SUM(orden_pedido_detalle.f) as f, SUM(orden_pedido_detalle.g) as g, SUM(orden_pedido_detalle.h) as h, SUM(orden_pedido_detalle.i) as i,
      SUM(orden_pedido_detalle.j) as j, SUM(orden_pedido_detalle.k) as k, SUM(orden_pedido_detalle.l) as l,SUM(orden_pedido_detalle.total) as total')
            ->whereIn('orden_pedido_id', $ordenes)
            ->whereIn('producto_id', $product_genius)
            ->groupBy('referencia_father')
            ->get();


        $facturado_g = DB::table('orden_facturacion_detalle')
            ->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->selectRaw('orden_facturacion_detalle.updated_at, orden_facturacion_detalle.referencia_father, producto.referencia_producto, producto.id as producto_id ,SUM(orden_facturacion_detalle.a) as a, SUM(orden_facturacion_detalle.b) as b, SUM(orden_facturacion_detalle.c) as c, SUM(orden_facturacion_detalle.d) as d, SUM(orden_facturacion_detalle.e) as e, SUM(orden_facturacion_detalle.f) as f, SUM(orden_facturacion_detalle.g) as g, SUM(orden_facturacion_detalle.h) as h, SUM(orden_facturacion_detalle.i) as i,
      SUM(orden_facturacion_detalle.j) as j, SUM(orden_facturacion_detalle.k) as k, SUM(orden_facturacion_detalle.l) as l,SUM(orden_facturacion_detalle.total) as total')
      ->where('orden_facturacion_detalle.updated_at',  '<',  $hasta)
      ->whereIn('producto_id', $product_genius)
            ->groupBy('referencia_father')
            ->get();


        $nota_credito_g = DB::table('nota_credito_detalle')
        ->join('producto', 'nota_credito_detalle.producto_id', 'producto.id')
        ->selectRaw('nota_credito_detalle.updated_at, nota_credito_detalle.referencia_father, producto.referencia_producto, producto.id as producto_id ,SUM(nota_credito_detalle.a) as a, SUM(nota_credito_detalle.b) as b, SUM(nota_credito_detalle.c) as c, SUM(nota_credito_detalle.d) as d, SUM(nota_credito_detalle.e) as e, SUM(nota_credito_detalle.f) as f, SUM(nota_credito_detalle.g) as g, SUM(nota_credito_detalle.h) as h, SUM(nota_credito_detalle.i) as i,
        SUM(nota_credito_detalle.j) as j, SUM(nota_credito_detalle.k) as k, SUM(nota_credito_detalle.l) as l,SUM(nota_credito_detalle.total) as total')
        ->where('nota_credito_detalle.updated_at',  '<',  $hasta)
        ->whereIn('producto_id', $product_genius)
            ->groupBy('referencia_father')
            ->get();


        $a_alm_g = $almacen_genius->sum('a') - $facturado_g->sum('a') + $nota_credito_g->sum('a');
        $b_alm_g = $almacen_genius->sum('b') - $facturado_g->sum('b') + $nota_credito_g->sum('b');
        $c_alm_g = $almacen_genius->sum('c') - $facturado_g->sum('c') + $nota_credito_g->sum('c');
        $d_alm_g = $almacen_genius->sum('d') - $facturado_g->sum('d') + $nota_credito_g->sum('d');
        $e_alm_g = $almacen_genius->sum('e') - $facturado_g->sum('e') + $nota_credito_g->sum('e');
        $f_alm_g = $almacen_genius->sum('f') - $facturado_g->sum('f') + $nota_credito_g->sum('f');
        $g_alm_g = $almacen_genius->sum('g') - $facturado_g->sum('g') + $nota_credito_g->sum('g');
        $h_alm_g = $almacen_genius->sum('h') - $facturado_g->sum('h') + $nota_credito_g->sum('h');
        $i_alm_g = $almacen_genius->sum('i') - $facturado_g->sum('i') + $nota_credito_g->sum('i');
        $j_alm_g = $almacen_genius->sum('j') - $facturado_g->sum('j') + $nota_credito_g->sum('j');
        $k_alm_g = $almacen_genius->sum('k') - $facturado_g->sum('k') + $nota_credito_g->sum('k');
        $l_alm_g = $almacen_genius->sum('l') - $facturado_l->sum('l') + $nota_credito_g->sum('l');
        // $ref_alm_l = $almacen_lavish[0]['referencia_producto'];
        $total_alm_g = $a_alm_g + $b_alm_g + $c_alm_g + $d_alm_g + $e_alm_g + $f_alm_g + $g_alm_g + $h_alm_g
            + $i_alm_g + $j_alm_g + $k_alm_g + $k_alm_g;


        $a_sub_alm = ($a_alm_m + $a_alm_l + $a_alm_g <= 0) ? 0 : $a_alm_m + $a_alm_l + $a_alm_g;
        $b_sub_alm = ($b_alm_m + $b_alm_l + $b_alm_g <= 0) ? 0 : $b_alm_m + $b_alm_l + $b_alm_g;
        $c_sub_alm = ($c_alm_m + $c_alm_l + $c_alm_g <= 0) ? 0 : $c_alm_m + $c_alm_l + $c_alm_g;
        $d_sub_alm = ($d_alm_m + $d_alm_l + $d_alm_g <= 0) ? 0 : $d_alm_m + $d_alm_l + $d_alm_g;
        $e_sub_alm = ($e_alm_m + $e_alm_l + $e_alm_g <= 0) ? 0 : $e_alm_m + $e_alm_l + $e_alm_g;
        $f_sub_alm = ($f_alm_m + $f_alm_l + $f_alm_g <= 0) ? 0 : $f_alm_m + $f_alm_l + $f_alm_g;
        $g_sub_alm = ($g_alm_m + $g_alm_l + $g_alm_g <= 0) ? 0 : $g_alm_m + $g_alm_l + $g_alm_g;
        $h_sub_alm = ($h_alm_m + $h_alm_l + $h_alm_g <= 0) ? 0 : $h_alm_m + $h_alm_l + $h_alm_g;
        $i_sub_alm = ($i_alm_m + $i_alm_l + $i_alm_g <= 0) ? 0 : $i_alm_m + $i_alm_l + $i_alm_g;
        $j_sub_alm = ($j_alm_m + $j_alm_l + $j_alm_g <= 0) ? 0 : $j_alm_m + $j_alm_l + $j_alm_g;
        $k_sub_alm = ($k_alm_m + $k_alm_l + $k_alm_g <= 0) ? 0 : $k_alm_m + $k_alm_l + $k_alm_g;
        $l_sub_alm = ($l_alm_m + $l_alm_l + $l_alm_g <= 0) ? 0 : $l_alm_m + $l_alm_l + $l_alm_g;

        $total_sub_alm = $a_sub_alm + $b_sub_alm + $c_sub_alm + $d_sub_alm + $e_sub_alm + $f_sub_alm + $g_sub_alm + $h_sub_alm
            + $i_sub_alm + $j_sub_alm + $k_sub_alm + $l_sub_alm;

        //Gran total
        $a_total = $a_sub_prod + $a_sub_alm;
        $b_total = $b_sub_prod + $b_sub_alm;
        $c_total = $c_sub_prod + $c_sub_alm;
        $d_total = $d_sub_prod + $d_sub_alm;
        $e_total = $e_sub_prod + $e_sub_alm;
        $f_total = $f_sub_prod + $f_sub_alm;
        $g_total = $g_sub_prod + $g_sub_alm;
        $h_total = $h_sub_prod + $h_sub_alm;
        $i_total = $i_sub_prod + $i_sub_alm;
        $j_total = $j_sub_prod + $j_sub_alm;
        $k_total = $k_sub_prod + $k_sub_alm;
        $l_total = $l_sub_prod + $l_sub_alm;
        $total_reporte = $a_total + $b_total + $c_total + $d_total + $e_total + $f_total + $g_total + $h_total
            + $i_total + $j_total + $k_total + $l_total + $sub_total_rec + $sub_total_lav;


        $pdf = \PDF::loadView('sistema.existencia.reporteDetallado',   compact(
         'tallasCorte',
            'tallasPerdidas',
            'tallasCorteLavish',
            'tallasCorteGenius',
            'lavanderia',
            'lavanderia_lavish',
            'lavanderia_genius',
            'recepcion_mythos',
            'recepcion_lavish',
            'recepcion_genius',
            'almacen_mythos',
            'almacen_lavish',
            'almacen_genius',
            'hasta',
            'a_sub_my',
            'b_sub_my',
            'c_sub_my',
            'd_sub_my',
            'e_sub_my',
            'f_sub_my',
            'g_sub_my',
            'h_sub_my',
            'i_sub_my',
            'j_sub_my',
            'k_sub_my',
            'l_sub_my',
            'total_sub_my',
            'a_sub_lav',
            'b_sub_lav',
            'c_sub_lav',
            'd_sub_lav',
            'e_sub_lav',
            'f_sub_lav',
            'g_sub_lav',
            'h_sub_lav',
            'i_sub_lav',
            'j_sub_lav',
            'k_sub_lav',
            'l_sub_lav',
            'total_sub_lav',
            'a_sub_gen',
            'b_sub_gen',
            'c_sub_gen',
            'd_sub_gen',
            'e_sub_gen',
            'f_sub_gen',
            'g_sub_gen',
            'h_sub_gen',
            'i_sub_gen',
            'j_sub_gen',
            'k_sub_gen',
            'l_sub_gen',
            'total_sub_gen',
            'a_sub_prod',
            'b_sub_prod',
            'c_sub_prod',
            'd_sub_prod',
            'e_sub_prod',
            'f_sub_prod',
            'g_sub_prod',
            'h_sub_prod',
            'i_sub_prod',
            'j_sub_prod',
            'k_sub_prod',
            'l_sub_prod',
            'total_sub_prod',
            'sub_lav_m',
            'sub_lav_l',
            'sub_lav_g',
            'sub_rec_m',
            'sub_rec_l',
            'sub_rec_g',
            'sub_total_rec',
            'sub_total_lav',
            'a_alm_m',
            'b_alm_m',
            'c_alm_m',
            'd_alm_m',
            'e_alm_m',
            'f_alm_m',
            'g_alm_m',
            'h_alm_m',
            'i_alm_m',
            'j_alm_m',
            'k_alm_m',
            'l_alm_m',
            // 'ref_alm_l',
            'total_alm_m',
            'a_alm_l',
            'b_alm_l',
            'c_alm_l',
            'd_alm_l',
            'e_alm_l',
            'f_alm_l',
            'g_alm_l',
            'h_alm_l',
            'i_alm_l',
            'j_alm_l',
            'k_alm_l',
            'l_alm_l',
            'total_alm_l',
            'a_alm_g',
            'b_alm_g',
            'c_alm_g',
            'd_alm_g',
            'e_alm_g',
            'f_alm_g',
            'g_alm_g',
            'h_alm_g',
            'i_alm_g',
            'j_alm_g',
            'k_alm_g',
            'l_alm_g',
            'total_alm_g',
            'a_sub_alm',
            'b_sub_alm',
            'c_sub_alm',
            'd_sub_alm',
            'e_sub_alm',
            'f_sub_alm',
            'g_sub_alm',
            'h_sub_alm',
            'i_sub_alm',
            'j_sub_alm',
            'k_sub_alm',
            'l_sub_alm',
            'total_sub_alm',
            'a_total',
            'b_total',
            'c_total',
            'd_total',
            'e_total',
            'f_total',
            'g_total',
            'h_total',
            'i_total',
            'j_total',
            'k_total',
            'l_total',
            'total_reporte',
            'orden_m',
            'orden_l',
            'facturado_m',
            'facturado_l',
            'facturado_g',
            'nota_credito_m',
            'nota_credito_l',
            'nota_credito_g',
        ));
        return $pdf->download('ReporteExistencias.pdf');
        return View('sistema.existencia.reporteDetallado', compact(
            'tallasCorte',
            'tallasPerdidas',
            'tallasCorteLavish',
            'tallasCorteGenius',
            'lavanderia',
            'lavanderia_lavish',
            'lavanderia_genius',
            'recepcion_mythos',
            'recepcion_lavish',
            'recepcion_genius',
            'almacen_mythos',
            'almacen_lavish',
            'almacen_genius',
            'a_sub_my',
            'b_sub_my',
            'c_sub_my',
            'd_sub_my',
            'e_sub_my',
            'f_sub_my',
            'g_sub_my',
            'h_sub_my',
            'i_sub_my',
            'j_sub_my',
            'k_sub_my',
            'l_sub_my',
            'total_sub_my',
            'a_sub_lav',
            'b_sub_lav',
            'c_sub_lav',
            'd_sub_lav',
            'e_sub_lav',
            'f_sub_lav',
            'g_sub_lav',
            'h_sub_lav',
            'i_sub_lav',
            'j_sub_lav',
            'k_sub_lav',
            'l_sub_lav',
            'total_sub_lav',
            'a_sub_gen',
            'b_sub_gen',
            'c_sub_gen',
            'd_sub_gen',
            'e_sub_gen',
            'f_sub_gen',
            'g_sub_gen',
            'h_sub_gen',
            'i_sub_gen',
            'j_sub_gen',
            'k_sub_gen',
            'l_sub_gen',
            'total_sub_gen',
            'a_sub_prod',
            'b_sub_prod',
            'c_sub_prod',
            'd_sub_prod',
            'e_sub_prod',
            'f_sub_prod',
            'g_sub_prod',
            'h_sub_prod',
            'i_sub_prod',
            'j_sub_prod',
            'k_sub_prod',
            'l_sub_prod',
            'total_sub_prod',
            'sub_lav_m',
            'sub_lav_l',
            'sub_lav_g',
            'sub_rec_m',
            'sub_rec_l',
            'sub_rec_g',
            'sub_total_rec',
            'sub_total_lav',
            'a_alm_m',
            'b_alm_m',
            'c_alm_m',
            'd_alm_m',
            'e_alm_m',
            'f_alm_m',
            'g_alm_m',
            'h_alm_m',
            'i_alm_m',
            'j_alm_m',
            'k_alm_m',
            'l_alm_m',
            // 'ref_alm_l',
            'total_alm_m',
            'a_alm_l',
            'b_alm_l',
            'c_alm_l',
            'd_alm_l',
            'e_alm_l',
            'f_alm_l',
            'g_alm_l',
            'h_alm_l',
            'i_alm_l',
            'j_alm_l',
            'k_alm_l',
            'l_alm_l',
            'total_alm_l',
            'a_alm_g',
            'b_alm_g',
            'c_alm_g',
            'd_alm_g',
            'e_alm_g',
            'f_alm_g',
            'g_alm_g',
            'h_alm_g',
            'i_alm_g',
            'j_alm_g',
            'k_alm_g',
            'l_alm_g',
            'total_alm_g',
            'a_sub_alm',
            'b_sub_alm',
            'c_sub_alm',
            'd_sub_alm',
            'e_sub_alm',
            'f_sub_alm',
            'g_sub_alm',
            'h_sub_alm',
            'i_sub_alm',
            'j_sub_alm',
            'k_sub_alm',
            'l_sub_alm',
            'total_sub_alm',
            'a_total',
            'b_total',
            'c_total',
            'd_total',
            'e_total',
            'f_total',
            'g_total',
            'h_total',
            'i_total',
            'j_total',
            'k_total',
            'l_total',
            'total_reporte',
            'orden_m',
            'orden_l',
            'facturado_m',
            'facturado_l',
            'facturado_g'
        ));
    }

    public function exportarFactura()
    {
        $existencias = DB::table('orden_facturacion_detalle')->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->join('orden_facturacion', 'orden_facturacion_detalle.orden_facturacion_id', 'orden_facturacion.id')
            ->select([
                'orden_facturacion_detalle.orden_facturacion_id', 'orden_facturacion.por_transporte', 'orden_facturacion_detalle.total',
                'producto.referencia_producto', 'producto.descripcion', 'producto.id as producto_id', 'producto.id_catalogo', 'orden_facturacion_detalle.precio'
                // 'factura.no_factura', 'factura.fecha', 'factura.fecha_vencimiento',
                // 'factura.itbis', 'factura.descuento', 'factura.nota'

            ])->where('orden_facturacion_id', '<>', NUll);
        return DataTables::of($existencias)
            ->addColumn('Customer ID', function ($factura) {
                $orden_facturacion = OrdenFacturacion::find($factura->orden_facturacion_id);
                $orden_empaque = ordenEmpaque::find($orden_facturacion->orden_empaque_id);
                $orden_pedido = OrdenPedido::find($orden_empaque->orden_pedido_id);
                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->codigo_cliente;
            })
            ->addColumn('Invoice/CM #', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)
                ->where('orden_facturacion_id', '<>', NUll)
                ->first();
                return $factura['no_factura'];
            })
            ->addColumn('Credit Memo', function ($orden) {
                return "False";
            })
            ->addColumn('Date', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)
                ->where('orden_facturacion_id', '<>', NUll)
                ->first();
                return date("d/m/20y", strtotime($factura['fecha']));
            })
            ->addColumn('Ship to Name', function ($factura) {
                $orden_facturacion = OrdenFacturacion::find($factura->orden_facturacion_id);
                $orden_empaque = ordenEmpaque::find($orden_facturacion->orden_empaque_id);
                $orden_pedido = OrdenPedido::find($orden_empaque->orden_pedido_id);
                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->nombre_cliente;
            })
            ->addColumn('Ship to Address-Line One', function ($factura) {
                $orden_facturacion = OrdenFacturacion::find($factura->orden_facturacion_id);
                $orden_empaque = ordenEmpaque::find($orden_facturacion->orden_empaque_id);
                $orden_pedido = OrdenPedido::find($orden_empaque->orden_pedido_id);
                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->calle;
            })
            ->addColumn('Ship to Address-Line Two', function ($factura) {
                $orden_facturacion = OrdenFacturacion::find($factura->orden_facturacion_id);
                $orden_empaque = ordenEmpaque::find($orden_facturacion->orden_empaque_id);
                $orden_pedido = OrdenPedido::find($orden_empaque->orden_pedido_id);
                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->sector;
            })
            ->addColumn('Ship to City', function ($factura) {
                $orden_facturacion = OrdenFacturacion::find($factura->orden_facturacion_id);
                $orden_empaque = ordenEmpaque::find($orden_facturacion->orden_empaque_id);
                $orden_pedido = OrdenPedido::find($orden_empaque->orden_pedido_id);
                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->provincia;
            })
            ->addColumn('Ship to Country', function ($factura) {


                return "REP. DOM.";
            })
            ->addColumn('Ship Via', function ($factura) {
                if($factura->por_transporte == 1){
                    return "T. BLANCO";
                }else{
                    return "CHOFER";
                }
            })
            ->addColumn('Date Due', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)
                ->where('orden_facturacion_id', '<>', NUll)
                ->first();
                return date("d/m/20y", strtotime($factura['fecha_vencimiento']));
            })
            ->addColumn('Sales Representative ID', function ($orden) {
                return "";
            })
            ->addColumn('Accounts Receivable Account', function ($orden) {
                return "11020-000";
            })
            ->addColumn('Sales Tax ID', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)
                ->where('orden_facturacion_id', '<>', NUll)
                ->first();

                if($factura['itbis'] == 0){
                    return "";
                }else{
                    return "ITBIS";
                }

            })
            ->addColumn('Invoice Note', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)
                ->where('orden_facturacion_id', '<>', NUll)
                ->first();

                return (isset($factura['nota']))? $factura['nota'] : "";
            })
            ->addColumn('Note Prints After Line Items', function ($orden) {

                return "FALSE";
            })
            ->addColumn('Number of Distributions', function ($orden) {
                $orden_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', $orden->orden_facturacion_id)->get();
                return count($orden_detalle);

            })
            ->addColumn('Invoice/CM Distribution', function ($orden) {
                return "pendiente";

            })
            ->addColumn('Quantity', function ($orden) {
                return $orden->total;

            })
            ->addColumn('Item ID', function ($orden) {
                return $orden->referencia_producto;

            })
            ->addColumn('Description', function ($orden) {
                return $orden->descripcion;

            })
            ->addColumn('G/L Account', function ($orden) {
                $catalogo_cuenta = CatalogoCuenta::find($orden->id_catalogo);

                return $catalogo_cuenta->codigo;

            })
            ->addColumn('Unit Price', function ($orden) {

                return str_replace('.00', '', $orden->precio);

            })
            ->addColumn('Tax Type', function ($orden) {
                return "1";
            })
            ->addColumn('UPC / SKU', function ($orden) {
                $sku = SKU::where('producto_id', $orden->producto_id)->get()
                ->first();
                return $sku['sku'];

            })
            ->addColumn('Amount', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)->get()
                ->first();
                if($factura['nc_uso'] == 1){
                    return $factura->total;
                }else{
                    return "-" .$factura['total'];
                }

            })
            ->addColumn('U/M ID', function ($orden) {
                return "UNIDAD";
            })
            ->addColumn('U/M No. of Stocking Units', function ($orden) {
                return "1";
            })
            ->addColumn('Sales Tax Agency ID', function ($orden) {
                $factura = Factura::where('orden_facturacion_id', $orden->orden_facturacion_id)->get()
                ->first();

                if($factura['itbis'] == 0){
                    return "";
                }else{
                    return "ITBIS";
                }

            })
            ->addColumn('Return Authorization', function ($orden) {
                return "";
            })

            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }
}


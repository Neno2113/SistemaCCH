<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Product;
use App\Talla;
use App\Perdida;
use App\TallasPerdidas;
use App\Almacen;
use App\Existencia;
use App\ordenPedidoDetalle;
use App\NotaCredito;
use App\NotaCreditoDetalle;
use App\Factura;
use App\OrdenFacturacion;
use App\ordenFacturacionDetalle;

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
        $almacen = Almacen::where('producto_id', $producto_id)->select('id')->get();

        $almacenes = array();

        $longitudAlmacen = count($almacen);

        for ($i=0; $i < $longitudAlmacen ; $i++) {
            array_push($almacenes, $almacen[$i]['id']);
        }

        $tallasAlmacen = Almacen::whereIn('id', $almacenes)->get();

        //Ordenes
        $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)
        // ->where('orden_empacada' , 'LIKE', '0')
        ->get()->load('ordenPedido');

        //nota de credito
        $tallasNC = NotaCreditoDetalle::where('producto_id', $producto_id)
        ->get()->load('notaCredito');

        //orden facturacion
        $tallasfacturacion = ordenFacturacionDetalle::where('producto_id', $producto_id)
        ->get();

        //Existencia
        $a = $tallasAlmacen->sum('a') - $tallasfacturacion->sum('a') + $tallasNC->sum('a') + $tallasSegundas->sum('a');
        $b = $tallasAlmacen->sum('b') - $tallasfacturacion->sum('b') + $tallasNC->sum('b') + $tallasSegundas->sum('a');
        $c = $tallasAlmacen->sum('c') - $tallasfacturacion->sum('c') + $tallasNC->sum('c') + $tallasSegundas->sum('a');
        $d = $tallasAlmacen->sum('d') - $tallasfacturacion->sum('d') + $tallasNC->sum('d') + $tallasSegundas->sum('a');
        $e = $tallasAlmacen->sum('e') - $tallasfacturacion->sum('e') + $tallasNC->sum('e') + $tallasSegundas->sum('a');
        $f = $tallasAlmacen->sum('f') - $tallasfacturacion->sum('f') + $tallasNC->sum('f') + $tallasSegundas->sum('a');
        $g = $tallasAlmacen->sum('g') - $tallasfacturacion->sum('g') + $tallasNC->sum('g') + $tallasSegundas->sum('a');
        $h = $tallasAlmacen->sum('h') - $tallasfacturacion->sum('h') + $tallasNC->sum('h') + $tallasSegundas->sum('a');
        $i = $tallasAlmacen->sum('i') - $tallasfacturacion->sum('i') + $tallasNC->sum('i') + $tallasSegundas->sum('a');
        $j = $tallasAlmacen->sum('j') - $tallasfacturacion->sum('j') + $tallasNC->sum('j') + $tallasSegundas->sum('a');
        $k = $tallasAlmacen->sum('k') - $tallasfacturacion->sum('k') + $tallasNC->sum('k') + $tallasSegundas->sum('a');
        $l = $tallasAlmacen->sum('l') - $tallasfacturacion->sum('l') + $tallasNC->sum('l') + $tallasSegundas->sum('a');
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
                ->where('referencia_producto', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}

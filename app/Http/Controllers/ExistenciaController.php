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
        ->where('orden_empacada' , 'LIKE', '0')
        ->get();

        //Ordenes
        $tallasNC = NotaCreditoDetalle::where('producto_id', $producto_id)
        ->get();

        

        //respuesta 
        $data = [
            'code' => 200,
            'status' => 'success',
            'a' => $tallas->sum('a'),
            'b' => $tallas->sum('b'),
            'c' => $tallas->sum('c'),
            'd' => $tallas->sum('d'),
            'e' => $tallas->sum('e'),
            'f' => $tallas->sum('f'),
            'g' => $tallas->sum('g'),
            'h' => $tallas->sum('h'),
            'i' => $tallas->sum('i'),
            'j' => $tallas->sum('j'),
            'k' => $tallas->sum('k'),
            'l' => $tallas->sum('l'),
            'tallas' => $tallas,
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
            'x_alm' => $tallasAlmacen->sum('talla_x'),
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

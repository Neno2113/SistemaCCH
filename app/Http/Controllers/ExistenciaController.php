<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Product;
use App\Talla;
use App\Perdida;
use App\TallasPerdidas;

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
            'x_seg' => $tallasSegundas->sum('talla_x')



        ];


        return \response()->json($data, $data['code']);
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

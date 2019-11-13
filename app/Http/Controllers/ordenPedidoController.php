<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Product;
use App\Talla;
use App\Perdida;
use App\TallasPerdidas;
use App\Almacen;
use App\Client;
use App\ClientBranch;

class ordenPedidoController extends Controller
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

        //respuesta 
        $data = [
            'code' => 200,
            'status' => 'success',
            'a' => $tallasAlmacen->sum('a') - $tallasPerdidas->sum('a') - $tallasSegundas->sum('a'),
            'b' => $tallasAlmacen->sum('b') - $tallasPerdidas->sum('b') - $tallasSegundas->sum('b'),
            'c' => $tallasAlmacen->sum('c') - $tallasPerdidas->sum('c') - $tallasSegundas->sum('c'),
            'd' => $tallasAlmacen->sum('d') - $tallasPerdidas->sum('d') - $tallasSegundas->sum('d'),
            'e' => $tallasAlmacen->sum('e') - $tallasPerdidas->sum('e') - $tallasSegundas->sum('e'),
            'f' => $tallasAlmacen->sum('f') - $tallasPerdidas->sum('f') - $tallasSegundas->sum('f'),
            'g' => $tallasAlmacen->sum('g') - $tallasPerdidas->sum('g') - $tallasSegundas->sum('g'),
            'h' => $tallasAlmacen->sum('h') - $tallasPerdidas->sum('h') - $tallasSegundas->sum('h'),
            'i' => $tallasAlmacen->sum('i') - $tallasPerdidas->sum('i') - $tallasSegundas->sum('i'),
            'j' => $tallasAlmacen->sum('j') - $tallasPerdidas->sum('j') - $tallasSegundas->sum('j'),
            'k' => $tallasAlmacen->sum('k') - $tallasPerdidas->sum('k') - $tallasSegundas->sum('k'),
            'l' => $tallasAlmacen->sum('l') - $tallasPerdidas->sum('l') - $tallasSegundas->sum('l'),

        ];


        return \response()->json($data, $data['code']);
    }

    public function selectProduct(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::join('producto', 'corte.producto_id', 'producto.id')
                ->select("producto.id", "producto.referencia_producto", "corte.fase")
                ->where('corte.fase', 'LIKE', "Almacen")
                ->where('producto.referencia_producto', 'LIKE', "%$search%")
                ->take(1)
                ->get();
               
                
        }
        return response()->json($data);
    }

    public function selectCliente(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Client::select("id", "nombre_cliente", "contacto_cliente_principal")
                // ->where('enviado_lavanderia', 'LIKE', '0')
                ->where('nombre_cliente', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectSucursal(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ClientBranch::select("id", "nombre_sucursal")
                // ->where('enviado_lavanderia', 'LIKE', '0')
                ->where('nombre_sucursal', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}

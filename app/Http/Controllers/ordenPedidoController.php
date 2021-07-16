<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Product;
use App\Talla;
use App\Perdida;
use App\TallasPerdidas;
use App\Almacen;
use App\AlmacenDetalle;
use App\Client;
use App\ClientBranch;
use App\ordenPedido;
use App\ordenPedidoDetalle;
use App\NotaCreditoDetalle;
use App\Empleado;
use App\ordenEmpaque;
use App\ordenEmpaqueDetalle;
use App\OrdenFacturacion;
use App\ordenFacturacionDetalle;
use App\Factura;
use App\FacturaDetalle;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ordenPedidoController extends Controller
{
    public function show(Request $request)
    {

        $a_ref2 = 0;
        $b_ref2 = 0;
        $c_ref2 = 0;
        $d_ref2 = 0;
        $e_ref2 = 0;
        $f_ref2 = 0;
        $g_ref2 = 0;
        $h_ref2 = 0;
        $i_ref2 = 0;
        $j_ref2 = 0;
        $k_ref2 = 0;
        $l_ref2 = 0;
        //Recoger datos por la request
        $producto_id = $request->input('producto_id');
        $referencia_producto = $request->input('referencia_producto');
        $segunda_input = $request->input('segunda');

        //buscar cortes con la misma referencia producto
        $corte = Corte::where('producto_id', $producto_id)->select('id', 'total')->get();

        $corte_proceso = Corte::where('producto_id', 'LIKE', $producto_id)
            ->where('fase', 'not like', 'almacen')->get()->load('producto');


        // if (\is_object($corte_proceso)) {
        //     $fecha_entrega = date("d-m-20y", strtotime($corte_proceso->fecha_entrega));
        // } else {
        //     $fecha_entrega = "";
        // }

        $cortes = array();

        $longitud = count($corte);


        for ($i = 0; $i < $longitud; $i++) {
            array_push($cortes, $corte[$i]['id']);
        }
        //buscar cantidades de tallas con el array de id de cortes
        $tallas = Talla::whereIn('corte_id', $cortes)->get()->load('corte');

        // if(){

        // }

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


        $ventas_segundas = ordenPedidoDetalle::where('producto_id', $producto_id)
        ->where('venta_segunda', '1')->get();

        //Almacen
        $tallasAlmacen = AlmacenDetalle::where('producto_id', $producto_id)->get();
        // print_r($tallasAlmacen);
        // die();

        //producto
        $producto = Product::find($producto_id);
        $genero = $producto->genero;
        // print_r($genero);
        // die();

        if ($genero == 3 || $genero == 4) {
            if (count($tallasAlmacen) <= 0) {
                $producto_f = Product::find($producto_id);
                $min = $producto_f->min;
                $max = $producto_f->max;
                $ref_father = $producto_f->referencia_father;
                $almacen = AlmacenDetalle::where('producto_id', $ref_father)
                ->select('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')
                ->get();
                $tallasOrdenes_f = ordenPedidoDetalle::where('referencia_father', $ref_father)->where('venta_segunda', '0')->get();
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
                $a_ref2 = $a_ref2 - $ventas_segundas->sum('a') - $tallasOrdenes_f->sum('a') + $tallasCredito_f->sum('a');
                $b_ref2 = $b_ref2 - $ventas_segundas->sum('b') - $tallasOrdenes_f->sum('b') + $tallasCredito_f->sum('b');
                $c_ref2 = $c_ref2 - $ventas_segundas->sum('c') - $tallasOrdenes_f->sum('c') + $tallasCredito_f->sum('c');
                $d_ref2 = $d_ref2 - $ventas_segundas->sum('d') - $tallasOrdenes_f->sum('d') + $tallasCredito_f->sum('d');
                $e_ref2 = $e_ref2 - $ventas_segundas->sum('e') - $tallasOrdenes_f->sum('e') + $tallasCredito_f->sum('e');
                $f_ref2 = $f_ref2 - $ventas_segundas->sum('f') - $tallasOrdenes_f->sum('f') + $tallasCredito_f->sum('f');
                $g_ref2 = $g_ref2 - $ventas_segundas->sum('g') - $tallasOrdenes_f->sum('g') + $tallasCredito_f->sum('g');
                $h_ref2 = $h_ref2 - $ventas_segundas->sum('h') - $tallasOrdenes_f->sum('h') + $tallasCredito_f->sum('h');
                $i_ref2 = $i_ref2 - $ventas_segundas->sum('i') - $tallasOrdenes_f->sum('i') + $tallasCredito_f->sum('i');
                $j_ref2 = $j_ref2 - $ventas_segundas->sum('j') - $tallasOrdenes_f->sum('j') + $tallasCredito_f->sum('j');
                $k_ref2 = $k_ref2 - $ventas_segundas->sum('k') - $tallasOrdenes_f->sum('k') + $tallasCredito_f->sum('k');
                $l_ref2 = $l_ref2 - $ventas_segundas->sum('l') - $tallasOrdenes_f->sum('l') + $tallasCredito_f->sum('l');

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
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'a' => $a_ref2,
                    'b' => $b_ref2,
                    'c' => $c_ref2,
                    'd' => $d_ref2,
                    'e' => $e_ref2,
                    'f' => $f_ref2,
                    'g' => $g_ref2,
                    'h' => $h_ref2,
                    'i' => $i_ref2,
                    'j' => $j_ref2,
                    'k' => $k_ref2,
                    'l' => $l_ref2,
                    'producto' => $producto,
                    'total_corte' => $total_real = $a_ref2 + $b_ref2 + $c_ref2 + $d_ref2 + $e_ref2 + $f_ref2 + $g_ref2 + $h_ref2 + $i_ref2 + $j_ref2 + $k_ref2 + $l_ref2,
                    'corte_proceso' => $corte_proceso,
                    'ordenes'=> $tallasOrdenes_f,
                    'Im here' => 'here'
                    // 'fecha_entrega' => $fecha_entrega
                ];
            }else{

                $producto_f = Product::find($producto_id);
                $min = $producto_f->min;
                $max = $producto_f->max;
                $ref_father = $producto_f->id;
                $almacen = AlmacenDetalle::where('producto_id', $ref_father)
                    ->select('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')
                    ->get();
                $tallasOrdenes_f = ordenPedidoDetalle::where('producto_id', $ref_father)->where('venta_segunda', '0')->get();
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
                $a_ref2 = $a_ref2 - $ventas_segundas->sum('a') - $tallasOrdenes_f->sum('a') + $tallasCredito_f->sum('a');
                $b_ref2 = $b_ref2 - $ventas_segundas->sum('b') - $tallasOrdenes_f->sum('b') + $tallasCredito_f->sum('b');
                $c_ref2 = $c_ref2 - $ventas_segundas->sum('c') - $tallasOrdenes_f->sum('c') + $tallasCredito_f->sum('c');
                $d_ref2 = $d_ref2 - $ventas_segundas->sum('d') - $tallasOrdenes_f->sum('d') + $tallasCredito_f->sum('d');
                $e_ref2 = $e_ref2 - $ventas_segundas->sum('e') - $tallasOrdenes_f->sum('e') + $tallasCredito_f->sum('e');
                $f_ref2 = $f_ref2 - $ventas_segundas->sum('f') - $tallasOrdenes_f->sum('f') + $tallasCredito_f->sum('f');
                $g_ref2 = $g_ref2 - $ventas_segundas->sum('g') - $tallasOrdenes_f->sum('g') + $tallasCredito_f->sum('g');
                $h_ref2 = $h_ref2 - $ventas_segundas->sum('h') - $tallasOrdenes_f->sum('h') + $tallasCredito_f->sum('h');
                $i_ref2 = $i_ref2 - $ventas_segundas->sum('i') - $tallasOrdenes_f->sum('i') + $tallasCredito_f->sum('i');
                $j_ref2 = $j_ref2 - $ventas_segundas->sum('j') - $tallasOrdenes_f->sum('j') + $tallasCredito_f->sum('j');
                $k_ref2 = $k_ref2 - $ventas_segundas->sum('k') - $tallasOrdenes_f->sum('k') + $tallasCredito_f->sum('k');
                $l_ref2 = $l_ref2 - $ventas_segundas->sum('l') - $tallasOrdenes_f->sum('l') + $tallasCredito_f->sum('l');
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
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'a' => $a_ref2,
                    'b' => $b_ref2,
                    'c' => $c_ref2,
                    'd' => $d_ref2,
                    'e' => $e_ref2,
                    'f' => $f_ref2,
                    'g' => $g_ref2,
                    'h' => $h_ref2,
                    'i' => $i_ref2,
                    'j' => $j_ref2,
                    'k' => $k_ref2,
                    'l' => $l_ref2,
                    'producto' => $producto,
                    'total_corte' => $total_real = $a_ref2 + $b_ref2 + $c_ref2 + $d_ref2 + $e_ref2 + $f_ref2 + $g_ref2 + $h_ref2 + $i_ref2 + $j_ref2 + $k_ref2 + $l_ref2,
                    'corte_proceso' => $corte_proceso,
                    'ordenes'=> $tallasOrdenes_f,
                    'Im here' => $tallasAlmacen
                    // 'fecha_entrega' => $fecha_entrega
                ];
            }

           

        }else{
            $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)->where('venta_segunda', '0')->get();

            //Notas De credito
            $tallasCredito = NotaCreditoDetalle::where('producto_id', $producto_id)->get();

            //calcular total real
            $a = $tallasAlmacen->sum('a') + $a_ref2 - $ventas_segundas->sum('a') - $tallasOrdenes->sum('a') + $tallasCredito->sum('a');
            $b = $tallasAlmacen->sum('b') + $b_ref2 - $ventas_segundas->sum('b') - $tallasOrdenes->sum('b') + $tallasCredito->sum('b');
            $c = $tallasAlmacen->sum('c') + $c_ref2 - $ventas_segundas->sum('c') - $tallasOrdenes->sum('c') + $tallasCredito->sum('c');
            $d = $tallasAlmacen->sum('d') + $d_ref2 - $ventas_segundas->sum('d') - $tallasOrdenes->sum('d') + $tallasCredito->sum('d');
            $e = $tallasAlmacen->sum('e') + $e_ref2 - $ventas_segundas->sum('e') - $tallasOrdenes->sum('e') + $tallasCredito->sum('e');
            $f = $tallasAlmacen->sum('f') + $f_ref2 - $ventas_segundas->sum('f') - $tallasOrdenes->sum('f') + $tallasCredito->sum('f');
            $g = $tallasAlmacen->sum('g') + $g_ref2 - $ventas_segundas->sum('g') - $tallasOrdenes->sum('g') + $tallasCredito->sum('g');
            $h = $tallasAlmacen->sum('h') + $h_ref2 - $ventas_segundas->sum('h') - $tallasOrdenes->sum('h') + $tallasCredito->sum('h');
            $i = $tallasAlmacen->sum('i') + $i_ref2 - $ventas_segundas->sum('i') - $tallasOrdenes->sum('i') + $tallasCredito->sum('i');
            $j = $tallasAlmacen->sum('j') + $j_ref2 - $ventas_segundas->sum('j') - $tallasOrdenes->sum('j') + $tallasCredito->sum('j');
            $k = $tallasAlmacen->sum('k') + $k_ref2 - $ventas_segundas->sum('k') - $tallasOrdenes->sum('k') + $tallasCredito->sum('k');
            $l = $tallasAlmacen->sum('l') + $l_ref2 - $ventas_segundas->sum('l') - $tallasOrdenes->sum('l') + $tallasCredito->sum('l');

            //Validacion de numeros negativos
            $a = ($a < 0 ? 0 : $a);
            $b = ($b < 0 ? 0 : $b);
            $c = ($c < 0 ? 0 : $c);
            $d = ($d < 0 ? 0 : $d);
            $e = ($e < 0 ? 0 : $e);
            $f = ($f < 0 ? 0 : $f);
            $g = ($g < 0 ? 0 : $g);
            $h = ($h < 0 ? 0 : $h);
            $i = ($i < 0 ? 0 : $i);
            $j = ($j < 0 ? 0 : $j);
            $k = ($k < 0 ? 0 : $k);
            $l = ($l < 0 ? 0 : $l);

            $cantidad_ordenadas = $tallasOrdenes->sum('cantidad');
            $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

            if (empty($segunda_input)) {
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
                    'producto' => $producto,
                    'total_corte' => ($total_real < 0) ? 0 : $total_real,
                    'corte_proceso' => $corte_proceso,
                    'cantidad_ordenadas' => $cantidad_ordenadas,
                  
                    // 'fecha_entrega' => $fecha_entrega
                ];
            } else {

                $ventas_segundas = ordenPedidoDetalle::where('producto_id', $producto_id)
                ->where('venta_segunda', '1')->get();

                $total_real = $tallasSegundas->sum('total') - $ventas_segundas->sum('total');
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'a' => ($tallasSegundas->sum('a') - $ventas_segundas->sum('a') < 0 ) ? 0 : $tallasSegundas->sum('a') - $ventas_segundas->sum('a'),
                    'b' => ($tallasSegundas->sum('b') - $ventas_segundas->sum('b') < 0 ) ? 0 : $tallasSegundas->sum('b') - $ventas_segundas->sum('b'),
                    'c' => ($tallasSegundas->sum('c') - $ventas_segundas->sum('c') < 0 ) ? 0 : $tallasSegundas->sum('c') - $ventas_segundas->sum('c'),
                    'd' => ($tallasSegundas->sum('d') - $ventas_segundas->sum('d') < 0 ) ? 0 : $tallasSegundas->sum('d') - $ventas_segundas->sum('d'),
                    'e' => ($tallasSegundas->sum('e') - $ventas_segundas->sum('e') < 0 ) ? 0 : $tallasSegundas->sum('e') - $ventas_segundas->sum('e'),
                    'f' => ($tallasSegundas->sum('f') - $ventas_segundas->sum('f') < 0 ) ? 0 : $tallasSegundas->sum('f') - $ventas_segundas->sum('f'),
                    'g' => ($tallasSegundas->sum('g') - $ventas_segundas->sum('g') < 0 ) ? 0 : $tallasSegundas->sum('g') - $ventas_segundas->sum('g'),
                    'h' => ($tallasSegundas->sum('h') - $ventas_segundas->sum('h') < 0 ) ? 0 : $tallasSegundas->sum('h') - $ventas_segundas->sum('h'),
                    'i' => ($tallasSegundas->sum('i') - $ventas_segundas->sum('i') < 0 ) ? 0 : $tallasSegundas->sum('i') - $ventas_segundas->sum('i'),
                    'j' => ($tallasSegundas->sum('j') - $ventas_segundas->sum('j') < 0 ) ? 0 : $tallasSegundas->sum('j') - $ventas_segundas->sum('k'),
                    'k' => ($tallasSegundas->sum('k') - $ventas_segundas->sum('k') < 0 ) ? 0 : $tallasSegundas->sum('k') - $ventas_segundas->sum('k'),
                    'l' => ($tallasSegundas->sum('l') - $ventas_segundas->sum('l') < 0 ) ? 0 : $tallasSegundas->sum('l') - $ventas_segundas->sum('l'),
                    'producto' => $producto,
                    'total_corte' => ($total_real < 0) ? 0 : $total_real,
                    'corte_proceso' => $corte_proceso,
                    'segunda' => 1
                ];
            }
        }



        return \response()->json($data, $data['code']);
    }

    public function consultaSustituto($id)
    {
        $almacen =  Almacen::find($id);

        if (is_object($almacen)) {
            $producto_id = $almacen->producto_id;

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

            //producto
            $producto = Product::find($producto_id);

            //Almacen

            $tallasAlmacen = AlmacenDetalle::where('producto_id', $producto_id)->get();

            $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)->get();

            //Notas De credito
            $tallasCredito = NotaCreditoDetalle::where('producto_id', $producto_id)->get();

            //calcular total real
            $a = $tallasAlmacen->sum('a') - $tallasSegundas->sum('a') - $tallasOrdenes->sum('a') + $tallasCredito->sum('a');
            $b = $tallasAlmacen->sum('b') - $tallasSegundas->sum('b') - $tallasOrdenes->sum('b') + $tallasCredito->sum('b');
            $c = $tallasAlmacen->sum('c') - $tallasSegundas->sum('c') - $tallasOrdenes->sum('c') + $tallasCredito->sum('c');
            $d = $tallasAlmacen->sum('d') - $tallasSegundas->sum('d') - $tallasOrdenes->sum('d') + $tallasCredito->sum('d');
            $e = $tallasAlmacen->sum('e') - $tallasSegundas->sum('e') - $tallasOrdenes->sum('e') + $tallasCredito->sum('e');
            $f = $tallasAlmacen->sum('f') - $tallasSegundas->sum('f') - $tallasOrdenes->sum('f') + $tallasCredito->sum('f');
            $g = $tallasAlmacen->sum('g') - $tallasSegundas->sum('g') - $tallasOrdenes->sum('g') + $tallasCredito->sum('g');
            $h = $tallasAlmacen->sum('h') - $tallasSegundas->sum('h') - $tallasOrdenes->sum('h') + $tallasCredito->sum('h');
            $i = $tallasAlmacen->sum('i') - $tallasSegundas->sum('i') - $tallasOrdenes->sum('i') + $tallasCredito->sum('i');
            $j = $tallasAlmacen->sum('j') - $tallasSegundas->sum('j') - $tallasOrdenes->sum('j') + $tallasCredito->sum('j');
            $k = $tallasAlmacen->sum('k') - $tallasSegundas->sum('k') - $tallasOrdenes->sum('k') + $tallasCredito->sum('k');
            $l = $tallasAlmacen->sum('l') - $tallasSegundas->sum('l') - $tallasOrdenes->sum('l') + $tallasCredito->sum('l');

            //Validacion de numeros negativos
            $a = ($a < 0 ? 0 : $a);
            $b = ($b < 0 ? 0 : $b);
            $c = ($c < 0 ? 0 : $c);
            $d = ($d < 0 ? 0 : $d);
            $e = ($e < 0 ? 0 : $e);
            $f = ($f < 0 ? 0 : $f);
            $g = ($g < 0 ? 0 : $g);
            $h = ($h < 0 ? 0 : $h);
            $i = ($i < 0 ? 0 : $i);
            $j = ($j < 0 ? 0 : $j);
            $k = ($k < 0 ? 0 : $k);
            $l = ($l < 0 ? 0 : $l);

            $cantidad_ordenadas = $tallasOrdenes->sum('cantidad');
            $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l - $cantidad_ordenadas;
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
                'producto' => $producto,
                'total_real' => $total_real,
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se encontro nada'
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function store(Request $request)
    {

        $validar = $request->validate([
            'cliente' => 'required',

            'generado_internamente' => 'required',
            'fecha_entrega' => 'required',
            'detallada' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $client_id = $request->input('cliente');
            $sucursal_id = $request->input('sucursal');
            $notas = $request->input('notas');
            $fecha_entrega = $request->input('fecha_entrega');
            $generado_internamente = $request->input('generado_internamente');
            $detallada = $request->input('detallada');
            $no_orden_pedido = $request->input('no_orden_pedido');
            $vendedor_id = $request->input('vendedor_id');

            $sec = $request->input('sec');

            $orden = new ordenPedido();

            $orden->cliente_id = $client_id;
            $orden->sucursal_id = $sucursal_id;
            $orden->vendedor_id = $vendedor_id;
            $orden->notas = $notas;
            $orden->fecha_entrega = $fecha_entrega;
            $orden->generado_internamente = $generado_internamente;
            $orden->detallada = $detallada;
            $orden->no_orden_pedido = $no_orden_pedido;
            $orden->corte_en_proceso = 'No';
            $orden->orden_proceso_impresa = 'No';
            $orden->status_orden_pedido = 'Stanby';

            $orden->sec = $sec + 0.01;
            $orden->fecha = date('Y/m/d h:i:s');
            $orden->user_id = \auth()->user()->id;
            $orden->user_aprobacion = \auth()->user()->id;


            $orden->save();


            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeOrdenProceso(Request $request)
    {
        $validar = $request->validate([
            'cliente_id' => 'required',
            // 'notas' => 'required',
            'generado_internamente' => 'required',
            'fecha_entrega' => 'required',
            'detallada' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $client_id = $request->input('cliente_id');
            $sucursal_id = $request->input('sucursal_id');
            $notas = $request->input('notas');
            $fecha_entrega = $request->input('fecha_entrega');
            $generado_internamente = $request->input('generado_internamente');
            $detallada = $request->input('detallada');
            $no_orden_pedido = $request->input('no_orden_pedido');


            $sec = $request->input('sec');


            $orden = new ordenPedido();

            $orden->cliente_id = $client_id;
            $orden->sucursal_id = $sucursal_id;
            $orden->notas = $notas;
            $orden->fecha_entrega = $fecha_entrega;
            $orden->generado_internamente = $generado_internamente;
            $orden->detallada = $detallada;
            $orden->no_orden_pedido = $no_orden_pedido;
            $orden->corte_en_proceso = 'Si';
            $orden->orden_proceso_impresa = 'No';
            $orden->status_orden_pedido = 'Corte Proceso';

            $orden->sec = $sec + 0.01;
            $orden->fecha = date('Y/m/d h:i:s');
            $orden->user_id = \auth()->user()->id;


            $orden->save();


            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetalle(Request $request)
    {
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
        $orden_id = $request->input('orden_id');
        $producto_id = $request->input('producto_id');
        $cantidad = $request->input('cantidad');
        $precio = $request->input('precio');
        $fecha_entrega = $request->input('fecha_entrega');
        $segunda_form = $request->input('segunda');
        $orden_redistribuida = $request->input('orden_detallada');
        $venta_segunda = $request->input('venta_segunda');
        // echo $segunda_input;
        // if(!empty($segunda_input)){
        //     echo "True";
        // }
        // die();

        //validaciones
        $a = intval(trim($a, "_"));
        $b = intval(trim($b, "_"));
        $c = intval(trim($c, "_"));
        $d = intval(trim($d, "_"));
        $e = intval(trim($e, "_"));
        $f = intval(trim($f, "_"));
        $g = intval(trim($g, "_"));
        $h = intval(trim($h, "_"));
        $i = intval(trim($i, "_"));
        $j = intval(trim($j, "_"));
        $k = intval(trim($k, "_"));
        $l = intval(trim($l, "_"));
        $cantidad = intval(trim($cantidad, "_"));
        //sacar next autogenerated ID
        $select = DB::select("SHOW TABLE STATUS LIKE 'orden_pedido'");
        $nextId = $select[0]->Auto_increment;

        if (!empty($segunda_form)) {
            //SEGUNDA
            $segunda_object = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
                ->where('producto_id', $producto_id)->select('id')->get();

            $segundas = array();

            $longitudSegunda = count($segunda_object);

            for ($m = 0; $m < $longitudSegunda; $m++) {
                array_push($segundas, $segunda_object[$m]['id']);
            }

            $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');

            $longitudOrden = count($tallasSegundas);

            for ($n = 0; $n < $longitudOrden; $n++) {
                $tallasSegundas[$n]->a = $tallasSegundas[$n]->a - $a;
                $tallasSegundas[$n]->b = $tallasSegundas[$n]->b - $b;
                $tallasSegundas[$n]->c = $tallasSegundas[$n]->c - $c;
                $tallasSegundas[$n]->d = $tallasSegundas[$n]->d - $d;
                $tallasSegundas[$n]->e = $tallasSegundas[$n]->e - $e;
                $tallasSegundas[$n]->f = $tallasSegundas[$n]->f - $f;
                $tallasSegundas[$n]->g = $tallasSegundas[$n]->g - $g;
                $tallasSegundas[$n]->h = $tallasSegundas[$n]->h - $h;
                $tallasSegundas[$n]->i = $tallasSegundas[$n]->i - $i;
                $tallasSegundas[$n]->j = $tallasSegundas[$n]->j - $j;
                $tallasSegundas[$n]->k = $tallasSegundas[$n]->k - $k;
                $tallasSegundas[$n]->l = $tallasSegundas[$n]->l - $l;
                // $tallasSegundas[$n]->total = $tallasSegundas[$i]->l - $l;
                $tallasSegundas[$n]->save();
            }
        }

        if (preg_match('/_/', $precio)) {
            $precio = trim($precio, "_,RD$");
        } else {
            $precio = trim($precio, "RD$");
            $precio = str_replace(',', '', $precio);
        }


        $orden_detalle = new ordenPedidoDetalle();

        if (!empty($fecha_entrega)) {



            //sacar next autogenerated ID
            $select = DB::select("SHOW TABLE STATUS LIKE 'orden_pedido'");
            $nextId = $select[0]->Auto_increment;

            $sec = $request->input('sec');

            $orden_proceso = OrdenPedido::where('fecha_entrega', $fecha_entrega)
                ->where('orden_pedido_father', $orden_id)->get()->first();

            if (is_object($orden_proceso)) {
                $orden_detalle->orden_pedido_id = $orden_proceso->id;
            } else {

                $numero_antiguo = DB::table('orden_pedido')->latest('updated_at')->first();

                if (empty($numero_antiguo) || $numero_antiguo == "") {
                    $sec = 0.00;
                } else {
                    $sec = $numero_antiguo->sec;
                }
                $orden = new ordenPedido();

                $orden->fecha_entrega = $fecha_entrega;
                $orden->orden_pedido_father = $orden_id;
                $next_sec = number_format($sec + 0.01, 2);
                $orden->no_orden_pedido = "OP-" . str_replace('.', '', $next_sec);
                $orden->corte_en_proceso = 'Si';
                $orden->orden_proceso_impresa = 'No';
                $orden->status_orden_pedido = 'Stanby';

                $orden->sec = number_format($sec + 0.01, 2);
                $orden->fecha = date('Y/m/d h:i:s');
                $orden->user_id = \auth()->user()->id;
                $orden->user_aprobacion = \auth()->user()->id;

                $orden->save();
                $orden_detalle->orden_pedido_id = $nextId;
            }
        } else {
            $orden_detalle->orden_pedido_id = $orden_id;
        }

        if(!$orden_redistribuida == 1){
            $orden_redistribuida = 0;
        }else{
            $orden_redistribuida = $orden_redistribuida;
        }


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
        $orden_detalle->fecha_entrega = $fecha_entrega;
        $orden_detalle->producto_id = $producto_id;
        $orden_detalle->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l + $cantidad;
        $orden_detalle->cantidad = $cantidad;
        $orden_detalle->cant_red = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l + $cantidad;
        $orden_detalle->precio = $precio;
        $orden_detalle->orden_redistribuida = $orden_redistribuida;
        $orden_detalle->orden_empacada = 0;
        $orden_detalle->venta_segunda = $venta_segunda;

        $producto = Product::find($producto_id);
        $ref_f = $producto->referencia_father;
        if(empty($ref_f)){
            $orden_detalle->referencia_father = $producto_id;
        }else{
            $orden_detalle->referencia_father = $ref_f;
        }

        $orden_detalle->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'detalle' => $orden_detalle

        ];


        return response()->json($data, $data['code']);
    }

    public function storeDetalleProceso(Request $request)
    {

        $producto_id = $request->input('producto_id');
        $orden_id = $request->input('orden_id');
        $cantidad = $request->input('cantidad');
        $precio = $request->input('precio');

        //sacar next autogenerated ID
        $select = DB::select("SHOW TABLE STATUS LIKE 'orden_pedido'");
        $nextId = $select[0]->Auto_increment;

        $orden_detalle = new ordenPedidoDetalle();

        if (preg_match('/_/', $precio)) {
            $precio = trim($precio, "_,RD$");
        } else {
            $precio = trim($precio, "RD$");
            $precio = str_replace(',', '', $precio);
        }

        $orden_detalle->orden_pedido_id = $orden_id;
        $orden_detalle->producto_id = $producto_id;
        $orden_detalle->total = $cantidad;
        $orden_detalle->cantidad = $cantidad;
        $orden_detalle->cant_red = $cantidad;
        $orden_detalle->precio = $precio;
        $orden_detalle->orden_redistribuida = 0;
        $orden_detalle->orden_empacada = 0;

        $orden_detalle->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'detalle' => $orden_detalle

        ];


        return response()->json($data, $data['code']);
    }

    public function selectProduct(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::join('producto', 'corte.producto_id', 'producto.id')
                ->select("producto.id", "producto.referencia_producto")
                ->where('producto.referencia_producto', 'LIKE', "%$search%")
                ->groupBy('producto.id', 'producto.referencia_producto')
                ->get();
        }
        return response()->json($data);
    }

    public function Productos()
    {

        $productos = Product::select("producto.id", "referencia_producto")
        ->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'productos' => $productos
        ];

        return response()->json($data, $data['code']);
    }

    // public function selectProducto(Request $request)
    // {
    //     $data = [];

    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = Product::select("id", "nombre_cliente", "contacto_cliente_principal")
    //             // ->where('enviado_lavanderia', 'LIKE', '0')
    //             ->where('nombre_cliente', 'LIKE', "%$search%")
    //             ->get();
    //     }
    //     return response()->json($data);
    // }

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

    public function selectSucu(Request $request)
    {
        $id = $request->input('cliente');
        $sucursal = ClientBranch::where('cliente_id', $id)
        ->orWhere('nombre_sucursal', 'LIKE', 'Principal')
        ->get();

       
        $data = [
            'code' => 200,
            'status' => 'success',
            'sucursal' => $sucursal
        ];
        return response()->json($data);
    }

    public function getDigits()
    {
        $orden = ordenPedido::orderBy('sec', 'desc')->first();

        if (\is_object($orden)) {
            $sec = $orden->sec;
        }

        if (empty($sec)) {
            $sec = 0.00;

            $data = [
                'code' => 200,
                'status' => 'success',
                'sec' => $sec
            ];
        } else {

            $data = [
                'code' => 200,
                'status' => 'success',
                'sec' => $sec
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function showOrden($id)
    {
        $orden = ordenPedidoDetalle::where('orden_pedido_id', $id)->get();

        if (is_object($orden)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'error'
            ];
        }

        return \response()->json($data, $data['code']);
    }

    public function ordenes()
    {
        $ordenes = DB::table('orden_pedido')->join('users', 'orden_pedido.user_id', 'users.id')
            ->join('empleado', 'orden_pedido.vendedor_id', 'empleado.id')
            ->join('cliente', 'orden_pedido.cliente_id', 'cliente.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', 'cliente_sucursales.id')
            ->select([
                'orden_pedido.id', 'empleado.nombre',
                'orden_pedido.no_orden_pedido', 'orden_pedido.fecha', 'orden_pedido.fecha_entrega',
                'orden_pedido.notas', 'orden_pedido.generado_internamente', 'orden_pedido.detallada',
                'users.name', 'cliente.nombre_cliente', 'cliente_sucursales.nombre_sucursal', 'orden_pedido.corte_en_proceso'
            ])->where('corte_en_proceso', 'LIKE', 'No');

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('total', function ($orden) {
                $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden->id)->get();

                return $ordenDetalle->sum('total');
            })
            ->editColumn('generado_internamente', function ($orden) {
                return ($orden->generado_internamente == 1 ? 'Si' : 'No');
            })
            ->editColumn('detallada', function ($orden) {
                return ($orden->detallada == 1 ? 'Si' : 'No');
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d-m-20y", strtotime($orden->fecha_entrega));
            })
            ->editColumn('fecha', function ($orden) {
                return date("h:i:s A d-m-20y", strtotime($orden->fecha));
            })
            ->addColumn('Opciones', function ($orden) {
                return '<button onclick="eliminar(' . $orden->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>' .
                    '<a href="imprimir_orden/conduce/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
            })
            // ->addColumn('Ver', function ($orden) {
            //     return '<button onclick="ver(' . $orden->id . ')" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></button>';
            // })
            ->rawColumns(['Opciones', 'Ver'])
            ->make(true);
    }

    public function imprimir($id)
    {
        //orden normal
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
            ->load('vendedor')
            ->load('sucursal')
            ->load('producto');

        //actualizar campo de impresion para pasar a la aprobacion
        $orden->orden_proceso_impresa = 'Si';
        $orden->save();


        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $productos_id = ordenPedidoDetalle::where('orden_pedido_id', $id)->select('producto_id')->get();

        $productos = array();

        $longitudProductos = count($productos_id);

        for ($i = 0; $i < $longitudProductos; $i++) {
            array_push($productos, $productos_id[$i]['producto_id']);
        }

        $productosOrdenes = Product::whereIn('id', $productos)->get();

        $orden->fecha = date("h:i:s A d-m-20y", strtotime($orden->fecha));
        $orden->fecha_entrega = date("d-m-20y", strtotime($orden->fecha_entrega));

        $a = $orden_detalle->sum('a');
        $b = $orden_detalle->sum('b');
        $c = $orden_detalle->sum('c');
        $d = $orden_detalle->sum('d');
        $e = $orden_detalle->sum('e');
        $f = $orden_detalle->sum('f');
        $g = $orden_detalle->sum('g');
        $h = $orden_detalle->sum('h');
        $i = $orden_detalle->sum('i');
        $j = $orden_detalle->sum('j');
        $k = $orden_detalle->sum('k');
        $l = $orden_detalle->sum('l');
        $cantidad = $orden_detalle->sum('cantidad');
        $total_detalle = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l + $cantidad;

        $detalles_totales = array();
        $totales_detalles = array();
        $precio_total = array();

        $longitudDetalles = count($orden_detalle);

        for ($i = 0; $i < $longitudDetalles; $i++) {
            array_push($detalles_totales, number_format(str_replace('.00', '', $orden_detalle[$i]['precio']) * $orden_detalle[$i]['total']));
            array_push($totales_detalles, $orden_detalle[$i]['total']);
            array_push($precio_total, $orden_detalle[$i]['precio']);
        }

        $total_sin_detalle = implode($precio_total);
        $total_sin_detalle = str_replace('.', '', $total_sin_detalle);

        $subtotal = array_sum(str_replace(',', '', $detalles_totales));
        $tax = 0.18 * $subtotal;
        $total = $subtotal + $tax;
        $cantidad = $orden_detalle->sum('cantidad');
        $precio_simple = str_replace('.', '', $precio_total);
        $total_simple = $cantidad * $total_sin_detalle;
        //fin orden normal


        //orden con corte que esta en proceso
        $ordenProceso = ordenPedido::where('corte_en_proceso', 'Si')
            ->where('orden_proceso_impresa', 'No')->get()->first();
        // if (!empty($ordenProceso)) {
        //     $corte_proceso = $ordenProceso->corte_en_proceso;
        //     $orden_proceso_id = $ordenProceso->id;

        //     $ordenProcesoDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden_proceso_id)->get()->load('producto');

        //     $ordenProceso->orden_proceso_impresa = 'Si';
        //     $ordenProceso->save();
        // } else {
        //     $corte_proceso = 'No';
        // }

        // if (empty($ordenProcesoDetalle)) {
        //     $ordenProcesoDetalle = "No";
        // }

        // // orden con corte que esta en proceso
        $ordenProceso = ordenPedido::where('corte_en_proceso', 'Si')
            ->where('orden_proceso_impresa', 'No')
            ->orderBy('fecha_entrega', 'asc')
            ->get();

        //Validar si existe algunas orden en proceso para imprimir
        $corte_proceso = (!$ordenProceso->count());

        $longitudOrden = count($ordenProceso);

        for ($i = 0; $i < $longitudOrden; $i++) {
            $ordenProceso[$i]->orden_proceso_impresa = 'Si';
            $ordenProceso[$i]->save();
        }

        $ordenesProcesoId = array();

        $longitudOrdenesProceso = count($ordenProceso);

        for ($i = 0; $i < $longitudOrdenesProceso; $i++) {
            array_push($ordenesProcesoId, $ordenProceso[$i]['id']);
        }

        $orden->fecha = date("d/m/20y", strtotime($orden->fecha));
        $orden->fecha_entrega = date("d/m/20y", strtotime($orden->fecha_entrega));

        $ordenesProcesoDetalle = ordenPedidoDetalle::whereIn('orden_pedido_id', $ordenesProcesoId)->get()->load('producto');

        $pdf = \PDF::loadView('sistema.ordenPedido.conduceOrden', \compact(
            'orden',
            'orden_detalle',
            'productosOrdenes',
            'total_detalle',
            'detalles_totales',
            'totales_detalles',
            'subtotal',
            'tax',
            'total',
            'cantidad',
            'total_simple',
            'ordenProceso',
            'corte_proceso',
            'longitudOrden',
            'ordenesProcesoDetalle'
        ))->setPaper('a4');
        return $pdf->download('conduceOrden.pdf');
        return View('sistema.ordenPedido.conduceOrden', \compact(
            'orden',
            'orden_detalle',
            'productosOrdenes',
            'total_detalle',
            'detalles_totales',
            'totales_detalles',
            'subtotal',
            'tax',
            'total',
            'cantidad',
            'total_simple',
            'ordenProceso',
            'corte_proceso',
            'ordenesProcesoDetalle'
        ));
    }

    public function verificar($id)
    {
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
            ->load('sucursal');

        if (!empty($orden)) {
            $productos_id = ordenPedidoDetalle::where('orden_pedido_id', $id)->select('producto_id')->get();

            $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

            $productos = array();

            $longitudProductos = count($productos_id);

            for ($i = 0; $i < $longitudProductos; $i++) {
                array_push($productos, $productos_id[$i]['producto_id']);
            }

            $productosOrdenes = Product::whereIn('id', $productos)->get();

            $a = $orden_detalle->sum('a');
            $b = $orden_detalle->sum('b');
            $c = $orden_detalle->sum('c');
            $d = $orden_detalle->sum('d');
            $e = $orden_detalle->sum('e');
            $f = $orden_detalle->sum('f');
            $g = $orden_detalle->sum('g');
            $h = $orden_detalle->sum('h');
            $i = $orden_detalle->sum('i');
            $j = $orden_detalle->sum('j');
            $k = $orden_detalle->sum('k');
            $l = $orden_detalle->sum('l');
            $cantidad = $orden_detalle->sum('cantidad');
            $total_detalle = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l + $cantidad;

            $detalles_totales = array();
            $totales_detalles = array();
            $precio_total = array();

            $longitudDetalles = count($orden_detalle);


            for ($i = 0; $i < $longitudDetalles; $i++) {
                array_push($detalles_totales, number_format(str_replace('.', '', $orden_detalle[$i]['precio']) * $orden_detalle[$i]['total']));
                array_push($totales_detalles, $orden_detalle[$i]['total']);
                array_push($precio_total, $orden_detalle[$i]['precio']);
            }

            $total = implode($precio_total);
            $total = str_replace('.', '', $total);
        }


        // orden con corte que esta en proceso
        $ordenProceso = ordenPedido::where('corte_en_proceso', 'Si')
            ->where('orden_proceso_impresa', 'No')
            ->orderBy('fecha_entrega')
            ->get();

        $corte_proceso = (!$ordenProceso->count());

        $longitudOrden = count($ordenProceso);

        for ($i = 0; $i < $longitudOrden; $i++) {
            $ordenProceso[$i]->orden_proceso_impresa = 'Si';
            $ordenProceso[$i]->save();
        }

        $ordenesProcesoId = array();

        $longitudOrdenesProceso = count($ordenProceso);

        for ($i = 0; $i < $longitudOrdenesProceso; $i++) {
            array_push($ordenesProcesoId, $ordenProceso[$i]['id']);
        }

        $ordenesProcesoDetalle = ordenPedidoDetalle::whereIn('orden_pedido_id', $ordenesProcesoId)->get()->load('producto');

        // $ordenProcesoDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden_proceso_id)->get()->load('producto');

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden,
            'detalle' => $orden_detalle,
            'producto' => $productosOrdenes,
            'total_detalle' => $total_detalle,
            'precios_totales' => $detalles_totales,
            'totales_detalle' => $totales_detalles,
            'subtotal' => array_sum(str_replace(',', '', $detalles_totales)),
            'cantidad' => getType($cantidad),
            'ordenProceso' => $ordenProceso,
            'ordenesProcesoDetalle' => $ordenesProcesoDetalle,
            'corte_proceso' => $corte_proceso
            // 'ordenProcesoDetalle' => $ordenProcesoDetalle
        ];

        return \response()->json($data, $data['code']);
    }

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Ordenes pedido')
        ->first();
        if(Auth::user()->role != 'Administrador'){
            if($user_login->eliminar == 0 || $user_login->eliminar == null){
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
    
        }
  
          // return response()->json($data, $data['code']);
      }


    public function destroy($id)
    {
        $orden = ordenPedido::find($id);
        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id);

        if (!empty($orden)) {
            $orden_proceso = ordenPedido::where('orden_pedido_father', $orden->id);
            if(!empty($orden_proceso)){
                $orden_proceso->delete();
            }

         

            $orden_empaque = ordenEmpaque::where('orden_pedido_id', $id)->first();

            
            
            if(is_object($orden_empaque)){
                
                $empaque_detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $orden_empaque->id)->get();
                
                //Orden facturacion
                $orden_facturacion = OrdenFacturacion::where('orden_empaque_id', $orden_empaque->id)->first();
                if(!empty($orden_facturacion)){
                    // $ordenes_id = [];

                    // for ($i = 0; $i < count($orden_facturacion); $i++) {
                    //     array_push($ordenes_id, $orden_facturacion[$i]['id']);
                    // }
            

                    $facturacion_detalle = OrdenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion->id)->get();

                    //Factura
                    $factura = Factura::where('orden_facturacion_id', $orden_facturacion->id)->first();

                    if(!empty($factura)){
                        $factura_detalle = FacturaDetalle::where('factura_id', $factura->id)->get();

                        for ($i = 0; $i < count($factura_detalle); $i++) {
                            $factura_detalle[$i]->delete();
                        }
                
                        // $factura_detalle->delete();
                        $factura->delete();
                    }
                    for ($i = 0; $i < count($facturacion_detalle); $i++) {
                        $facturacion_detalle[$i]->delete();
                    }
                    // $facturacion_detalle->delete();
                    $orden_facturacion->delete();

                }
                for ($i = 0; $i < count($empaque_detalle); $i++) {
                    $empaque_detalle[$i]->delete();
                }
                // $empaque_detalle->delete();
                $orden_empaque->delete();
                

            }
            
            $orden_detalle->delete();
            $orden->delete();





            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden,
                // 'empaque_detalle' => $empaque_detalle
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrio un error durante esta operacion'
            ];
        }
        return response()->json($data, $data['code']);
    }


    public function ordenesAprobacion()
    {
        $ordenes = DB::table('orden_pedido')->join('users', 'orden_pedido.user_aprobacion', 'users.id')
            ->join('cliente', 'orden_pedido.cliente_id', 'cliente.id')
            ->join('empleado', 'orden_pedido.vendedor_id', 'empleado.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', 'cliente_sucursales.id')
            ->select([
                'orden_pedido.id', 'orden_pedido.fecha_aprobacion',
                'orden_pedido.no_orden_pedido', 'orden_pedido.fecha', 'orden_pedido.fecha_entrega',
                'orden_pedido.notas', 'orden_pedido.generado_internamente', 'orden_pedido.detallada',
                'cliente.nombre_cliente', 'cliente_sucursales.nombre_sucursal', 'orden_pedido.corte_en_proceso',
                'orden_pedido.status_orden_pedido', 'orden_pedido.orden_proceso_impresa', 'empleado.nombre', 'empleado.apellido'
            ])->where('orden_proceso_impresa', 'LIKE', 'Si');

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('total', function ($orden) {
                $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden->id)->get();

                return $ordenDetalle->sum('total');
            })
            ->editColumn('generado_internamente', function ($orden) {
                return ($orden->generado_internamente == 1 ? 'Si' : 'No');
            })
            ->editColumn('detallada', function ($orden) {
                return ($orden->detallada == 1 ? 'Si' : 'No');
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d-m-20y", strtotime($orden->fecha_entrega));
            })
            ->editColumn('fecha', function ($orden) {
                return date("h:i:s  d-m", strtotime($orden->fecha));
            })
            ->editColumn('fecha_aprobacion', function ($orden) {
                return date("h:i d-m", strtotime($orden->fecha_aprobacion));
            })
            ->editColumn('status_orden_pedido', function ($orden) {
                if ($orden->status_orden_pedido == 'Vigente') {
                    return '<span class="badge badge-pill badge-success">Vigente</span>';
                } else if ($orden->status_orden_pedido == 'Cancelado') {
                    return '<span class="badge badge-pill badge-danger">Cancelada</span>';
                } else if ($orden->status_orden_pedido == 'Stanby') {
                    return '<span class="badge badge-pill badge-secondary">Stanby</span>';
                } else if ($orden->status_orden_pedido == 'Despachado') {
                    return '<span class="badge badge-pill badge-info">Despachado</span>';
                } else if ($orden->status_orden_pedido == 'Facturado') {
                    return '<span class="badge badge-pill badge-dark">Facturado</span>';
                }
            })
            ->addColumn('Opciones', function ($orden) {
                if ($orden->status_orden_pedido == 'Vigente') {
                    return  '<button onclick="cancelar(' . $orden->id . ')" class="btn btn-danger btn-sm mr-1"><i class="fas fa-window-close fa-sm"></i></button>' .
                        '<button onclick="ver(' . $orden->id . ')" class="btn btn-warning btn-sm ml-1"><i class="fas fa-random fa-sm"></i></button>';
                } else if ($orden->status_orden_pedido == 'Stanby') {
                    return '<button onclick="aprobar(' . $orden->id . ')" class="btn btn-outline-dark  btn-sm" id="btn-status"> <i class="far fa-square"></i></button>';
                } else if ($orden->status_orden_pedido == 'Cancelado') {
                    return '<button onclick="aprobar(' . $orden->id . ')" class="btn btn-outline-dark  btn-sm  ml-1" id="btn-status"> <i class="far fa-square"></i></button>';
                } else {
                    return '<span class="badge badge-pill badge-info">Facturado</span>';
                }
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function verRedistribuir($id, Request $request)
    {
        $orden = ordenPedido::find($id)->load('user')->load('cliente')->load('sucursal')->load('vendedor');

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $ids = [];
        $longitudOrden = count($orden_detalle);

        for ($i = 0; $i < $longitudOrden; $i++) {
            array_push($ids, $orden_detalle[$i]['id']);
        }
        if (is_object($orden)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden,
                'detalle' => $orden_detalle
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkAprob(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Aprobar y redistribuir')
        ->first();
        if(Auth::user()->role != 'Administrador'){
            if($user_login->eliminar == 0 || $user_login->eliminar == null){
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
    
        }
  
          // return response()->json($data, $data['code']);
      }

    public function aprobar($id)
    {

        $orden = ordenPedido::find($id);

        $orden->status_orden_pedido = 'Vigente';
        $orden->fecha_aprobacion =  date('Y/m/d h:i:s');
        $orden->user_aprobacion = \auth()->user()->id;
        $orden->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden
        ];

        return \response()->json($data, $data['code']);
    }

    public function cancelar($id)
    {

        $orden = ordenPedido::find($id);

        $orden->status_orden_pedido = 'Cancelado';
        $orden->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden
        ];

        return \response()->json($data, $data['code']);
    }


    public function ordenesRedistribucion()
    {
        $ordenes = DB::table('orden_pedido_detalle')->join('producto', 'orden_pedido_detalle.producto_id', 'producto.id')
            ->join('orden_pedido', 'orden_pedido_detalle.orden_pedido_id', 'orden_pedido.id')
            ->select([
                'orden_pedido_detalle.id', 'orden_pedido_detalle.a', 'orden_pedido_detalle.b',
                'orden_pedido_detalle.c', 'orden_pedido_detalle.d', 'orden_pedido_detalle.e',
                'orden_pedido_detalle.f', 'orden_pedido_detalle.g', 'orden_pedido_detalle.h',
                'orden_pedido_detalle.i', 'orden_pedido_detalle.j', 'orden_pedido_detalle.k',
                'orden_pedido_detalle.orden_redistribuida', 'orden_pedido_detalle.l',
                'orden_pedido_detalle.l', 'orden_pedido_detalle.total', 'orden_pedido_detalle.total',
                'producto.referencia_producto', 'orden_pedido.no_orden_pedido', 'orden_pedido.detallada',
                'orden_pedido_detalle.precio',  'orden_pedido_detalle.orden_pedido_id', 'orden_pedido.status_orden_pedido'
            ])->where('corte_en_proceso', 'No');
        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('Opciones', function ($orden) {
                $id = $orden->orden_pedido_id;

                $orden_pedido = ordenPedido::find($id);

                $client_id = $orden_pedido->cliente_id;
                $cliente = Client::find($client_id);

                $redistribucion_tallas = $cliente->redistribucion_tallas;

                if ($redistribucion_tallas == '1' && $orden->orden_redistribuida == 0) {
                    return  '<a onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1" id="btn-status"> <i class="fas fa-random"></i></a>';
                } else if ($redistribucion_tallas == '0'  && $orden->orden_redistribuida == 0) {
                    return  '<a onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1" id="btn-status"> <i class="fas fa-random"></i></a>';
                } else if ($redistribucion_tallas == '1' && $orden->orden_redistribuida == 0) {
                    return  '<a onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1" id="btn-status"> <i class="fas fa-random"></i></a>' .
                        '<span class="badge badge-success ml-2">Redistribuido</span>';
                } else {
                    return '<span class="badge badge-success">Redistribuido</span>';
                }
            })
            ->addColumn('client', function ($orden) {
                $id = $orden->orden_pedido_id;

                $orden_pedido = ordenPedido::find($id);

                $client_id = $orden_pedido->cliente_id;
                $cliente = Client::find($client_id);

                return $cliente->nombre_cliente;
            })
            ->addColumn('sucursal', function ($orden) {
                $id = $orden->orden_pedido_id;

                $orden_pedido = ordenPedido::find($id);

                $sucursal_id = $orden_pedido->sucursal_id;
                $sucursal = ClientBranch::find($sucursal_id);

                return $sucursal->nombre_sucursal;
            })
            ->editColumn('status_orden_pedido', function ($orden) {
                if ($orden->status_orden_pedido == 'Vigente') {
                    return '<span class="badge badge-pill badge-success">Vigente</span>';
                } else if ($orden->status_orden_pedido == 'Cancelado') {
                    return '<span class="badge badge-pill badge-danger">Cancelada</span>';
                } else if ($orden->status_orden_pedido == 'Stanby') {
                    return '<span class="badge badge-pill badge-secondary">Stanby</span>';
                } else if ($orden->status_orden_pedido == 'Despachado') {
                    return '<span class="badge badge-pill badge-info">Despachado</span>';
                }
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function ordenesProceso()
    {
        $ordenes = DB::table('orden_pedido')
            ->select([
                'orden_pedido.id', 'orden_pedido.orden_pedido_father',
                'orden_pedido.no_orden_pedido', 'orden_pedido.fecha_entrega', 'orden_pedido.notas', 'orden_pedido.generado_internamente', 'orden_pedido.corte_en_proceso',
                'orden_pedido.status_orden_pedido', 'orden_pedido.orden_proceso_impresa'
            ])->where('corte_en_proceso', 'LIKE', 'Si');

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('cliente', function ($orden) {
                $orden_pedido = OrdenPedido::where('id', $orden->orden_pedido_father)->get()->first();

                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->nombre_cliente;
            })
            ->addColumn('sucursal', function ($orden) {
                $orden_pedido = OrdenPedido::where('id', $orden->orden_pedido_father)->get()->first();

                $sucursal = ClientBranch::find($orden_pedido->sucursal_id);

                return $sucursal->nombre_sucursal;
            })
            ->addColumn('referencia', function ($orden) {
                $orden_detalle = OrdenPedidoDetalle::where('orden_pedido_id', $orden->id)->get()->first()->load('producto');

                return $orden_detalle->producto->referencia_producto;
            })
            ->addColumn('total', function ($orden) {
                $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden->id)->get();

                return $ordenDetalle->sum('total');
            })
            ->editColumn('generado_internamente', function ($orden) {
                return ($orden->generado_internamente == 1 ? 'Si' : 'No');
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d/m/20y", strtotime($orden->fecha_entrega));
            })
            ->editColumn('status_orden_pedido', function ($orden) {
                if ($orden->status_orden_pedido == 'Vigente') {
                    return '<span class="badge badge-pill badge-success">Vigente</span>';
                } else if ($orden->status_orden_pedido == 'Cancelado') {
                    return '<span class="badge badge-pill badge-danger">Cancelada</span>';
                } else if ($orden->status_orden_pedido == 'Stanby') {
                    return '<span class="badge badge-pill badge-secondary">Stanby</span>';
                } else if ($orden->status_orden_pedido == 'Despachado') {
                    return '<span class="badge badge-pill badge-info">Despachado</span>';
                } else if ($orden->status_orden_pedido == 'Corte Proceso') {
                    return '<span class="badge badge-pill badge-warning">Corte Proceso</span>';
                }
            })
            ->addColumn('Opciones', function ($orden) {
                return '<button onclick="eliminar(' . $orden->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function listarOrden($id)
    {
        $ordenes = DB::table('orden_pedido_detalle')->join('producto', 'orden_pedido_detalle.producto_id', 'producto.id')
            ->select([
                'orden_pedido_detalle.id', 'orden_pedido_detalle.a', 'orden_pedido_detalle.b',
                'orden_pedido_detalle.c', 'orden_pedido_detalle.d', 'orden_pedido_detalle.e',
                'orden_pedido_detalle.f', 'orden_pedido_detalle.g', 'orden_pedido_detalle.h',
                'orden_pedido_detalle.i', 'orden_pedido_detalle.j', 'orden_pedido_detalle.k',
                'producto.referencia_producto', 'orden_pedido_detalle.l',
                'orden_pedido_detalle.l', 'orden_pedido_detalle.total'
            ])->where('orden_pedido_id', $id);
        return DataTables::of($ordenes)
            ->make(true);
    }

    public function mostrar($id)
    {

        $orden = ordenPedido::find($id)->load('user')
            ->load('cliente')
            ->load('sucursal');

        if (is_object($orden)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function home_orden()
    {
        $orden = ordenPedido::where('status_orden_pedido', 'LIKE', 'Stanby')
        ->orWhere('status_orden_pedido', 'LIKE', 'Vigente')
        ->where('corte_en_proceso', 'LIKE', 'No')
        ->count();

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden
        ];

        return response()->json($data, $data['code']);
    }

    public function validar(Request $request)
    {
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
        $orden = $request->input('orden_id');
        $producto = $request->input('producto_id');

        //validaciones
        $a = intval(trim($a, "_"));
        $b = intval(trim($b, "_"));
        $c = intval(trim($c, "_"));
        $d = intval(trim($d, "_"));
        $e = intval(trim($e, "_"));
        $f = intval(trim($f, "_"));
        $g = intval(trim($g, "_"));
        $h = intval(trim($h, "_"));
        $i = intval(trim($i, "_"));
        $j = intval(trim($j, "_"));
        $k = intval(trim($k, "_"));
        $l = intval(trim($l, "_"));
        $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

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
            'producto' => $producto
        ];

        return response()->json($data, $data['code']);
    }

    public function clienteSegunda(Request $request)
    {

        $cliente_id = $request->input('cliente_id');

        $cliente = Client::find($cliente_id);

        if (is_object($cliente)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'cliente_segundas' => $cliente->acepta_segundas
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'messages' => 'Ocurrio un error'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function vendedores()
    {
        $vendedor = Empleado::where('departamento', 'LIKE', 'VENTA')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'vendedores' => $vendedor
        ];

        return response()->json($data, $data['code']);
    }

    public function listarOrdenRed($id)
    {
        $ordenes = DB::table('orden_pedido_detalle')->join('producto', 'orden_pedido_detalle.producto_id', 'producto.id')
            ->select([
                'orden_pedido_detalle.id', 'orden_pedido_detalle.a', 'orden_pedido_detalle.b', 'orden_pedido_detalle.orden_ajustada',
                'orden_pedido_detalle.c', 'orden_pedido_detalle.d', 'orden_pedido_detalle.e', 'orden_pedido_detalle.cantidad',
                'orden_pedido_detalle.f', 'orden_pedido_detalle.g', 'orden_pedido_detalle.h', 'orden_pedido_detalle.cant_red',
                'orden_pedido_detalle.i', 'orden_pedido_detalle.j', 'orden_pedido_detalle.k',
                'producto.referencia_producto', 'orden_pedido_detalle.l', 'orden_pedido_detalle.orden_pedido_id',
                'orden_pedido_detalle.l', 'orden_pedido_detalle.total', 'orden_pedido_detalle.orden_redistribuida'
            ])->where('orden_pedido_id', $id);
        return DataTables::of($ordenes)
            // ->editColumn('a', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="a' . $orden->id . '" name="a" class="form-control red" value=' . $orden->a . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->a <= 0) {
            //         return '<input type="text" id="a' . $orden->id . '" name="a" class="form-control  red" readonly value=' . $orden->a . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1 || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="a' . $orden->id . '" name="a" class="form-control  red" readonly value=' . $orden->a . '>';
            //     } else {
            //         return '<input type="number"  id="a' . $orden->id . '" name="a"  class="form-control red" value=' . $orden->a . '>';
            //     }
            // })
            // ->editColumn('b', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="b' . $orden->id . '" name="b" class="form-control red" value=' . $orden->b . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->b <= 0) {
            //         return '<input type="text" id="b' . $orden->id . '" name="b"  class="form-control  red" readonly value=' . $orden->b . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="b' . $orden->id . '" name="b" class="form-control  red" readonly value=' . $orden->b . '>';
            //     } else {
            //         return '<input type="number" id="b' . $orden->id . '" name="b" class="form-control red" value=' . $orden->b . '>';
            //     }
            // })
            // ->editColumn('c', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="c' . $orden->id . '" name="c" data-inputmask=' . "mask" . ":" . "9[99]" . ' data-mask class="form-control red"  value=' . $orden->c . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->c <= 0) {
            //         return '<input type="text" id="c' . $orden->id . '" name="c"  class="form-control font-weight-bold red" readonly value=' . $orden->c . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="c' . $orden->id . '" name="c"  class="form-control font-weight-bold red" readonly value=' . $orden->c . '>';
            //     } else {
            //         return '<input type="number" id="c' . $orden->id . '" name="c" data-inputmask=' . "mask" . ":" . "9[99]" . ' data-mask  class="form-control red" value=' . $orden->c . '>';
            //     }
            // })
            // ->editColumn('d', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="d' . $orden->id . '" name="d" class="form-control red" value=' . $orden->d . '>';;
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->d <= 0) {
            //         return '<input type="text" id="d' . $orden->id . '" name="d" class="form-control font-weight-bold  red" readonly value=' . $orden->d . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="d' . $orden->id . '" name="d" class="form-control font-weight-bold red" readonly value=' . $orden->d . '>';
            //     } else {
            //         return '<input type="number" id="d' . $orden->id . '" name="d" class="form-control red" value=' . $orden->d . '>';
            //     }
            // })
            // ->editColumn('e', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="e' . $orden->id . '" name="e"  class="form-control red" value=' . $orden->e . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->e <= 0) {
            //         return '<input type="text" id="e' . $orden->id . '" name="e" class="form-control font-weight-bold red" readonly value=' . $orden->e . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="e' . $orden->id . '" name="e" class="form-control font-weight-bold red" readonly value=' . $orden->e . '>';
            //     } else {
            //         return '<input type="number" id="e' . $orden->id . '" name="e" class="form-control red" value=' . $orden->e . '>';
            //     }
            // })
            // ->editColumn('f', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="f' . $orden->id . '" name="f" class="form-control red" value=' . $orden->f . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->f <= 0) {
            //         return '<input type="text" id="f' . $orden->id . '" name="f" class="form-control font-weight-bold red" readonly value=' . $orden->f . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="f' . $orden->id . '" name="f" class="form-control font-weight-bold red" readonly value=' . $orden->f . '>';
            //     } else {
            //         return '<input type="number" id="f' . $orden->id . '" name="f" class="form-control red" value=' . $orden->f . '>';
            //     }
            // })
            // ->editColumn('g', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="g' . $orden->id . '" name="g" class="form-control red" value=' . $orden->g . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->g <= 0) {
            //         return '<input type="text" id="g' . $orden->id . '" name="g" class="form-control font-weight-bold red" readonly value=' . $orden->g . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="g' . $orden->id . '" name="g" class="form-control font-weight-bold red" readonly value=' . $orden->g . '>';
            //     } else {
            //         return '<input type="number" id="g' . $orden->id . '" name="g" class="form-control red" value=' . $orden->g . '>';
            //     }
            // })
            // ->editColumn('h', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="h' . $orden->id . '" name="h" class="form-control red" value=' . $orden->h . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->h <= 0) {
            //         return '<input type="text" id="h' . $orden->id . '" name="h" class="form-control font-weight-bold red" readonly value=' . $orden->h . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="h' . $orden->id . '" name="h" class="form-control font-weight-bold red" readonly value=' . $orden->h . '>';
            //     } else {
            //         return '<input type="number" id="h' . $orden->id . '" name="h" class="form-control red" value=' . $orden->h . '>';
            //     }
            // })
            // ->editColumn('i', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="i' . $orden->id . '" name="i" class="form-control red" value=' . $orden->i . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->i <= 0) {
            //         return '<input type="text" id="i' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->i . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="i' . $orden->id . '" name="i" class="form-control font-weight-bold red" readonly value=' . $orden->i . '>';
            //     } else {
            //         return '<input type="number" id="i' . $orden->id . '" name="i" class="form-control red" value=' . $orden->i . '>';
            //     }
            // })
            // ->editColumn('j', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="j' . $orden->id . '" name="j" class="form-control red" value=' . $orden->j . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->j <= 0) {
            //         return '<input type="text" id="j' . $orden->id . '" name="j" class="form-control font-weight-bold red" readonly value=' . $orden->j . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="j' . $orden->id . '" name="j" class="form-control font-weight-bold red" readonly value=' . $orden->j . '>';
            //     } else {
            //         return '<input type="number" id="j' . $orden->id . '" name="j" class="form-control red" value=' . $orden->j . '>';
            //     }
            // })
            // ->editColumn('k', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="k' . $orden->id . '" name="k" class="form-control red" value=' . $orden->k . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->k <= 0) {
            //         return '<input type="text" id="k' . $orden->id . '" name="k" class="form-control font-weight-bold red" readonly value=' . $orden->k . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="k' . $orden->id . '" name="k" class="form-control font-weight-bold red" readonly value=' . $orden->k . '>';
            //     } else {
            //         return '<input type="number" id="k' . $orden->id . '" name="k" class="form-control red" value=' . $orden->k . '>';
            //     }
            // })
            // ->editColumn('l', function ($orden) {
            //     if ($orden->orden_redistribuida == 0 && $orden->orden_ajustada == 0) {
            //         return '<input type="number" id="l' . $orden->id . '" name="l" class="form-control red" value=' . $orden->l . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 0 && $orden->l <= 0) {
            //         return '<input type="text" id="l' . $orden->id . '" name="l" class="form-control font-weight-bold red" readonly value=' . $orden->l . '>';
            //     } else if ($orden->orden_redistribuida == 1 && $orden->orden_ajustada == 1  || $orden->orden_redistribuida == 0 && $orden->orden_ajustada == 1) {
            //         return '<input type="text" id="l' . $orden->id . '" name="l" class="form-control font-weight-bold red" readonly value=' . $orden->l . '>';
            //     } else {
            //         return '<input type="number" id="l' . $orden->id . '" name="l" class="form-control red" value=' . $orden->l . '>';
            //     }
            // })
            // ->editColumn('total', function ($orden) {
            //     return '<input type="text" id="red' . $orden->id . '" readonly class="form-control font-weight-bold  red" value=' . $orden->total . '>';
            // })
            // ->editColumn('cant_red', function ($orden) {
            //     return '<input type="text" id="total' . $orden->id . '" readonly  class="form-control font-weight-bold text-success red"  value=' . $orden->cantidad . '>';
            // })
            // // ->editColumn('referencia_producto', function ($orden) {
            // //     return '<input type="number" id="ref"  class="form-control" value='.$orden->referencia_producto.'>';
            // // })
            // ->addColumn('Opciones', function ($orden) {
            //     $id = $orden->orden_pedido_id;

            //     $orden_pedido = ordenPedido::find($id);

            //     $client_id = $orden_pedido->cliente_id;
            //     $cliente = Client::find($client_id);

            //     $redistribucion_tallas = $cliente->redistribucion_tallas;

            //     if ($redistribucion_tallas == '1' && $orden->orden_redistribuida == 0) {
            //         return  '<a onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm text-white" ml-1" id="btn-status"> <i class="fas fa-random"></i></a>';
            //     } else if ($redistribucion_tallas == '0'  && $orden->orden_redistribuida == 0) {
            //         return  '<a onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm text-white" ml-1" id="btn-status"> <i class="fas fa-random"></i></a>';
            //     } else if ($redistribucion_tallas == '1' && $orden->orden_redistribuida == 0) {
            //         return  '<a onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm text-white" ml-1" id="btn-status"> <i class="fas fa-random"></i></a>' .
            //             '<span class="badge badge-success ml-2">Redistribuido</span>';
            //     } else {
            //         return '<span class="badge badge-success ml-2">Red</span>';
            //     }
            // })
            // ->addColumn('manual', function ($orden) {
            //     if ($orden->orden_ajustada == 0) {
            //         return '<a onclick="ajuste(' . $orden->id . ')" class="btn btn-primary btn-sm text-white" id="btn-status"><i class="far fa-save"></i></a>';
            //     } else {
            //         return '<a onclick="reajustar(' . $orden->id . ')" class="badge badge-success text-white" id="badge-red">Red</a>';
            //     }
            // })
            ->rawColumns([
                'Opciones', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
                'total', 'referencia_producto', 'manual', 'cant_red'
            ])
            ->make(true);
    }

    


    public function ajuste($id, Request $request)
    {
        $orden_detalle = ordenPedidoDetalle::find($id);
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
        $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        if (is_object($orden_detalle)) {
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
            $orden_detalle->total = $total;
            $orden_detalle->orden_ajustada = 1;
            $orden_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_detalle' => $orden_detalle
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function reajuste($id)
    {

        $orden_detalle = ordenPedidoDetalle::find($id);

        if (is_object($orden_detalle)) {

            $orden_detalle->orden_ajustada = 0;
            $orden_detalle->orden_redistribuida = 0;
            $orden_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_detalle' => $orden_detalle
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function sustituto(Request $request)
    {
        $producto_id = $request->input('producto');
        $cantidad = $request->input('cantidad');

        $producto = Product::find($producto_id);

        if (is_object($producto)) {
            $tono = $producto->tono;
            $genero =  $producto->genero;
            $proceso_seco = $producto->intensidad_proceso_seco;
            $atributo_1 = $producto->atributo_no_1;
            $atributo_2 = $producto->atributo_no_2;
            $atributo_3 = $producto->atributo_no_3;

            $sustitutos = Product::where('genero', $genero)
                ->where('tono', $tono)

                ->where(function ($query) use ($proceso_seco, $atributo_1, $atributo_2, $atributo_3) {
                    $query->where('intensidad_proceso_seco', $proceso_seco)
                        ->orWhere('atributo_no_1', $atributo_1)
                        ->orWhere('atributo_no_2', $atributo_2)
                        ->orWhere('atributo_no_3', $atributo_3);
                })
                ->select('id', 'referencia_producto')
                ->get();

            $productos = array();

            $length = count($sustitutos);

            for ($i = 0; $i < $length; $i++) {
                array_push($productos, $sustitutos[$i]['id']);
            }

            $talla_almacen = Almacen::where('producto_id', 'not like', $producto_id)
                ->where('total', '>=', $cantidad)
                ->whereIn('producto_id', $productos)
                ->get()->load('producto');

            $t_sustitutos = count($talla_almacen);

            // for ($i = 0; $i < $t_sustitutos; $i++) {

            //     $ref_id = $talla_almacen[$i]->producto_id;
            //     $almacen_id = $talla_almacen[$i]->producto_id;

            //     $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
            //         ->where('producto_id', $ref_id)->select('id')->get();

            //     $segundas = array();

            //     $longitudSegunda = count($segunda);

            //     for ($i = 0; $i < $longitudSegunda; $i++) {
            //         array_push($segundas, $segunda[$i]['id']);
            //     }

            //     $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');
            //     $to = $talla_almacen[$i]->sum('total');
            //     echo $to;
            //     die();
            //     // $talla_almacen[$i]->total = $talla_almacen[$i]->total - $tallasSegundas->sum('total');
            // }


            if (empty($talla_almacen)) {
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se encontraron ningun sustituto'
                ];
            } else {
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'almacen' => $talla_almacen,
                ];
            }
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se encontraron ningun sustituto'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function fechaEntrega($id)
    {
        $corte = Corte::find($id);

        if (is_object($corte)) {
            //tallas corte
            $tallas = Talla::where('corte_id', $corte->id)->get();

            //perdidas
            $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
                ->where('corte_id', $corte->id)->select('id')->get();

            $perdidas = array();

            $longitudPerdida = count($perdida);

            for ($i = 0; $i < $longitudPerdida; $i++) {
                array_push($perdidas, $perdida[$i]['id']);
            }

            $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();

            //SEGUNDA
            $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
                ->where('corte_id', $corte->id)->select('id')->get();

            $segundas = array();

            $longitudSegunda = count($segunda);

            for ($i = 0; $i < $longitudSegunda; $i++) {
                array_push($segundas, $segunda[$i]['id']);
            }

            $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');
            $total = $tallas->sum('total') - $tallasPerdidas->sum('total') - $tallasSegundas->sum('total');

            $data = [
                'code' => 200,
                'status' => 'success',
                'fecha_entrega' => $corte->fecha_entrega,
                'a' => $tallas->sum('a') - $tallasPerdidas->sum('a') - $tallasSegundas->sum('a'),
                'b' => $tallas->sum('b') - $tallasPerdidas->sum('b') - $tallasSegundas->sum('b'),
                'c' => $tallas->sum('c') - $tallasPerdidas->sum('c') - $tallasSegundas->sum('c'),
                'd' => $tallas->sum('d') - $tallasPerdidas->sum('d') - $tallasSegundas->sum('d'),
                'e' => $tallas->sum('e') - $tallasPerdidas->sum('e') - $tallasSegundas->sum('e'),
                'f' => $tallas->sum('f') - $tallasPerdidas->sum('f') - $tallasSegundas->sum('f'),
                'g' => $tallas->sum('g') - $tallasPerdidas->sum('g') - $tallasSegundas->sum('g'),
                'h' => $tallas->sum('h') - $tallasPerdidas->sum('h') - $tallasSegundas->sum('h'),
                'i' => $tallas->sum('i') - $tallasPerdidas->sum('i') - $tallasSegundas->sum('i'),
                'j' => $tallas->sum('j') - $tallasPerdidas->sum('j') - $tallasSegundas->sum('j'),
                'k' => $tallas->sum('k') - $tallasPerdidas->sum('k') - $tallasSegundas->sum('k'),
                'l' => $tallas->sum('l') - $tallasPerdidas->sum('l') - $tallasSegundas->sum('l'),
                'total' => ($total < 0) ? 0 : $total


            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'no se encontro el corte'
            ];
        }

        return response()->json($data, $data['code']);
    }

    function clearOP()
    {
        $ordenes_id = ordenPedido::all();

        $ordenes = array();

        $longitud = count($ordenes_id);

        for ($i = 0; $i < $longitud; $i++) {
            array_push($ordenes, $ordenes_id[$i]['id']);
        }

        $orden_detalle = ordenPedidoDetalle::whereIn('orden_pedido_id', $ordenes)->get();

        $detalles = array();

        $longitudDetalle = count($orden_detalle);

        for ($i = 0; $i < $longitudDetalle; $i++) {
            array_push($detalles, $orden_detalle[$i]['orden_pedido_id']);
        }

        //verificar diferencia

        $diferencia = array_diff($ordenes, $detalles);

        if (!empty($diferencia)) {
            $orden = ordenPedido::whereIn('id', $diferencia)->get();
            $length = count($orden);

            if (!empty($orden)) {
                for ($i = 0; $i < $length; $i++) {
                    $orden[$i]->delete();
                }
            }
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Hecho'
            // 'ordenes' => $ordenes,
            // 'detalle' => $detalles,
            // 'diferencia' => $orden
        ];


        return response()->json($data, $data['code']);
    }

    
    public function destroyProduct($id)
    {
        // $select = DB::select("SHOW TABLE STATUS LIKE 'orden_pedido'");
        // $detail_id = $select[0]->Auto_increment - 1;

        $detalle = ordenPedidoDetalle::find($id);

        if(!empty($detalle)){
            $detalle->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'detalle' => $detalle
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error',
                'detail' => $detalle
            ];
        }
       
        return response()->json($data, $data['code']);
    }
}

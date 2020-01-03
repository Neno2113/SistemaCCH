<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ordenPedido;
use App\Factura;
use App\Almacen;
use App\Talla;
use App\TallasPerdidas;
use App\Corte;
use App\ordenFacturacionDetalle;
use App\Perdida;
use App\ordenPedidoDetalle;
use App\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function ordenes()
    {
        $orden = ordenPedido::all();

        $data = [
            'code' => 100,
            'status' => 'success',
            'orden' => $orden
        ];

        return response()->json($data, $data['code']);
    }

    public function totalVenta(Request $request){
        $almacen = Almacen::all();
        $perdida = TallasPerdidas::all();
        $facturado = ordenFacturacionDetalle::all();
        $orden = ordenPedidoDetalle::all();

        $existencia = $almacen->sum('total') - $perdida->sum('total') - $facturado->sum('total');
        $dispVenta = $existencia - $orden->sum('total');

        $data = [
            'code' => '200',
            'status' => 'success',
            'almacen' => $almacen->sum('total'),
            'perdida' => $perdida->sum('total'),
            'facturado' => $facturado->sum('total'),
            'orden' => $orden->sum('total'),
            'dispVenta' => ($dispVenta < 0) ? 0 : $dispVenta,
            'existencia' => ($existencia < 0) ? 0 : $existencia
        ];
   
        return response()->json($data, $data['code']);
    }


    public function ventas12meses()
    {
        $ventas = DB::table('factura')
            ->select(DB::raw("DATE_FORMAT(fecha, '%M') as fecha, SUM(total) as total"))
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->get();

        echo  print_r($ventas);   
        die(); 
        $fechasv = '';
        $totalesv = '';
        // while($regfechav = $ventas){
        //     $fechasv = $fechasv. '"'. $regfechav['fecha'] . '",';
        // }

        // $fechasv = substr($fechasv, 0, -1);


        $data = [
            'code' => 200,
            'status' => 'success',
            'ventas' => $fechasv
        ];

        return response()->json($data, $data['code']);
    }


    public function latestOrders(){
        $ordenes = ordenPedido::orderBy('id', 'DESC')->take(5)->get()->load('cliente');

        if(!empty($ordenes)){
            $data = [ 
                'code' => 200,
                'status' => 'success',
                'ordenes' => $ordenes
            ];
        }else{
            $data = [ 
                'code' => 400,
                'status' => 'error',
                'message' => 'ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function latestProduct(){
        $productos = Product::orderBy('id', 'DESC')->take(5)->get();

        if(!empty($productos)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'productos' => $productos
            ];
        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function latestCortes(){
        $cortes = Corte::orderBy('id', 'DESC')->take(5)->get()->load('producto');

        if(!empty($cortes)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'cortes' => $cortes
            ];
        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }
}

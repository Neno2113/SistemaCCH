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

         //perdidas
         $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
         ->get();
 
         $perdidas = array();
 
         $longitudPerdida = count($perdida);
 
         for ($i = 0; $i < $longitudPerdida; $i++) {
             array_push($perdidas, $perdida[$i]['id']);
         }
 
         $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();
 
 
         //SEGUNDA
         $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
         ->get();
 
         $segundas = array();
 
         $longitudSegunda = count($segunda);
 
         for ($i = 0; $i < $longitudSegunda; $i++) {
             array_push($segundas, $segunda[$i]['id']);
         }
 
         $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get();

        $facturado = ordenFacturacionDetalle::all();
        $orden = ordenPedidoDetalle::all();

        $existencia = $almacen->sum('total') - $tallasPerdidas->sum('total') - $facturado->sum('total') + $tallasSegundas->sum('total');
        $dispVenta = $existencia - $orden->sum('total') - $tallasSegundas->sum('total');

        $data = [
            'code' => '200',
            'status' => 'success',
            'almacen' => $almacen->sum('total'),
            'perdida' => $tallasPerdidas->sum('total'),
            'segunda' => $tallasSegundas->sum('total'),
            'facturado' => $facturado->sum('total'),
            'orden' => $orden->sum('total'),
            'dispVenta' => ($dispVenta < 0) ? 0 : $dispVenta,
            'existencia' => ($existencia < 0) ? 0 : $existencia
        ];
   
        return response()->json($data, $data['code']);
    }


    public function ventas12meses()
    {
      
        $sqlquery = "SELECT DATE_FORMAT(fecha, '%M') as mes, SUM(total) as total FROM factura GROUP BY mes ORDER BY fecha DESC limit 0,12";
        $result = DB::select($sqlquery);
 

        $months = array();
        $montos = array();

        $longitudventas = count($result);

        for ($i = 0; $i < $longitudventas; $i++) {
            array_push($months, $result[$i]->mes);
            array_push($montos,  number_format($result[$i]->total));
          
        }   

        $data = [
            'code' => 200,
            'status' => 'success',
            // 'ventas' => $ventas,
            'mes' => $months,
            'amount' => $montos,
            'result' => $result
        ];

        return response()->json($data, $data['code']);
    }

    public function ventas10dias()
    {
      
        $sqlquery = "SELECT CONCAT(DAY(fecha), '-', MONTH(fecha)) as fecha, SUM(total) as total FROM factura GROUP BY fecha ORDER BY fecha DESC limit 0,10";
        $result = DB::select($sqlquery);
 


        $data = [
            'code' => 200,
            'status' => 'success',
            'result' => $result
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

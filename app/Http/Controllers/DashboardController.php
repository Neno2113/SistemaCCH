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
            'orden' => $orden->sum('total')
        ];
   
        return response()->json($data, $data['code']);
    }


    // public function ventas12meses()
    // {
    //     $ventas = Factura::selectRaw()
    //     $data = [
    //         'code' => 200,
    //         'status' => 'success',
    //         'ventas' => $ventas
    //     ];

    //     return response()->json($data, $data['code']);
    // }
}

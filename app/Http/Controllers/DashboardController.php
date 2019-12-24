<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ordenPedido;
use App\Factura;
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


    public function ventas12meses()
    {
        $ventas = Factura::selectRaw()
        $data = [
            'code' => 200,
            'status' => 'success',
            'ventas' => $ventas
        ];

        return response()->json($data, $data['code']);
    }
}

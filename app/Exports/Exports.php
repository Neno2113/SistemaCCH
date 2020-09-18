<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\User;
use App\ordenFacturacionDetalle;
use App\OrdenFacturacion;
use App\ordenEmpaque;
use App\ordenPedido;
use App\client;
use App\Factura;

class Exports implements FromView
{

    public function view(): View
    {
        $detalle = ordenFacturacionDetalle::all();
        $ordenes_facturacion = array();

        for ($i = 0; $i < count($detalle); $i++) {
            array_push($ordenes_facturacion, $detalle[$i]['orden_facturacion_id']);
        }
        $facturacion = OrdenFacturacion::whereIn('id', $ordenes_facturacion)->get();

        $ordenes_empaque = [];

        for ($i = 0; $i < count($facturacion); $i++) {
            array_push($ordenes_empaque, $facturacion[$i]['orden_empaque_id']);
        }

        $orden_empaque = ordenEmpaque::whereIn('id', $ordenes_empaque)->get();

        $ordenes_pedido = [];

        for ($i = 0; $i < count($orden_empaque); $i++) {
            array_push($ordenes_pedido, $orden_empaque[$i]['orden_pedido_id']);
        }

        $orden_pedido = ordenPedido::whereIn('id', $ordenes_pedido)->get();

        $clientes = [];

        for ($i = 0; $i < count($orden_pedido); $i++) {
            array_push($clientes, $orden_pedido[$i]['cliente_id']);
        }


        $cliente = client::whereIn('id', $clientes)->get();


        $factura = Factura::whereIn('orden_facturacion_id', $ordenes_facturacion)->get()->load('cliente')
        ->load('empleado');

        $factura_detalle = ordenFacturacionDetalle::all()
        ->load('producto')->load('catalogo')
        ->load('sku');
        // $array_detalle = (array) $factura_detalle;

        $distribuciones = [];

        for ($i = 0; $i < count($factura_detalle); $i++) {
            array_push($distribuciones, $factura_detalle[$i]['orden_facturacion_id']);
        }

        // echo var_dump($distribuciones);
        // die();

        return view('sistema.existencia.export', [
            'factura_detalle' => $factura_detalle,
            'facturacion' => $factura,
            'detalle_array' => $distribuciones
        ]);
    }
}

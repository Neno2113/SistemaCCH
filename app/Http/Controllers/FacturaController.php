<?php

namespace App\Http\Controllers;

use App\ordenPedido;
use App\OrdenFacturacion;
use App\ordenFacturacionDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FacturaController extends Controller
{
    public function orden_facturacion()
    {
        $ordenes = DB::table('orden_facturacion')
            ->join('users', 'orden_facturacion.user_id', 'users.id')
            ->join('orden_empaque', 'orden_facturacion.orden_empaque_id', 'orden_empaque.id')
            ->select([
               'orden_facturacion.id', 'orden_facturacion.no_orden_facturacion', 'orden_facturacion.fecha',
               'users.name', 'users.surname', 'orden_empaque.no_orden_empaque', 'orden_empaque.fecha as fecha_empaque',
               'orden_empaque.orden_pedido_id'
            ]);

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function ($orden) {
                return "";
            })
            ->editColumn('fecha', function ($orden) {
                return date("h:i:s A d-m-20y", strtotime($orden->fecha));
            })
            ->editColumn('fecha_empaque', function ($orden) {
                return date("h:i:s A d-m-20y", strtotime($orden->fecha_empaque));
            })
            ->editColumn('name', function ($orden) {
                return $orden->name." ".$orden->surname;
            })
            ->editColumn('no_orden_empaque', function ($orden) {
                return str_replace(" ", "", $orden->no_orden_empaque);
            })
            ->addColumn('Opciones', function ($orden) {
                return '<button onclick="mostrar(' . $orden->id . ')" id="agregar'.$orden->id.'"  class="btn btn-info btn-sm ml-1"> <i class="fas fa-eye fa-lg"></i></button>';
            })
            ->addColumn('no_orden_pedido', function ($orden) {
                $orden_pedido = ordenPedido::find($orden->orden_pedido_id);

                return $orden_pedido->no_orden_pedido;
            })
            ->addColumn('fecha_entrega', function ($orden) {
                $orden_pedido = ordenPedido::find($orden->orden_pedido_id);

                return $orden_pedido->fecha_entrega;
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function show($id){

        $orden_facturacion = OrdenFacturacion::find($id);

        if(\is_object($orden_facturacion)){
            

            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_facturacion' => $orden_facturacion
            ];
        }else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'ocurrio un error'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function facturaDetalle($id)
    {
        $ordenes = DB::table('orden_facturacion_detalle')
            ->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->select([
                'orden_facturacion_detalle.id', 'orden_facturacion_detalle.a',
                'orden_facturacion_detalle.b', 'orden_facturacion_detalle.c', 'orden_facturacion_detalle.d',
                'orden_facturacion_detalle.e', 'orden_facturacion_detalle.f', 'orden_facturacion_detalle.f',
                'orden_facturacion_detalle.g', 'orden_facturacion_detalle.h', 'orden_facturacion_detalle.i',
                'orden_facturacion_detalle.j', 'orden_facturacion_detalle.k', 'orden_facturacion_detalle.l',
                'orden_facturacion_detalle.total', 'producto.referencia_producto'
            ])->where('orden_facturacion_id', 'LIKE', $id);

        return DataTables::of($ordenes)
        
            ->make(true);
    }
}

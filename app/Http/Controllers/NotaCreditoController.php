<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotaCredito;
use App\ordenFacturacionDetalle;
use App\OrdenFacturacion;
use App\ordenEmpaque;
use App\ordenEmpaqueDetalle;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotaCreditoController extends Controller
{
    public function facturacionDetail()
    {
        $ordenes = DB::table('orden_facturacion_detalle')
            ->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->join('orden_facturacion', 'orden_facturacion_detalle.orden_facturacion_id', 'orden_facturacion.id')
            ->select([
                'orden_facturacion_detalle.id', 'orden_facturacion_detalle.a', 'orden_facturacion.no_orden_facturacion',
                'orden_facturacion_detalle.b', 'orden_facturacion_detalle.c', 'orden_facturacion_detalle.d',
                'orden_facturacion_detalle.e', 'orden_facturacion_detalle.f', 'orden_facturacion_detalle.f',
                'orden_facturacion_detalle.g', 'orden_facturacion_detalle.h', 'orden_facturacion_detalle.i',
                'orden_facturacion_detalle.j', 'orden_facturacion_detalle.k', 'orden_facturacion_detalle.l',
                'orden_facturacion_detalle.total', 'producto.referencia_producto', 'orden_facturacion.id as facturacion_id',
                'orden_facturacion_detalle.fecha', 'orden_facturacion.orden_empaque_id as empaque_id'
            ]);

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function ($orden) {
                return "";
            })
            ->addColumn('orden_empaque', function ($orden) {
                $ordenEmpaque = ordenEmpaque::find($orden->empaque_id);

                return str_replace(" ", "", $ordenEmpaque->no_orden_empaque);
            })
            ->editColumn('fecha', function ($orden) {
                return date("h:i:s A d-m-20y", strtotime($orden->fecha));
            })
            // ->addColumn('Opciones', function ($orden) {
            //     return ($orden->facturado == 1) ? '<span id="empacado_listo" class="badge badge-success">Agregado <i class="fas fa-check"></i> </span>' :
            //     '<a onclick="agregar(' . $orden->id . ')" id="agregar'.$orden->id.'"  class="btn btn-info btn-sm ml-1"> <i class="fas fa-file-invoice"></i></a>';
            // })
            ->rawColumns(['Opciones'])
            ->make(true);
    }
}

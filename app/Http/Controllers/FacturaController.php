<?php

namespace App\Http\Controllers;

use App\ordenPedido;
use App\OrdenFacturacion;
use App\ordenFacturacionDetalle;
use App\Factura;
use App\ordenEmpaque;
use App\Product;
use App\SKU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FacturaController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'id' => 'required',
            'tipo_factura' => 'required',
            'numeracion' => 'required',
            'itbis' => 'required',
            'descuento' => 'required',
            'fecha' => 'required',
            'comprobante_fiscal' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $orden_facturacion_id = $request->input('id');
            $tipo_factura = $request->input('tipo_factura');
            $numeracion = $request->input('numeracion');
            $itbis = $request->input('itbis');
            $descuento = $request->input('descuento');
            $fecha = $request->input('fecha');
            $comprobante_fiscal = $request->input('comprobante_fiscal');
            $numero_comprobante = $request->input('numero_comprobante');
            $sec = $request->input('sec');

            $factura = new Factura();

            $factura->orden_facturacion_id = $orden_facturacion_id;
            $factura->no_factura = $tipo_factura . '-' . $numeracion;
            $factura->user_id = \auth()->user()->id;
            $factura->tipo_factura = $tipo_factura;
            $factura->sec = $sec + 0.01;
            $factura->impreso = 0;
            $factura->comprobante_fiscal = $comprobante_fiscal;
            $factura->numero_comprobante = 'B01' . $numero_comprobante;
            $factura->descuento = trim($descuento, '_%');
            $factura->itbis = trim($itbis, '_%');;
            $factura->fecha = $fecha;

            $factura->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'factura' => $factura
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function orden_facturacion()
    {
        $ordenes = DB::table('orden_facturacion')
            ->join('users', 'orden_facturacion.user_id', 'users.id')
            ->join('orden_empaque', 'orden_facturacion.orden_empaque_id', 'orden_empaque.id')
            ->select([
                'orden_facturacion.id', 'orden_facturacion.no_orden_facturacion', 'orden_facturacion.fecha',
                'users.name', 'users.surname', 'orden_empaque.no_orden_empaque', 'orden_empaque.fecha as fecha_empaque',
                'orden_empaque.orden_pedido_id', 'orden_facturacion.por_transporte'
            ])->where('impreso', 'LIKE', '1');

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
                return $orden->name . " " . $orden->surname;
            })
            ->editColumn('por_transporte', function ($orden) {
                return ($orden->por_transporte == 1) ? 'Si' : 'No';
            })
            ->editColumn('no_orden_empaque', function ($orden) {
                return str_replace(" ", "", $orden->no_orden_empaque);
            })
            ->addColumn('Opciones', function ($orden) {
                return '<button onclick="mostrar(' . $orden->id . ')" id="agregar' . $orden->id . '"  class="btn btn-primary btn-sm ml-1"> <i class="fas fa-edit"></i></button>';
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

    public function show($id)
    {

        $orden_facturacion = OrdenFacturacion::find($id);

        if (\is_object($orden_facturacion)) {
            $orden_empaque = ordenEmpaque::find($orden_facturacion->orden_empaque_id);
            $pedido_id = $orden_empaque->orden_pedido_id;

            $orden_pedido = ordenPedido::find($pedido_id)->load('cliente')->load('sucursal');

            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_facturacion' => $orden_facturacion,
                'orden_pedido' => $orden_pedido
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



    public function getDigits()
    {
        $orden = Factura::orderBy('sec', 'desc')->first();

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

    public function facturas()
    {
        $facturas = DB::table('factura')
            ->join('orden_facturacion', 'factura.orden_facturacion_id', 'orden_facturacion.id')
            ->join('users', 'factura.user_id', 'users.id')
            ->select([
                'factura.id', 'factura.no_factura', 'factura.tipo_factura', 'factura.fecha', 'factura.comprobante_fiscal',
                'factura.descuento', 'factura.itbis', 'orden_facturacion.no_orden_facturacion', 'users.name', 'users.surname',
                'factura.impreso'
            ])->where('factura.impreso', 'LIKE', 0);

        return DataTables::of($facturas)
            ->editColumn('comprobante_fiscal', function ($factura) {
                return ($factura->comprobante_fiscal == 1 ? 'Si' : 'No');
            })
            ->editColumn('name', function ($factura) {
                return $factura->name . ' ' . $factura->surname;
            })
            ->editColumn('tipo_factura', function ($factura) {
                if ($factura->tipo_factura == 'IN') {
                    return "Factura";
                } else if ($factura->tipo_factura == 'B01') {
                    return "Credito Fiscal";
                } else if ($factura->tipo_factura == 'B02') {
                    return "Consumidor Final";
                } else if ($factura->tipo_factura == 'B03') {
                    return "Nota de Debito(gubernamental)";
                } else if ($factura->tipo_factura == 'DN') {
                    return "Nota de debito(Normal)";
                } else if ($factura->tipo_factura == 'B04') {
                    return "Nota Credito con NCF(gubernamental)";
                } else if ($factura->tipo_factura == 'B14') {
                    return "Comprobante regimen especiales";
                } else if ($factura->tipo_factura == 'B15') {
                    return "Comprobante gubernamental";
                } else if ($factura->tipo_factura == 'B16') {
                    return "Comprobante para exportaciones";
                } else if ($factura->tipo_factura == 'CN') {
                    return "Nota de credito(normal)";
                }
            })
            ->editColumn('descuento', function ($factura) {
                return $factura->descuento . '%';
            })
            ->editColumn('itbis', function ($factura) {
                return $factura->itbis . '%';
            })
            ->editColumn('fecha', function ($factura) {
                return date("d-m-20y", strtotime($factura->fecha));
            })
            ->addColumn('Opciones', function ($orden) {
                return '<button onclick="eliminar(' . $orden->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>' .
                    '<a href="factura/resumida/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Factura Resumida"> <i class="fas fa-file-invoice-dollar fa-lg"></i></a>' .
                    '<a href="imprimir_orden/conduce/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Factura detallada"> <i class="fas fa-file-invoice fa-lg"></i></a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function imprimir($id)
    {
        $factura = Factura::find($id)->load('orden_facturacion');

        if (\is_object($factura)) {

            $factura->fecha_impresion = date('Y/m/d h:i:s');
            $factura->impreso = 1;
            $factura->save();

            $id_orden_facturacion = $factura->orden_facturacion->id;
            $orden_facturacion = OrdenFacturacion::find($id_orden_facturacion);
            $orden_facturacion->impreso = 1;
            $orden_facturacion->save();

            $id_orden_empaque = $factura->orden_facturacion->orden_empaque_id;
            $orden_facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', 'LIKE', $id_orden_facturacion)
                ->get();
            $productos_id = ordenFacturacionDetalle::where('orden_facturacion_id', 'LIKE', $id_orden_facturacion)->select('producto_id')
                ->get();

            $productos = array();

            $longitudProductos = count($productos_id);

            for ($i = 0; $i < $longitudProductos; $i++) {
                array_push($productos, $productos_id[$i]['producto_id']);
            }

            $productosFactura = Product::whereIn('id', $productos)->get();
            $sku = SKU::whereIn('producto_id', $productos)->get();


            $orden_empaque = ordenEmpaque::find($id_orden_empaque);
            $orden_pedido_id = $orden_empaque->orden_pedido_id;
            $orden_pedido = ordenPedido::find($orden_pedido_id)->load('cliente')
                ->load('sucursal');

            $orden_pedido->fecha = date("h:i:s A d-m-20y", strtotime($orden_pedido->fecha));

            $detalles_totales = array();
            $totales_detalles = array();
            $precio_total = array();

            $longitudDetalles = count($orden_facturacion_detalle);


            for ($i = 0; $i < $longitudDetalles; $i++) {
                array_push($detalles_totales, number_format(str_replace('.', '', $orden_facturacion_detalle[$i]['precio']) * $orden_facturacion_detalle[$i]['total']));
                array_push($totales_detalles, $orden_facturacion_detalle[$i]['total']);
                array_push($precio_total, $orden_facturacion_detalle[$i]['precio']);
            }

            $total = implode($precio_total);
            $total = str_replace('.', '', $total);

            $subtotal = array_sum(str_replace(',', '', $detalles_totales));
            $itbis = $factura->itbis / 100;
            $impuesto = $itbis * $subtotal;

            $porc_desc = $factura->descuento / 100;
            $descuento = $porc_desc * $subtotal;

            $total_final = $subtotal + $impuesto - $descuento;

            $factura->total = $total_final;
            $factura->save();

            $ordenes_pedido_id = array();

            $longitudOrdenes = count($orden_facturacion_detalle);

            for ($i = 0; $i < $longitudOrdenes; $i++) {
                array_push($ordenes_pedido_id, $orden_facturacion_detalle[$i]['orden_pedido_id']);
            }

            //actualizar orden pedido status
            $orden_pedidos_id = $factura->orden_pedido_id;

            $ordenes_pedido = ordenPedido::whereIn('id', $ordenes_pedido_id)->get();

            $longitudOrden = count($ordenes_pedido);

            //actualizar status de la orden pedido
            for ($i = 0; $i < $longitudOrden; $i++) {
                $ordenes_pedido[$i]->status_orden_pedido = 'Despachado';
                $ordenes_pedido[$i]->save();
            }

            $bultos = $orden_facturacion_detalle->sum('cant_bultos');

            $pdf = \PDF::loadView('sistema.ordenFacturacion.facturaResumida', \compact(
                'factura',
                'orden_pedido',
                'orden_facturacion_detalle',
                'productosFactura',
                'sku',
                'detalles_totales',
                'subtotal',
                'impuesto',
                'descuento',
                'total_final',
                'bultos',
                'ordenes_pedido'
            ));
            return $pdf->download('facturaResumida.pdf');
        }
    }

    public function verificar($id)
    {
        $factura = Factura::find($id)->load('orden_facturacion');

        if (\is_object($factura)) {

            $id_orden_facturacion = $factura->orden_facturacion->id;
            $id_orden_empaque = $factura->orden_facturacion->orden_empaque_id;
            $orden_facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', 'LIKE', $id_orden_facturacion)
                ->get();
            $productos_id = ordenFacturacionDetalle::where('orden_facturacion_id', 'LIKE', $id_orden_facturacion)->select('producto_id')
                ->get();

            $productos = array();

            $longitudProductos = count($productos_id);

            for ($i = 0; $i < $longitudProductos; $i++) {
                array_push($productos, $productos_id[$i]['producto_id']);
            }

            $productosFactura = Product::whereIn('id', $productos)->get();
            $sku = SKU::whereIn('producto_id', $productos)->get();


            $orden_empaque = ordenEmpaque::find($id_orden_empaque);
            $orden_pedido_id = $orden_empaque->orden_pedido_id;
            $orden_pedido = ordenPedido::find($orden_pedido_id)->load('cliente')
                ->load('sucursal');

            $orden_pedido->fecha = date("h:i:s A d-m-20y", strtotime($orden_pedido->fecha));

            $detalles_totales = array();
            $totales_detalles = array();
            $precio_total = array();

            $longitudDetalles = count($orden_facturacion_detalle);


            for ($i = 0; $i < $longitudDetalles; $i++) {
                array_push($detalles_totales, number_format(str_replace('.', '', $orden_facturacion_detalle[$i]['precio']) * $orden_facturacion_detalle[$i]['total']));
                array_push($totales_detalles, $orden_facturacion_detalle[$i]['total']);
                array_push($precio_total, $orden_facturacion_detalle[$i]['precio']);
            }

            $total = implode($precio_total);
            $total = str_replace('.', '', $total);

            $subtotal = array_sum(str_replace(',', '', $detalles_totales));

            $itbis = $factura->itbis / 100;
            $impuesto = $itbis * $subtotal;


            $porc_desc = $factura->descuento / 100;
            $descuento = $porc_desc * $subtotal;
            $total_final = $subtotal + $impuesto - $descuento;

            $ordenes_pedido_id = array();

            $longitudOrdenes = count($orden_facturacion_detalle);

            for ($i = 0; $i < $longitudOrdenes; $i++) {
                array_push($ordenes_pedido_id, $orden_facturacion_detalle[$i]['orden_pedido_id']);
            }

            //actualizar orden pedido status
            $orden_pedidos_id = $factura->orden_pedido_id;

            $ordenes_pedido = ordenPedido::whereIn('id', $ordenes_pedido_id)->get();

            $longitudOrden = count($ordenes_pedido);

            for ($i = 0; $i < $longitudOrden; $i++) {
                $ordenes_pedido[$i]->status_orden_pedido = 'Despachado';
                $ordenes_pedido[$i]->save();
            }

            $data = [
                'code' => 200,
                'status' => 'success',
                'factura' => $factura,
                'orden_pedido' => $orden_pedido,
                'facturacion_detalle' => $orden_facturacion_detalle,
                'productos' => $productosFactura,
                'sku' => $sku,
                'totales' => $detalles_totales,
                'subtotal' => $subtotal,
                'itbis' => $impuesto,
                'total' => number_format($total_final),
                'descuento' => $descuento,
                'orden_pedidos' => $ordenes_pedido,
                'bultos' => $orden_facturacion_detalle->sum('cant_bultos')
            ];
        }
        return response()->json($data, $data['code']);
    }
}

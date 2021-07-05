<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenFacturacion;
use App\ordenEmpaque;
use App\ordenPedido;
use App\ordenEmpaqueDetalle;
use App\ordenFacturacionDetalle;
use App\Product;
use App\SKU;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class OrdenFacturacionController extends Controller
{

    public function store(Request $request)
    {
        $validar = $request->validate([
            // 'no_orden_facturacion' => 'required',
            'empaque_id' => 'required',
            // 'sec' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            // $no_orden_facturacion = $request->input('no_orden_facturacion');
            $orden_empaque_id = $request->input('empaque_id');
            $por_transporte = $request->input('por_transporte');
            // $sec = $request->input('sec');

            $orden_empaque = ordenEmpaque::find($orden_empaque_id);
            
            $detalle_empaque = ordenEmpaqueDetalle::where('orden_empaque_id', $orden_empaque_id)->get();

            if(count($detalle_empaque) == 0){

                $data = [
                    'code' => 200,
                    'status' => 'info',
                    'message' => 'Debe Registrar la cantidad de bultos'
                ];
            } else {
             
                $orden_facturacion = new OrdenFacturacion();

                // $orden_facturacion->no_orden_facturacion = $no_orden_facturacion;
                $orden_facturacion->orden_empaque_id = $orden_empaque_id;
                $orden_facturacion->user_id = \auth()->user()->id;
                $orden_facturacion->fecha = date('Y/m/d h:i:s');
                $orden_facturacion->impreso = 0;
                $orden_facturacion->por_transporte = $por_transporte;
                // $orden_facturacion->sec = $sec + 0.01;

                $orden_facturacion->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'orden_facturacion' => $orden_facturacion,
                    'empaque' => $orden_empaque
                ];
            }
        
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetalle(Request $request)
    {

        $orden_facturacion_id = $request->input('orden_facturacion_id');
        $detalle_id = $request->input('detalle');

        $empaque_detalle = ordenEmpaqueDetalle::find($detalle_id);

        if (\is_object($empaque_detalle)) {
            //actualizar detalle para modificar datatable en el frontend
            $empaque_detalle->facturado = 1;
            $empaque_detalle->save();

            $orden_empaque_id = $empaque_detalle->orden_empaque_id;
            $orden_empaque = ordenEmpaque::find($orden_empaque_id)->load('orden_pedido');
            $orden_pedido_id = $orden_empaque->orden_pedido->id;
            $orden_pedido = ordenPedido::find($orden_pedido_id);
            // $orden_pedido->status_orden_pedido = 'Facturado';
            $orden_pedido->save();

            $orden_empaque->empacado = 1;
            $orden_empaque->save();

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

            $sumEmpaque = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
            
            // $total = $empaque_detalle->sumEmpaque;
            $precio = $empaque_detalle->precio;
            $bultos = $empaque_detalle->cant_bulto;
            $producto_id = $empaque_detalle->producto_id;
            $orden_pedido_id = $orden_pedido->id;


            $facturaDetalle = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion_id)
            ->where('producto_id', $producto_id)->first();

            if(is_object($facturaDetalle)){

                $facturaDetalle->a = $facturaDetalle->a + $a;
                $facturaDetalle->b = $facturaDetalle->b + $b;
                $facturaDetalle->c = $facturaDetalle->c + $c;
                $facturaDetalle->d = $facturaDetalle->d + $d;
                $facturaDetalle->e = $facturaDetalle->e + $e;
                $facturaDetalle->f = $facturaDetalle->f + $f;
                $facturaDetalle->g = $facturaDetalle->g + $g;
                $facturaDetalle->h = $facturaDetalle->h + $h;
                $facturaDetalle->i = $facturaDetalle->i + $i;
                $facturaDetalle->j = $facturaDetalle->j + $j;
                $facturaDetalle->k = $facturaDetalle->k + $k;
                $facturaDetalle->l = $facturaDetalle->l + $l;
                $facturaDetalle->total = $facturaDetalle->total + $sumEmpaque;
                $facturaDetalle->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'factura_detalle' => $facturaDetalle
                ];
            } else {
                $factura_detalle = new ordenFacturacionDetalle();
                $factura_detalle->a = $a;
                $factura_detalle->b = $b;
                $factura_detalle->c = $c;
                $factura_detalle->d = $d;
                $factura_detalle->e = $e;
                $factura_detalle->f = $f;
                $factura_detalle->g = $g;
                $factura_detalle->h = $h;
                $factura_detalle->i = $i;
                $factura_detalle->j = $j;
                $factura_detalle->k = $k;
                $factura_detalle->l = $l;
                $factura_detalle->total = $sumEmpaque;
                $factura_detalle->precio = $precio;
                $factura_detalle->cant_bultos = $bultos;
                $factura_detalle->producto_id = $producto_id;

                //invoice /cm distribution
                $detalle_invoice = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion_id)->get()
                ->last();
                if(is_object($detalle_invoice)){
                    $cm_distribution = $detalle_invoice->cm_distribuciones;
                
                }
                if(empty($cm_distribution)){
                    $cm_distribution = 0;
                }

                $factura_detalle->user_id = \auth()->user()->id;
                $factura_detalle->orden_facturacion_id = $orden_facturacion_id;
                $factura_detalle->fecha = date('Y/m/d h:i:s');
                $factura_detalle->orden_pedido_id = $orden_pedido_id;
                $factura_detalle->nota_credito = 0;
                $factura_detalle->cm_distribuciones = $cm_distribution + 1;

                $producto = Product::find($producto_id);
                $catalogo = $producto->id_catalogo;
                $ref_f = $producto->referencia_father;
                if(empty($ref_f)){
                    $factura_detalle->referencia_father = $producto_id;
                }else{
                    $factura_detalle->referencia_father = $ref_f;
                }

                $sku = SKU::where('producto_id', $producto->id)
                ->where('talla', 'LIKE', 'General')
                ->get()->first();

                if(is_object($sku)){
                    $factura_detalle->sku_id = $sku->sku;
                }
                $factura_detalle->id_catalogo = $catalogo;
                $factura_detalle->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'factura_detalle' => $factura_detalle
                ];
            }

            
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function empaqueSearch(Request $request)
    {
        $id = $request->input('id');

        $orden_empaque = ordenEmpaque::find($id);
        $orden_pedido_id = $orden_empaque->orden_pedido_id;
        $orden_pedido = ordenPedido::find($orden_pedido_id)->load('cliente')->load('sucursal');

        if (\is_object($orden_empaque)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_empaque' => $orden_empaque,
                'orden_pedido' => $orden_pedido
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'no se encontro nada'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function empaqueDetail($id)
    {
        $ordenes = DB::table('orden_empaque_detalle')
            ->join('producto', 'orden_empaque_detalle.producto_id', 'producto.id')
            ->select([
                'orden_empaque_detalle.id', 'orden_empaque_detalle.a', 'orden_empaque_detalle.facturado',
                'orden_empaque_detalle.b', 'orden_empaque_detalle.c', 'orden_empaque_detalle.d',
                'orden_empaque_detalle.e', 'orden_empaque_detalle.f', 'orden_empaque_detalle.f',
                'orden_empaque_detalle.g', 'orden_empaque_detalle.h', 'orden_empaque_detalle.i',
                'orden_empaque_detalle.j', 'orden_empaque_detalle.k', 'orden_empaque_detalle.l',
                'orden_empaque_detalle.total', 'orden_empaque_detalle.empacado', 'producto.referencia_producto'
            ])->where('orden_empaque_id', 'LIKE', $id);

        return DataTables::of($ordenes)
            ->addColumn('Opciones', function ($orden) {
                return ($orden->facturado == 1) ? '<span id="empacado_listo" class="badge badge-success">Agregado <i class="fas fa-check"></i> </span>' :
                    '<a onclick="agregar(' . $orden->id . ')" id="agregar' . $orden->id . '"  class="btn btn-info btn-sm ml-1"> <i class="fas fa-file-invoice"></i></a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

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

    public function selectEmpaque(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ordenEmpaque::select("id", "no_orden_empaque")
                ->where('no_orden_empaque', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }



    public function getDigits()
    {
        $orden = OrdenFacturacion::orderBy('sec', 'desc')->first();

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
}

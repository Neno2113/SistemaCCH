<?php

namespace App\Http\Controllers;

use App\Factura;
use Illuminate\Http\Request;
use App\NotaCredito;
use App\ordenFacturacionDetalle;
use App\OrdenFacturacion;
use App\ordenEmpaque;
use App\ordenEmpaqueDetalle;
use App\ordenPedido;
use App\Product;
use App\NotaCreditoDetalle;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotaCreditoController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'sec' => 'required',
            'no_nota_credito' => 'required',
            'factura_id' => 'required',
            'precio_lista_factura' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $factura_id = $request->input('factura_id');
            $no_nota_credito = $request->input('no_nota_credito');
            $sec = $request->input('sec');
            $tipo_nota_credito = $request->input('tipo_nota_credito');
            $precio_lista_factura = $request->input('precio_lista_factura');
        

            
            if (preg_match('/_/', $precio_lista_factura)) {
                $precio_lista_factura = trim($precio_lista_factura, "_,RD$");
            } else {
                $precio_lista_factura = trim($precio_lista_factura, "RD$");
                $precio_lista_factura = str_replace(',', '', $precio_lista_factura);
            }

            //actualizar estado en factura nc_uso
            $factura = Factura::find($factura_id);
            $factura->nc_uso = 1;
            $factura->save();

            $nota_credito = new NotaCredito();
         
            $nota_credito->factura_id = $factura_id;
            $nota_credito->no_nota_credito = $no_nota_credito;
            $nota_credito->user_id = \auth()->user()->id;
            $nota_credito->fecha =  date('Y/m/d h:i:s');
            $nota_credito->sec = $sec + 0.01;
            $nota_credito->precio_lista_factura = $precio_lista_factura;
            $nota_credito->tipo_nota_credito = $tipo_nota_credito;
    

            $nota_credito->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'nota_credito' => $nota_credito
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetalle($id, Request $request)
    {
        $validar = $request->validate([
            'nc_id' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $nc_id = $request->input('nc_id');

            $facturacion_detalle = ordenFacturacionDetalle::find($id);
            $facturacion_detalle->nota_credito = 1;
            $facturacion_detalle->save();

            $a = $facturacion_detalle->a;
            $b = $facturacion_detalle->b;
            $c = $facturacion_detalle->c;
            $d = $facturacion_detalle->d;
            $e = $facturacion_detalle->e;
            $f = $facturacion_detalle->f;
            $g = $facturacion_detalle->g;
            $h = $facturacion_detalle->h;
            $i = $facturacion_detalle->i;
            $j = $facturacion_detalle->j;
            $k = $facturacion_detalle->k;
            $l = $facturacion_detalle->l;

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


            $nota_credito_detalle = new NotaCreditoDetalle();
            
            $nota_credito_detalle->nota_credito_id = $nc_id;
            $nota_credito_detalle->a = $a;
            $nota_credito_detalle->b = $b;
            $nota_credito_detalle->c = $c;
            $nota_credito_detalle->d = $d;
            $nota_credito_detalle->e = $e;
            $nota_credito_detalle->f = $f;
            $nota_credito_detalle->g = $g;
            $nota_credito_detalle->h = $h;
            $nota_credito_detalle->i = $i;
            $nota_credito_detalle->j = $j;
            $nota_credito_detalle->k = $k;
            $nota_credito_detalle->l = $l;
            $nota_credito_detalle->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
         

            $nota_credito_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'nota_credito_detalle' => $nota_credito_detalle
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function facturas()
    {
        $facturas = DB::table('factura')
            ->join('orden_facturacion', 'factura.orden_facturacion_id', 'orden_facturacion.id')
            ->select([
                'factura.id', 'factura.no_factura', 'factura.fecha', 'factura.fecha_impresion',
                'orden_facturacion.por_transporte', 'factura.nc_uso'
            ]);

        return DataTables::of($facturas)
            ->addColumn('Expandir', function ($dactura) {
                return "";
            })
            ->editColumn('fecha', function ($facturas) {
                return date("d-m-20y", strtotime($facturas->fecha));
            })
            ->editColumn('fecha_impresion', function ($facturas) {
                return date("h:i:s  d-m-20y", strtotime($facturas->fecha_impresion));
            })
            ->editColumn('por_transporte', function ($facturas) {
                return ($facturas->por_transporte == 1) ? "Si" : "No";
            })
            ->addColumn('referencia_producto', function ($factura) {
                $orden_facturacion_detalle = ordenFacturacionDetalle::find($factura->id);
                $producto_id = $orden_facturacion_detalle->producto_id;

                $producto = Product::find($producto_id);

                return $producto->referencia_producto;
            })
            ->addColumn('total', function ($factura) {
                $orden_facturacion_detalle = ordenFacturacionDetalle::find($factura->id);

                return $orden_facturacion_detalle->total;
            })
            ->addColumn('Opciones', function ($facturas) {
                return ($facturas->nc_uso == 0) ? '<button onclick="mostrar(' . $facturas->id . ')" id="agregar"  class="btn btn-warning btn-sm "><i class="fas fa-eye"></i></button>':
                '<button onclick="eliminar(' . $facturas->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>'.
                '<a href="imprimir_empaque/' . $facturas->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
              
                
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }
    public function facturacionDetail($id)
    {
        $ordenes = DB::table('orden_facturacion_detalle')
            ->join('producto', 'orden_facturacion_detalle.producto_id', 'producto.id')
            ->select([
                'orden_facturacion_detalle.id', 'orden_facturacion_detalle.a',
                'orden_facturacion_detalle.b', 'orden_facturacion_detalle.c', 'orden_facturacion_detalle.d',
                'orden_facturacion_detalle.e', 'orden_facturacion_detalle.f', 'orden_facturacion_detalle.f',
                'orden_facturacion_detalle.g', 'orden_facturacion_detalle.h', 'orden_facturacion_detalle.i',
                'orden_facturacion_detalle.j', 'orden_facturacion_detalle.k', 'orden_facturacion_detalle.l',
                'orden_facturacion_detalle.total', 'producto.referencia_producto', 'orden_facturacion_detalle.nota_credito'
            ])->where('orden_facturacion_id', $id);
        return DataTables::of($ordenes)
        ->addColumn('Opciones', function ($facturacion_detalle) {
            return ($facturacion_detalle->nota_credito == 1) ? '<span id="empacado_listo" class="badge badge-success">Agregada <i class="fas fa-check"></i> </span>' :
            '<a onclick="agregar(' . $facturacion_detalle->id . ')" id="btn-guardar'.$facturacion_detalle->id.'"  class="btn btn-info btn-sm ml-1"><i class="fas fa-cart-arrow-down"></i></a>';
        })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function show($id)
    {

        $factura = Factura::find($id)->load('user')->load('orden_facturacion');
        $factura->fecha = date('d-m-20y', strtotime($factura->fecha));
        $factura->fecha_impresion = date('d-m-20y h:i', strtotime($factura->fecha_impresion));
        $factura->total = number_format($factura->total);

        $orden_facturacion_id = $factura->orden_facturacion->id;
        $orden_facturacion_detalle = ordenFacturacionDetalle::find($orden_facturacion_id)->load('producto');
        $orden_pedido_id = $orden_facturacion_detalle->orden_pedido_id;
        $orden_facturacion_detalle->precio = number_format($orden_facturacion_detalle->precio);
    

        //cliente
        $orden_pedido = ordenPedido::find($orden_pedido_id)->load('cliente')->load('sucursal');

        if (is_object($factura)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'factura' => $factura,
                'detalle' => $orden_facturacion_detalle,
                'cliente' => $orden_pedido->cliente,
                'sucursal' => $orden_pedido->sucursal,
                'producto' => $orden_facturacion_detalle->producto
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => "Ocurrio un error"
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function getDigits()
    {
        $nota_credito = NotaCredito::orderBy('sec', 'desc')->first();

        if (\is_object($nota_credito)) {
            $sec = $nota_credito->sec;
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

    public function destroy($id)
    {
        $factura = Factura::find($id);
        $orden_facturacion_id = $factura->orden_facturacion_id;

        if (!empty($factura)) {
            $factura->nc_uso = 0;
            $factura->save();

            $nota_credito = NotaCredito::where('factura_id', $id)->first();
            $nota_credito->delete();

            $orden_facturacion_detalle = ordenFacturacionDetalle::find($orden_facturacion_id);
            $orden_facturacion_detalle->nota_credito = 0;
            $orden_facturacion_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'nota_credito' => $nota_credito
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

    // public function invoiceDetail(Request $request){

    //     $factura_id = $request->input('factura_id');
    //     $factura = 

    //     ordenFacturacionDetalle::where()

    // }

}

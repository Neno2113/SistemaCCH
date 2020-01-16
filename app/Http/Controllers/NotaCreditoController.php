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

            $a_detalle = $facturacion_detalle->a;
            $b_detalle = $facturacion_detalle->b;
            $c_detalle = $facturacion_detalle->c;
            $d_detalle = $facturacion_detalle->d;
            $e_detalle = $facturacion_detalle->e;
            $f_detalle = $facturacion_detalle->f;
            $g_detalle = $facturacion_detalle->g;
            $h_detalle = $facturacion_detalle->h;
            $i_detalle = $facturacion_detalle->i;
            $j_detalle = $facturacion_detalle->j;
            $k_detalle = $facturacion_detalle->k;
            $l_detalle = $facturacion_detalle->l;


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
            $producto_id = $facturacion_detalle->producto_id;

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

            $a = $a_detalle - $a;
            $b = $b_detalle - $b;
            $c = $c_detalle - $c;
            $d = $d_detalle - $d;
            $e = $e_detalle - $e;
            $f = $f_detalle - $f;
            $g = $g_detalle - $g;
            $h = $h_detalle - $h;
            $i = $i_detalle - $i;
            $j = $j_detalle - $j;
            $k = $k_detalle - $k;
            $l = $l_detalle - $l;


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
            $nota_credito_detalle->producto_id = $producto_id;

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
        $facturas = DB::table('factura')->join('users', 'factura.user_id', 'users.id')
            ->join('orden_facturacion', 'factura.orden_facturacion_id', 'orden_facturacion.id')
            ->select([
                'factura.id', 'factura.no_factura', 'factura.fecha', 'factura.fecha_impresion',
                'orden_facturacion.por_transporte', 'factura.nc_uso', 'users.name', 'users.surname'
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
            ->editColumn('name', function ($factura) {
                return $factura->name." ". $factura->surname;
            })
            // ->addColumn('referencia_producto', function ($factura) {

            //     $productos_id = ordenFacturacionDetalle::select('producto_id')
            //     ->get();

            //     $productos = array();

            //     $longitudProductos = count($productos_id);

            //     for ($i = 0; $i < $longitudProductos; $i++) {
            //         array_push($productos, $productos_id[$i]['producto_id']);
            //     }

            //     $productos = Product::whereIn('id', $productos)->select('referencia_producto')->get();

            //     return $productos;
            // })
            // ->addColumn('total', function ($factura) {
            //     $orden_facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', $factura->id)->get();

            //     return $orden_facturacion_detalle->total;
            // })
            ->addColumn('Opciones', function ($facturas) {
                return ($facturas->nc_uso == 0) ? '<button onclick="mostrar(' . $facturas->id . ')" id="agregar"  class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt fa-lg"></i></button>':
                '<button onclick="eliminar(' . $facturas->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>'.
                '<a href="imprimir_notaCredito/' . $facturas->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
              
                
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
     
        $factura->fecha = date('d/m/20y', strtotime($factura->fecha));
        $factura->fecha_impresion = date('d/m/20y h:i', strtotime($factura->fecha_impresion));
        $factura->total = number_format($factura->total);

        $orden_facturacion_id = $factura->orden_facturacion->id;
        $orden_facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion_id)
        ->get()
        ->load('producto');
        $orden_facturacion_unique = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion_id)->get()->last();
        $orden_pedido_id = $orden_facturacion_unique->orden_pedido_id;
        $orden_facturacion_unique->precio = number_format($orden_facturacion_unique->precio);
    
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
                'precio' => $orden_facturacion_unique->precio
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

            $orden_facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion_id)->get();
            $longitudDetalle = count($orden_facturacion_detalle);

            //actualizar status de la orden pedido
            for ($i = 0; $i < $longitudDetalle; $i++) {
                $orden_facturacion_detalle[$i]->nota_credito = 0;
                $orden_facturacion_detalle[$i]->save();
            }
            
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
            $sku = SKU::whereIn('producto_id', $productos)
            ->where('talla', 'LIKE', 'General')
            ->get();


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
                array_push($detalles_totales, number_format(str_replace('.00', '', $orden_facturacion_detalle[$i]['precio']) * $orden_facturacion_detalle[$i]['total']));
                array_push($totales_detalles, $orden_facturacion_detalle[$i]['total']);
                array_push($precio_total, $orden_facturacion_detalle[$i]['precio']);
            }

            $total = implode($precio_total);
            $total = str_replace('.', '', $total);

            $subtotal = array_sum(str_replace(',', '', $detalles_totales));
            $itbis = $factura->itbis / 100;
           

            $porc_desc = $factura->descuento / 100;
            $descuento = $porc_desc * $subtotal;

            $subtotal_real = $subtotal- $descuento;
            $impuesto = $itbis * $subtotal_real;

            $total_final = $subtotal_real + $impuesto;

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
            $total_articulos = $orden_facturacion_detalle->sum('total');

            $factura->fecha = date("d/m/20y", strtotime($factura->fecha));

            $orden_empaque_detalle = ordenEmpaqueDetalle::where('orden_empaque_id', $orden_empaque->id)
            ->get()->last();

            $orden_empaque_detalle->fecha_empacado = date("d/m/20y h:i:s", strtotime($orden_empaque_detalle->fecha_empacado));

            $pdf = \PDF::loadView('sistema.ordenFacturacion.docNotaCredito', \compact(
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
                'ordenes_pedido',
                'subtotal_real',
                'total_articulos',
                'orden_empaque_detalle'
            ));
            return $pdf->download('facturaResumida.pdf');
            return view('sistema.ordenFacturacion.facturaResumida',\compact(
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
                'ordenes_pedido',
                'subtotal_real',
                'total_articulos',
                'orden_empaque_detalle'
            ));         
        }
    }

}

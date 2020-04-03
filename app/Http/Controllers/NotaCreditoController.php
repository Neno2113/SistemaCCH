<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientBranch;
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
use App\SKU;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotaCreditoController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'no_nota_credito' => 'required',
            'factura_id' => 'required',
            'cliente' => 'required',
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
            $itbis = $request->input('itbis');
            $descuento = $request->input('descuento');
            $tipo_nota_credito = $request->input('tipo_nota_credito');
            $precio_lista_factura = $request->input('precio_lista_factura');
            $ncf = $request->input('ncf');
            $cliente_id = $request->input('cliente');

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
            $nota_credito->no_nota_credito = trim($no_nota_credito, "_");
            $nota_credito->ncf = $ncf;
            $nota_credito->user_id = \auth()->user()->id;
            $nota_credito->fecha =  date('Y/m/d h:i:s');
            $nota_credito->sec = $sec + 0.01;
            $nota_credito->cliente_id = $cliente_id;
            $nota_credito->itbis = $itbis;
            $nota_credito->descuento = $descuento;
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

            $a = $a;
            $b = $b;
            $c = $c;
            $d = $d;
            $e = $e;
            $f = $f;
            $g = $g;
            $h = $h;
            $i = $i;
            $j = $j;
            $k = $k;
            $l = $l;

            //actualizar detalle de orden de facturacion
            // $a_detalle = $a_detalle - $a;
            // $b_detalle = $b_detalle - $b;
            // $c_detalle = $c_detalle - $c;
            // $d_detalle = $d_detalle - $d;
            // $e_detalle = $e_detalle - $e;
            // $f_detalle = $f_detalle - $f;
            // $g_detalle = $g_detalle - $g;
            // $h_detalle = $h_detalle - $h;
            // $i_detalle = $i_detalle - $i;
            // $j_detalle = $j_detalle - $j;
            // $k_detalle = $k_detalle - $k;
            // $l_detalle = $l_detalle - $l;

            // $facturacion_detalle->a = $a_detalle;
            // $facturacion_detalle->b = $b_detalle;
            // $facturacion_detalle->c = $c_detalle;
            // $facturacion_detalle->d = $d_detalle;
            // $facturacion_detalle->e = $e_detalle;
            // $facturacion_detalle->f = $f_detalle;
            // $facturacion_detalle->g = $g_detalle;
            // $facturacion_detalle->h = $h_detalle;
            // $facturacion_detalle->i = $i_detalle;
            // $facturacion_detalle->j = $j_detalle;
            // $facturacion_detalle->k = $k_detalle;
            // $facturacion_detalle->l = $l_detalle;
            // $facturacion_detalle->total = $a_detalle + $b_detalle + $c_detalle + $d_detalle + $e_detalle + $f_detalle + $g_detalle
            // + $h_detalle + $i_detalle + $j_detalle + $k_detalle + $l_detalle;
            // $facturacion_detalle->nota_credito = 1;
            // $facturacion_detalle->save();


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

            $producto = Product::find($producto_id);
            $ref_f = $producto->referencia_father;
            if(empty($ref_f)){
                $nota_credito_detalle->referencia_father = $producto_id;
            }else{
                $nota_credito_detalle->referencia_father = $ref_f;
            }


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
                'orden_facturacion.por_transporte', 'factura.nc_uso', 'users.name', 'users.surname',
                'orden_facturacion.orden_empaque_id as empaque_id'
            ]);

        return DataTables::of($facturas)
            ->addColumn('Expandir', function ($factura) {
                return "";
            })
            ->addColumn('cliente', function ($factura) {
                $orden_empaque = ordenEmpaque::find($factura->empaque_id);
                $orden_pedido = ordenPedido::find($orden_empaque->orden_pedido_id);
                $cliente = Client::find($orden_pedido->cliente_id);

                return $cliente->nombre_cliente;
            })
            ->addColumn('sucursal', function ($factura) {
                $orden_empaque = ordenEmpaque::find($factura->empaque_id);
                $orden_pedido = ordenPedido::find($orden_empaque->orden_pedido_id);
                $sucursal = ClientBranch::find($orden_pedido->sucursal_id);

                return $sucursal->nombre_sucursal;
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
                return ($facturas->nc_uso == 0) ? '<button onclick="mostrar(' . $facturas->id . ')" id="agregar"  class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt "></i></button>':
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
            $nota_credito_id = $nota_credito->id;


            // $facturacion_detalle = ordenFacturacionDetalle::where('orden_facturacion_id', $orden_facturacion_id)->get();
            // $longitudDetalle = count($facturacion_detalle);
            // $nota_detalle = NotaCreditoDetalle::where('nota_credito_id', $nota_credito_id)->get();
            // //actualizar status de la orden pedido
            // for ($i = 0; $i < $longitudDetalle; $i++) {
            //     $facturacion_detalle[$i]->a = $facturacion_detalle[$i]->a + $nota_detalle[$i]->a;
            //     $facturacion_detalle[$i]->b = $facturacion_detalle[$i]->b + $nota_detalle[$i]->b;
            //     $facturacion_detalle[$i]->c = $facturacion_detalle[$i]->c + $nota_detalle[$i]->c;
            //     $facturacion_detalle[$i]->d = $facturacion_detalle[$i]->d + $nota_detalle[$i]->d;
            //     $facturacion_detalle[$i]->e = $facturacion_detalle[$i]->e + $nota_detalle[$i]->e;
            //     $facturacion_detalle[$i]->f = $facturacion_detalle[$i]->f + $nota_detalle[$i]->f;
            //     $facturacion_detalle[$i]->g = $facturacion_detalle[$i]->g + $nota_detalle[$i]->g;
            //     $facturacion_detalle[$i]->h = $facturacion_detalle[$i]->h + $nota_detalle[$i]->h;
            //     $facturacion_detalle[$i]->i = $facturacion_detalle[$i]->i + $nota_detalle[$i]->i;
            //     $facturacion_detalle[$i]->j = $facturacion_detalle[$i]->j + $nota_detalle[$i]->j;
            //     $facturacion_detalle[$i]->k = $facturacion_detalle[$i]->k + $nota_detalle[$i]->k;
            //     $facturacion_detalle[$i]->l = $facturacion_detalle[$i]->l + $nota_detalle[$i]->l;
            //     $facturacion_detalle[$i]->total = $facturacion_detalle[$i]->total + $nota_detalle[$i]->total;
            //     $facturacion_detalle[$i]->nota_credito = 0;
            //     $facturacion_detalle[$i]->save();
            // }
            $nota_credito->delete();
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

    public function validar($id){
        $factura_detalle = ordenFacturacionDetalle::find($id);

        if(is_object($factura_detalle)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'a' => $factura_detalle->a,
                'b' => $factura_detalle->b,
                'c' => $factura_detalle->c,
                'd' => $factura_detalle->d,
                'e' => $factura_detalle->e,
                'f' => $factura_detalle->f,
                'g' => $factura_detalle->g,
                'h' => $factura_detalle->h,
                'i' => $factura_detalle->i,
                'j' => $factura_detalle->j,
                'k' => $factura_detalle->k,
                'l' => $factura_detalle->l,
            ];
        }else{
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

            $nota_credito = NotaCredito::where('factura_id', $id)->get()->first()->load('factura');
            $nota_credito_id = $nota_credito->id;


            $nota_detalle = NotaCreditoDetalle::where('nota_credito_id', $nota_credito_id)->get()->load('producto');

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

            $longitudDetalles = count($nota_detalle);

            for ($i = 0; $i < $longitudDetalles; $i++) {
                array_push($detalles_totales, number_format(str_replace('.00', '', $nota_detalle[$i]['producto']['precio_lista']) * $nota_detalle[$i]['total']));
                array_push($totales_detalles, $nota_detalle[$i]['total']);
                array_push($precio_total, $orden_facturacion_detalle[$i]['precio']);
            }

            $total = implode($precio_total);
            $total = str_replace('.', '', $total);

            $subtotal = array_sum(str_replace(',', '', $detalles_totales));

            $porc_desc = $nota_credito->descuento / 100;
            $descuento = $porc_desc * $subtotal;

            $itbis = $nota_credito->itbis / 100;

            $subtotal_real = $subtotal - $descuento;;
            $impuesto = $itbis * $subtotal_real;

            $total_final = $subtotal_real + $impuesto;

            $nota_credito->total = $total_final;
            $nota_credito->hora_impresion = date('Y/m/d h:i:s');
            $nota_credito->save();


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
            $total_articulos = $nota_detalle->sum('total');

            $factura->fecha = date("d/m/20y", strtotime($factura->fecha));
            $nota_credito->fecha = date("d/m/20y", strtotime($nota_credito->fecha));

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
                'orden_empaque_detalle',
                'nota_credito',
                'nota_detalle'
            ));
            return $pdf->download('NotaCredito.pdf');
            return view('sistema.ordenFacturacion.docNotaCredito',\compact(
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
                'orden_empaque_detalle',
                'nota_credito',
                'nota_detalle'
            ));
        }
    }

}

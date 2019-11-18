<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Product;
use App\Talla;
use App\Perdida;
use App\TallasPerdidas;
use App\Almacen;
use App\Client;
use App\ClientBranch;
use App\ordenPedido;
use App\ordenPedidoDetalle;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ordenPedidoController extends Controller
{
    public function show(Request $request)
    {
        //Recoger datos por la request 
        $producto_id = $request->input('producto_id');
        $referencia_producto = $request->input('referencia_producto');

        //buscar cortes con la misma referencia producto
        $corte = Corte::where('producto_id', $producto_id)->select('id', 'total')->get();
        $corte_proceso = Corte::select('id', 'fase', 'fecha_entrega', 'numero_corte')
            ->where('producto_id', 'LIKE', $producto_id)
            ->where('fase', 'not like', 'almacen')->get()->first();


        if (\is_object($corte_proceso)) {
            $fecha_entrega = date("d-m-20y", strtotime($corte_proceso->fecha_entrega));
        } else {
            $fecha_entrega = "";
        }


        $cortes = array();

        $longitud = count($corte);


        for ($i = 0; $i < $longitud; $i++) {
            array_push($cortes, $corte[$i]['id']);
        }
        //buscar cantidades de tallas con el array de id de cortes
        $tallas = Talla::whereIn('corte_id', $cortes)->get()->load('corte');


        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('producto_id', $producto_id)->select('id')->get();

        $perdidas = array();

        $longitudPerdida = count($perdida);

        for ($i = 0; $i < $longitudPerdida; $i++) {
            array_push($perdidas, $perdida[$i]['id']);
        }


        $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get()->load('perdida');


        //SEGUNDA
        $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
            ->where('producto_id', $producto_id)->select('id')->get();

        $segundas = array();

        $longitudSegunda = count($segunda);

        for ($i = 0; $i < $longitudSegunda; $i++) {
            array_push($segundas, $segunda[$i]['id']);
        }

        $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');


        //Almacen
        $almacen = Almacen::where('producto_id', $producto_id)->select('id')->get();

        $almacenes = array();

        $longitudAlmacen = count($almacen);

        for ($i = 0; $i < $longitudAlmacen; $i++) {
            array_push($almacenes, $almacen[$i]['id']);
        }

        $tallasAlmacen = Almacen::whereIn('id', $almacenes)->get();

        //orden Pedido
        // $orden = ordenPedido::where('producto_id', $producto_id)->select('id')->get();

        // $ordenes = array();

        // $longitudOrdenes = count($orden);

        // for ($i = 0; $i < $longitudOrdenes; $i++) {
        //     array_push($ordenes, $orden[$i]['id']);
        // }

        $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)->get();



        //producto
        $producto = Product::find($producto_id);


        //calcular total real
        $a = $tallasAlmacen->sum('a') - $tallasPerdidas->sum('a') - $tallasSegundas->sum('a') - $tallasOrdenes->sum('a');
        $b = $tallasAlmacen->sum('b') - $tallasPerdidas->sum('b') - $tallasSegundas->sum('b') - $tallasOrdenes->sum('b');
        $c = $tallasAlmacen->sum('c') - $tallasPerdidas->sum('c') - $tallasSegundas->sum('c') - $tallasOrdenes->sum('c');
        $d = $tallasAlmacen->sum('d') - $tallasPerdidas->sum('d') - $tallasSegundas->sum('d') - $tallasOrdenes->sum('d');
        $e = $tallasAlmacen->sum('e') - $tallasPerdidas->sum('e') - $tallasSegundas->sum('e') - $tallasOrdenes->sum('e');
        $f = $tallasAlmacen->sum('f') - $tallasPerdidas->sum('f') - $tallasSegundas->sum('f') - $tallasOrdenes->sum('f');
        $g = $tallasAlmacen->sum('g') - $tallasPerdidas->sum('g') - $tallasSegundas->sum('g') - $tallasOrdenes->sum('g');
        $h = $tallasAlmacen->sum('h') - $tallasPerdidas->sum('h') - $tallasSegundas->sum('h') - $tallasOrdenes->sum('h');
        $i = $tallasAlmacen->sum('i') - $tallasPerdidas->sum('i') - $tallasSegundas->sum('i') - $tallasOrdenes->sum('i');
        $j = $tallasAlmacen->sum('j') - $tallasPerdidas->sum('j') - $tallasSegundas->sum('j') - $tallasOrdenes->sum('j');
        $k = $tallasAlmacen->sum('k') - $tallasPerdidas->sum('k') - $tallasSegundas->sum('k') - $tallasOrdenes->sum('k');
        $l = $tallasAlmacen->sum('l') - $tallasPerdidas->sum('l') - $tallasSegundas->sum('l') - $tallasOrdenes->sum('l');
        $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        //respuesta 
        $data = [
            'code' => 200,
            'status' => 'success',
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
            'e' => $e,
            'f' => $f,
            'g' => $g,
            'h' => $h,
            'i' => $i,
            'j' => $j,
            'k' => $k,
            'l' => $l,
            'producto' => $producto,
            'total_corte' => $total_real,
            'corte_proceso' => $corte_proceso,
            'fecha_entrega' => $fecha_entrega
        ];


        return \response()->json($data, $data['code']);
    }
    public function store(Request $request)
    {

        $validar = $request->validate([
            'cliente_id' => 'required',
            'notas' => 'required',
            'generado_internamente' => 'required',
            'fecha_entrega' => 'required',
            'detallada' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $client_id = $request->input('cliente_id');
            $sucursal_id = $request->input('sucursal_id');
            $notas = $request->input('notas');
            $fecha_entrega = $request->input('fecha_entrega');
            $generado_internamente = $request->input('generado_internamente');
            $detallada = $request->input('detallada');
            $no_orden_pedido = $request->input('no_orden_pedido');
            $precio = $request->input('precio');
            $sec = $request->input('sec');
            


            $orden = new ordenPedido();

            $orden->cliente_id = $client_id;
            $orden->sucursal_id = $sucursal_id;
            $orden->notas = $notas;
            $orden->fecha_entrega = $fecha_entrega;
            $orden->generado_internamente = $generado_internamente;
            $orden->detallada = $detallada;
            $orden->no_orden_pedido = $no_orden_pedido;
            $orden->precio = $precio;
            $orden->sec = $sec + 0.01;
            $orden->fecha = date('Y/m/d h:i:s');
            $orden->user_id = \auth()->user()->id;
           

            $orden->save();


            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetalle(Request $request)
    {
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
        $producto_id = $request->input('producto_id');
        $cantidad = $request->input('cantidad');

        //sacar next autogenerated ID
        $select = DB::select("SHOW TABLE STATUS LIKE 'orden_pedido'");
        $nextId = $select[0]->Auto_increment;

        $orden_detalle = new ordenPedidoDetalle();

        $orden_detalle->orden_pedido_id = $nextId;
        $orden_detalle->a = $a;
        $orden_detalle->b = $b;
        $orden_detalle->c = $c;
        $orden_detalle->d = $d;
        $orden_detalle->e = $e;
        $orden_detalle->f = $f;
        $orden_detalle->g = $g;
        $orden_detalle->h = $h;
        $orden_detalle->i = $i;
        $orden_detalle->j = $j;
        $orden_detalle->k = $k;
        $orden_detalle->l = $l;
        $orden_detalle->producto_id = $producto_id;
        $orden_detalle->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
        $orden_detalle->cantidad = $cantidad;

        $orden_detalle->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'detalle' => $orden_detalle

        ];


        return response()->json($data, $data['code']);
    }

    public function selectProduct(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::join('producto', 'corte.producto_id', 'producto.id')
                ->select("producto.id", "producto.referencia_producto", "corte.fase")
                ->where('corte.fase', 'LIKE', "Almacen")
                ->where('producto.referencia_producto', 'LIKE', "%$search%")
                ->take(1)
                ->get();
        }
        return response()->json($data);
    }

    public function selectCliente(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Client::select("id", "nombre_cliente", "contacto_cliente_principal")
                // ->where('enviado_lavanderia', 'LIKE', '0')
                ->where('nombre_cliente', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectSucursal(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ClientBranch::select("id", "nombre_sucursal")
                // ->where('enviado_lavanderia', 'LIKE', '0')
                ->where('nombre_sucursal', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function getDigits()
    {
        $orden = ordenPedido::orderBy('sec', 'desc')->first();

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

    public function showOrden($id)
    {
        $orden = ordenPedidoDetalle::where('orden_pedido_id', $id)->get();

        if (is_object($orden)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden' => $orden
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'error'
            ];
        }

        return \response()->json($data, $data['code']);
    }

    public function ordenes()
    {
        $ordenes = DB::table('orden_pedido')->join('cliente', 'orden_pedido.cliente_id', '=', 'cliente.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', '=', 'cliente_sucursales.id')
            ->join('users', 'orden_pedido.user_id', 'users.id')
            ->select([
                'orden_pedido.id', 'cliente.nombre_cliente', 'cliente_sucursales.nombre_sucursal', 'orden_pedido.fecha', 'orden_pedido.fecha_entrega', 'orden_pedido.notas', 'orden_pedido.generado_internamente', 'orden_pedido.precio', 'orden_pedido.detallada', 'users.name'
            ]);

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function ($orden) {
                return "";
            })
            ->editColumn('generado_internamente', function ($orden) {
                return ($orden->generado_internamente == 1 ? 'Si' : 'No');
            })
            ->editColumn('detallada', function ($orden) {
                return ($orden->detallada == 1 ? 'Si' : 'No');
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d-m-20y", strtotime($orden->fecha_entrega));
            })
            ->editColumn('fecha', function ($orden) {
                return date("h:i:s A d-m-20y", strtotime($orden->fecha));
            })
            ->addColumn('Opciones', function ($orden) {
                return '<button id="btnEdit" onclick="mostrar(' . $orden->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $orden->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>'.
                    '<a href="imprimir_orden/conduce/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function imprimir($id)
    {
        $orden = ordenPedido::find($id)->load('cliente')
                            ->load('user')
                            ->load('sucursal')
                            ->load('producto');  

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get();

        $productos_id = ordenPedidoDetalle::where('orden_pedido_id', $id)->select('producto_id')->get();

        $productos = array();

        $longitudProductos = count($productos_id);

        for ($i = 0; $i < $longitudProductos; $i++) {
            array_push($productos, $productos_id[$i]['producto_id']);
        }

        $productosOrdenes = Product::whereIn('id', $productos)->get();
          
        $orden->fecha = date("h:i:s A d-m-20y", strtotime($orden->fecha));
        $orden->fecha_entrega = date("d-m-20y", strtotime($orden->fecha_entrega));

        $pdf = \PDF::loadView('sistema.ordenPedido.conduceOrden', \compact('orden', 'orden_detalle', 'productosOrdenes'))->setPaper('a4', 'landscape');
        return $pdf->download('conduceOrden.pdf');
    }

    public function verificar($id)
    {
        $orden = ordenPedido::find($id)->load('cliente')
                            ->load('user')
                            ->load('sucursal');
                             

        $productos_id = ordenPedidoDetalle::where('orden_pedido_id', $id)->select('producto_id')->get();

        $productos = array();

        $longitudProductos = count($productos_id);

        for ($i = 0; $i < $longitudProductos; $i++) {
            array_push($productos, $productos_id[$i]['producto_id']);
        }

        $productosOrdenes = Product::whereIn('id', $productos)->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden,
            // 'detalle' => $orden_detalle,
            'producto' => $productosOrdenes
        ];

        return \response()->json($data, $data['code']);
    }
}

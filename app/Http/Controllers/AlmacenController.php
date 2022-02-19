<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Corte;
use App\Almacen;
use App\Lavanderia;
use App\Recepcion;
use App\Perdida;
use App\TallasPerdidas;
use App\Talla;
use App\AlmacenDetalle;
use App\AtributosProducto;
use App\ordenPedido;
use App\ordenPedidoDetalle;
use App\CurvaProducto;
use App\PermisoUsuario;
use App\SKU;
use App\Ubicaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AlmacenController extends Controller
{

    public function store(Request $request)
    {

        $validar = $request->validate([
            'corte' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $corte_id = $request->input('corte');

            $almacen_check = Almacen::where('corte_id', $corte_id)->first();


            if (!empty($almacen_check)) {

                $data = [
                    'code' => 200,
                    'status' => 'info',
                    'message' => 'Este corte ya se le dio entrada a almacen.'
                ];
            } else {

                $ubicacion = $request->input('ubicacion');
                $tono = $request->input('tono');
                $intensidad_proceso_seco = $request->input('intensidad_proceso_seco');
                $atributo_no_1 = $request->input('atributo_no_1');
                $atributo_no_2 = $request->input('atributo_no_2');
                $atributo_no_3 = $request->input('atributo_no_3');


                $almacen = new Almacen();
                $corte = Corte::find($corte_id);
                $producto_id = $corte['producto_id'];

                $ordenes_proceso = ordenPedido::where('corte_en_proceso', 'LIKE', 'Si')->get()->first();
                if (!empty($ordenes_proceso)) {
                    $proceso_detalle = ordenPedidoDetalle::where('orden_pedido_id', $ordenes_proceso->id)
                        ->where('producto_id', $producto_id)->get()->first();
                }

                if (!empty($proceso_detalle)) {
                    $ordenes_proceso->corte_en_proceso = "No";
                    $orden_father_id = $ordenes_proceso->orden_pedido_father;
                    $orden_father = ordenPedido::find($orden_father_id);
                    $ordenes_proceso->cliente_id = $orden_father->cliente_id;
                    $ordenes_proceso->sucursal_id = $orden_father->sucursal_id;
                    $ordenes_proceso->vendedor_id = $orden_father->vendedor_id;
                    $ordenes_proceso->detallada = $orden_father->detallada;
                    $ordenes_proceso->notas = $orden_father->notas;
                    $ordenes_proceso->generado_internamente = $orden_father->generado_internamente;
                    $ordenes_proceso->save();
                }

                if (!empty($ubicacion)) {
                    $producto = Product::find($producto_id);

                    $producto->ubicacion = $ubicacion;
                    $producto->tono = $tono;
                    $producto->intensidad_proceso_seco = $intensidad_proceso_seco;
                    $producto->atributo_no_1 = $atributo_no_1;
                    $producto->atributo_no_2 = $atributo_no_2;
                    $producto->atributo_no_3 = $atributo_no_3;
                    $producto->producto_terminado = 1;

                    $producto->save();
                }

                //En caso de que exista otra referencia en el registro de tabla de producto
                //Se va a generar otra referencia para mejor manejo de las ordenes de pedido en base
                //a productos.
                $producto = Product::find($producto_id);
                $ref2 = $producto->referencia_producto_2;

                if (!empty($ref2)) {
                    $producto_father = Product::find($producto_id);
                    $select_product = DB::select("SHOW TABLE STATUS LIKE 'producto'");
                    $nexProductId = $select_product[0]->Auto_increment;

                    //actualizar corte
                    // $corte->producto_id_ref_2 = $nexProductId;
                    // $corte->save();

                    $producto_ref_2 = new Product();
                    $producto_ref_2->id_user = Auth::user()->id;
                    $producto_ref_2->genero = $producto_father->genero;
                    $producto_ref_2->marca = $producto_father->marca;
                    $producto_ref_2->referencia_producto = $ref2;
                    $producto_ref_2->referencia_father = $producto->id;
                    $producto_ref_2->descripcion = $producto_father->descripcion_2;
                    $producto_ref_2->ubicacion = $producto_father->ubicacion;
                    $producto_ref_2->imagen_frente = $producto_father->imagen_frente;
                    $producto_ref_2->imagen_trasero = $producto_father->imagen_trasero;
                    $producto_ref_2->imagen_perfil = $producto_father->imagen_perfil;
                    $producto_ref_2->imagen_bolsillo = $producto_father->imagen_bolsillo;
                    $producto_ref_2->tono = $producto_father->tono;
                    $producto_ref_2->intensidad_proceso_seco = $producto_father->intensidad_proceso_seco;
                    $producto_ref_2->atributo_no_1 = $producto_father->atributo_no_1;
                    $producto_ref_2->atributo_no_2 = $producto_father->atributo_no_2;
                    $producto_ref_2->atributo_no_3 = $producto_father->atributo_no_3;
                    $producto_ref_2->precio_lista = $producto_father->precio_lista_2;
                    $producto_ref_2->precio_venta_publico = $producto_father->precio_venta_publico_2;
                    $producto_ref_2->min = $producto_father->min;
                    $producto_ref_2->max = $producto_father->max;

                    $producto_ref_2->save();

                    //Asigar los SKU a la nueva referencia
                    $min = $producto_ref_2->min;
                    $max = $producto_ref_2->max;
                    $array = array("a" => 'A', "b" => 'B', "c" => 'C', "d" => 'D', "e" => 'E', "f" => 'F', "g" => 'G', "h" => 'H');
                    $res = array_keys($array);
                    $result = array_search($min, $res);
                    $result2 = array_search($max, $res);
                    $tallas = array_slice($array, $result, $result2);

                    $a = (array_key_exists("a", $tallas) ? $tallas['a'] : 0);
                    $b = (array_key_exists("b", $tallas) ? $tallas['b'] : 0);
                    $c = (array_key_exists("c", $tallas) ? $tallas['c'] : 0);
                    $d = (array_key_exists("d", $tallas) ? $tallas['d'] : 0);
                    $e = (array_key_exists("e", $tallas) ? $tallas['e'] : 0);
                    $f = (array_key_exists("f", $tallas) ? $tallas['f'] : 0);
                    $g = (array_key_exists("g", $tallas) ? $tallas['g'] : 0);
                    $h = (array_key_exists("h", $tallas) ? $tallas['h'] : 0);

                    $sku_a = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $a)->get()->last();

                    $sku_b = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $b)->get()->last();

                    $sku_c = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $c)->get()->last();

                    $sku_d = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $d)->get()->last();

                    $sku_e = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $e)->get()->last();

                    $sku_f = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $f)->get()->last();

                    $sku_g = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $g)->get()->last();

                    $sku_h = SKU::where('producto_id', $producto_ref_2->referencia_father)
                        ->where('talla', $h)->get()->last();


                    if (is_object($sku_a)) {
                        $sku_a->producto_id = $producto_ref_2->id;
                        $sku_a->save();
                    }

                    if (is_object($sku_b)) {
                        $sku_b->producto_id = $producto_ref_2->id;
                        $sku_b->save();
                    }
                    if (is_object($sku_c)) {
                        $sku_c->producto_id = $producto_ref_2->id;
                        $sku_c->save();
                    }
                    if (is_object($sku_d)) {
                        $sku_d->producto_id = $producto_ref_2->id;
                        $sku_d->save();
                    }
                    if (is_object($sku_e)) {
                        $sku_e->producto_id = $producto_ref_2->id;
                        $sku_e->save();
                    }
                    if (is_object($sku_f)) {
                        $sku_f->producto_id = $producto_ref_2->id;
                        $sku_f->save();
                    }
                    if (is_object($sku_g)) {
                        $sku_g->producto_id = $producto_ref_2->id;
                        $sku_g->save();
                    }
                    if (is_object($sku_h)) {
                        $sku_h->producto_id = $producto_ref_2->id;
                        $sku_h->save();
                    }

                    //asignar uno genero
                    $sku_general = SKU::where('referencia_producto', $producto_ref_2->referencia_producto)
                        // ->where('producto_id', $producto_father->id)
                        ->where('talla', 'General')
                        ->get()->last();
                    // print_r($sku_general);
                    // $data = [
                    //     'code' => 200,
                    //     'status' => 'success',
                    //     'sku_general' => $sku_general
                    // ];
                    // die();
                    // return response()->json($data, $data['code']);

                    $sku_general->producto_id = $producto_ref_2->id;
                    // $sku_general->referencia_producto = $producto_ref_2->referencia_producto;
                    // $sku_general->talla = 'General';
                    $sku_general->save();

                    //asignar curva a la referencia 2
                    $curva = CurvaProducto::where('producto_id', $producto_father->id)
                        ->where('producto_padre', $producto_father->id)->get()->last();

                    if (is_object($curva)) {
                        $curva->producto_id = $producto_ref_2->id;
                        $curva->curva_ref_2 = "";
                        $curva->save();
                    }

                    //Quitar todo rastro de referencia 2 en el registro de la tabla de producto.
                    $producto_father->referencia_producto_2 = Null;
                    $producto_father->descripcion_2 = Null;
                    $producto_father->precio_lista_2 = Null;
                    $producto_father->precio_venta_publico_2 = Null;
                    $producto_father->save();
                }

                $select = DB::select("SHOW TABLE STATUS LIKE 'almacen'");
                $nextId = $select[0]->Auto_increment;
                // $almacen_detalle = AlmacenDetalle::where('almacen_id', $nextId)->first();
                // $total = $almacen_detalle->total;

                $corte->fase = 'Almacen';
                $corte->save();

                $almacen->producto_id = $producto_id;
                $almacen->corte_id = $corte_id;
                $almacen->user_id = \auth()->user()->id;

                // $almacen->total = $total;
                // $almacen->usado_curva = 0;

                $almacen->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'almacen' => $almacen,
                    // 'sku_general' => $sku_general
                ];
            }
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
        $almacen_id = $request->input('almacen_id');
        $producto_id = $request->input('producto_id');
        $codigo_entrada = $request->input('codigo_entrada');
        $sec = $request->input('sec');
        $fecha_entrada = $request->input('fecha');

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

        $almacen_detalle = new AlmacenDetalle();

        if (empty($almacen_id)) {
            //sacar next autogenerated ID
            $select = DB::select("SHOW TABLE STATUS LIKE 'almacen'");
            $nextId = $select[0]->Auto_increment;
            $almacen_detalle->almacen_id = $nextId;
        } else {
            $almacen_detalle->almacen_id = $almacen_id;

            $almacen = Almacen::find($almacen_id);
            $total_anterior = $almacen->total;
            $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l + $total_anterior;
            $almacen->total = $total;
            $almacen->save();
        }

        $almacen_detalle->a = $a;
        $almacen_detalle->b = $b;
        $almacen_detalle->c = $c;
        $almacen_detalle->d = $d;
        $almacen_detalle->e = $e;
        $almacen_detalle->f = $f;
        $almacen_detalle->g = $g;
        $almacen_detalle->h = $h;
        $almacen_detalle->i = $i;
        $almacen_detalle->j = $j;
        $almacen_detalle->k = $k;
        $almacen_detalle->l = $l;
        $almacen_detalle->producto_id = $producto_id;
        $almacen_detalle->codigo_entrada = $codigo_entrada;
        $almacen_detalle->sec = $sec + 0.01;
        $almacen_detalle->fecha_entrada = $fecha_entrada;
        $almacen_detalle->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        $almacen_detalle->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'detalle' => $almacen_detalle

        ];

        return response()->json($data, $data['code']);
    }

    public function cantidad(Request $request)
    {
        $validate = $request->validate([
            'corte_id' => 'required'
        ]);

        if (empty($validate)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $corte_id = $request->input('corte_id');

            $corte = Corte::find($corte_id);
            $cantidad_total = $corte['total'];

            $perdida = Perdida::where('corte_id', 'LIKE', "$corte_id")
                ->where('tipo_perdida', 'LIKE', 'Normal')
                // ->whereIn('fase', ['Terminacion', 'Terminacion o almacen'])
                ->select('id')->get();
            $perdida_id = array();

            $longitud = count($perdida);

            for ($i = 0; $i < $longitud; $i++) {
                array_push($perdida_id, $perdida[$i]['id']);
            }

            $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            $totales = array();

            $lent = count($talla_perdida);

            for ($i = 0; $i < $lent; $i++) {
                array_push($totales, $talla_perdida[$i]['total']);
            }
            $cant_perdida = array_sum($totales);

            $cantidad_recibida = Recepcion::where('corte_id', $corte_id)
                ->get()->last();
            $total_recibido = $cantidad_recibida['total_recibido'];

            // $recepcion = Recepcion::where('corte_id', 'LIKE', "$corte_id")->get()->last();
            // $total_recibido = $recepcion['total_recibido'];

            $alm_id = $request->input('almacen_id');

            $tallasAlmacen = AlmacenDetalle::where('almacen_id', $alm_id)->get();

            $real_terminacion =  $total_recibido - $tallasAlmacen->sum('total');

            $data = [
                'code' => 200,
                'status' => 'success',
                'total_cortado' => $cantidad_total,
                'perdidas' => $cant_perdida,
                'total_recibido' => $total_recibido,
                'real_terminacion' => $real_terminacion

            ];
        }
        return \response()->json($data, $data['code']);
    }

    public function almacenes()
    {
        $almacen = DB::table('almacen')->join('corte', 'almacen.corte_id', '=', 'corte.id')
            ->join('producto', 'almacen.producto_id', '=', 'producto.id')
            ->join('users', 'almacen.user_id', '=', 'users.id')
            ->select([
                'almacen.id', 'almacen.total', 'corte.numero_corte', 'corte.id as corte_id', 'corte.total as totalCorte',
                'corte.fase', 'producto.referencia_producto', 'users.name', 'users.surname',
                'producto.ubicacion'
            ]);

        return DataTables::of($almacen)
            ->addColumn('Expandir', function ($almacen) {
                return "";
            })
            ->editColumn('name', function ($almacen) {
                return "$almacen->name $almacen->surname";
            })
            ->editColumn('ubicacion', function ($almacen) {
                
                if(empty($almacen->ubicacion)){
                    return 'Sin asignar';
                } else {
                    return $almacen->ubicacion;
                } 
            })
            // ->editColumn('totalCorte', function ($almacen) {
            //     //perdidas
            //     $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            //     ->where('corte_id', $almacen->corte_id)->select('id')->get();

            //     $perdidas = array();

            //     $longitudPerdida = count($perdida);

            //     for ($i = 0; $i < $longitudPerdida; $i++) {
            //         array_push($perdidas, $perdida[$i]['id']);
            //     }

            //     $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();

            //     return $almacen->totalCorte;
            // })
            ->editColumn('total', function ($almacen) {
                $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
                    ->where('corte_id', $almacen->corte_id)->select('id')->get();

                $segundas = array();

                $longitudPerdida = count($segunda);

                for ($i = 0; $i < $longitudPerdida; $i++) {
                    array_push($segundas, $segunda[$i]['id']);
                }

                $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get();


                $detalle = AlmacenDetalle::where('almacen_id', $almacen->id)->get();
                return $detalle->sum('total') + $tallasSegundas->sum('total');
            })
            ->addColumn('Opciones', function ($almacen) {
                return
                    '<button id="btnEdit" onclick="mostrar(' . $almacen->id . ')" class="btn btn-primary btn-sm" ><i class="fas fa-list-alt"></i></button>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function atributoAlmacen()
    {
        $almacen = DB::table('almacen')->join('corte', 'almacen.corte_id', '=', 'corte.id')
            ->join('producto', 'almacen.producto_id', '=', 'producto.id')
            ->join('users', 'almacen.user_id', '=', 'users.id')
            ->select([
                'almacen.id', 'almacen.total', 'corte.numero_corte', 'corte.id as corte_id', 'corte.total as totalCorte',
                'corte.fase', 'producto.referencia_producto', 'users.name', 'users.surname'
            ]);

        return DataTables::of($almacen)
            ->addColumn('Expandir', function ($almacen) {
                return "";
            })
            ->editColumn('name', function ($almacen) {
                return "$almacen->name $almacen->surname";
            })

            ->editColumn('total', function ($almacen) {
                $detalle = AlmacenDetalle::where('almacen_id', $almacen->id)->get();
                return $detalle->sum('total');
            })
            ->addColumn('Opciones', function ($almacen) {
                return
                    '<button id="btnEdit" onclick="mostrar(' . $almacen->id . ')" class="btn btn-warning btn-sm" ><i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $almacen->id . ')" class="btn btn-danger btn-sm ml-2"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function corte_detalle($id)
    {
        $corte = DB::table('tallas')->join('corte', 'tallas.corte_id', '=', 'corte.id')
            ->select([
                'tallas.id', 'tallas.total', 'tallas.a', 'tallas.b', 'tallas.c',
                'tallas.d', 'tallas.e', 'tallas.f', 'tallas.g', 'tallas.h', 'tallas.i',
                'tallas.j', 'tallas.k', 'tallas.l'
            ])->where('corte_id', 'LIKE', $id);

        return DataTables::of($corte)
            ->make(true);
    }

    public function show($id)
    {

        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Definir Atributos')
            ->first();
        if (Auth::user()->role != 'Administrador') {
            if ($user_login->modificar == 0 || $user_login->modificar == null) {
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
        }
        $almacen = Almacen::find($id)->load('producto')->load('corte');
        $detalle = AlmacenDetalle::where('almacen_id', $almacen->id)->get();
        $corte_id =  $almacen->corte_id;

        $tallas = Talla::where('corte_id', $almacen->corte->id)->first();

        $recepcion  = Recepcion::where('corte_id', $almacen->corte->id)->get()->last();
        $lavanderia  = Lavanderia::where('corte_id', $almacen->corte->id)->get()->last();

        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('corte_id', $corte_id)->select('id')->get();

        $perdidas = array();

        $longitudPerdida = count($perdida);

        for ($i = 0; $i < $longitudPerdida; $i++) {
            array_push($perdidas, $perdida[$i]['id']);
        }

        $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();

        //calcular total real
        $a = $tallas->a - $tallasPerdidas->sum('a');
        $b = $tallas->b - $tallasPerdidas->sum('b');
        $c = $tallas->c - $tallasPerdidas->sum('c');
        $d = $tallas->d - $tallasPerdidas->sum('d');
        $e = $tallas->e - $tallasPerdidas->sum('e');
        $f = $tallas->f - $tallasPerdidas->sum('f');
        $g = $tallas->g - $tallasPerdidas->sum('g');
        $h = $tallas->h - $tallasPerdidas->sum('h');
        $i = $tallas->i - $tallasPerdidas->sum('i');
        $j = $tallas->j - $tallasPerdidas->sum('j');
        $k = $tallas->k - $tallasPerdidas->sum('k');
        $l = $tallas->l - $tallasPerdidas->sum('l');

        //Validacion de numeros negativos
        $a = ($a < 0 ? 0 : $a);
        $b = ($b < 0 ? 0 : $b);
        $c = ($c < 0 ? 0 : $c);
        $d = ($d < 0 ? 0 : $d);
        $e = ($e < 0 ? 0 : $e);
        $f = ($f < 0 ? 0 : $f);
        $g = ($g < 0 ? 0 : $g);
        $h = ($h < 0 ? 0 : $h);
        $i = ($i < 0 ? 0 : $i);
        $j = ($j < 0 ? 0 : $j);
        $k = ($k < 0 ? 0 : $k);
        $l = ($l < 0 ? 0 : $l);
        $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        $pendiente_lavanderia = $almacen->corte->total - $tallasPerdidas->sum('total');
        $pendiente_lavanderia = $pendiente_lavanderia - $lavanderia->total_enviado;

        if (is_object($almacen)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'almacen' => $almacen,
                'detalle' => $detalle,
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
                'total' => $total_real,
                // 'perdida' => $perdida,
                'pen_lavanderia' => $recepcion->pendiente,
                'total_recibido' => $recepcion->total_recibido,
                'pen_produccion' => $pendiente_lavanderia,
                'perdida_x' => $tallasPerdidas->sum('talla_x'),
                'a_alm' => $detalle->sum('a'),
                'b_alm' => $detalle->sum('b'),
                'c_alm' => $detalle->sum('c'),
                'd_alm' => $detalle->sum('d'),
                'e_alm' => $detalle->sum('e'),
                'f_alm' => $detalle->sum('f'),
                'g_alm' => $detalle->sum('g'),
                'h_alm' => $detalle->sum('h'),
                'i_alm' => $detalle->sum('i'),
                'j_alm' => $detalle->sum('j'),
                'k_alm' => $detalle->sum('k'),
                'l_alm' => $detalle->sum('l'),
                'total_alm' => $detalle->sum('total')
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No existe el usuario'
            ];
        }

        return \response()->json($data, $data['code']);
    }


    public function showAlmacen($id)
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Entrada Almacen')
            ->first();
        if (Auth::user()->role != 'Administrador') {
            if ($user_login->modificar == 0 || $user_login->modificar == null) {
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
        }
        $almacen = Almacen::find($id)->load('producto')->load('corte');
        $detalle = AlmacenDetalle::where('almacen_id', $almacen->id)->get();
        $corte_id =  $almacen->corte_id;

        $tallas = Talla::where('corte_id', $almacen->corte->id)->first();

        $recepcion  = Recepcion::where('corte_id', $almacen->corte->id)->get()->last();
        $lavanderia  = Lavanderia::where('corte_id', $almacen->corte->id)->get()->last();

        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('corte_id', $corte_id)->select('id')->get();

        $perdidas = array();

        $longitudPerdida = count($perdida);

        for ($i = 0; $i < $longitudPerdida; $i++) {
            array_push($perdidas, $perdida[$i]['id']);
        }

        $tallasPerdidas = TallasPerdidas::where('talla_x', '0')
            ->whereIn('perdida_id', $perdidas)->get();


        //perdidas produccion
        $perdidaProduccion = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->whereIn('fase',  ['Produccion', 'Procesos secos'])
            ->where('corte_id', $corte_id)->select('id')->get();

        $perdidasProduccion = array();

        // $longitudPerdida = count($perdida);

        for ($i = 0; $i < count($perdidaProduccion); $i++) {
            array_push($perdidasProduccion, $perdidaProduccion[$i]['id']);
        }

        $tallasPerdidas = TallasPerdidas::where('talla_x', '0')
            ->whereIn('perdida_id', $perdidas)->get();

        $tallasPerdidasProd = TallasPerdidas::where('talla_x', '0')
            ->whereIn('perdida_id', $perdidasProduccion)->get();


        $tallasPerdidasX = TallasPerdidas::where('talla_x', '>', '0')
            ->whereIn('perdida_id', $perdidas)->get();

        // $perdidaProduccion = TallasPerdidas::where('talla_x', '0')
        // ->where('fase', 'Produccion')
        // ->whereIn('perdida_id', $perdidas)->get();



        $pendiente_lavanderia = $almacen->corte->total - $tallasPerdidasProd->sum('total') - $tallasPerdidasX->sum('total');
        $pendiente_lavanderia = $pendiente_lavanderia - $lavanderia->total_enviado;

        //segundas
        $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
            ->where('corte_id', $corte_id)->select('id')->get();

        $segundas = array();

        $longitudSegunda = count($segunda);

        for ($i = 0; $i < $longitudSegunda; $i++) {
            array_push($segundas, $segunda[$i]['id']);
        }

        $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get();

        //calcular total real
        $a = $tallas->a - $tallasPerdidas->sum('a') - $tallasSegundas->sum('a');
        $b = $tallas->b - $tallasPerdidas->sum('b') - $tallasSegundas->sum('b');
        $c = $tallas->c - $tallasPerdidas->sum('c') - $tallasSegundas->sum('c');
        $d = $tallas->d - $tallasPerdidas->sum('d') - $tallasSegundas->sum('d');
        $e = $tallas->e - $tallasPerdidas->sum('e') - $tallasSegundas->sum('e');
        $f = $tallas->f - $tallasPerdidas->sum('f') - $tallasSegundas->sum('f');
        $g = $tallas->g - $tallasPerdidas->sum('g') - $tallasSegundas->sum('g');
        $h = $tallas->h - $tallasPerdidas->sum('h') - $tallasSegundas->sum('h');
        $i = $tallas->i - $tallasPerdidas->sum('i') - $tallasSegundas->sum('i');
        $j = $tallas->j - $tallasPerdidas->sum('j') - $tallasSegundas->sum('j');
        $k = $tallas->k - $tallasPerdidas->sum('k') - $tallasSegundas->sum('k');
        $l = $tallas->l - $tallasPerdidas->sum('l') - $tallasSegundas->sum('l');

        //Validacion de numeros negativos
        $a = ($a < 0 ? 0 : $a);
        $b = ($b < 0 ? 0 : $b);
        $c = ($c < 0 ? 0 : $c);
        $d = ($d < 0 ? 0 : $d);
        $e = ($e < 0 ? 0 : $e);
        $f = ($f < 0 ? 0 : $f);
        $g = ($g < 0 ? 0 : $g);
        $h = ($h < 0 ? 0 : $h);
        $i = ($i < 0 ? 0 : $i);
        $j = ($j < 0 ? 0 : $j);
        $k = ($k < 0 ? 0 : $k);
        $l = ($l < 0 ? 0 : $l);
        $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        $real_terminacion =  $recepcion->total_recibido - $detalle->sum('total') - $tallasSegundas->sum('total');
        $total_entrada = $recepcion->total_recibido - $detalle->sum('total') - $tallasSegundas->sum('total')
            - $tallasPerdidasX->sum('talla_x');

        $corte = Corte::find($corte_id);


        if (is_object($almacen)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'almacen' => $almacen,
                'detalle' => $detalle,
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
                'total' => $total_real,
                // 'perdida' => $perdida,
                'pen_lavanderia' => ($recepcion->pendiente < 0) ? 0 : $recepcion->pendiente,
                'total_recibido' => ($recepcion->total_recibido < 0) ? 0 : $recepcion->total_recibido,
                'pen_produccion' => ($pendiente_lavanderia < 0) ? 0 : $pendiente_lavanderia,
                'perdida_x' => $tallasPerdidasX->sum('talla_x'),
                'total_perdidas' => $tallasPerdidas->sum('total'),
                'total_segundas' => $tallasSegundas->sum('total'),
                'a_alm' => $detalle->sum('a') + $tallasSegundas->sum('a'),
                'b_alm' => $detalle->sum('b') + $tallasSegundas->sum('b'),
                'c_alm' => $detalle->sum('c') + $tallasSegundas->sum('c'),
                'd_alm' => $detalle->sum('d') + $tallasSegundas->sum('d'),
                'e_alm' => $detalle->sum('e') + $tallasSegundas->sum('e'),
                'f_alm' => $detalle->sum('f') + $tallasSegundas->sum('f'),
                'g_alm' => $detalle->sum('g') + $tallasSegundas->sum('g'),
                'h_alm' => $detalle->sum('h') + $tallasSegundas->sum('h'),
                'i_alm' => $detalle->sum('i') + $tallasSegundas->sum('i'),
                'j_alm' => $detalle->sum('j') + $tallasSegundas->sum('j'),
                'k_alm' => $detalle->sum('k') + $tallasSegundas->sum('k'),
                'l_alm' => $detalle->sum('l') + $tallasSegundas->sum('l'),
                'total_alm' => $detalle->sum('total') + $tallasSegundas->sum('total'),
                'segundas' => $tallasSegundas,
                'real_terminacion' => ($real_terminacion < 0) ? 0 : $real_terminacion,
                'total_entrada' => ($total_entrada < 0) ? 0 : $total_entrada,
                'tallasPerdidasX' => $tallasPerdidasX,
                'tallasPerdidas' => $tallasPerdidas,
                'total_cortado' => $corte->total
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No existe el usuario'
            ];
        }

        return \response()->json($data, $data['code']);
    }


    public function update(Request $request)
    {
        $validar = $request->validate([
            'corte' => 'required',
            'ubicacion' => 'required',
            // 'tono' => 'required',
            // 'intensidad_proceso_seco' => 'required'
        ]);

        if (empty($validar)) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);

            $corte_id = $request->input('corte');
            $ubicacion = $request->input('ubicacion');
            $tono = $request->input('tono');
            $intensidad_proceso_seco = $request->input('intensidad_proceso_seco');
            $atributo_no_1 = $request->input('atributo_no_1');
            $atributo_no_2 = $request->input('atributo_no_2');
            $atributo_no_3 = $request->input('atributo_no_3');


            $almacen = Almacen::find($id);
            $corte = Corte::find($corte_id);
            $producto_id = $corte['producto_id'];

            if (!empty($ubicacion)) {
                $producto = Product::find($producto_id);

                $producto->ubicacion = $ubicacion;
                $producto->tono = $tono;
                $producto->intensidad_proceso_seco = $intensidad_proceso_seco;
                $producto->atributo_no_1 = $atributo_no_1;
                $producto->atributo_no_2 = $atributo_no_2;
                $producto->atributo_no_3 = $atributo_no_3;
                $producto->producto_terminado = 1;

                $producto->save();
            }


            $corte->fase = 'Almacen';
            $corte->save();

            $almacen->producto_id = $producto_id;
            $almacen->corte_id = $corte_id;
            $almacen->user_id = \auth()->user()->id;
            $almacen->usado_curva = 0;

            $almacen->save();
            $data = [
                'code' => 200,
                'status' => 'success',
                'almacen' => $almacen
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy()
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Definir Atributos')
            ->first();
        if (Auth::user()->role != 'Administrador') {
            if ($user_login->eliminar == 0 || $user_login->eliminar == null) {
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
        }

        // return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $almacen = Almacen::find($id);
        $detalle = AlmacenDetalle::where('almacen_id', $id)->get();
        $corte_id = $almacen['corte_id'];
        $corte = Corte::find($corte_id);

        if (!empty($almacen)) {
            $longitud = count($detalle);

            //actualizar status de la orden pedido
            for ($i = 0; $i < $longitud; $i++) {
                $detalle[$i]->delete();
            }


            $corte->fase = 'Terminacion';
            $corte->save();
            $almacen->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'almacen' => $almacen
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

    public function corteProducto(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            $id = $request->input('idEdit');
        }
        $corte = Corte::find($id);
        $id_producto = $corte['producto_id'];
        $producto = Product::find($id_producto);

        if (is_object($producto)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'referencia' => $producto['referencia_producto'],
                'id' => $producto['id']
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No existe el usuario'
            ];
        }

        return \response()->json($data, $data['code']);
    }

    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('fase', 'LIKE', 'Terminacion')
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function corteSelect(Request $request)
    {
        $corte = Corte::where('fase', 'LIKE', 'Terminacion')
            ->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'cortes' => $corte
        ];


        return response()->json($data);
    }

    public function upload(Request $request)
    {

        //validar la imagen
        $validate = \Validator::make($request->all(), [
            'imagen_frente' => 'image|mimes:jpg,jpeg,png',
            'imagen_trasera' => 'image|mimes:jpg,jpeg,png',
            'imagen_perfil' => 'image|mimes:jpg,jpeg,png',
            'imagen_bolsillo' => 'image|mimes:jpg,jpeg,png'
        ]);
        // Guardar la imagen
        if ($validate->fails()) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            $imagen_frente = $request->file('imagen_frente');
            $imagen_trasero = $request->file('imagen_trasera');
            $imagen_perfil = $request->file('imagen_perfil');
            $imagen_bolsillo = $request->file('imagen_bolsillo');
            $corte_id = $request->input('corte_id');
            $corte_id_edit = $request->input('corte_id_edit');
            $image_name_1 = (!empty($imagen_frente)) ? time() . $imagen_frente->getClientOriginalName() : null;
            $image_name_2 = (!empty($imagen_trasero)) ? time() . $imagen_trasero->getClientOriginalName() : null;
            $image_name_3 = (!empty($imagen_perfil)) ? time() . $imagen_perfil->getClientOriginalName() : null;
            $image_name_4 = (!empty($imagen_bolsillo)) ? time() . $imagen_bolsillo->getClientOriginalName() : null;

            if (empty($corte_id) && !empty($corte_id_edit)) {
                $corte_id = $corte_id_edit;

                $corte = Corte::find($corte_id);
                $producto_id = $corte->producto_id;
                $producto = Product::find($producto_id);
                $producto->imagen_frente = $image_name_1;
                $producto->imagen_trasero = $image_name_2;
                $producto->imagen_perfil = $image_name_3;
                $producto->imagen_bolsillo = $image_name_4;
                $producto->save();
            } else {
                $corte = Corte::find($corte_id);
                $producto_id = $corte->producto_id;
                $producto = Product::find($producto_id);
                $producto->imagen_frente = $image_name_1;
                $producto->imagen_trasero = $image_name_2;
                $producto->imagen_perfil = $image_name_3;
                $producto->imagen_bolsillo = $image_name_4;
                $producto->save();
            }

            if (!empty($imagen_frente)) {
                \Storage::disk('producto')->put($image_name_1, \File::get($imagen_frente));
            }
            if (!empty($imagen_trasero)) {
                \Storage::disk('producto')->put($image_name_2, \File::get($imagen_trasero));
            }
            if (!empty($imagen_perfil)) {
                \Storage::disk('producto')->put($image_name_3, \File::get($imagen_perfil));
            }
            if (!empty($imagen_bolsillo)) {
                \Storage::disk('producto')->put($image_name_4, \File::get($imagen_bolsillo));
            }

            $data = [
                'code' => 200,
                'status' => 'success',
                'frente' => $image_name_1,
                'trasero' => $image_name_2,
                'perfil' => $image_name_3,
                'bolsillo' => $image_name_4
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function verificar_ref(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            $id = $request->input('idEdit');
        }

        $corte_pendiente = Corte::find($id);
        $recepcion  = Recepcion::where('corte_id', $id)->get()->last();
        $lavanderia  = Lavanderia::where('corte_id', $id)->get()->last();

        $producto_id = $corte_pendiente->producto_id;

        $producto = Product::find($producto_id);

        //buscar cortes con la misma referencia producto
        $corte = Corte::where('id', $id)
            // ->where('fase', 'LIKE', 'Terminacion')
            ->select('id', 'total')->get();

        $cortes = array();

        $longitud = count($corte);

        for ($i = 0; $i < $longitud; $i++) {
            array_push($cortes, $corte[$i]['id']);
        }
        //buscar cantidades de tallas con el array de id de cortes
        $tallas = Talla::where('corte_id', $id)->first();
        // echo $tallas;
        // die();

        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('corte_id', $id)->select('id')->get();

        $perdidas = array();

        $longitudPerdida = count($perdida);

        for ($i = 0; $i < $longitudPerdida; $i++) {
            array_push($perdidas, $perdida[$i]['id']);
        }

        $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get();

        //SEGUNDA
        $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
            ->where('producto_id', $producto_id)->select('id')->get();

        $segundas = array();

        $longitudSegunda = count($segunda);

        for ($i = 0; $i < $longitudSegunda; $i++) {
            array_push($segundas, $segunda[$i]['id']);
        }

        $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');

        //producto
        $producto = Product::find($producto_id);

        //calcular total real
        $a = $tallas->a - $tallasPerdidas->sum('a');
        $b = $tallas->b - $tallasPerdidas->sum('b');
        $c = $tallas->c - $tallasPerdidas->sum('c');
        $d = $tallas->d - $tallasPerdidas->sum('d');
        $e = $tallas->e - $tallasPerdidas->sum('e');
        $f = $tallas->f - $tallasPerdidas->sum('f');
        $g = $tallas->g - $tallasPerdidas->sum('g');
        $h = $tallas->h - $tallasPerdidas->sum('h');
        $i = $tallas->i - $tallasPerdidas->sum('i');
        $j = $tallas->j - $tallasPerdidas->sum('j');
        $k = $tallas->k - $tallasPerdidas->sum('k');
        $l = $tallas->l - $tallasPerdidas->sum('l');

        //Validacion de numeros negativos
        $a = ($a < 0 ? 0 : $a);
        $b = ($b < 0 ? 0 : $b);
        $c = ($c < 0 ? 0 : $c);
        $d = ($d < 0 ? 0 : $d);
        $e = ($e < 0 ? 0 : $e);
        $f = ($f < 0 ? 0 : $f);
        $g = ($g < 0 ? 0 : $g);
        $h = ($h < 0 ? 0 : $h);
        $i = ($i < 0 ? 0 : $i);
        $j = ($j < 0 ? 0 : $j);
        $k = ($k < 0 ? 0 : $k);
        $l = ($l < 0 ? 0 : $l);

        $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
        $pendiente_lavanderia = $corte_pendiente->total - $tallasPerdidas->sum('total');
        $pendiente_lavanderia = $pendiente_lavanderia - $lavanderia->total_enviado;

        if (!empty($producto)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $producto,
                'id' => $id,
                'referencia' => $producto->referencia_producto,
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
                'total' => $total_real,
                // 'pen_lavanderia' => ($recepcion->pendiente < 0 ) ? 0 : $recepcion->pendiente,
                'pen_produccion' => ($pendiente_lavanderia < 0) ? 0 : $pendiente_lavanderia,
                'perdida_x' => $tallasPerdidas->sum('talla_x')
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'El producto no fue encontrado'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function validar(Request $request)
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
        $id = $request->input('almacen_id');

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
        $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

        if (!empty($id)) {
            $detalle = AlmacenDetalle::where('almacen_id', $id)->get();

            $data = [
                'code' => 200,
                'status' => 'success',
                'a' => $a + $detalle->sum('a'),
                'b' => $b + $detalle->sum('b'),
                'c' => $c + $detalle->sum('c'),
                'd' => $d + $detalle->sum('d'),
                'e' => $e + $detalle->sum('e'),
                'f' => $f + $detalle->sum('f'),
                'g' => $g + $detalle->sum('g'),
                'h' => $h + $detalle->sum('h'),
                'i' => $i + $detalle->sum('i'),
                'j' => $j + $detalle->sum('j'),
                'k' => $k + $detalle->sum('k'),
                'l' => $l + $detalle->sum('l'),
                'total' => $total,
                'a_alm' => $detalle->sum('a'),
                'b_alm' => $detalle->sum('b'),
                'c_alm' => $detalle->sum('c'),
                'd_alm' => $detalle->sum('d'),
                'e_alm' => $detalle->sum('e'),
                'f_alm' => $detalle->sum('f'),
                'g_alm' => $detalle->sum('g'),
                'h_alm' => $detalle->sum('h'),
                'i_alm' => $detalle->sum('i'),
                'j_alm' => $detalle->sum('j'),
                'k_alm' => $detalle->sum('k'),
                'l_alm' => $detalle->sum('l'),
                'total_alm' => $detalle->sum('total')

            ];
        } else {
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
                'total' => $total,
            ];
        }

        return response()->json($data, $data['code']);
    }

    function calcularTotales(Request $request)
    {
        $id = $request->input('almacen_id');

        if (!empty($id)) {
            $detalle = AlmacenDetalle::where('almacen_id', $id)->get();

            $data = [
                'code' => 200,
                'status' => 'success',
                'a' => $detalle->sum('a'),
                'b' => $detalle->sum('b'),
                'c' => $detalle->sum('c'),
                'd' => $detalle->sum('d'),
                'e' => $detalle->sum('e'),
                'f' => $detalle->sum('f'),
                'g' => $detalle->sum('g'),
                'h' => $detalle->sum('h'),
                'i' => $detalle->sum('i'),
                'j' => $detalle->sum('j'),
                'k' => $detalle->sum('k'),
                'l' => $detalle->sum('l'),
                'total' => $detalle->sum('total')

            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'success',
                'message' => 'No hay nada que buscar'
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function getDigits()
    {
        $almacenDetalle = AlmacenDetalle::orderBy('sec', 'desc')->first();

        if (\is_object($almacenDetalle)) {
            $sec = $almacenDetalle->sec;
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

    public function imprimir($id)
    {
        $almacen_detalle = AlmacenDetalle::find($id)->load('producto');
        $almacen_detalle->impreso = 1;
        $almacen_detalle->fecha_impreso = date('Y/m/d h:i:s');
        $almacen_detalle->save();

        $producto  = $almacen_detalle->producto;
        $almacen_id = $almacen_detalle->almacen_id;
        $almacen_detalle->fecha_impreso =  date("d-m-20y h:i:s", strtotime($almacen_detalle->fecha_impreso));
        $pdf = \PDF::loadView('sistema.almacen.DocEA', \compact('almacen_detalle', 'producto'));
        return $pdf->download('EADoc.pdf');
        return View('sistema.almacen.DocEA', \compact('almacen_detalle', 'producto'));
    }

    public function atributos()
    {
        $categorias = AtributosProducto::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'atributos' => $categorias
        ];
        return response()->json($data, $data['code']);
    }

    public function storeAtributo(Request $request)
    {

        $validar = $request->validate([
            'indice' => 'required',
            'nombre' => 'required'
        ]);

        if (empty($validar)) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $indice = $request->input('indice');
            $nombre = $request->input('nombre');

            $categoria = new AtributosProducto();

            $categoria->indice = $indice;
            $categoria->nombre = $nombre;

            $categoria->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'atributo' => $categoria
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroyAtributo($id)
    {
        $categoria = AtributosProducto::find($id);

        if (is_object($categoria)) {
            $categoria->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'categoria' => $categoria
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

    public function ubicaciones()
    {
        $categorias = Ubicaciones::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'ubicaciones' => $categorias
        ];
        return response()->json($data, $data['code']);
    }

    public function destroyUbicacion($id)
    {
        $categoria = Ubicaciones::find($id);

        if (is_object($categoria)) {
            $categoria->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'categoria' => $categoria
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

    public function storeUbicacion(Request $request)
    {

        $validar = $request->validate([
            'ubicacion' => 'required'
        ]);

        if (empty($validar)) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $nombre = $request->input('ubicacion');

            $categoria = new Ubicaciones();

            $nombre = trim($nombre, '_');

            $categoria->ubicacion = strtoupper($nombre);

            $categoria->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'ubicacion' => $categoria
            ];
        }

        return response()->json($data, $data['code']);
    }
}

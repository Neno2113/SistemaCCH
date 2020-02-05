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
            $ubicacion = $request->input('ubicacion');
            $tono = $request->input('tono');
            $intensidad_proceso_seco = $request->input('intensidad_proceso_seco');
            $atributo_no_1 = $request->input('atributo_no_1');
            $atributo_no_2 = $request->input('atributo_no_2');
            $atributo_no_3 = $request->input('atributo_no_3');
            // $a = $request->input('a');
            // $b = $request->input('b');
            // $c = $request->input('c');
            // $d = $request->input('d');
            // $e = $request->input('e');
            // $f = $request->input('f');
            // $g = $request->input('g');
            // $h = $request->input('h');
            // $i = $request->input('i');
            // $j = $request->input('j');
            // $k = $request->input('k');
            // $l = $request->input('l');


            //validaciones
            // $a = intval(trim($a, "_"));
            // $b = intval(trim($b, "_"));
            // $c = intval(trim($c, "_"));
            // $d = intval(trim($d, "_"));
            // $e = intval(trim($e, "_"));
            // $f = intval(trim($f, "_"));
            // $g = intval(trim($g, "_"));
            // $h = intval(trim($h, "_"));
            // $i = intval(trim($i, "_"));
            // $j = intval(trim($j, "_"));
            // $k = intval(trim($k, "_"));
            // $l = intval(trim($l, "_"));

            $almacen = new Almacen();
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
            // $almacen->a = $a;
            // $almacen->b = $b;
            // $almacen->c = $c;
            // $almacen->d = $d;
            // $almacen->e = $e;
            // $almacen->f = $f;
            // $almacen->g = $g;
            // $almacen->h = $h;
            // $almacen->i = $i;
            // $almacen->j = $j;
            // $almacen->k = $k;
            // $almacen->l = $l;
            // $almacen->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
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
                ->whereIn('fase', ['Terminacion', 'Terminacion o almacen'])
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

            $data = [
                'code' => 200,
                'status' => 'success',
                'total_cortado' => $cantidad_total,
                'perdidas' => $cant_perdida,
                'total_recibido' => $total_recibido

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
                'almacen.id', 'almacen.total', 'corte.numero_corte', 'corte.total as totalCorte',
                'corte.fase', 'producto.referencia_producto', 'users.name', 'users.surname'
            ]);

        return DataTables::of($almacen)
            ->addColumn('Expandir', function ($almacen) {
                return "";
            })
            ->editColumn('name', function ($almacen) {
                return "$almacen->name $almacen->surname";
            })
            ->addColumn('Opciones', function ($almacen) {
                return
                    '<button id="btnEdit" onclick="mostrar(' . $almacen->id . ')" class="btn btn-primary btn-sm" ><i class="fas fa-list-alt"></i></button>' .
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
        $almacen = Almacen::find($id)->load('producto')->load('corte');
        $detalle = AlmacenDetalle::where('almacen_id', $almacen->id)->get();

        $tallas = Talla::where('corte_id', $almacen->corte->id)->first();

        $recepcion  = Recepcion::where('corte_id', $almacen->corte->id)->get()->last();
        $lavanderia  = Lavanderia::where('corte_id', $almacen->corte->id)->get()->last();

        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('corte_id', $id)->select('id')->get();

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

        $pendiente_lavanderia = $almacen->corte->total;
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
                'pen_lavanderia' => $recepcion->pendiente,
                'total_recibido' => $recepcion->total_recibido,
                'pen_produccion' => $pendiente_lavanderia,
                'perdida_x' => $tallasPerdidas->sum('talla_x')
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
            'tono' => 'required',
            'intensidad_proceso_seco' => 'required'
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
            $almacen->a = $a;
            $almacen->b = $b;
            $almacen->c = $c;
            $almacen->d = $d;
            $almacen->e = $e;
            $almacen->f = $f;
            $almacen->g = $g;
            $almacen->h = $h;
            $almacen->i = $i;
            $almacen->j = $j;
            $almacen->k = $k;
            $almacen->l = $l;
            $almacen->total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
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

    public function destroy($id)
    {
        $almacen = Almacen::find($id);
        $corte_id = $almacen['corte_id'];
        $corte = Corte::find($corte_id);

        if (!empty($almacen)) {
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
                ->orwhere('fase', 'LIKE', 'Almacen')
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function upload(Request $request)
    {

        //validar la imagen
        $validate = \Validator::make($request->all(), [
            'imagen_frente' => 'required|image|mimes:jpg,jpeg,png',
            'imagen_trasera' => 'required|image|mimes:jpg,jpeg,png',
            'imagen_perfil' => 'required|image|mimes:jpg,jpeg,png',
            'imagen_bolsillo' => 'required|image|mimes:jpg,jpeg,png'
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
            $image_name_1 = time() . $imagen_frente->getClientOriginalName();
            $image_name_2 = time() . $imagen_trasero->getClientOriginalName();
            $image_name_3 = time() . $imagen_perfil->getClientOriginalName();
            $image_name_4 = time() . $imagen_bolsillo->getClientOriginalName();

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

            \Storage::disk('producto')->put($image_name_1, \File::get($imagen_frente));
            \Storage::disk('producto')->put($image_name_2, \File::get($imagen_trasero));
            \Storage::disk('producto')->put($image_name_3, \File::get($imagen_perfil));
            \Storage::disk('producto')->put($image_name_4, \File::get($imagen_bolsillo));

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
        $pendiente_lavanderia = $corte_pendiente->total;
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
                'pen_lavanderia' => $recepcion->pendiente,
                'pen_produccion' => $pendiente_lavanderia,
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
            'total' => $total
        ];

        return response()->json($data, $data['code']);
    }
}

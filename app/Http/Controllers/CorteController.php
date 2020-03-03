<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rollos;
use App\Corte;
use App\Talla;
use App\Product;
use App\CurvaProducto;
use App\AlmacenDetalle;
use App\ordenPedidoDetalle;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CorteController extends Controller
{

    public function store(Request $request)
    {
        $validar = $request->validate([
            'numero_corte' => 'required',
            'producto' => 'required',
            'no_marcada' => 'required|unique:corte',
            'fecha_entrega' => 'required',
            'aprovechamiento' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $numero_corte = $request->input('numero_corte');
            $producto_id = $request->input('producto');
            // $fecha_corte = $request->input('fecha_corte');
            $no_marcada = $request->input('no_marcada');
            $ancho_marcada = $request->input('ancho_marcada');
            $largo_marcada = $request->input('largo_marcada');
            $aprovechamiento = $request->input('aprovechamiento');
            $fecha_entrega = $request->input('fecha_entrega');

            $sec = $request->input('sec');
            $fase = 'Produccion';

            $date = date('20y-m-d');

            $corte = new Corte();

            $corte->numero_corte = $numero_corte;
            $corte->producto_id = $producto_id;
            $corte->user_id = \auth()->user()->id;
            $corte->fecha_corte = $date;
            $corte->no_marcada = $no_marcada;
            $corte->largo_marcada = $largo_marcada;
            $corte->ancho_marcada = $ancho_marcada;
            $corte->aprovechamiento = trim($aprovechamiento, '%');
            $corte->fase = $fase;
            $corte->sec = $sec + 0.01;
            $corte->fecha_entrega = $fecha_entrega;

            $corte->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function cortes()
    {
        $cortes = DB::table('corte')->join('users', 'corte.user_id', '=', 'users.id')
            ->join('producto', 'corte.producto_id', '=', 'producto.id')
            ->select(['corte.id', 'users.name', 'users.surname', 'corte.numero_corte', 'producto.referencia_producto'
            , 'producto.referencia_producto_2', 'corte.fecha_corte', 'corte.no_marcada', 'corte.ancho_marcada', 'corte.largo_marcada',
            'corte.aprovechamiento', 'corte.fase', 'corte.total', 'corte.fecha_entrega']);

        return DataTables::of($cortes)
            ->addColumn('Expandir', function ($corte) {
                return "";
            })
            ->editColumn('name', function ($corte) {
                return "$corte->name $corte->surname";
            })
            ->editColumn('fecha_corte', function ($corte) {
                return date("d-m-20y", strtotime($corte->fecha_corte));
            })
            ->addColumn('Opciones', function ($corte) {
                if($corte->fase != "Produccion"){
                    return '<button id="btnEdit" onclick="mostrar(' . $corte->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>';
                }else{
                    return '<button id="btnEdit" onclick="mostrar(' . $corte->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $corte->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
                }

            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }



    public function rollos()
    {
        $cond = null;
        $rollos = DB::table('rollos')->join('tela', 'rollos.id_tela', '=', 'tela.id')
            ->select(['rollos.id', 'tela.referencia', 'rollos.codigo_rollo', 'rollos.longitud_yarda', 'rollos.num_tono', 'rollos.corte_utilizado']);
            // ->where('corte_utilizado', $cond);

        return DataTables::of($rollos)
            ->addColumn('Editar', function ($rollo) {
                if($rollo->corte_utilizado == NULL || $rollo->corte_utilizado == ""){
                    return '<button id="btnEdit" onclick="asignar(' . $rollo->id . ')" class="btn btn-warning btn-sm mr-1"  > <i class="fas fa-marker"></i></button>';
                }else{
                 return '<button id="btnEdit" onclick="remover(' . $rollo->id . ')" class="btn btn-danger btn-sm ml-1" ><i class="fas fa-eraser"></i></button>';
                }

            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
    }


    public function show($id)
    {
        $corte = Corte::find($id)->load('producto');
        $tallas = Talla::where('corte_id', $id)->get();
        $rollos = Rollos::where('corte_utilizado', $corte->numero_corte)->get();

        if (is_object($corte)) {
            $curva = CurvaProducto::where('producto_id', $corte->producto->id)->get()->first();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte,
                'a' => $tallas->sum('a'),
                'b' => $tallas->sum('b'),
                'c' => $tallas->sum('c'),
                'd' => $tallas->sum('d'),
                'e' => $tallas->sum('e'),
                'f' => $tallas->sum('f'),
                'g' => $tallas->sum('g'),
                'h' => $tallas->sum('h'),
                'i' => $tallas->sum('i'),
                'j' => $tallas->sum('j'),
                'k' => $tallas->sum('a'),
                'l' => $tallas->sum('a'),
                'rollos' => $rollos,
                'curva' => $curva
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
            'producto' => 'required',
            'aprovechamiento' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $producto_id = $request->input('producto');
            $producto_id_ref_2 = $request->input('producto');
            $no_marcada = $request->input('no_marcada');
            $ancho_marcada = $request->input('ancho_marcada');
            $largo_marcada = $request->input('largo_marcada');
            $aprovechamiento = $request->input('aprovechamiento');
            $fecha_entrega = $request->input('fecha_entrega');
            $corte = Corte::find($id);

            $corte->producto_id = $producto_id;
            $corte->producto_id_ref_2 = $producto_id;
            $corte->no_marcada = $no_marcada;
            $corte->ancho_marcada = $ancho_marcada;
            $corte->largo_marcada = $largo_marcada;
            $corte->aprovechamiento = trim($aprovechamiento, '%');
            $corte->fecha_entrega = $fecha_entrega;

            $corte->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $corte = Corte::find($id);

        if (!empty($corte)) {
            $corte->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
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

    public function getDigits()
    {
        $corte = Corte::orderBy('sec', 'desc')->first();

        if (\is_object($corte)) {
            $sec = $corte->sec;
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

    public function selectProduct(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select("id", "referencia_producto")
                ->where('referencia_producto', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }


    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::join('producto', 'corte.producto_id', '=', 'producto.id')
                ->select("corte.id", "corte.numero_corte", "corte.fase", "producto.referencia_producto")
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }


    public function testSelect2(){
        $productos = Product::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'productos' => $productos
        ];

        return response()->json($data, $data['code']);
    }

    public function asignar($id, Request $request)
    {
        $rollo = Rollos::find($id);

        $numero_corte = $request->input('numero_corte');

        if (!empty($rollo)) {
            $corte_utilizado = $rollo->corte_utilizado;

            if ($corte_utilizado == NULL || $corte_utilizado == '') {
                $rollo->corte_utilizado = $numero_corte;

                $rollo->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollo' => $rollo
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Rollo ya asignado!!'
                ];
             }
        } else {

            $data = [
                'code' => 500,
                'status' => 'error',
                'message' => 'Ocurrio un error!!'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function remover($id, Request $request)
    {
        $rollo = Rollos::find($id);

        $numero_corte = $request->input('numero_corte');

        if (!empty($rollo)) {
            $corte_utilizado = $rollo->corte_utilizado;

                $rollo->corte_utilizado = "";

                $rollo->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollo' => $rollo,
                    'corte_utilizado' => $corte_utilizado
                ];

        } else {

            $data = [
                'code' => 500,
                'status' => 'error',
                'message' => 'Ocurrio un error!!'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function corte_home(){
        $corte = Corte::where('fase', 'LIKE', 'Produccion')
        ->orwhere('fase', 'LIKE', 'Lavanderia')
        ->orwhere('fase', 'LIKE', 'Terminacion')->count();

        $data = [
            'code' => 200,
            'status' => 'success',
            'corte' => $corte
        ];

        return response()->json($data, $data['code']);
    }

    public function verificarCorte(Request $request){

        $validar = $request->validate([
            'numero_corte' => 'unique:corte',

        ]);
        if(!empty($validar)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => 'Test'
            ];

        }
        return response()->json($data, $data['code']);
    }

    public function verificarReferencia(Request $request){

        $id = $request->input('producto');

        $referencia = Product::find($id);
        $curva = CurvaProducto::where('producto_id', $id)->first();


        $corte = Corte::where('producto_id', $id)->latest()->first();

        $tallasAlmacen = AlmacenDetalle::where('producto_id', $id)->get();

        $tallasOrden = ordenPedidoDetalle::where('producto_id', $id)->get();

        $a_alm = ($tallasAlmacen->sum('a') - $tallasOrden->sum('a') < 0) ? 0 : $tallasAlmacen->sum('a') - $tallasOrden->sum('a');
        $b_alm = ($tallasAlmacen->sum('b') - $tallasOrden->sum('b') < 0) ? 0 : $tallasAlmacen->sum('b') - $tallasOrden->sum('b');
        $c_alm = ($tallasAlmacen->sum('c') - $tallasOrden->sum('c') < 0) ? 0 : $tallasAlmacen->sum('c') - $tallasOrden->sum('c');
        $d_alm = ($tallasAlmacen->sum('d') - $tallasOrden->sum('d') < 0) ? 0 : $tallasAlmacen->sum('d') - $tallasOrden->sum('d');
        $e_alm = ($tallasAlmacen->sum('e') - $tallasOrden->sum('e') < 0) ? 0 : $tallasAlmacen->sum('e') - $tallasOrden->sum('e');
        $f_alm = ($tallasAlmacen->sum('f') - $tallasOrden->sum('f') < 0) ? 0 : $tallasAlmacen->sum('f') - $tallasOrden->sum('f');
        $g_alm = ($tallasAlmacen->sum('g') - $tallasOrden->sum('g') < 0) ? 0 : $tallasAlmacen->sum('g') - $tallasOrden->sum('g');
        $h_alm = ($tallasAlmacen->sum('h') - $tallasOrden->sum('h') < 0) ? 0 : $tallasAlmacen->sum('h') - $tallasOrden->sum('h');
        $i_alm = ($tallasAlmacen->sum('i') - $tallasOrden->sum('i') < 0) ? 0 : $tallasAlmacen->sum('i') - $tallasOrden->sum('i');
        $j_alm = ($tallasAlmacen->sum('j') - $tallasOrden->sum('j') < 0) ? 0 : $tallasAlmacen->sum('j') - $tallasOrden->sum('j');
        $k_alm = ($tallasAlmacen->sum('k') - $tallasOrden->sum('k') < 0) ? 0 : $tallasAlmacen->sum('k') - $tallasOrden->sum('k');
        $l_alm = ($tallasAlmacen->sum('l') - $tallasOrden->sum('l') < 0) ? 0 : $tallasAlmacen->sum('l') - $tallasOrden->sum('l');
        $total_alm = ($tallasAlmacen->sum('total') - $tallasOrden->sum('total') < 0) ? 0 : $tallasAlmacen->sum('total') - $tallasOrden->sum('total');

         //porcentaje alm
        $a_perc = number_format(($a_alm / $total_alm) * 100, 2);
        $b_perc = number_format(($b_alm / $total_alm) * 100, 2);
        $c_perc = number_format(($c_alm / $total_alm) * 100, 2);
        $d_perc = number_format(($d_alm / $total_alm) * 100, 2);
        $e_perc = number_format(($e_alm / $total_alm) * 100, 2);
        $f_perc = number_format(($f_alm / $total_alm) * 100, 2);
        $g_perc = number_format(($g_alm / $total_alm) * 100, 2);
        $h_perc = number_format(($h_alm / $total_alm) * 100, 2);
        $i_perc = number_format(($i_alm / $total_alm) * 100, 2);
        $j_perc = number_format(($j_alm / $total_alm) * 100, 2);
        $k_perc = number_format(($k_alm / $total_alm) * 100, 2);
        $l_perc = number_format(($l_alm / $total_alm) * 100, 2);

        if(!empty($corte)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Existe un corte con esta referencia',
                'corte' => $corte,
                'a' => str_replace('.00', '', $curva->a),
                'b' => str_replace('.00', '', $curva->b),
                'c' => str_replace('.00', '', $curva->c),
                'd' => str_replace('.00', '', $curva->d),
                'e' => str_replace('.00', '', $curva->e),
                'f' => str_replace('.00', '', $curva->f),
                'g' => str_replace('.00', '', $curva->g),
                'h' => str_replace('.00', '', $curva->h),
                'i' => str_replace('.00', '', $curva->i),
                'j' => str_replace('.00', '', $curva->j),
                'k' => str_replace('.00', '', $curva->k),
                'l' => str_replace('.00', '', $curva->l),
                'a_alm'=> $a_alm,
                'b_alm'=> $b_alm,
                'c_alm'=> $c_alm,
                'd_alm'=> $d_alm,
                'e_alm'=> $e_alm,
                'f_alm'=> $f_alm,
                'g_alm'=> $g_alm,
                'h_alm'=> $h_alm,
                'i_alm'=> $i_alm,
                'j_alm'=> $j_alm,
                'k_alm'=> $k_alm,
                'l_alm'=> $l_alm,
                'total_alm'=> $total_alm,
                'a_perc' => $a_perc,
                'b_perc' => $b_perc,
                'c_perc' => $c_perc,
                'd_perc' => $d_perc,
                'e_perc' => $e_perc,
                'f_perc' => $f_perc,
                'g_perc' => $g_perc,
                'h_perc' => $h_perc,
                'i_perc' => $i_perc,
                'j_perc' => $j_perc,
                'k_perc' => $k_perc,
                'l_perc' => $l_perc
            ];

        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No existe un corte con este referencia',
                'a' => str_replace('.00', '', $curva->a),
                'b' => str_replace('.00', '', $curva->b),
                'c' => str_replace('.00', '', $curva->c),
                'd' => str_replace('.00', '', $curva->d),
                'e' => str_replace('.00', '', $curva->e),
                'f' => str_replace('.00', '', $curva->f),
                'g' => str_replace('.00', '', $curva->g),
                'h' => str_replace('.00', '', $curva->h),
                'i' => str_replace('.00', '', $curva->i),
                'j' => str_replace('.00', '', $curva->j),
                'k' => str_replace('.00', '', $curva->k),
                'l' => str_replace('.00', '', $curva->l),
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function updateCurva(Request $request){
        $id = $request->input('referencia');
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

        $curva = CurvaProducto::where('producto_id', $id)->latest()->first();

        if(is_object($curva)){
            $curva->a = $a;
            $curva->b = $b;
            $curva->c = $c;
            $curva->d = $d;
            $curva->e = $e;
            $curva->f = $f;
            $curva->g = $g;
            $curva->h = $h;
            $curva->i = $i;
            $curva->j = $j;
            $curva->k = $k;
            $curva->l = $l;

            $curva->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'curva' => $curva
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }
}



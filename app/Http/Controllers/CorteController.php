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
            ->select([
                'corte.id', 'users.name', 'users.surname', 'corte.numero_corte', 'producto.referencia_producto', 'producto.referencia_producto_2', 'corte.fecha_corte', 'corte.no_marcada', 'corte.ancho_marcada', 'corte.largo_marcada',
                'corte.aprovechamiento', 'corte.fase', 'corte.total', 'corte.fecha_entrega'
            ]);

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
                if ($corte->fase != "Produccion") {
                    return '<button id="btnEdit" onclick="mostrar(' . $corte->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>';
                } else {
                    return '<button id="btnEdit" onclick="mostrar(' . $corte->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>' .
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
                if ($rollo->corte_utilizado == NULL || $rollo->corte_utilizado == "") {
                    return '<button id="btnEdit" onclick="asignar(' . $rollo->id . ')" class="btn btn-warning btn-sm mr-1"  > <i class="fas fa-marker"></i></button>';
                } else {
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


    public function testSelect2()
    {
        $productos = Product::where('referencia_father', NUll)->get();

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

    public function corte_home()
    {
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

    public function verificarCorte(Request $request)
    {

        $validar = $request->validate([
            'numero_corte' => 'unique:corte',

        ]);
        if (!empty($validar)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => 'Test'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function verificarReferencia(Request $request)
    {

        $id = $request->input('producto');

        $referencia = Product::find($id);

        $curva = CurvaProducto::where('producto_id', $id)->first();
        if (is_object($curva)) {
            $a = (is_null($curva->a)) ? 0 : str_replace('.00', '', $curva->a);
            $b = (is_null($curva->b)) ? 0 : str_replace('.00', '', $curva->b);
            $c = (is_null($curva->c)) ? 0 : str_replace('.00', '', $curva->c);
            $d = (is_null($curva->d)) ? 0 : str_replace('.00', '', $curva->d);
            $e = (is_null($curva->e)) ? 0 : str_replace('.00', '', $curva->e);
            $f = (is_null($curva->f)) ? 0 : str_replace('.00', '', $curva->f);
            $g = (is_null($curva->g)) ? 0 : str_replace('.00', '', $curva->g);
            $h = (is_null($curva->h)) ? 0 : str_replace('.00', '', $curva->h);
            $i = (is_null($curva->i)) ? 0 : str_replace('.00', '', $curva->i);
            $j = (is_null($curva->j)) ? 0 : str_replace('.00', '', $curva->j);
            $k = (is_null($curva->k)) ? 0 : str_replace('.00', '', $curva->k);
            $l = (is_null($curva->l)) ? 0 : str_replace('.00', '', $curva->l);
            $total_porc = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
        }

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

        $genero = $referencia->genero;
        $ref2 = $referencia->referencia_producto_2;
        if ($genero == 3 || $genero == 4) {
            $min = $referencia->min;
            $max = $referencia->max;
            $array = array("a" => 2, "b" => 4, "c" => 6, "d" => 8, "e" => 10, "f" => 12, "g" => 14, "h" => 16);
            $res = array_keys($array);
            $result = array_search($min, $res);
            $result2 = array_search($max, $res);
            $tallas = array_slice($array, $result, $result2);
            $curva_prod2 = CurvaProducto::where('producto_padre', $referencia->id)->get()->last();

            if (is_object($curva_prod2)) {
                $a_curva2 = (is_null($curva_prod2->a)) ? 0 : str_replace('.00', '', $curva_prod2->a);
                $b_curva2 = (is_null($curva_prod2->b)) ? 0 : str_replace('.00', '', $curva_prod2->b);
                $c_curva2 = (is_null($curva_prod2->c)) ? 0 : str_replace('.00', '', $curva_prod2->c);
                $d_curva2 = (is_null($curva_prod2->d)) ? 0 : str_replace('.00', '', $curva_prod2->d);
                $e_curva2 = (is_null($curva_prod2->e)) ? 0 : str_replace('.00', '', $curva_prod2->e);
                $f_curva2 = (is_null($curva_prod2->f)) ? 0 : str_replace('.00', '', $curva_prod2->f);
                $g_curva2 = (is_null($curva_prod2->g)) ? 0 : str_replace('.00', '', $curva_prod2->g);
                $h_curva2 = (is_null($curva_prod2->h)) ? 0 : str_replace('.00', '', $curva_prod2->h);
                $i_curva2 = (is_null($curva_prod2->i)) ? 0 : str_replace('.00', '', $curva_prod2->i);
                $j_curva2 = (is_null($curva_prod2->j)) ? 0 : str_replace('.00', '', $curva_prod2->j);
                $k_curva2 = (is_null($curva_prod2->k)) ? 0 : str_replace('.00', '', $curva_prod2->k);
                $l_curva2 = (is_null($curva_prod2->l)) ? 0 : str_replace('.00', '', $curva_prod2->l);
                $total_porc_2 = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

                $referencia2 = Product::where('referencia_father', $referencia->id)->get()->last();
            }

            $a_ref2 = (array_key_exists("a", $tallas) ? $tallas['a'] : 0);
            $b_ref2 = (array_key_exists("b", $tallas) ? $tallas['b'] : 0);
            $c_ref2 = (array_key_exists("c", $tallas) ? $tallas['c'] : 0);
            $d_ref2 = (array_key_exists("d", $tallas) ? $tallas['d'] : 0);
            $e_ref2 = (array_key_exists("e", $tallas) ? $tallas['e'] : 0);
            $f_ref2 = (array_key_exists("f", $tallas) ? $tallas['f'] : 0);
            $g_ref2 = (array_key_exists("g", $tallas) ? $tallas['g'] : 0);
            $h_ref2 = (array_key_exists("h", $tallas) ? $tallas['h'] : 0);
        }

        if (!empty($corte)) {

            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Existe un corte con esta referencia',
                'corte' => $corte,
                'a' => (isset($a)) ? $a : 0,
                'b' => (isset($b)) ? $b : 0,
                'c' => (isset($c)) ? $c : 0,
                'd' => (isset($d)) ? $d : 0,
                'e' => (isset($e)) ? $e : 0,
                'f' => (isset($f)) ? $f : 0,
                'g' => (isset($g)) ? $g : 0,
                'h' => (isset($h)) ? $h : 0,
                'i' => (isset($i)) ? $i : 0,
                'j' => (isset($j)) ? $j : 0,
                'k' => (isset($k)) ? $k : 0,
                'l' => (isset($l)) ? $l : 0,
                'total_porc' => (isset($total_porc)) ? $total_porc : 0,
                'a_alm' => ($a_alm) < 0 ? 0 : $a_alm,
                'b_alm' => ($b_alm) < 0 ? 0 : $b_alm,
                'c_alm' => ($c_alm) < 0 ? 0 : $c_alm,
                'd_alm' => ($d_alm) < 0 ? 0 : $d_alm,
                'e_alm' => ($e_alm) < 0 ? 0 : $e_alm,
                'f_alm' => ($f_alm) < 0 ? 0 : $f_alm,
                'g_alm' => ($g_alm) < 0 ? 0 : $g_alm,
                'h_alm' => ($h_alm) < 0 ? 0 : $h_alm,
                'i_alm' => ($i_alm) < 0 ? 0 : $i_alm,
                'j_alm' => ($j_alm) < 0 ? 0 : $j_alm,
                'k_alm' => ($k_alm) < 0 ? 0 : $k_alm,
                'l_alm' => ($l_alm) < 0 ? 0 : $l_alm,
                'total_alm' => $total_alm,
                'a_ref2' => (isset($a_ref2)) ? $a_ref2 : 0,
                'b_ref2' => (isset($b_ref2)) ? $b_ref2 : 0,
                'c_ref2' => (isset($c_ref2)) ? $c_ref2 : 0,
                'd_ref2' => (isset($d_ref2)) ? $d_ref2 : 0,
                'e_ref2' => (isset($e_ref2)) ? $e_ref2 : 0,
                'f_ref2' => (isset($f_ref2)) ? $f_ref2 : 0,
                'g_ref2' => (isset($g_ref2)) ? $g_ref2 : 0,
                'h_ref2' => (isset($h_ref2)) ? $h_ref2 : 0,
                'producto' => $referencia,
                'a_curva2' => (isset($a_curva2)) ? $a_curva2 : 0,
                'b_curva2' => (isset($b_curva2)) ? $b_curva2 : 0,
                'c_curva2' => (isset($c_curva2)) ? $c_curva2 : 0,
                'd_curva2' => (isset($d_curva2)) ? $d_curva2 : 0,
                'e_curva2' => (isset($e_curva2)) ? $e_curva2 : 0,
                'f_curva2' => (isset($f_curva2)) ? $f_curva2 : 0,
                'g_curva2' => (isset($g_curva2)) ? $g_curva2 : 0,
                'h_curva2' => (isset($h_curva2)) ? $h_curva2 : 0,
                'i_curva2' => (isset($i_curva2)) ? $i_curva2 : 0,
                'j_curva2' => (isset($j_curva2)) ? $j_curva2 : 0,
                'k_curva2' => (isset($k_curva2)) ? $k_curva2 : 0,
                'l_curva2' => (isset($l_curva2)) ? $l_curva2 : 0,
                'total_porc2' => (isset($total_porc_2)) ? $total_porc_2 : 0,
                'referencia2' => (isset($referencia2)) ? $referencia2 : 0

            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No existe un corte con este referencia',
                'a' => (isset($a)) ? $a : 0,
                'b' => (isset($b)) ? $b : 0,
                'c' => (isset($c)) ? $c : 0,
                'd' => (isset($d)) ? $d : 0,
                'e' => (isset($e)) ? $e : 0,
                'f' => (isset($f)) ? $f : 0,
                'g' => (isset($g)) ? $g : 0,
                'h' => (isset($h)) ? $h : 0,
                'i' => (isset($i)) ? $i : 0,
                'j' => (isset($j)) ? $j : 0,
                'k' => (isset($k)) ? $k : 0,
                'l' => (isset($l)) ? $l : 0,
                'total_porc' => (isset($total_porc)) ? $total_porc : 0,
                'a_ref2' => (isset($a_ref2)) ? $a_ref2 : 0,
                'b_ref2' => (isset($b_ref2)) ? $b_ref2 : 0,
                'c_ref2' => (isset($c_ref2)) ? $c_ref2 : 0,
                'd_ref2' => (isset($d_ref2)) ? $d_ref2 : 0,
                'e_ref2' => (isset($e_ref2)) ? $e_ref2 : 0,
                'f_ref2' => (isset($f_ref2)) ? $f_ref2 : 0,
                'g_ref2' => (isset($g_ref2)) ? $g_ref2 : 0,
                'h_ref2' => (isset($h_ref2)) ? $h_ref2 : 0,
                'producto' => $referencia

            ];
        }
        return response()->json($data, $data['code']);
    }

    public function updateCurva(Request $request)
    {
        $id = $request->input('referencia');
        $producto = Product::find($id);
        $genero = $producto->genero;

        if ($genero == 1 || $genero == 2) {
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

            $curva = CurvaProducto::where('producto_id', $id)->get()->first();

            if (is_object($curva)) {
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
                    'curva' => $curva,
                    'message' => 'Curva actualizada correctamente'
                ];
            } else {
                $curva_new = new CurvaProducto();
                $curva_new->producto_id = $id;
                $curva_new->a = $a;
                $curva_new->b = $b;
                $curva_new->c = $c;
                $curva_new->d = $d;
                $curva_new->e = $e;
                $curva_new->f = $f;
                $curva_new->g = $g;
                $curva_new->h = $h;
                $curva_new->i = $i;
                $curva_new->j = $j;
                $curva_new->k = $k;
                $curva_new->l = $l;

                $curva_new->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'curva' => $curva_new,
                    'message' => 'Curva creada correctamente'
                ];
            }
        }else{
            $a_ref1 = $request->input('a_ref1');
            $b_ref1 = $request->input('b_ref1');
            $c_ref1 = $request->input('c_ref1');
            $d_ref1 = $request->input('d_ref1');
            $e_ref1 = $request->input('e_ref1');
            $f_ref1 = $request->input('f_ref1');
            $g_ref1 = $request->input('g_ref1');
            $h_ref1 = $request->input('h_ref1');

            $a_ref2 = $request->input('a_ref2');
            $b_ref2 = $request->input('b_ref2');
            $c_ref2 = $request->input('c_ref2');
            $d_ref2 = $request->input('d_ref2');
            $e_ref2 = $request->input('e_ref2');
            $f_ref2 = $request->input('f_ref2');
            $g_ref2 = $request->input('g_ref2');
            $h_ref2 = $request->input('h_ref2');

            $curva = CurvaProducto::where('producto_id', $id)->get()->first();

            if(is_object($curva)){
                $curva->a = $a_ref1;
                $curva->b = $b_ref1;
                $curva->c = $c_ref1;
                $curva->d = $d_ref1;
                $curva->e = $e_ref1;
                $curva->f = $f_ref1;
                $curva->g = $g_ref1;
                $curva->h = $h_ref1;
                $curva->save();

                $curva_2 = CurvaProducto::where('producto_padre', $id)->get()->first();
                $curva_2->a = $a_ref2;
                $curva_2->b = $b_ref2;
                $curva_2->c = $c_ref2;
                $curva_2->d = $d_ref2;
                $curva_2->e = $e_ref2;
                $curva_2->f = $f_ref2;
                $curva_2->g = $g_ref2;
                $curva_2->h = $h_ref2;
                $curva_2->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'curva' => $curva,
                    'message' => 'Curva actualizada correctamente'
                ];

            }else{
                $curva_new = new CurvaProducto();
                $curva_new->producto_id = $id;
                $curva_new->a = $a_ref1;
                $curva_new->b = $b_ref1;
                $curva_new->c = $c_ref1;
                $curva_new->d = $d_ref1;
                $curva_new->e = $e_ref1;
                $curva_new->f = $f_ref1;
                $curva_new->g = $g_ref1;
                $curva_new->h = $h_ref1;

                $curva_new->save();

                $curva_new_2 = new CurvaProducto();
                $curva_new_2->producto_id = $id;
                $curva_new_2->a = $a_ref2;
                $curva_new_2->b = $b_ref2;
                $curva_new_2->c = $c_ref2;
                $curva_new_2->d = $d_ref2;
                $curva_new_2->e = $e_ref2;
                $curva_new_2->f = $f_ref2;
                $curva_new_2->g = $g_ref2;
                $curva_new_2->h = $h_ref2;
                $curva_new_2->curva_ref_2 = $producto->referencia_producto_2;
                $curva_new_2->producto_padre = $id;

                $curva_new_2->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'curva' => $curva_new,
                    'message' => 'Curva creada correctamente'
                ];
            }

        }

        return response()->json($data, $data['code']);
    }
}

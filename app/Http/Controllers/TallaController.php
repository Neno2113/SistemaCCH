<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Talla;
use App\CurvaProducto;

class TallaController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'corte_id' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $corte_id = $request->input('corte_id');
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
            $mod_curva = $request->input('mod_curva');

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

            $talla = new Talla();
            $corte = Corte::find($corte_id);
            $producto_id = $corte->producto_id;

            $corte->total = $total;
            $corte->save();

            $talla->corte_id = $corte_id;
            $talla->a = $a;
            $talla->b = $b;
            $talla->c = $c;
            $talla->d = $d;
            $talla->e = $e;
            $talla->f = $f;
            $talla->g = $g;
            $talla->h = $h;
            $talla->i = $i;
            $talla->j = $j;
            $talla->k = $k;
            $talla->l = $l;
            $talla->total = $total;

            $talla->save();

            $curva = CurvaProducto::where('producto_id', $producto_id)->get()->first();

            if (!empty($curva) && empty($mod_curva) && $curva->curva_porcentuada == 0) {
                //ACTUALIZAR CURVA


                $a_curva = $curva->a;
                $b_curva = $curva->b;
                $c_curva = $curva->c;
                $d_curva = $curva->d;
                $e_curva = $curva->e;
                $f_curva = $curva->f;
                $g_curva = $curva->g;
                $h_curva = $curva->h;
                $i_curva = $curva->i;
                $j_curva = $curva->j;
                $k_curva = $curva->k;
                $l_curva = $curva->l;

                $a_curva = ($talla->a) == 0 ? 0 : ($a_curva / $talla->a) * 100;
                $b_curva = ($talla->b) == 0 ? 0 : ($b_curva / $talla->b) * 100;
                $c_curva = ($talla->c) == 0 ? 0 : ($c_curva / $talla->c) * 100;
                $d_curva = ($talla->d) == 0 ? 0 : ($d_curva / $talla->d) * 100;
                $e_curva = ($talla->e) == 0 ? 0 : ($e_curva / $talla->e) * 100;
                $f_curva = ($talla->f) == 0 ? 0 : ($f_curva / $talla->f) * 100;
                $g_curva = ($talla->g) == 0 ? 0 : ($g_curva / $talla->g) * 100;
                $h_curva = ($talla->h) == 0 ? 0 : ($h_curva / $talla->h) * 100;
                $i_curva = ($talla->i) == 0 ? 0 : ($i_curva / $talla->i) * 100;
                $j_curva = ($talla->j) == 0 ? 0 : ($j_curva / $talla->j) * 100;
                $k_curva = ($talla->k) == 0 ? 0 : ($k_curva / $talla->k) * 100;
                $l_curva = ($talla->l) == 0 ? 0 : ($l_curva / $talla->l) * 100;

                $curva->a = $a_curva;
                $curva->b = $b_curva;
                $curva->c = $c_curva;
                $curva->d = $d_curva;
                $curva->e = $e_curva;
                $curva->f = $f_curva;
                $curva->g = $g_curva;
                $curva->h = $h_curva;
                $curva->i = $i_curva;
                $curva->j = $j_curva;
                $curva->k = $k_curva;
                $curva->l = $l_curva;
                $curva->curva_porcentuada = 1;

                $curva->save();
            }



            $data = [
                'code' => 200,
                'status' => 'success',
                'talla' => $talla
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function show($id)
    {

        $talla = Talla::where('corte_id', $id)->get()->first();

        if (is_object($talla)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'talla' => $talla
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'ocurrio un error!!'
            ];
        }

        return \response()->json($data, $data['code']);
    }

    public function update(Request $request)
    {
        $validar = $request->validate([
            'corte_id' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $corte_id = $request->input('corte_id');
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

            $talla = Talla::where('corte_id', $corte_id)->first();
            $corte = Corte::find($corte_id);

            $corte->total = $total;
            $corte->save();

            $talla->corte_id = $corte_id;
            $talla->a = $a;
            $talla->b = $b;
            $talla->c = $c;
            $talla->d = $d;
            $talla->e = $e;
            $talla->f = $f;
            $talla->g = $g;
            $talla->h = $h;
            $talla->i = $i;
            $talla->j = $j;
            $talla->k = $k;
            $talla->l = $l;
            $talla->total = $total;

            $talla->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'talla' => $talla
            ];
        }

        return response()->json($data, $data['code']);
    }
}

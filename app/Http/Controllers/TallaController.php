<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Talla;

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
          
            $total = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l; 
                    
            $talla = new Talla();
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
          
            $total = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l; 
                    
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

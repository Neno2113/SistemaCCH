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
            $total = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l; 
                    
            $talla = new Talla();

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
            
            $data = [
                'code' => 200,
                'status' => 'success',
                'talla' => $talla
            ];
        }

        return response()->json($data, $data['code']);
    }
}

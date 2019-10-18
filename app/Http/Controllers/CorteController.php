<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rollos;
use App\Corte;
use App\Talla;
use App\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CorteController extends Controller
{

    public function store(Request $request)
    {
        $validar = $request->validate([
            'numero_corte' => 'required',
            'producto_id' => 'required',
            'fecha_corte' => 'required',
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
            $producto_id = $request->input('producto_id');
            $fecha_corte = $request->input('fecha_corte');
            $no_marcada = $request->input('no_marcada');
            $ancho_marcada = $request->input('ancho_marcada');
            $largo_marcada = $request->input('largo_marcada');
            $aprovechamiento = $request->input('aprovechamiento');
            
            $sec = $request->input('sec');
            $fase = 'Produccion';

            $corte = new Corte();

            $corte->numero_corte = $numero_corte;
            $corte->producto_id = $producto_id;
            $corte->user_id = \auth()->user()->id;
            $corte->fecha_corte = $fecha_corte;
            $corte->no_marcada = $no_marcada;
            $corte->largo_marcada = $largo_marcada;
            $corte->ancho_marcada = $ancho_marcada;
            $corte->aprovechamiento = trim($aprovechamiento, '%');
            $corte->fase = $fase;
            $corte->sec = $sec + 0.01;

            $corte->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
            ];
        }

        return response()->json($data, $data['code']);
    }



    public function rollos()
    {
        $cond = null;
        $rollos = DB::table('rollos')->join('tela', 'rollos.id_tela', '=', 'tela.id')
            ->select(['rollos.id', 'tela.referencia', 'rollos.codigo_rollo', 'rollos.longitud_yarda'])
            ->where('corte_utilizado', $cond);

        return DataTables::of($rollos)
            ->addColumn('Editar', function ($rollo) {
                return '<button id="btnEdit" onclick="asignar(' . $rollo->id . ')" class="btn btn-warning" > <i class="fas fa-marker"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
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
}

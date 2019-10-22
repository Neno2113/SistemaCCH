<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lavanderia;
use App\Corte;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LavanderiaController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'sec' => 'required',
            'numero_envio' => 'required',
            'cantidad' => 'required',
            'receta_lavado' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            
            $sec = $request->input('sec');
            $numero_envio = $request->input('numero_envio');
            $corte_id = $request->input('corte_id');
            $fecha_envio = $request->input('fecha_envio');
            $cantidad = $request->input('cantidad');
            $receta_lavado = $request->input('receta_lavado');
            $estandar_incluido = $request->input('estandar_incluido');

            $lavanderia = new Lavanderia();
            $corte = Corte::find($corte_id);

            $corte->fase = 'Lavanderia';

            $corte->save();

            $lavanderia->numero_envio = $numero_envio;
            $lavanderia->corte_id = $corte_id;
            $lavanderia->fecha_envio = $fecha_envio;
            $lavanderia->cantidad = $cantidad;
            $lavanderia->receta_lavado = $receta_lavado;
            $lavanderia->estandar_incluido = $estandar_incluido;
            $lavanderia->sec = $sec + 0.01;

            $lavanderia->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function lavanderias()
    {
        $lavanderia = DB::table('lavanderia')->join('corte', 'lavanderia.corte_id', '=', 'corte.id')
            ->select(['lavanderia.id', 'lavanderia.numero_envio', 'lavanderia.fecha_envio', 'lavanderia.receta_lavado'
            , 'lavanderia.cantidad', 'lavanderia.estandar_incluido', 'corte.numero_corte', 'corte.fase']);

        return DataTables::of($lavanderia)
            ->addColumn('Expandir', function ($lavanderia) {
                return "";
            })
            ->editColumn('estandar_incluido', function ($lavanderia) {
                return ($lavanderia->estandar_incluido == 1 ? 'Si' : 'No');;
            })
            ->addColumn('Editar', function ($lavanderia) {
                return '<button id="btnEdit" onclick="mostrar(' . $lavanderia->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function ($lavanderia) {
                return '<button onclick="eliminar(' . $lavanderia->id . ')" class="btn btn-danger btn-sm"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
    }

    public function show($id)
    {
        $lavanderia = Lavanderia::find($id)->load('corte');

        if (is_object($lavanderia)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return \response()->json($data, $data['code']);
    }



    public function getDigits()
    {
        $lavanderia = Lavanderia::orderBy('sec', 'desc')->first();

        if (\is_object($lavanderia)) {
            $sec = $lavanderia->sec;
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
}

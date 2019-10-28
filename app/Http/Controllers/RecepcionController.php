<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;
use App\Corte;
use App\Lavanderia;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RecepcionController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'corte_id' => 'required',
            'id_lavanderia' => 'required',
            'fecha_recepcion' => 'required',
            'cantidad_recibida' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $corte_id = $request->input('corte_id');
            $id_lavanderia = $request->input('id_lavanderia');
            $fecha_recepcion = $request->input('fecha_recepcion');
            $cantidad_recibida = $request->input('cantidad_recibida');
            $estandar_recibido = $request->input('estandar_recibido');

            $lavanderia = Lavanderia::find($id_lavanderia);

            $cantidad = $lavanderia->cantidad;
            $porciento = $cantidad + $cantidad_recibida;

            $pc_l = ($cantidad * 100) / ($cantidad + $cantidad_recibida);
            $pc_r = ($cantidad_recibida * 100) / ($cantidad + $cantidad_recibida);

            if ($pc_r > 47.36) {
                $lavanderia->recibido = 1;
                $lavanderia->save();

                $corte = Corte::find($corte_id);
                $corte->fase = 'Terminacion';
                $corte->save();

                $recepcion = new Recepcion();
                $recepcion->corte_id = $corte_id;
                $recepcion->id_lavanderia = $id_lavanderia;
                $recepcion->fecha_recepcion = $fecha_recepcion;
                $recepcion->cantidad_recibida = $cantidad_recibida;
                $recepcion->estandar_recibido = $estandar_recibido;

                $recepcion->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'recepcion' => $recepcion
                ];
            } else {
                $data = [
                    'code' => 422,
                    'status' => 'error',
                    'message' => 'Este corte no puede pasar a Terminacion debido a que la cantidad recibida 
                    equivale a menos del 90% de la cantidad enviada.'
                ];
            }
        }

        return response()->json($data, $data['code']);
    }

    public function recepciones()
    {
        $recepciones = DB::table('recepcion')->join('corte', 'recepcion.corte_id', '=', 'corte.id')
            ->join('lavanderia', 'recepcion.id_lavanderia', '=', 'lavanderia.id')
            ->select([
                'recepcion.id', 'recepcion.fecha_recepcion', 'recepcion.cantidad_recibida', 'recepcion.estandar_recibido',
                'corte.numero_corte', 'lavanderia.numero_envio', 'lavanderia.fecha_envio', 'lavanderia.cantidad'
            ]);

        return DataTables::of($recepciones)
            ->addColumn('Expandir', function ($recepcion) {
                return "";
            })
            ->editColumn('estandar_recibido', function ($lavanderia) {
                return ($lavanderia->estandar_recibido == 1 ? 'Si' : 'No');
            })
            // ->editColumn('enviado', function ($lavanderia) {
            //     return ($lavanderia->enviado == 1 ? 'Si' : 'No');
            // })
            ->addColumn('Opciones', function ($recepcion) {
                return
                    '<button id="btnEdit" onclick="mostrar(' . $recepcion->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $recepcion->id . ')" class="btn btn-danger btn-sm ml-2"> <i class="fas fa-eraser"></i></button>';
                // '<a href="imprimir/conduce/'.$lavanderia->id .'" class="btn btn-secondary btn-sm ml-2"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function show($id)
    {
        $recepcion = Recepcion::find($id)->load('corte')
            ->load('lavanderia');

        if (is_object($recepcion)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'recepcion' => $recepcion
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
                ->where('fase', 'LIKE', 'Lavanderia')
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectCorteEdit(Request $request)
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


    public function selectLavanderia(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Lavanderia::select("id", "numero_envio", "enviado", "recibido", "cantidad")
                ->where('enviado', 'LIKE', '1')
                ->where('recibido', 'LIKE', '0')
                ->where('numero_envio', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectLavanderiaEdit(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Lavanderia::select("id", "numero_envio", "enviado", "recibido", "cantidad")
                ->where('enviado', 'LIKE', '1')
                ->where('recibido', 'LIKE', '1')
                ->where('numero_envio', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validar = $request->validate([
            'corte_id' => 'required',
            'id_lavanderia' => 'required',
            'fecha_recepcion' => 'required',
            'cantidad_recibida' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id');
            $corte_id = $request->input('corte_id');
            $id_lavanderia = $request->input('id_lavanderia');
            $fecha_recepcion = $request->input('fecha_recepcion');
            $cantidad_recibida = $request->input('cantidad_recibida');
            $estandar_recibido = $request->input('estandar_recibido');

            $lavanderia = Lavanderia::find($id_lavanderia);

            $cantidad = $lavanderia->cantidad;
            $porciento = $cantidad + $cantidad_recibida;

            $pc_l = ($cantidad * 100) / ($cantidad + $cantidad_recibida);
            $pc_r = ($cantidad_recibida * 100) / ($cantidad + $cantidad_recibida);

            if ($pc_r > 47.36) {
                $lavanderia->recibido = 1;
                $lavanderia->save();

                $corte = Corte::find($corte_id);
                $corte->fase = 'Terminacion';
                $corte->save();

                $recepcion = Recepcion::find($id);
                $recepcion->corte_id = $corte_id;
                $recepcion->id_lavanderia = $id_lavanderia;
                $recepcion->fecha_recepcion = $fecha_recepcion;
                $recepcion->cantidad_recibida = $cantidad_recibida;
                $recepcion->estandar_recibido = $estandar_recibido;

                $recepcion->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'recepcion' => $recepcion
                ];
            } else {
                $data = [
                    'code' => 422,
                    'status' => 'error',
                    'message' => 'Este corte no puede pasar a Terminacion debido a que la cantidad recibida 
                    equivale a menos del 90% de la cantidad enviada.'
                ];
            }
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $recepcion = Recepcion::find($id);

        $id_corte = $recepcion['corte_id']; 
        $id_lavanderia = $recepcion['id_lavanderia'];

        $corte = Corte::find($id_corte);
        $corte->fase = 'Lavanderia';
        $corte->save();

        $lavanderia = Lavanderia::find($id_lavanderia);
        $lavanderia->recibido = 0;
        $lavanderia->save();

        if (!empty($recepcion)) {
            $recepcion->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'recepcion' => $recepcion
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
}

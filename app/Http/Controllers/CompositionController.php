<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Composition;
use Yajra\DataTables\Facades\DataTables;

class CompositionController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre_composicion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            // $codgo_composicion = $request->input('codigo_composicion', true);
            $nombre_composicion = $request->input('nombre_composicion', true);

            $composition = new Composition();
            // $composition->codigo_composicion = $codgo_composicion;
            $composition->nombre_composicion = $nombre_composicion;


            $composition->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $composition
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function show($id)
    {
        $composition = Composition::find($id);

        if (is_object($composition)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'composition' => $composition
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
            'nombre_composicion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            // $codgo_composicion = $request->input('codigo_composicion', true);
            $nombre_composicion = $request->input('nombre_composicion', true);



            $composition = Composition::find($id);

            // $composition->codigo_composicion = $codgo_composicion;
            $composition->nombre_composicion = $nombre_composicion;


            $composition->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'composition' => $composition
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $composition = Composition::find($id);

        if (!empty($composition)) {
            $composition->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'composition' => $composition
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

    public function compositions()
    {
        $compositions = Composition::query();

        return DataTables::eloquent($compositions)
            ->addColumn('Editar', function ($composition) {
                return '<button id="btnEdit" onclick="mostrar(' . $composition->id . ')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function ($composition) {
                return '<button onclick="eliminar(' . $composition->id . ')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
    }
}

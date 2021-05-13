<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cloth;
use App\Rollos;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RollosController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'suplidor' => 'required',
            'tela' => 'required',
            'codigo_rollo' => 'required',
            'num_tono' => 'required',
            'no_factura_compra' => 'required',
            'longitud_yarda' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $id_user = \auth()->user()->id;
            $id_suplidor = $request->input('suplidor', true);
            $id_tela = $request->input('tela', true);
            $codigo_rollo = $request->input('codigo_rollo', true);
            $num_tono = $request->input('num_tono', true);
            $fecha_compra = $request->input('fecha_compra', true);
            $longitud_yarda = $request->input('longitud_yarda', true);
            $no_factura_compra = $request->input('no_factura_compra', true);

            
            $verificar = Rollos::where('id_suplidor', 'LIKE', $id_suplidor)
            ->where('id_tela', 'LIKE', $id_tela)
            ->where('codigo_rollo', 'LIKE', $codigo_rollo)->get()->first();


            if(empty($verificar) || $verificar == null){

                $rollos = new Rollos();
                $rollos->id_user = $id_user;
                $rollos->id_suplidor = $id_suplidor;
                $rollos->id_tela = $id_tela;
                $rollos->codigo_rollo = $codigo_rollo;
                $rollos->num_tono = $num_tono;
                $rollos->fecha_compra = $fecha_compra;
                $rollos->no_factura_compra = $no_factura_compra;
                $rollos->longitud_yarda = $longitud_yarda;
    
                $rollos->save();
    
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollo' => $rollos
                ];
            } else {
                $data = [
                    'code' => 200,
                    'status' => 'info',
                    'message' => 'Este rollo ya existe!',
                    'rollo' => $verificar
                ];
            }

           

           
        }

        return response()->json($data, $data['code']);
    }

    public function rollos()
    {

        $rollos = DB::table('rollos')->join('suplidor', 'rollos.id_suplidor', '=', 'suplidor.id')
            ->join('tela', 'rollos.id_tela', '=', 'tela.id')
            ->select([
                'rollos.id', 'tela.referencia', 'suplidor.nombre', 'rollos.codigo_rollo', 'rollos.num_tono',
                'rollos.no_factura_compra', 'rollos.fecha_compra', 'rollos.longitud_yarda', 'rollos.corte_utilizado'
            ]);

        return DataTables::of($rollos)
            ->addColumn('Expandir', function ($rollo) {
                return "";
            })
            ->addColumn('Opciones', function ($rollo) {
                return '<button id="btnEdit" onclick="mostrar(' . $rollo->id . ')" class="btn btn-warning btn-sm mr-1" > <i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $rollo->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
            })

            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function show($id)
    {
        $rollo = Rollos::find($id)->load('suplidor')
            ->load('tela');

        if (is_object($rollo)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'rollo' => $rollo
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
            'suplidor' => 'required',
            'tela' => 'required',
            'codigo_rollo' => 'required',
            'num_tono' => 'required',
            'no_factura_compra' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $id_user = \auth()->user()->id;
            $id_suplidor = $request->input('suplidor', true);
            $id_tela = $request->input('tela', true);
            $codigo_rollo = $request->input('codigo_rollo', true);
            $num_tono = $request->input('num_tono', true);
            $fecha_compra = $request->input('fecha_compra', true);
            $longitud_yarda = $request->input('longitud_yarda', true);
            $no_factura_compra = $request->input('no_factura_compra', true);

            $rollo = Rollos::find($id);

            $rollo->id_user = $id_user;
            $rollo->id_suplidor = $id_suplidor;
            $rollo->id_tela = $id_tela;
            $rollo->codigo_rollo = $codigo_rollo;
            $rollo->num_tono = $num_tono;
            $rollo->fecha_compra = $fecha_compra;
            $rollo->longitud_yarda = $longitud_yarda;
            $rollo->no_factura_compra = $no_factura_compra;

            $rollo->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'rollo' => $rollo
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $rollo = Rollos::find($id);

        if (!empty($rollo)) {
            $rollo->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'rollo' => $rollo
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



    public function selectCloth(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Cloth::select("id", "referencia")
                ->where('referencia', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectTela(Request $request)
    {
        $id = $request->input('suplidor');
        $tela = Cloth::where('id_suplidor', $id)->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'tela' => $tela
        ];
        return response()->json($data);
    }
}

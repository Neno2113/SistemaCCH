<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cloth;
use App\PermisoUsuario;
use App\Rollos;
use App\RollosDetail;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RollosController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'suplidor' => 'required',
            'fecha_compra' => 'required',
            'no_factura_compra' => 'required',

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
            $fecha_compra = $request->input('fecha_compra', true);
            $no_factura_compra = $request->input('no_factura_compra', true);
            $tela = $request->input('tela');

            $rollo_check = Rollos::where('id_suplidor', $id_suplidor)
            ->where('no_factura_compra', $no_factura_compra)
            ->where('fecha_compra', $fecha_compra)
            ->first();

            if(!empty($rollo_check)){
                $data = [
                    'code' => 200,
                    'status' => 'info',
                    'message' => 'Este rollo ya esta registrado.'
                ];
            } else {
                $rollos = new Rollos();
                $rollos->id_user = $id_user;
                $rollos->id_suplidor = $id_suplidor;
                $rollos->fecha_compra = $fecha_compra;
                $rollos->no_factura_compra = $no_factura_compra;
    
    
                $rollos->save();
    
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollo' => $rollos
                ];
            }




         
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetail(Request $request)
    {
        $validar = $request->validate([
            'numero' => 'required',
            'tono' => 'required',
            'longitud' => 'required',

        ]);

        if (empty($validar)) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $rollo = $request->input('id_rollo');
            $tela = $request->input('id_tela');
            $numero = $request->input('numero');
            $tono = $request->input('tono');
            $longitud = $request->input('longitud');



            $verificar = RollosDetail::where('id_rollo', 'LIKE', $rollo)
                ->where('id_tela', 'LIKE', $tela)
                ->where('numero', 'LIKE', $numero)->get()->first();

            if (empty($verificar) || $verificar == null) {

                $rollos_detail = new RollosDetail();

                $rollos_detail->id_rollo = $rollo;
                $rollos_detail->id_tela = $tela;
                $rollos_detail->numero = $numero;
                $rollos_detail->tono = $tono;
                $rollos_detail->longitud = $longitud;

                $rollos_detail->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollo' => $rollos_detail
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
            ->select([
                'rollos.id', 'suplidor.nombre','rollos.no_factura_compra', 'rollos.fecha_compra'
            ]);

        return DataTables::of($rollos)
            ->addColumn('Expandir', function ($rollo) {
                return "";
            })
            ->addColumn('tela', function ($rollo) {
                $rollos_detail = RollosDetail::where('id_rollo', $rollo->id)->get()->first()->load('telas');

                return $rollos_detail->telas->referencia;
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
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Rollos')
            ->first();
        if (Auth::user()->role != 'Administrador') {
            if ($user_login->modificar == 0 || $user_login->modificar == null) {
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
        }

        $rollo = Rollos::find($id)->load('suplidor');
       

        if (is_object($rollo)) {
            $rollos = RollosDetail::where('id_rollo', $rollo->id)->get();

            //tela
            $rollo_tela = RollosDetail::where('id_rollo', $rollo->id)->first();
            $tela = Cloth::find($rollo_tela->id_tela);

            $data = [
                'code' => 200,
                'status' => 'success',
                'rollo' => $rollo,
                'rollos' => $rollos,
                'tela' => $tela
                
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
            'fecha_compra' => 'required',
            'no_factura_compra' => 'required',
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
            $fecha_compra = $request->input('fecha_compra', true);
            $no_factura_compra = $request->input('no_factura_compra', true);

            $rollo = Rollos::find($id);

            $rollo->id_user = $id_user;
            $rollo->id_suplidor = $id_suplidor;
            $rollo->fecha_compra = $fecha_compra;
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

    public function checkDestroy()
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Rollos')
            ->first();
        if (Auth::user()->role != 'Administrador') {
            if ($user_login->eliminar == 0 || $user_login->eliminar == null) {
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
        }

        // return response()->json($data, $data['code']);
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

    public function select()
    {
        $suppliers = Supplier::where('tipo_suplidor', 'Material')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'suplidores' => $suppliers
        ];

        return response()->json($data, $data['code']);
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

    public function destroyDetail($id){
        $rollo = RollosDetail::find($id);

        if(is_object($rollo)){
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
}

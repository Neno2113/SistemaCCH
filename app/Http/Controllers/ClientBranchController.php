<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientBranch;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClientBranchController extends Controller
{

    public function store(Request $request)
    {

        $validar = $request->validate([
            'client_id' => 'required',
            'nombre_sucursal' => 'required|unique:cliente_sucursales',
            'telefono_sucursal' => 'required',
            'calle' => 'required',
            'provincia' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $random = rand(9, 99);
            $nombre_sucursal = $request->input('nombre_sucursal', true);
            $cliente_id = $request->input('client_id', true);
            $telefono_sucursal = $request->input('telefono_sucursal', true);
            $calle = $request->input('calle', true);
            $sector = $request->input('sector', true);
            $provincia = $request->input('provincia', true);
            $sitios_cercanos = $request->input('sitios_cercanos', true);

            $codigo_sucursal = "$cliente_id-$random";

            $client_branch = new ClientBranch();

            $client_branch->cliente_id =  $cliente_id;
            $client_branch->codigo_sucursal = $codigo_sucursal;
            $client_branch->nombre_sucursal = $nombre_sucursal;
            $client_branch->telefono_sucursal = $telefono_sucursal;
            $client_branch->calle = $calle;
            $client_branch->sector = $sector;
            $client_branch->provincia = $provincia;
            $client_branch->sitios_cercanos = $sitios_cercanos;



            $client_branch->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'sucursal' => $client_branch
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function select()
    {
        $clientes = Client::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'clientes' => $clientes
        ];

        return response()->json($data, $data['code']);
    }

    public function show($id)
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Sucursales')
        ->first();
        if(Auth::user()->role != 'Administrador'){
            if($user_login->modificar == 0 || $user_login->modificar == null){
                return  $data = [
                    'code' => 200,
                    'status' => 'denied',
                    'message' => 'No tiene permiso para realizar esta accion.'
                ];
            }
    
        }
        $client_branch = ClientBranch::find($id)->load('cliente');

        if (is_object($client_branch)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'branch' => $client_branch
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
            'id' => 'required',
            'client_id' => 'required',
            'nombre_sucursal' => 'required',
            'telefono_sucursal' => 'required',
            'calle' => 'required',
            'provincia' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $nombre_sucursal = $request->input('nombre_sucursal', true);
            $cliente_id = $request->input('client_id', true);
            $telefono_sucursal = $request->input('telefono_sucursal', true);
            $calle = $request->input('calle', true);
            $sector = $request->input('sector', true);
            $provincia = $request->input('provincia', true);
            $sitios_cercanos = $request->input('sitios_cercanos', true);

            $client_branch = ClientBranch::find($id);

            $client_branch->cliente_id =  $cliente_id;
            $client_branch->nombre_sucursal = $nombre_sucursal;
            $client_branch->telefono_sucursal = $telefono_sucursal;
            $client_branch->calle = $calle;
            $client_branch->sector = $sector;
            $client_branch->provincia = $provincia;
            $client_branch->sitios_cercanos = $sitios_cercanos;

            $client_branch->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'branch' => $client_branch
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Sucursales')
        ->first();
        if(Auth::user()->role != 'Administrador'){
            if($user_login->eliminar == 0 || $user_login->eliminar == null){
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
        $client_branch = ClientBranch::find($id);

        if (!empty($client_branch)) {
            $client_branch->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'branch' => $client_branch
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

    public function branches()
    {
        $branches = DB::table('cliente_sucursales')->join('cliente', 'cliente_sucursales.cliente_id', '=', 'cliente.id')
            ->select([
                'cliente_sucursales.id', 'cliente.nombre_cliente', 'cliente_sucursales.codigo_sucursal', 'cliente_sucursales.nombre_sucursal',
                'cliente_sucursales.telefono_sucursal', 'cliente_sucursales.provincia'
            ]);

        return DataTables::of($branches)
            ->addColumn('Expandir', function ($branch) {
                return "";
            })
            // ->addColumn('Ver', function ($branch) {
            //     return '<button onclick="ver(' . $branch->id . ')" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></button>';
            // })
            ->addColumn('Opciones', function ($branch) {
                return '<button onclick="eliminar(' . $branch->id . ')" class="btn btn-danger btn-sm mr-1"> <i class="fas fa-eraser"></i></button>'.
                '<button id="btnEdit" onclick="mostrar(' . $branch->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="fas fa-edit"></i></button>';
            })

            ->rawColumns(['Ver', 'Opciones'])
            ->make(true);
    }
}

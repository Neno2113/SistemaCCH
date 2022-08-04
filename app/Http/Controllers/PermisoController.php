<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\PermisoUsuario;
use App\User;
use Illuminate\Validation\Rule;



class PermisoController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([

            'usuario' => 'required',
            'permiso' => 'required'

        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {


            $permiso = $request->input('permiso');
            $user_id = $request->input('usuario');

            $unico = PermisoUsuario::where('user_id', $user_id)
            ->where('permiso', $permiso)->get()->first();

            if(empty($unico)){
                $permiso_usuario = new PermisoUsuario();

                $permiso_usuario->user_id = $user_id;
                $permiso_usuario->permiso = $permiso;
                $permiso_usuario->ver = 0;
                $permiso_usuario->agregar = 0;
                $permiso_usuario->modificar = 0;
                $permiso_usuario->eliminar = 0;

                $permiso_usuario->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'permiso' => $permiso_usuario->load('user')
                ];
            }else{
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Ya existe este permiso'
                ];
            }

        }

        return response()->json($data, $data['code']);
    }

    public function usuarios(){
        $usuarios = User::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'usuarios' => $usuarios
        ];

        return response()->json($data, $data['code']);
    }

    public function permisos()
    {
        $permisos = DB::table('users')
            ->select([
                'users.name', 'users.surname', 'users.id',
                'users.role', 'users.email'
            ])->where('role', 'NOT LIKE', 'Administrador');

        return DataTables::of($permisos)
        ->editColumn('name', function($permiso){
            return $permiso->name." ". $permiso->surname;
        })
        ->addColumn('Expandir', function ($permiso) {
            return "";
        })
        ->addColumn('Opciones', function ($permiso) {
            return '<button onclick="mostrar(' . $permiso->id . ')" class="btn btn-primary btn-sm ml-1"> <i class="fas fa-user-cog"></i></button>';
        })
            ->rawColumns(['Opciones'])
            ->make(true);
    } 

    public function destroy($id)
    {
        $permiso = PermisoUsuario::find($id);

        if (!empty($permiso)) {
            $permiso->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'permiso' => $permiso
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

    public function show($id){

        $permiso_usuario = PermisoUsuario::where('user_id', $id)->get()->load('user');

        if(!empty($permiso_usuario)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'permiso' => $permiso_usuario
            ];
        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function permisoAdd(Request $request){
        
        $permiso = $request->input('permiso');
        $acceso = $request->input('acceso');

        $permiso_usuario = PermisoUsuario::find($permiso);

        if(!empty($permiso_usuario)){

            if($acceso == 'r'){
                $permiso_usuario->ver = 1;
                $permiso_usuario->save();
            }

            if($acceso == 'a'){
                $permiso_usuario->agregar = 1;
                $permiso_usuario->save();
            }

            if($acceso == 'w'){
                $permiso_usuario->modificar = 1;
                $permiso_usuario->ver = 1;
                $permiso_usuario->save();
            }

            if($acceso == 'd'){
                $permiso_usuario->eliminar = 1;
                $permiso_usuario->ver = 1;
                $permiso_usuario->save();
            }
            
            return $data = [
                'code' => 200,
                'status' => 'success',
                'permiso' => $permiso_usuario,
                'acceso' => $acceso
            ];

        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No encontro el permiso'
            ];
        }
        // $data = [
        //     'code' => 404,
        //     'status' => 'error',
        //     'message' => $permiso_usuario
        // ];
        return response()->json($data, $data['code']);
    }


    public function permisoRemove(Request $request){
        
        $permiso = $request->input('permiso');
        $acceso = $request->input('acceso');

        $permiso_usuario = PermisoUsuario::find($permiso);

        if(is_object($permiso_usuario)){

            if($acceso == 'r'){
                $permiso_usuario->ver = 0;
                $permiso_usuario->save();
            }

            if($acceso == 'a'){
                $permiso_usuario->agregar = 0;
                $permiso_usuario->save();
            }

            if($acceso == 'w'){
                $permiso_usuario->modificar = 0;
                $permiso_usuario->save();
            }

            if($acceso == 'd'){
                $permiso_usuario->eliminar = 0;
                $permiso_usuario->save();
            }

            return $data = [
                'code' => 200,
                'status' => 'success',
                'permiso' => $permiso_usuario,
                'acceso' => $acceso
            ];

        } else {
           return $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No encontro el permiso'
            ];
        }
     
        return response()->json($data, $data['code']);
    }

    public function showPermiso($id){
        $permiso_usuario = PermisoUsuario::find($id);

        if(!empty($permiso_usuario)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'permiso' => $permiso_usuario
            ];
        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return response()->json($data, $data['code']);
    }
}

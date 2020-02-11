<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\PermisoUsuario;
use App\User;



class PermisoController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'permiso' => 'required',
            'usuario' => 'required',

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

            $permiso_usuario = new PermisoUsuario();

            $permiso_usuario->user_id = $user_id;
            $permiso_usuario->permiso = $permiso;

            $permiso_usuario->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'permiso' => $permiso_usuario
            ];
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
            ]);

        return DataTables::of($permisos)
        ->editColumn('name', function($permiso){
            return $permiso->name." ". $permiso->surname;
        })
        ->addColumn('Opciones', function ($permiso) {
            return '<button onclick="mostrar(' . $permiso->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="fas fa-user-edit"></i></button>';
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
}

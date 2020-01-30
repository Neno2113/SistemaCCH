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
        $permisos = DB::table('permiso_usuario')
            ->join('users', 'permiso_usuario.user_id', 'users.id')
            ->select([
                'permiso_usuario.id', 'users.name', 'users.surname', 'permiso_usuario.permiso',
                'users.role', 'users.email'
            ]);

        return DataTables::of($permisos)
        ->editColumn('name', function($permiso){
            return $permiso->name." ". $permiso->surname;
        })
        ->addColumn('Opciones', function ($permiso) {
            return
            '<button onclick="eliminar(' . $permiso->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}

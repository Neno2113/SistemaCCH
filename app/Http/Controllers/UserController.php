<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'name' => 'required|alpha|',
            'surname' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if (empty($validar)){

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        }else{
            $name = $request->input('name', true);
            $surname = $request->input('surname', true);
            $edad = $request->input('edad', true);
            $email = $request->input('email', true);
            $role = $request->input('role', true);
            $password = $request->input('password', true);
            $direccion = $request->input('direccion', true);
            $telefono = $request->input('telefono', true);
            $celular = $request->input('celular', true);

            $pwd = Hash::make($password);

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $pwd;
            $user->role = $role;
            $user->direccion = $direccion;
            $user->telefono = $telefono;
            $user->celular = $celular;
            $user->surname = $surname;
            $user->edad = $edad;

            $user->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (is_object($user)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user
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

}

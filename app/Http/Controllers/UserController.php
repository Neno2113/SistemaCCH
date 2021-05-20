<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required|alpha|',
            'apellido' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $nombre = $request->input('nombre', true);
            $apellido = $request->input('apellido', true);
            $edad = $request->input('edad', true);
            $email = $request->input('email', true);
            $role = $request->input('role', true);
            $password = $request->input('password', true);
            $direccion = $request->input('direccion', true);
            $telefono = $request->input('telefono', true);
            $celular = $request->input('celular', true);
            $avatar = $request->input('avatar');

            $pwd = Hash::make($password);

            $user = new User();
            $user->name = $nombre;
            $user->email = $email;
            $user->password = $pwd;
            $user->role = $role;
            $user->direccion = $direccion;
            $user->telefono = $telefono;
            $user->celular = $celular;
            $user->surname = $apellido;
            $user->edad = $edad;
            $user->avatar = $avatar;

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
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Usuarios')
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
    
        $user = User::find($id);

        if (is_object($user)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user,
                'user_login' => $user_login
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
            'nombre' => 'required|alpha|',
            'apellido' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $nombre = $request->input('nombre', true);
            $apellido = $request->input('apellido', true);
            $edad = $request->input('edad', true);
            $email = $request->input('email', true);
            $role = $request->input('role', true);
            $password = $request->input('password', true);
            $direccion = $request->input('direccion', true);
            $telefono = $request->input('telefono', true);
            $celular = $request->input('celular', true);
            $avatar = $request->input('avatar');

            $pwd = Hash::make($password);

            $user = User::find($id);

            $user->name = $nombre;
            $user->email = $email;
            $user->password = $pwd;
            $user->role = $role;
            $user->direccion = $direccion;
            $user->telefono = $telefono;
            $user->celular = $celular;
            $user->surname = $apellido;
            $user->edad = $edad;
            $user->avatar = $avatar;

            $user->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy(){
      //Chekcing if the user has access to this function
      $user_loginId = Auth::user()->id;
      $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Usuarios')
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

        $user = User::find($id);

        if (!empty($user)) {
            $user->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user
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


    public function users()
    {
        $users = User::query();

        return DataTables::eloquent($users)
            ->addColumn('Expandir', function ($user) {
                return "";
            })
            ->addColumn('editar', function ($user) {
              
                return '<button id="btnEdit" onclick="mostrar(' . $user->id . ')" class="btn btn-warning btn-sm mr-1"> <i class="fas fa-user-edit "></i></button>';

            })
            ->addColumn('eliminar', function ($user) {
                return '<button onclick="eliminar(' . $user->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-user-times"></i></button>';
            })

            ->rawColumns(['editar', 'eliminar'])
            ->make(true);
    }

    public function upload(Request $request)
    {
        //validar la imagen
        $validate = \Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpg,jpeg,png',

        ]);
        // Guardar la imagen
        if ($validate->fails()) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            $avatar = $request->file('avatar');
            $image_name_1 = time() . $avatar->getClientOriginalName();
            // echo $id;
            // die();


            if (!empty($avatar)) {
            \Storage::disk('avatar')->put($image_name_1, \File::get($avatar));
            } else {
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'WTF'
                ];
            }


            $data = [
                'code' => 200,
                'status' => 'success',
                'avatar' =>$image_name_1
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function getImage($filename){

        $isset = \Storage::disk('avatar')->exists($filename);
        if($isset){

            $file = \Storage::disk('avatar')->get($filename);

            //Devolver imagen
            return new Response($file, 200);

        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La imagen no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

}




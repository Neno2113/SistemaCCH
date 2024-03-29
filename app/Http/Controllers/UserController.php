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
use DateTime;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
  
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function updatePassword(Request $request) 
    {
        $validar = $request->validate([
            'nueva' => 'required',
            'vieja' => 'required'
        ]);

        if(empty($validar)){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $vieja = $request->input('vieja');
            $nueva = $request->input('nueva');
            $confirmar = $request->input('confirmar');
            $userId = Auth::user()->id;
            
            $user = User::find($userId);
            
            if($nueva != $confirmar){
                $data = [
                    'code' => 200,
                    'status' => 'validationBoth',
                    'message' => 'Las contrasenas no coinciden'
                ];
            } else {
                $current_password = $user->password;
                // $old_pwd = Hash::make($vieja);

                if(!Hash::check($vieja, $current_password)){
                    $data = [
                        'code' => 200,
                        'status' => 'validation',
                        'message' => 'Las contrasena vieja no coincide',
                        'current' => $current_password
                    ];
                } else {
                    $new_pwd = Hash::make($nueva);
                    $user->password = $new_pwd;
                    $user->first_login = 1;
                    $user->save();
    
                    $data = [
                        'code' => 200,
                        'status' => 'success',
                        'message' => 'Password actualizada correctamente'
                    ];
                }
            }
        }

        return response()->json($data, $data['code']);
    }

    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
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
            $fecha_nacimiento = $request->input('fecha_nacimiento', true);
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
            $user->fecha_nacimiento = $fecha_nacimiento;
            $user->first_login = 0;
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
            'nombre' => 'required',
            'apellido' => 'required',
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
            $fecha_nacimiento = $request->input('fecha_nacimiento', true);
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
            $user->fecha_nacimiento = $fecha_nacimiento;
            $user->first_login = 0;
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
            ->editColumn('fecha_nacimiento', function ($user){
                $bDay = new DateTime($user->fecha_nacimiento);
                $today = new DateTime(date('m.d.y'));
                $diff = $today->diff($bDay);
                return $diff->y;
             })
            ->addColumn('editar', function ($user) {
              
                return '<button onclick="eliminar(' . $user->id . ')" class="btn btn-danger btn-sm mr-1"> <i class="fas fa-user-times"></i></button>'. 
                '<button id="btnEdit" onclick="mostrar(' . $user->id . ')" class="btn btn-warning btn-sm ml-1"> <i class="fas fa-user-edit "></i></button>';

            })
            ->addColumn('eliminar', function ($user) {
                if($user->active == 1 && $user->role != 'Administrador'){
                    return '<button onclick="desactivar(' . $user->id . ')" class="btn btn-outline-danger btn-sm "><i class="fas fa-user-slash"></i></button>';
                } elseif($user->role == 'Administrador' ) {
                    return  '<span class="badge badge-pill badge-success">Admin</span>';
                } else {
                    return '<button onclick="activar(' . $user->id . ')" class="btn btn-success btn-sm "><i class="fas fa-user-check"></i></button>';

                }
            })
            ->addColumn('status', function ($user) {
                if($user->active == 1){
                    return  '<span class="badge badge-pill badge-success">Activo</span>';
                } else {
                    return  '<span class="badge badge-pill badge-danger">Desactivado</span>';
                }
            })

            ->rawColumns(['editar', 'eliminar', 'status'])
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


    public function activar($id){

        $user = User::find($id);

        if(empty($user)){
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No se encontro el usuario'
            ];
        } else {
            $user->active = 1;
            $user->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' =>$user
            ];

        }

        return response()->json($data, $data['code']);
    }


    public function desactivar($id){

        $user = User::find($id);

        if(empty($user)){
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No se encontro el usuario'
            ];
        } else {
            $user->active = 0;
            $user->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' =>$user
            ];

        }

        return response()->json($data, $data['code']);
    }


}




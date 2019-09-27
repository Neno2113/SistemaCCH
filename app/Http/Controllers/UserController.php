<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function store(Request $request){
        
        $name = $request->input('name', true);
        $email = $request->input('email', true);
        $role = $request->input('role', true);
        $password = $request->input('password', true);

        if (!empty($name)) {

            $pwd = Hash::make($password);

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $pwd;
            $user->role = $role;

            $user->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Envia los datos correctamente'
            ];
        }

        return response()->json($data, $data['code']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientBranch;

class ClientBranchController extends Controller
{

    public function store(Request $request){

        $validar = $request->validate([
            'nombre_sucursal' => 'required',
            'telefono_sucursal' => 'required',
            'direccion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            

            $data = [
                'code' => 200,
                'status' => 'success'
            ];
        }

        return response()->json($data, $data['code']);

    }


    public function select(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Client::select("id", "nombre_cliente")
                            ->where('nombre_cliente', 'LIKE',"%$search%")
                            ->get(); 
        }
        return response()->json($data);
    }


    public function selectClient(){
        $client = Client::all();

        return response()->json([
            'code' => 200,
            'status'=> 'success',
            'client' => $client
        ],200);
    }


}

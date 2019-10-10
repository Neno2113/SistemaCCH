<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'referencia' => 'required',
            'descripcion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $referencia = $request->input('referencia', true);
            $descripcion = $request->input('descripcion', true);
            $sec = $request->input('sec', true);
           
            $product = new Product();
            $product->referencia_producto = $referencia;
            $product->descripcion = $descripcion;
            $product->sec = $sec + 0.1;
            $product->id_user = \auth()->user()->id;

            $product->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $product
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function getDigits(){
        $product = Product::orderBy('sec', 'desc')->first();

        $sec = $product->sec;
         
    
        $data = [
            'code' => 200,
            'status' => 'success',
            'sec' => $sec
        ];

        
        return response()->json($data, $data['code']);
    }
}

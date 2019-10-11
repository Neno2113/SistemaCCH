<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

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

    public function products()
    {
        $products = DB::table('producto')->join('users', 'producto.id_user', '=', 'users.id')
        ->select(['producto.id', 'users.name', 'users.surname', 'producto.referencia_producto','producto.descripcion']);

        return DataTables::of($products)
            ->editColumn('name', function($product){
                return "$product->name $product->surname";
            })
            ->addColumn('Editar', function ($product) {
                return '<button id="btnEdit" onclick="mostrar(' . $product->id . ')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function ($product) {
                return '<button onclick="eliminar(' . $product->id . ')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (is_object($product)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'product' => $product
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
            $id = $request->input('id', true);
            $referencia = $request->input('referencia', true);
            $descripcion = $request->input('descripcion', true);
            $sec = $request->input('sec', true);
           
            $product = Product::find($id);
    
            $product->referencia_producto = $referencia;
            $product->descripcion = $descripcion;
            $product->sec = $sec;
            // $product->id_user = \auth()->user()->id;

            $product->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'product' => $product
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!empty($product)) {
            $product->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'product' => $product
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


    public function getDigits(){
        $product = Product::orderBy('sec', 'desc')->first();

        $sec = $product->sec;

        if(empty($sec)){
            $sec = 0.0;

            $data = [
                'code' => 200,
                'status' => 'success',
                'sec' => $sec
            ];
    
        }else{
            $data = [
                'code' => 200,
                'status' => 'success',
                'sec' => $sec
            ];
        }
                 
        return response()->json($data, $data['code']);
    }
}

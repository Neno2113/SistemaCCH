<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\SKU;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except'=>['asignarSKU']]);
    // }
    public function store(Request $request)
    {
        $validar = $request->validate([
            'precio_lista' => 'required',
            'descripcion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id');
            $descripcion = $request->input('descripcion', true);
            $descripcion_2 = $request->input('descripcion_2', true);
            $precio_lista = $request->input('precio_lista');
            $precio_lista_2 = $request->input('precio_lista_2');
            $precio_venta_publico = $request->input('precio_venta_publico');
            $precio_venta_publico_2 = $request->input('precio_venta_publico_2');
            

            $product = Product::find($id);
            $product->descripcion = $descripcion;
            $product->descripcion_2 = $descripcion_2;
            $product->precio_lista = trim($precio_lista, "_");
            $product->precio_lista_2 = $precio_lista_2;
            $product->precio_venta_publico = $precio_venta_publico;
            $product->precio_venta_publico_2 = $precio_venta_publico_2;
           
            $product->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $product
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function guardarReferencias(Request $request)
    {

        $validar = $request->validate([
            'referencia' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $referencia = $request->input('referencia', true);
            $referencia_2 = $request->input('referencia_2', true);
            $sec = $request->input('sec', true);
     
            $product = new Product();
            $product->referencia_producto = $referencia;
            $product->referencia_producto_2 = $referencia_2;
            $product->id_user = \auth()->user()->id;
            $product->sec = $sec + 0.1;
            $product->enviado_lavanderia = 0;
           
         
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
            ->select(['producto.id', 'users.name', 'users.surname', 'producto.referencia_producto', 'producto.descripcion'
            , 'producto.referencia_producto_2', 'producto.precio_lista', 'producto.precio_venta_publico']);

        return DataTables::of($products)
            ->addColumn('Expandir', function ($product) {
                return "";
            })
            ->editColumn('name', function ($product) {
                return "$product->name $product->surname";
            })
            ->addColumn('Editar', function ($product) {
                return '<button id="btnEdit" onclick="mostrar(' . $product->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function ($product) {
                return '<button onclick="eliminar(' . $product->id . ')" class="btn btn-danger btn-sm"> <i class="fas fa-eraser"></i></button>';
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
            $descripcion_2 = $request->input('descripcion_2', true);
            $precio_lista = $request->input('precio_lista');
            $precio_lista_2 = $request->input('precio_lista_2');
            $precio_venta_publico = $request->input('precio_venta_publico');
            $precio_venta_publico_2 = $request->input('precio_venta_publico_2');
            // $sec = $request->input('sec', true);

            $product = Product::find($id);

            $product->referencia_producto = $referencia;
            $product->descripcion_2 = $descripcion_2;
            $product->descripcion = $descripcion;
            $product->precio_lista = $precio_lista;
            $product->precio_lista_2 = $precio_lista_2;
            $product->precio_venta_publico = $precio_venta_publico;
            $product->precio_venta_publico_2 = $precio_venta_publico_2;
            // $product->sec = $sec;
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


    public function getDigits()
    {
        $product = Product::orderBy('sec', 'desc')->first();

        if(\is_object($product)){
            $sec = $product->sec;
        }
        
        // $sec = $product->sec;
        if (empty($sec)) {
            $sec = 0.0;

            $data = [
                'code' => 200,
                'status' => 'success',
                'sec' => $sec
            ];
        } else {
           
            $data = [
                'code' => 200,
                'status' => 'success',
                'sec' => $sec
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function asignarSKU(Request $request){
        $val = 0;
        $sku = SKU::where('asignado', $val)->get()->first();
        \json_encode($sku);
        
        if(empty($sku)){
            $val = null;
            $sku = SKU::where('asignado', $val)->get()->first();
            \json_encode($sku);
        }

        $id = $sku['id'];

        $producto_id = $request->input('id');
        $talla = $request->input('talla');
        $referencia = $request->input('referencia');

        $sku_update = SKU::find($id);
        $sku_update->producto_id = $producto_id;
        $sku_update->talla = $talla;
        $sku_update->referencia_producto = $referencia;
        $sku_update->asignado = 1;

        $sku_update->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'sku' => $sku_update
        ];

        return response()->json($data, $data['code']);
    }

    public function productoTerminado()
    {
        $products = DB::table('producto')->select(['producto.id', 'producto.referencia_producto', 'producto.descripcion', 'producto.tono'
            , 'producto.precio_lista', 'producto.precio_venta_publico'])
            ->where('producto.producto_terminado', 'LIKE', '1');

        return DataTables::of($products)
            ->addColumn('Expandir', function ($product) {
                return "";
            })
            
            ->addColumn('Opciones', function ($product) {
                return '<button id="btnEdit" onclick="mostrar(' . $product->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-eye fa-lg"></i></button>';
            })
         
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function getImage($filename){
        
        $isset = \Storage::disk('producto')->exists($filename);
        if($isset){
           
            $file = \Storage::disk('producto')->get($filename);

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

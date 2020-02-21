<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\SKU;
use stdClass;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except'=>['asignarSKU']]);
    // }
    public function store(Request $request)
    {
        $validar = $request->validate([
            'referencia' => 'required',
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

            $referencia = $request->input('referencia', true);
            $referencia_2 = $request->input('referencia_2', true);
            $sec = $request->input('sec', true);
            $descripcion = $request->input('descripcion', true);
            $descripcion_2 = $request->input('descripcion_2', true);
            $precio_lista = $request->input('precio_lista');
            $genero = $request->input('genero');
            $precio_lista_2 = $request->input('precio_lista_2');
            $precio_venta_publico = $request->input('precio_venta_publico');
            $precio_venta_publico_2 = $request->input('precio_venta_publico_2');
            $min = $request->input('min');
            $max = $request->input('max');


            $product = new Product();
            $product->genero = $genero;
            $product->referencia_producto = $referencia;
            $product->referencia_producto_2 = $referencia_2;
            $product->id_user = \auth()->user()->id;
            $product->sec = $sec + 0.1;
            $product->enviado_lavanderia = 0;
            $product->descripcion = $descripcion;
            $product->descripcion_2 = $descripcion_2;
            $product->precio_lista = trim($precio_lista, "RD$");
            $product->precio_lista_2 = trim($precio_lista_2, "RD$");
            $product->precio_venta_publico = trim($precio_venta_publico, "RD$");
            $product->precio_venta_publico_2 = trim($precio_venta_publico_2, "RD$");
            $product->min = $min;
            $product->max = $max;

            if (empty($precio_lista_2)) {
                $precio_lista_2 = 0;
                $precio_venta_publico_2 = 0;
            }
            if (!empty($min)) {
                switch ($min) {
                    case '2':
                        $min = "a";
                        break;
                    case '4':
                        $min = "b";
                        break;
                    case '6':
                        $min = "c";
                        break;
                    case '8':
                        $min = "d";
                        break;
                    case '10':
                        $min = "e";
                        break;
                    case '12':
                        $min = "f";
                        break;
                    case '14':
                        $min = "g";
                        break;
                    case '16':
                        $min = "h";
                        break;
                    default:
                        $min = $min;
                        break;
                }

                switch ($max) {
                    case '2':
                        $max = "a";
                        break;
                    case '4':
                        $max = "b";
                        break;
                    case '6':
                        $max = "c";
                        break;
                    case '8':
                        $max = "d";
                        break;
                    case '10':
                        $max = "e";
                        break;
                    case '12':
                        $max = "f";
                        break;
                    case '14':
                        $max = "g";
                        break;
                    case '16':
                        $max = "h";
                        break;


                    default:
                        $max = $max;
                        break;
                }
            }





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
            ->select([
                'producto.id', 'users.name', 'users.surname', 'producto.referencia_producto', 'producto.descripcion', 'producto.referencia_producto_2', 'producto.precio_lista', 'producto.precio_venta_publico'
            ]);

        return DataTables::of($products)
            ->addColumn('Expandir', function ($product) {
                return "";
            })
            ->editColumn('name', function ($product) {
                return "$product->name $product->surname";
            })
            ->editColumn('precio_lista', function ($product) {
                return number_format($product->precio_lista) . " RD$";
            })
            ->editColumn('precio_venta_publico', function ($product) {
                return number_format($product->precio_venta_publico) . " RD$";
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
            $product->precio_lista = trim($precio_lista, "_RD$");
            $product->precio_lista_2 = trim($precio_lista_2, "_RD$");
            $product->precio_venta_publico = trim($precio_venta_publico, "_RD$");
            $product->precio_venta_publico_2 = trim($precio_venta_publico_2, "_RD$");
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

        if (\is_object($product)) {
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

    public function asignarSKU(Request $request)
    {

        $producto_id = $request->input('id');
        $talla = $request->input('talla');
        $referencia = $request->input('referencia');

        $val = 0;
        $sku = SKU::where('asignado', $val)->get()->first();
        \json_encode($sku);

        if (empty($sku)) {
            $val = null;
            $sku = SKU::where('asignado', $val)->get()->first();
            \json_encode($sku);
        }

        $id = $sku['id'];


        $producto = Product::find($producto_id);
        $referencia_2 = $producto->referencia_producto_2;
        $rango = $producto->min;

        $sku_update = SKU::find($id);
        $sku_update->producto_id = $producto_id;
        $sku_update->talla = $talla;
        $sku_update->referencia_producto = $referencia;
        $sku_update->asignado = 1;

        $sku_update->save();

        if (!empty($referencia_2)) {

            $val_2 = 0;
            $sku_2 = SKU::where('asignado', $val)->get()->first();
            \json_encode($sku_2);

            if (empty($sku_2)) {
                $val_2 = null;
                $sku_2 = SKU::where('asignado', $val_2)->get()->first();
                \json_encode($sku_2);
            }

            $id_2 = $sku_2['id'];

            $sku_update_2 = SKU::find($id_2);
            $sku_update_2->producto_id = $producto_id;
            $sku_update_2->talla = $talla;
            $sku_update_2->referencia_producto = $referencia_2;
            $sku_update_2->asignado = 1;

            $sku_update_2->save();
        }



        $data = [
            'code' => 200,
            'status' => 'success',
            'sku' => $sku_update
        ];

        return response()->json($data, $data['code']);
    }

    public function productoTerminado()
    {
        $products = DB::table('producto')->select([
            'producto.id', 'producto.referencia_producto', 'producto.descripcion', 'producto.tono', 'producto.precio_lista', 'producto.precio_venta_publico'
        ])
            ->where('producto.producto_terminado', 'LIKE', '1');

        return DataTables::of($products)
            ->addColumn('Expandir', function ($product) {
                return "";
            })
            ->editColumn('precio_lista', function ($product) {
                return $product->precio_lista . " RD$";
            })
            ->editColumn('precio_venta_publico', function ($product) {
                return $product->precio_lista . " RD$";
            })


            ->addColumn('Opciones', function ($product) {
                return '<button id="btnEdit" onclick="mostrar(' . $product->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-eye fa-lg"></i></button>';
            })

            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function getImage($filename)
    {

        $isset = \Storage::disk('producto')->exists($filename);
        if ($isset) {

            $file = \Storage::disk('producto')->get($filename);

            //Devolver imagen
            return new Response($file, 200);
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La imagen no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function validarSku(Request $request)
    {

        $referencia = $request->input('referencia');


        $producto = Product::find($referencia);
        $ref = $producto->referencia_producto;
        $tallas = array();

        $sku = SKU::where('referencia_producto', $ref)
            ->orderBy('talla', 'asc')
            ->get();

        $longitud = count($sku);



        for ($i = 0; $i < $longitud; $i++) {
            array_push($tallas, $sku[$i]['talla']);
        }

        $longitudTalla = count($tallas);

        // for ($i = 0; $i < $longitudTalla; $i++) {
        //     $data = [
        //         $tallas[$i] => $tallas[$i]
        //     ];
        // }

        $a = (empty($tallas[0])) ? 0 : $tallas[0];
        $b = (empty($tallas[1])) ? 0 : $tallas[1];
        $c = (empty($tallas[2])) ? 0 : $tallas[2];
        $d = (empty($tallas[3])) ? 0 : $tallas[3];
        $e = (empty($tallas[4])) ? 0 : $tallas[4];
        $f = (empty($tallas[5])) ? 0 : $tallas[5];
        $g = (empty($tallas[6])) ? 0 : $tallas[6];
        $h = (empty($tallas[7])) ? 0 : $tallas[7];
        $n = (empty($tallas[8])) ? 0 : $tallas[8];
        $j = (empty($tallas[9])) ? 0 : $tallas[9];
        $k = (empty($tallas[10])) ? 0 : $tallas[10];
        $l = (empty($tallas[11])) ? 0 : $tallas[11];
        $general = (empty($tallas[12])) ? 0 : $tallas[12];

        $talla = (object) $tallas;


        $data = [
            'code' => 200,
            'status' => 'success',
            'tallas' => $tallas,
            $a => $a,
            $b => $b,
            $c => $c,
            $d => $d,
            $e => $e,
            $f => $f,
            $g => $g,
            $h => $h,
            $n => $n,
            $j => $j,
            $k => $l,
            $l => $l,
            $general => $general,
            // $tallas[4] => $tallas[4],
            // $tallas[5] => $tallas[5],
            // $tallas[6] => $tallas[6],
            // $tallas[7] => $tallas[7],
            // $tallas[8] => $tallas[8],
            // $tallas[9] => $tallas[9],
            // $tallas[10] => $tallas[10],
            // $tallas[11] => $tallas[11],
            // $tallas[12] => $tallas[12]

        ];

        return response()->json($data, 200);
    }

    public function verificarReferencia(Request $request)
    {

        $validar = $request->validate([
            'referencia_producto' => 'unique:producto',

        ]);
        if (!empty($validar)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => 'Test'
            ];
        }
        return response()->json($data, $data['code']);
    }
}

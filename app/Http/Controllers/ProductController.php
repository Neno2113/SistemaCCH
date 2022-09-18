<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\SKU;
use App\CurvaProducto;
use App\CatalogoCuenta;
use App\Articulo;
use App\CategoriaProducto;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;

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
            $catalogo = $request->input('catalogo');
            $precio_lista_2 = $request->input('precio_lista_2');
            $precio_venta_publico = $request->input('precio_venta_publico');
            $precio_venta_publico_2 = $request->input('precio_venta_publico_2');
            $min = $request->input('min');
            $max = $request->input('max');
            $a = $request->input('a');
            $b = $request->input('b');
            $c = $request->input('c');
            $d = $request->input('d');
            $e = $request->input('e');
            $f = $request->input('f');
            $g = $request->input('g');
            $h = $request->input('h');
            $i = $request->input('i');
            $j = $request->input('j');
            $k = $request->input('k');
            $l = $request->input('l');
            $marca = $request->input('marca');

               //validaciones
            $a = intval(trim($a, "_"));
            $b = intval(trim($b, "_"));
            $c = intval(trim($c, "_"));
            $d = intval(trim($d, "_"));
            $e = intval(trim($e, "_"));
            $f = intval(trim($f, "_"));
            $g = intval(trim($g, "_"));
            $h = intval(trim($h, "_"));
            $i = intval(trim($i, "_"));
            $j = intval(trim($j, "_"));
            $k = intval(trim($k, "_"));
            $l = intval(trim($l, "_"));

            if (empty($precio_lista_2)) {
                $precio_lista_2 = 0;
                $precio_venta_publico_2 = 0;
            }

            $product = new Product();
            $product->genero = $genero;
            $product->marca = $marca;
            $product->referencia_producto = $referencia;
            $product->referencia_producto_2 = $referencia_2;
            $product->id_user = \auth()->user()->id;
            $product->sec = $sec + 0.1;
            $product->enviado_lavanderia = 0;
            $product->id_catalogo = 3;
            $product->descripcion = $descripcion;
            $product->descripcion_2 = $descripcion_2;
            $product->precio_lista = trim($precio_lista, "RD$");
            $product->precio_lista_2 = trim($precio_lista_2, "RD$");
            $product->precio_venta_publico = trim($precio_venta_publico, "RD$");
            $product->precio_venta_publico_2 = trim($precio_venta_publico_2, "RD$");

            if (!empty($min)) {
                switch ($min) {
                    case 2:
                        $min = "a";
                        break;
                    case 4:
                        $min = "b";
                        break;
                    case 6:
                        $min = "c";
                        break;
                    case 8:
                        $min = "d";
                        break;
                    case  10:
                        $min = "e";
                        break;
                    case 12:
                        $min = "f";
                        break;
                    case 14:
                        $min = "g";
                        break;
                    case  16:
                        $min = "h";
                        break;
                }
                $product->min = $min;
            }

            if (!empty($max)) {
                switch ($max) {
                    case 2:
                        $max = "a";
                        break;
                    case 4:
                        $max = "b";
                        break;
                    case 6:
                        $max = "c";
                        break;
                    case 8:
                        $max = "d";
                        break;
                    case 10:
                        $max = "e";
                        break;
                    case 12:
                        $max = "f";
                        break;
                    case 14:
                        $max = "g";
                        break;
                    case 16:
                        $max = "h";
                        break;
                }
                $product->max = $max;
            }

            $product->save();
            // $curva = New CurvaProducto();
            // $curva->producto_id = $product->id;
            // $curva->a = $a;
            // $curva->b = $b;
            // $curva->c = $c;
            // $curva->d = $d;
            // $curva->e = $e;
            // $curva->f = $f;
            // $curva->g = $g;
            // $curva->h = $h;
            // $curva->i = $i;
            // $curva->j = $j;
            // $curva->k = $k;
            // $curva->l = $l;
            // $curva->curva_porcentuada = 0;

            // $curva->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'producto' => $product,
                // 'curva' => $curva
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
      
            ->editColumn('precio_lista', function ($product) {
                return  "RD$ " . number_format($product->precio_lista);
            })
            ->editColumn('name', function ($product) {
                return "$product->name $product->surname";
            })
            ->editColumn('precio_venta_publico', function ($product) {
                return "RD$ " . number_format($product->precio_venta_publico);
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

    //CRISTOBAL
    public function buscarLastId() {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Productos')
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
        $product = Product::select('id')->orderBy('id', 'desc')->first();

        $data = [
            'code' => 200,
            'status' => 'success',
            'product' => $product
        ];

    //    return \response()->json($data, $data['code']);
        return response()->json($data, $data['code']);

    }

    //CRISTOBAL

    public function show($id)
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Productos')
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
        $product = Product::find($id);

        if (is_object($product)) {
            $curva = CurvaProducto::where('producto_id', $product->id)->first();

            $skus = SKU::where('producto_id', $id)->get();
            

            $product->precio_lista = number_format($product->precio_lista );
            $product->precio_venta_publico = number_format($product->precio_venta_publico );

            $product->precio_lista_2 = number_format($product->precio_lista_2 );
            $product->precio_venta_publico_2 = number_format($product->precio_venta_publico_2 );

            if (!empty($product->min)) {
                switch ($product->min) {
                    case "a":
                        $product->min = 2;
                        break;
                    case "b":
                        $product->min = 4;
                        break;
                    case "c":
                        $product->min = 6;
                        break;
                    case "d":
                        $product->min = 8;
                        break;
                    case  "e":
                        $product->min = 10;
                        break;
                    case "f":
                        $product->min = 12;
                        break;
                    case "g":
                        $product->min = 14;
                        break;
                    case  "h":
                        $product->min = 16;
                        break;
                }
                $product->min = $product->min;
            }

            if (!empty($product->max)) {
                switch ($product->max) {
                    case "a":
                        $product->max = 2;
                        break;
                    case "b":
                        $product->max = 4;
                        break;
                    case "c":
                        $product->max = 6;
                        break;
                    case "d":
                        $product->max = 8;
                        break;
                    case  "e":
                        $product->max = 10;
                        break;
                    case "f":
                        $product->max = 12;
                        break;
                    case "g":
                        $product->max = 14;
                        break;
                    case  "h":
                        $product->max = 16;
                        break;
                }
                $product->max = $product->max;
            }

            $data = [
                'code' => 200,
                'status' => 'success',
                'product' => $product,
                'sku' => $skus,
               
                // 'a' => str_replace('.00', '', $curva->a),
                // 'b' => str_replace('.00', '', $curva->b),
                // 'c' => str_replace('.00', '', $curva->c),
                // 'd' => str_replace('.00', '', $curva->d),
                // 'e' => str_replace('.00', '', $curva->e),
                // 'f' => str_replace('.00', '', $curva->f),
                // 'g' => str_replace('.00', '', $curva->g),
                // 'h' => str_replace('.00', '', $curva->h),
                // 'i' => str_replace('.00', '', $curva->i),
                // 'j' => str_replace('.00', '', $curva->j),
                // 'k' => str_replace('.00', '', $curva->k),
                // 'l' => str_replace('.00', '', $curva->l),
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

    public function skuStore(Request $request){
        
        $producto = $request->input('producto');
        $sku = $request->input('sku');
        $talla = $request->input('talla');
        $referencia = $request->input('referencia');


        $sku_gen = SKU::where('sku', $sku)->first();

        if(is_object($sku_gen)){
            $data = [
                'code' => 200,
                'status' => 'validation',
                'message' => 'El SKU General ya existe',
                'sku' => $sku_gen
            ];
        } else {
         
           

            $ref = Product::find($producto);
            $sku_gen = new SKU();

            $sku_gen->producto_id = $producto;
            $sku_gen->talla = $talla;
            $sku_gen->sku = $sku;
            if(empty($referencia)){
                $sku_gen->referencia_producto = $ref->referencia_producto;
                //Verificar la talla
                $sku_check = SKU::where('producto_id', $producto)
                ->where('talla', $talla)->first();

                if(empty($sku_check)){

               
                    $sku_gen->save();
                    $skus = SKU::where('producto_id', $producto)->get();


                    $data = [
                        'code' => 200,
                        'status' => 'success',
                        'sku' => $skus,
                        'sku_check' => $sku_check
                    ];
                } else {
                    $data = [
                        'code' => 200,
                        'status' => 'talla_exist',
                        'message' => 'Esta referencia ya tiene un SKU asignado a esta talla',
                    ];
                }
            } else {
                $sku_gen->referencia_producto = $referencia;

                //Verificar la talla
                $sku_check = SKU::where('producto_id', $producto)
                ->where('referencia_producto', $referencia)
                ->where('talla', $talla)->first();

                if(empty($sku_check)){
                    $sku_gen->save();
                    $skus = SKU::where('producto_id', $producto)->get();


                    $data = [
                        'code' => 200,
                        'status' => 'success',
                        'sku' => $skus,
                        'sku_check' => $sku_check
                    ];

                 
                    
                } else {
                    $data = [
                        'code' => 200,
                        'status' => 'talla_exist',
                        'message' => 'Esta referencia ya tiene un SKU asignado a esta talla',
                    ];
                }

            }

          

          

        }

        return \response()->json($data, $data['code']); 
    }

    public function showTerminado($id)
    {
     
        $product = Product::find($id);

        if (is_object($product)) {
            $curva = CurvaProducto::where('producto_id', $product->id)->first();

            $product->precio_lista = number_format($product->precio_lista);
            $product->precio_venta_publico = number_format($product->precio_venta_publico);

            $data = [
                'code' => 200,
                'status' => 'success',
                'product' => $product,
                // 'a' => str_replace('.00', '', $curva->a),
                // 'b' => str_replace('.00', '', $curva->b),
                // 'c' => str_replace('.00', '', $curva->c),
                // 'd' => str_replace('.00', '', $curva->d),
                // 'e' => str_replace('.00', '', $curva->e),
                // 'f' => str_replace('.00', '', $curva->f),
                // 'g' => str_replace('.00', '', $curva->g),
                // 'h' => str_replace('.00', '', $curva->h),
                // 'i' => str_replace('.00', '', $curva->i),
                // 'j' => str_replace('.00', '', $curva->j),
                // 'k' => str_replace('.00', '', $curva->k),
                // 'l' => str_replace('.00', '', $curva->l),
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
            $referencia_2 = $request->input('referencia_2', true);
            $descripcion = $request->input('descripcion', true);
            $descripcion_2 = $request->input('descripcion_2', true);
            $precio_lista = $request->input('precio_lista');
            $catalogo = $request->input('catalogo');
            $precio_lista_2 = $request->input('precio_lista_2');
            $precio_venta_publico = $request->input('precio_venta_publico');
            $precio_venta_publico_2 = $request->input('precio_venta_publico_2');
            $min = $request->input('min');
            $max = $request->input('max');
            $a = $request->input('a');
            $b = $request->input('b');
            $c = $request->input('c');
            $d = $request->input('d');
            $e = $request->input('e');
            $f = $request->input('f');
            $g = $request->input('g');
            $h = $request->input('h');
            $i = $request->input('i');
            $j = $request->input('j');
            $k = $request->input('k');
            $l = $request->input('l');

               //validaciones
            $a = intval(trim($a, "_"));
            $b = intval(trim($b, "_"));
            $c = intval(trim($c, "_"));
            $d = intval(trim($d, "_"));
            $e = intval(trim($e, "_"));
            $f = intval(trim($f, "_"));
            $g = intval(trim($g, "_"));
            $h = intval(trim($h, "_"));
            $i = intval(trim($i, "_"));
            $j = intval(trim($j, "_"));
            $k = intval(trim($k, "_"));
            $l = intval(trim($l, "_"));


            $product = Product::find($id);

            if (empty($precio_lista_2)) {
                $precio_lista_2 = 0;
                $precio_venta_publico_2 = 0;
            }

            $product->referencia_producto = $referencia;
            $product->referencia_producto_2 = $referencia_2;
            $product->descripcion_2 = $descripcion_2;
            $product->descripcion = $descripcion;
            $product->id_catalogo = 3;
            $product->precio_lista = trim($precio_lista, "_RD$");
            $product->precio_lista_2 = trim($precio_lista_2, "_RD$");
            $product->precio_venta_publico = trim($precio_venta_publico, "_RD$");
            $product->precio_venta_publico_2 = trim($precio_venta_publico_2, "_RD$");
            // $product->sec = $sec;
            // $product->id_user = \auth()->user()->id;
            if (!empty($min)) {
                switch ($min) {
                    case 2:
                        $min = "a";
                        break;
                    case 4:
                        $min = "b";
                        break;
                    case 6:
                        $min = "c";
                        break;
                    case 8:
                        $min = "d";
                        break;
                    case  10:
                        $min = "e";
                        break;
                    case 12:
                        $min = "f";
                        break;
                    case 14:
                        $min = "g";
                        break;
                    case  16:
                        $min = "h";
                        break;
                }
                $product->min = $min;
            }

            if (!empty($max)) {
                switch ($max) {
                    case 2:
                        $max = "a";
                        break;
                    case 4:
                        $max = "b";
                        break;
                    case 6:
                        $max = "c";
                        break;
                    case 8:
                        $max = "d";
                        break;
                    case 10:
                        $max = "e";
                        break;
                    case 12:
                        $max = "f";
                        break;
                    case 14:
                        $max = "g";
                        break;
                    case 16:
                        $max = "h";
                        break;
                }
                $product->max = $max;
            }


            $product->save();

            // $curva =CurvaProducto::where('producto_id', $id)->first();
            // $curva->a = $a;
            // $curva->b = $b;
            // $curva->c = $c;
            // $curva->d = $d;
            // $curva->e = $e;
            // $curva->f = $f;
            // $curva->g = $g;
            // $curva->h = $h;
            // $curva->i = $i;
            // $curva->j = $j;
            // $curva->k = $k;
            // $curva->l = $l;

            // $curva->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'product' => $product,
                // 'curva' => $curva
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Productos')
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

    public function editSKU($id)
    {
        $sku = SKU::find($id);

        if (!empty($sku)) {

            $sku->producto_id = '';
            $sku->referencia_producto = '';
            $sku->talla = '';
            $sku->asignado = '';
            $sku->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'sku' => $sku
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


    public function destroySKU($id)
    {
        $sku = SKU::find($id);

        if (!empty($sku)) {
            $sku->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'sku' => $sku
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
        $ref2 = $request->input('ref2');


        if(empty($ref2)){

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
            $rango = $producto->min;
    
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
        }

        if( !empty($ref2) ){
            $producto = Product::find($producto_id);
            $referencia_2 = $producto->referencia_producto_2;
            $val_2 = 0;
            $sku_2 = SKU::where('asignado', $val_2)->get()->first();
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

            $data = [
                'code' => 200,
                'status' => 'success',
                'sku' => $sku_update_2
            ];
        }

        // if (!empty($referencia_2)) {

        //     $val_2 = 0;
        //     $sku_2 = SKU::where('asignado', $val)->get()->first();
        //     \json_encode($sku_2);

        //     if (empty($sku_2)) {
        //         $val_2 = null;
        //         $sku_2 = SKU::where('asignado', $val_2)->get()->first();
        //         \json_encode($sku_2);
        //     }

        //     $id_2 = $sku_2['id'];

        //     $sku_update_2 = SKU::find($id_2);
        //     $sku_update_2->producto_id = $producto_id;
        //     $sku_update_2->talla = $talla;
        //     $sku_update_2->referencia_producto = $referencia_2;
        //     $sku_update_2->asignado = 1;

        //     $sku_update_2->save();
        // }



     

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
                return number_format($product->precio_lista) . " RD$";
            })
            ->editColumn('precio_venta_publico', function ($product) {
                return number_format($product->precio_lista) . " RD$";
            })


            ->addColumn('Opciones', function ($product) {
                return '<button id="btnEdit" onclick="mostrar(' . $product->id . ')" class="btn btn-dark btn-sm" > <i class="fas fa-eye fa-lg"></i></button>';
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
        $ref = $request->input('referencia_producto');
        $product = Product::where('referencia_producto', 'LIKE', $ref)
        ->orWhere('referencia_producto_2', 'LIKE', $ref)->get()->first();
     
        if (empty($product)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Este referencia esta disponible',
                'product' => $product
            
            ];
        }  else {
            $data = [
                'code' => 200,
                'status' => 'validation',
                'message' => 'Este referencia ya fue creada',
                'product' => $product
            ];
         
        }
        return response()->json($data, $data['code']);
    }

    public function storeCatalogo(Request $request){
        $validar = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
            'tipo_cuenta' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $codigo = $request->input('codigo');
            $descripcion = $request->input('descripcion');
            $tipo_cuenta = $request->input('tipo_cuenta');


            $catalogo = new CatalogoCuenta();
            $catalogo->codigo = $codigo;
            $catalogo->descripcion = $descripcion;
            $catalogo->tipo_cuenta = $tipo_cuenta;

            $catalogo->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'catalogo' => $catalogo
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function catalogos()
    {
        $catalogos = DB::table('catalogo_cuenta')->select([
            'catalogo_cuenta.id', 'catalogo_cuenta.codigo', 'catalogo_cuenta.descripcion', 'catalogo_cuenta.tipo_cuenta'
        ]);
        return DataTables::of($catalogos)
            ->addColumn('Expandir', function ($catalogo) {
                return "";
            })

            ->addColumn('Editar', function ($catalogo) {
                return '<button id="btnEdit" onclick="mostrar(' . $catalogo->id . ')" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $catalogo->id . ')" class="btn btn-danger btn-sm ml-1"><i class="fas fa-eraser"></i></button>';
            })

            ->rawColumns(['Editar'])
            ->make(true);
    }

    public function showCatalogo($id){
        $catalogo = CatalogoCuenta::find($id);

        if(is_object($catalogo)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'catalogo' => $catalogo
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error en la busqueda'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function updateCatalogo(Request $request)
    {
        $validar = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
            'tipo_cuenta' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id');
            $codigo = $request->input('codigo');
            $descripcion = $request->input('descripcion');
            $tipo_cuenta = $request->input('tipo_cuenta');


            $catalogo = CatalogoCuenta::find($id);

            $catalogo->codigo = $codigo;
            $catalogo->descripcion = $descripcion;
            $catalogo->tipo_cuenta = $tipo_cuenta;

            $catalogo->save();


            $data = [
                'code' => 200,
                'status' => 'success',
                'catalogo' => $catalogo
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroyCatalogo($id){
        $catalogo = CatalogoCuenta::find($id);

        if(is_object($catalogo)){
            $catalogo->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'catalogo' => $catalogo
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'no se encontro nada'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function catalogoSeleccionar(){
        $catalogo = CatalogoCuenta::all();


        $data = [
            'code' => 200,
            'status' => 'success',
            'catalogo' => $catalogo
        ];


        return response()->json($data, $data['code']);
    }

    public function storeArticulo(Request $request){
        $validar = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo_articulo' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $nombre = $request->input('nombre');
            $descripcion = $request->input('descripcion');
            $tipo_articulo = $request->input('tipo_articulo');


            $articulo = new Articulo();
            $articulo->nombre = $nombre;
            $articulo->descripcion = $descripcion;
            $articulo->tipo_articulo = $tipo_articulo;

            $articulo->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'articulo' => $articulo
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function articulos()
    {
        $catalogos = DB::table('producto_articulo')->select([
            'producto_articulo.id', 'producto_articulo.nombre', 'producto_articulo.descripcion', 'producto_articulo.tipo_articulo'
        ]);
        return DataTables::of($catalogos)
            ->addColumn('Expandir', function ($catalogo) {
                return "";
            })

            ->addColumn('Editar', function ($catalogo) {
                return '<button id="btnEdit" onclick="mostrar(' . $catalogo->id . ')" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $catalogo->id . ')" class="btn btn-danger btn-sm ml-1"><i class="fas fa-eraser"></i></button>';
            })

            ->rawColumns(['Editar'])
            ->make(true);
    }

    public function showArticulo($id){
        $articulo = Articulo::find($id);

        if(is_object($articulo)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'articulo' => $articulo
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error en la busqueda'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function updateArticulo(Request $request)
    {
        $validar = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo_articulo' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id');
            $nombre = $request->input('nombre');
            $descripcion = $request->input('descripcion');
            $tipo_articulo = $request->input('tipo_articulo');


            $catalogo = CatalogoCuenta::find($id);

            $articulo = Articulo::find($id);
            $articulo->nombre = $nombre;
            $articulo->descripcion = $descripcion;
            $articulo->tipo_articulo = $tipo_articulo;

            $articulo->save();


            $data = [
                'code' => 200,
                'status' => 'success',
                'articulo' => $articulo
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function destroyArticulo($id){
        $articulo = Articulo::find($id);

        if(is_object($articulo)){
            $articulo->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'articulo' => $articulo
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'no se encontro nada'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }


    public function upload(Request $request)
    {

        //validar la imagen
        $validate = \Validator::make($request->all(), [
            'imagen_frente' => 'image|mimes:jpg,jpeg,png',
            'imagen_trasera' => 'image|mimes:jpg,jpeg,png',
            'imagen_perfil' => 'image|mimes:jpg,jpeg,png',
            'imagen_bolsillo' => 'image|mimes:jpg,jpeg,png',
            'product_id' => 'required'
        ]);
        // Guardar la imagen
        if ($validate->fails()) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            $imagen_frente = $request->file('imagen_frente');
            $imagen_trasero = $request->file('imagen_trasera');
            $imagen_perfil = $request->file('imagen_perfil');
            $imagen_bolsillo = $request->file('imagen_bolsillo');
            $product_id = $request->input('product_id');

            $image_name_1 = (!empty($imagen_frente)) ? time() . $imagen_frente->getClientOriginalName() : null;
            $image_name_2 = (!empty($imagen_trasero)) ? time() . $imagen_trasero->getClientOriginalName() : null;
            $image_name_3 = (!empty($imagen_perfil)) ? time() . $imagen_perfil->getClientOriginalName() : null;
            $image_name_4 = (!empty($imagen_bolsillo)) ? time() . $imagen_bolsillo->getClientOriginalName() : null;

            if(empty($product_id)){
                $select = DB::select("SHOW TABLE STATUS LIKE 'producto'");
                $nextId = $select[0]->Auto_increment;

                $product_id = $nextId;
            }

            $producto = Product::find($product_id);
            $producto->imagen_frente = $image_name_1;
            $producto->imagen_trasero = $image_name_2;
            $producto->imagen_perfil = $image_name_3;
            $producto->imagen_bolsillo = $image_name_4;
            $producto->save();

            if(!empty($imagen_frente)){
                // $resize_imagen_frente = $this->resize_image($imagen_frente, 300, 500);
                // $image_resize = Image::make($imagen_frente->getRealPath() );
                // $img =  $image_resize->resize(300, 500);

            
                // \Storage::disk('producto')->put($image_name_1, $img);
                \Storage::disk('producto')->put($image_name_2, \File::get($imagen_frente));
            }
            if(!empty($imagen_trasero)){
                \Storage::disk('producto')->put($image_name_2, \File::get($imagen_trasero));

            }
            if(!empty($imagen_perfil)){
                \Storage::disk('producto')->put($image_name_3, \File::get($imagen_perfil));

            }
            if(!empty($imagen_bolsillo)){
                \Storage::disk('producto')->put($image_name_4, \File::get($imagen_bolsillo));

            }

            $data = [
                'code' => 200,
                'status' => 'success',
                'frente' => $image_name_1,
                'trasero' => $image_name_2,
                'perfil' => $image_name_3,
                'bolsillo' => $image_name_4
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function catMarcas(){
        $marcas = CategoriaProducto::where('tipo', 'marca')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'marcas' => $marcas
        ];
        return response()->json($data, $data['code']);
    }   


    public function catGenero(){
        $generos = CategoriaProducto::where('tipo', 'genero')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'generos' => $generos
        ];
        return response()->json($data, $data['code']);
    } 

    public function catTipo(){
        $tipos = CategoriaProducto::where('tipo', 'tipo_producto')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'tipos' => $tipos
        ];
        return response()->json($data, $data['code']);
    } 

    public function catCategoria(){
        $categorias = CategoriaProducto::where('tipo', 'categoria')->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'categorias' => $categorias
        ];
        return response()->json($data, $data['code']);
    } 

    public function storeCategoria(Request $request){

        $validar = $request->validate([
            'tipo' => 'required',
            'indice' => 'required',
            'nombre' => 'required'
        ]);

        if(empty($validar)){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $tipo = $request->input('tipo');
            $indice = $request->input('indice');
            $nombre = $request->input('nombre');

            $categoria = new CategoriaProducto();

            $categoria->tipo = $tipo;
            $categoria->indice = $indice;
            $categoria->nombre = $nombre;

            $categoria->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'categoria' => $categoria
            ];

        }

        return response()->json($data, $data['code']);
    }


    public function showCategorias($tipo) {
        $tipos = CategoriaProducto::where('tipo', $tipo)->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'categorias' => $tipos
        ];
        return response()->json($data, $data['code']);
    }

    public function destroyCategoria($id){
        $categoria = CategoriaProducto::find($id);

        if(is_object($categoria)){
            $categoria->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'categoria' => $categoria
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
    
}

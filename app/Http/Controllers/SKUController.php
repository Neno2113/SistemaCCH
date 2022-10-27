<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SKU;
use App\Corte;
use App\Product;
use App\CategoriaProducto;
use PHPUnit\Util\Json;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;
use App\RollosDetail;
use App\Cloth;
use App\Talla;
use App\Supplier;
use App\Client;
use App\SkuEspecial;
use Illuminate\Http\Response;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;

class SKUController extends Controller
{
    public function read_file(Request $request)
    {
        if ($request->hasFile('sku')) { // comprobar que existe el archivo del input con name = sku
            $file = $request->file('sku');
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); // instancia de la libreria phpOffice
            $reader = $spreadsheet->load($file);  //cargar el archivo
            $worksheet = $reader->getActiveSheet(); // leer solo las hojas activas
            $rows = [];  // array del final
            foreach ($worksheet->getRowIterator() as $row) { // loop para recorrer todas las celdas activas
                $cellIteratorr = $row->getCellIterator();
                $cellIteratorr->setIterateOnlyExistingCells(false);
                $cells = [];
                foreach ($cellIteratorr as $cell) {
                    $cells[] = $cell->getValue();
                }
                $rows[] = $cells; // se le asigna el resultado al array rows
            }

            $clean_rows = array_filter($rows, function ($value) { // limpiado de arrays vacios
                return $value != "" ? array_pop($value) : '';
            });

            for ($i = 0; $i < count($clean_rows); $i++) {
                $arr[] = ['sku' => $clean_rows[$i][0]]; //agregandole cabecera de sku para hacer el insert

            }
            SKU::insert($arr);
            $request->session()->flash('msg', 'SKU agregados correctamente!!');
            return redirect('/sku');
        }
    }

    public function skus()
    {
        
        $skus = DB::table('sku')->where('talla', 'General')->leftJoin('producto', 'sku.producto_id', '=', 'producto.id')->leftJoin('corte', 'sku.producto_id', '=', 'corte.producto_id')
            ->select([
                'sku.id', 'sku.producto_id', 'corte.numero_corte', 'corte.fecha_corte', 'corte.no_marcada', 'corte.id AS corteid', 'sku.sku', 'sku.referencia_producto', 'sku.talla', 'producto.referencia_producto AS preferencia1', 'producto.referencia_producto_2', 'producto.genero', 'producto.entalle_bragueta', 'producto.entalle_piernas', 'producto.min', 'producto.max'
            ])->groupBy('sku.referencia_producto');

        return DataTables::of($skus)
        ///////////////////////////////////////////////
            ->addColumn('Expandir', function ($sku) {
                return "";
            })
            ->addColumn('Editar', function ($sku) {
            //    return "Print-".$sku->producto_id;
            //    $producto = $sku->producto_id;
                if ($sku->producto_id) {
                //    return '<button id="printLabel" onclick="printlabel(' . $sku->id . ')" class="btn btn-success btn-sm mr-1"><i class="fas fa-print"></i></button>';
                //    return '<a href="print_label/' . $sku->id . '" target="_blank" class="btn btn-primary btn-sm ml-1"> <i class="fas fa-print"></i></a>';
                    return '<button id="print_label" onclick="mostrar(' . $sku->id . ')" class="btn btn-primary btn-sm ml-1"> <i class="fas fa-print"></i></button>';
                } else {
                    return "";
                }
            }) 
            ->editColumn('numero_corte', function ($sku) {
                if ($sku->numero_corte){
                    $num_corte = $sku->numero_corte;
                } else {
                    $num_corte = '';
                }
                return $num_corte;  
            })
            ->editColumn('fecha_corte', function ($sku) {
                if ($sku->fecha_corte){
                    $fecha_corte = $sku->fecha_corte;
                } else {
                    $fecha_corte = '';
                }
                return $fecha_corte;  
            })
            ->editColumn('no_marcada', function ($sku) {
                if ($sku->numero_corte){
                    $rollo = RollosDetail::where('corte_utilizado', $sku->numero_corte)->get()->first();
                    $tela = Cloth::where('id', $rollo->id_tela)->get()->first();
                    $nombreTela = $tela->referencia;
                //    $marcada = substr($sku->no_marcada, 6, -3);
                } else {
                    $nombreTela = '';
                }
                return $nombreTela;  
            })
            ->editColumn('entalle_bragueta', function ($sku) {
                if (is_numeric($sku->entalle_bragueta)){
                    /*
                    $bragueta = DB::table('categorias_producto')->where([
                        ['tipo', 'entalle_bragueta'],
                        ['indice', $sku->entalle_bragueta]
                        ])->select('categorias_producto.nombre');

                    $entalle_bragueta = $bragueta->nombre;
                    */
                    if($bragueta = CategoriaProducto::where('tipo', 'entalle_bragueta')->where('indice', $sku->entalle_bragueta)->get()->first()) {
                        $entalle_bragueta = $bragueta->nombre;
                    } else {
                        $entalle_bragueta = '';
                    }
                    
                } else {
                    $entalle_bragueta = '';
                }
                return $entalle_bragueta;  
            })
            ->editColumn('entalle_piernas', function ($sku) {
                if (is_numeric($sku->entalle_piernas)){
                    if($piernas = CategoriaProducto::where('tipo', 'entalle_piernas')->where('indice', $sku->entalle_piernas)->get()->first()) {
                        $entalle_piernas = $piernas->nombre;
                    } else {
                        $entalle_piernas = '';
                    }
                    
                } else {
                    $entalle_piernas = '';
                }
                return $entalle_piernas;  
            })
            ->editColumn('talla', function ($sku) {
                $producto = $sku->producto_id;
                $referencia = $sku->referencia_producto;
                $talla = $sku->talla;
                /*
                if ($sku->$referencia_producto_2) {
                    $referencia2 = $sku->referencia_producto_2;
                    $referencia1 = $sku->referencia_producto;
                    $genero = $sku->genero;   
                    $mujer_plus = substr($referencia, 3, 1);
                    $min_talla = $sku->min;   
                    $max_talla = $sku->max;   
                */
                
                if($product = Product::where('id', $producto)->get()->first()) {
                    $referencia2 = $product->referencia_producto_2;
                    $referencia1 = $product->referencia_producto;
                    $genero = $product->genero;   
                    $mujer_plus = substr($referencia, 3, 1);
                    $hay_tallas = "no";
                    $tallas = Talla::where('corte_id', $sku->corteid)->get()->first();
                    if (is_object($tallas)) {
                        $hay_tallas = "si";
                        if ($tallas->a > 0) {
                            $min_talla = "a"; 
                        } elseif ($tallas->b > 0) {
                            $min_talla = "b"; 
                        } elseif ($tallas->c > 0) {
                            $min_talla = "c"; 
                        } elseif ($tallas->d > 0) {
                            $min_talla = "d"; 
                        } elseif ($tallas->e > 0) {
                            $min_talla = "e"; 
                        } elseif ($tallas->f > 0) {
                            $min_talla = "f"; 
                        } elseif ($tallas->g > 0) {
                            $min_talla = "g"; 
                        } elseif ($tallas->h > 0) {
                            $min_talla = "h"; 
                        } elseif ($tallas->i > 0) {
                            $min_talla = "i"; 
                        } elseif ($tallas->j > 0) {
                            $min_talla = "j"; 
                        } elseif ($tallas->k > 0) {
                            $min_talla = "k"; 
                        } elseif ($tallas->l > 0) {
                            $min_talla = "l"; 
                        }
    
                        if ($tallas->l > 0) {
                            $max_talla = "l"; 
                        } elseif ($tallas->k > 0) {
                            $max_talla = "k"; 
                        } elseif ($tallas->j > 0) {
                            $max_talla = "j"; 
                        } elseif ($tallas->i > 0) {
                            $max_talla = "i"; 
                        } elseif ($tallas->h > 0) {
                            $max_talla = "h"; 
                        } elseif ($tallas->g > 0) {
                            $max_talla = "g"; 
                        } elseif ($tallas->f > 0) {
                            $max_talla = "f"; 
                        } elseif ($tallas->e > 0) {
                            $max_talla = "e"; 
                        } elseif ($tallas->d > 0) {
                            $max_talla = "d"; 
                        } elseif ($tallas->c > 0) {
                            $max_talla = "c"; 
                        } elseif ($tallas->b > 0) {
                            $max_talla = "b"; 
                        } elseif ($tallas->a > 0) {
                            $max_talla = "a"; 
                        }
                    }
 
                    if ($genero == "2") {
                        if ($mujer_plus == "7") {
                            $a = '12W';
                            $b = '14W';
                            $c = '16W';
                            $d = '18W';
                            $e = '20W';
                            $f = '22W';
                            $g = '24W';
                            $h = '26W';
                        } else {
                            $a = '0/0';
                            $b = '1/2';
                            $c = '3/4';
                            $d = '5/6';
                            $e = '7/8';
                            $f = '9/10';
                            $g = '11/12';
                            $h = '13/14';
                            $i = '15/16';
                            $j = '17/18';
                            $k = '19/20';
                            $l = '21/22';
                        }
                    } else if ($genero == "3" || $genero == "4") {
                            $a = '2';
                            $b = '4';
                            $c = '6';
                            $d = '8';
                            $e = '10';
                            $f = '12';
                            $g = '14';
                            $h = '16';
                            
                        if ($referencia == $referencia1) {
                            switch ($product->min) {
                                case "a":
                                    $min_talla = "";
                                    $max_talla = "";
                                    break;
                                case "b":
                                    $min_talla = "a";
                                    $max_talla = "a";
                                    break;
                                case "c":
                                    $min_talla = "a";
                                    $max_talla = "b";
                                    break;
                                case "d":
                                    $min_talla = "a";
                                    $max_talla = "c";
                                    break;
                                case "e":
                                    $min_talla = "a";
                                    $max_talla = "d";
                                    break;
                                case "f":
                                    $min_talla = "a";
                                    $max_talla = "e";
                                    break;
                                case "g":
                                    $min_talla = "a";
                                    $max_talla = "f";
                                    break;
                                case "h":
                                    $min_talla = "a";
                                    $max_talla = "g";
                                    break;
                            }

                        } else {
                            switch ($product->min) {
                                case "a":
                                    $min_talla = "a";
                                    $max_talla = "h";
                                    break;
                                case "b":
                                    $min_talla = "b";
                                    $max_talla = "h";
                                    break;
                                case "c":
                                    $min_talla = "c";
                                    $max_talla = "h";
                                    break;
                                case "d":
                                    $min_talla = "d";
                                    $max_talla = "h";
                                    break;
                                case "e":
                                    $min_talla = "e";
                                    $max_talla = "h";
                                    break;
                                case "f":
                                    $min_talla = "f";
                                    $max_talla = "h";
                                    break;
                                case "g":
                                    $min_talla = "g";
                                    $max_talla = "h";
                                    break;
                                case "h":
                                    $min_talla = "h";
                                    $max_talla = "h";
                                    break;
                            }

                        }
                    } else if ($genero == "1") {
                            $a = '28';
                            $b = '29';
                            $c = '30';
                            $d = '32';
                            $e = '34';
                            $f = '36';
                            $g = '38';
                            $h = '40';
                            $i = '42';
                            $j = '44';
                            $k = '46';
                    }

                    if ($talla == "General" && $hay_tallas == "si") {
                        if ($min_talla == 'a') {
                            $min_talla = $a;
                        } else if ($min_talla == 'b') {
                            $min_talla = $b;
                        } else if ($min_talla == 'c') {
                            $min_talla = $c;
                        } else if ($min_talla == 'd') {
                            $min_talla = $d;
                        } else if ($min_talla == 'e') {
                            $min_talla = $e;
                        } else if ($min_talla == 'f') {
                            $min_talla = $f;
                        } else if ($min_talla == 'g') {
                            $min_talla = $g;
                        } else if ($min_talla == 'h') {
                            $min_talla = $h;
                        } else if ($min_talla == 'i') {
                            $min_talla = $i;
                        } else if ($min_talla == 'j') {
                            $min_talla = $j;
                        } else if ($min_talla == 'k') {
                            $min_talla = $k;
                        } else if ($min_talla == 'l') {
                            $min_talla = $l;
                        } 
    
                        if ($max_talla == 'a') {
                            $max_talla = $a;
                        } else if ($max_talla == 'b') {
                            $max_talla = $b;
                        } else if ($max_talla == 'c') {
                            $max_talla = $c;
                        } else if ($max_talla == 'd') {
                            $max_talla = $d;
                        } else if ($max_talla == 'e') {
                            $max_talla = $e;
                        } else if ($max_talla == 'f') {
                            $max_talla = $f;
                        } else if ($max_talla == 'g') {
                            $max_talla = $g;
                        } else if ($max_talla == 'h') {
                            $max_talla = $h;
                        } else if ($max_talla == 'i') {
                            $max_talla = $i;
                        } else if ($max_talla == 'j') {
                            $max_talla = $j;
                        } else if ($max_talla == 'k') {
                            $max_talla = $k;
                        } else if ($max_talla == 'l') {
                            $max_talla = $l;
                        } 
    
                        return $min_talla. ' - '.$max_talla;
                    } else {
                        if ($talla == 'A') {
                            $talla = $a;
                        } else if ($talla == 'B') {
                            $talla = $b;
                        } else if ($talla == 'C') {
                            $talla = $c;
                        } else if ($talla == 'D') {
                            $talla = $d;
                        } else if ($talla == 'E') {
                            $talla = $e;
                        } else if ($talla == 'F') {
                            $talla = $f;
                        } else if ($talla == 'G') {
                            $talla = $g;
                        } else if ($talla == 'H') {
                            $talla = $h;
                        } else if ($talla == 'I') {
                            $talla = $i;
                        } else if ($talla == 'J') {
                            $talla = $j;
                        } else if ($talla == 'K') {
                            $talla = $k;
                        } else if ($talla == 'L') {
                            $talla = $l;
                        } else if ($talla == 'General') {
                            $talla = "General";
                        } 

                        return $talla;
                    }  
                }
             })
            ->rawColumns(['Editar'])
        //    ->rawColumns(['Corte', 'Fecha', 'Marcada'])
            ->make(true);
    }
    


    public function sku_disponibles()
    {
        $skus = SKU::whereNull('referencia_producto')->count();

        $data = [
            'code' => 200,
            'status' => 'success',
            'sku' => $skus
        ];

        return response()->json($data, $data['code']);
    }

    public function clienteSelect(){
        $cliente = Client::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'cliente' => $cliente
        ];

        return response()->json($data, $data['code']);
    }

    public function upload(Request $request)
    {
        
        //validar csv
        $validate = \Validator::make($request->all(), [
            'skus_esp' => 'required|mimes:csv,txt',
        ]);
        // Guardar la imagen
        if ($validate->fails()) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            $file = $request->file('skus_esp');  
            $referencia = $request->input('referencia');  
            $product_id = $request->input('product_id');  
            $cliente_id = $request->input('cliente_id');  
            $nombre_cliente = $request->input('nombre_cliente');
            if ($file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
                $tempPath = $file->getRealPath();
                $fileSize = $file->getSize(); //Get size of uploaded file in bytes

                    //Where uploaded file will be stored on the server 
                $location = public_path().'/uploads'; //Created an "uploads" folder for that
                // Upload file
                $file->move($location, $filename);

                // In case the uploaded file path is to be stored in the database 
                //    $filepath = public_path($location . "/" . $filename);
                $filepath = $location."/".$filename;
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array(); // Read through the file and store the contents as an array
                $i = 0;

                //Read the contents of the uploaded file 
                while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                        $i++;
                        continue;
                        }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                        $i++;
                }
                fclose($file); //Close after reading

                $j = 0;
                foreach ($importData_arr as $importData) {
                    $sku_e = $importData[0]; //Get sku
                    $talla = $importData[1]; //Get talla
                    $cant = $importData[2]; //Get cantidad
                    $j++;

                    try {
                        
                        $sku_especi = new SkuEspecial();

                        $sku_especi->producto_id = intval($product_id);
                        $sku_especi->referencia_producto = $referencia;
                        $sku_especi->sku_especial = $sku_e;
                        $sku_especi->cantidad = intval($cant);
                        $sku_especi->talla = $talla;
                        $sku_especi->cliente_id = intval($cliente_id);
                        $sku_especi->nombre_cliente = $nombre_cliente;

                        $sku_especi->save();
                    
                    } catch (\Exception $e) {
                        //throw $th;
                    //    DB::rollBack();

                    }
                }
                $skus_esp = SkuEspecial::where('producto_id', $product_id)->where('cliente_id', $cliente_id)->get();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'skus_esp' => $skus_esp
                ];
        
            } else {
            //no file was uploaded
        //    throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                $data = [
                    'code' => 200,
                    'status' => 'file-no-valid'
                ];
            }
        }

        return response()->json($data, $data['code']); 
        
    }

    public function show($id)
    {  
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Telas')
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
        $sku = SKU::find($id);
        $referencia = $sku->referencia_producto;
        $skus = SKU::where('referencia_producto', $referencia)->get();
        $corte = Corte::where('producto_id', $sku->producto_id)->get()->first();
        $tallas = Talla::where('corte_id', $corte->id)->get()->first();
        $producto = Product::where('id', $sku->producto_id)->get()->first();

        if (is_object($corte)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'sku' => $sku,
                'skus' => $skus,
                'tallas' => $tallas,
                'producto' => $producto
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'Error',
                'message' => 'Este producto aun no tiene corte'
            ];
        }

        return \response()->json($data, $data['code']);
        
    }

    public function showEspecial($cliente_id, $product_id)
    {  
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Telas')
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

        $skus_esp = SkuEspecial::where('producto_id', $product_id)->where('cliente_id', $cliente_id)->get();

        if (is_object($skus_esp)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'skus' => $skus_esp
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'Error',
                'message' => 'Este cliente no tiene codigos especiales'
            ];
        }

        return \response()->json($data, $data['code']);
        
    }

    public function imprimirlabel($id, $cantidad, $tipo)
    {
        function firstNumPos($text, $number){
            preg_match_all('!\d+!', $text, $match);
            foreach ($match[0] as $value) {
                if ($value > $number) {
                    return strpos($text, $value);
                }
            }
        }
        if ($tipo == 1) {
            $skus = SKU::find($id);
            $barcode_sku = $skus->sku;
        } else {
            $skus = SkuEspecial::find($id);
            $barcode_sku = $skus->sku_especial;
        }

        $producto = Product::where('id', $skus->producto_id)->get()->first();
        $corte = Corte::where('producto_id', $skus->producto_id)->get()->first();
        $bragueta = CategoriaProducto::where('tipo', 'entalle_bragueta')->where('indice', $producto->entalle_bragueta)->get()->first();
            if (is_object($bragueta)) {
                $entalle_bragueta = $bragueta->nombre;
            } else {
                $entalle_bragueta = "No Available";
            }
            
        $pierna = CategoriaProducto::where('tipo', 'entalle_piernas')->where('indice', $producto->entalle_piernas)->get()->first();
            if (is_object($pierna)) {
                $entalle_piernas = $pierna->nombre;
            } else {
                $entalle_piernas = "No Available";
            }
            

        if (is_object($corte)) {
            $wash = $corte->wash;
            $season = substr($corte->fecha_corte,2,2)."-".substr($corte->fecha_corte,5,2);
            $rollo = RollosDetail::where('corte_utilizado', $corte->numero_corte)->get()->first();
            $tela = Cloth::where('id', $rollo->id_tela)->get()->first();
            $suplidor = Supplier::where('id', $tela->id_suplidor)->get()->first();
            $telaAbrev = substr_count($tela->referencia, ' ');
            $hay_tallas = "no";

            if ($telaAbrev >= 1){

                $telaNumPos = firstNumPos($tela->referencia, 0);
                if (is_numeric($telaNumPos) && $telaNumPos > 0) {
                    $lastNumber = substr($tela->referencia,$telaNumPos,1);
                    if ($lastNumber == 0){
                        $telaNumPos = $telaNumPos+1;
                        $lastNumber = substr($tela->referencia,$telaNumPos,1);
                        if ($lastNumber == 0){
                            $telaNumPos = $telaNumPos+1;
                            $lastNumber = substr($tela->referencia,$telaNumPos,1);
                        }
                    }
                } else {
                    $lastNumber = '';
                }
                
                $palabras = explode(" ", $tela->referencia);
                $telaAbrev = substr($palabras[0],0,1).substr($palabras[1],0,1).$lastNumber;
            } else {

                $telaNumPos = firstNumPos($tela->referencia, 0);
                if (is_numeric($telaNumPos) && $telaNumPos > 0) {
                    $lastNumber = substr($tela->referencia,$telaNumPos,1);
                    if ($lastNumber == 0){
                        $telaNumPos = $telaNumPos+1;
                        $lastNumber = substr($tela->referencia,$telaNumPos,1);
                        if ($lastNumber == 0){
                            $telaNumPos = $telaNumPos+1;
                            $lastNumber = substr($tela->referencia,$telaNumPos,1);
                        }
                    }
                } else {
                    $lastNumber = '';
                }
                $telaAbrev = substr($tela->referencia,0,2).$lastNumber;
            }

            $fabric = $suplidor->abreviacion."-".$telaAbrev;
        } else {
            $fabric = "No Available";
            $season = "No Available";
        }
        
            $referencia2 = $producto->referencia_producto_2;
            $referencia1 = $producto->referencia_producto;
            $genero = $producto->genero;   
            $mujer_plus = substr($referencia1, 3, 1);
            $min_talla = $producto->min;   
            $max_talla = $producto->max;   
            $talla = $skus->talla;

            $tallas = Talla::where('corte_id', $corte->id)->get()->first();
                if (is_object($tallas)) {
                    $hay_tallas = "si";
                    if ($tallas->a > 0) {
                        $min_talla = "a"; 
                    } elseif ($tallas->b > 0) {
                        $min_talla = "b"; 
                    } elseif ($tallas->c > 0) {
                        $min_talla = "c"; 
                    } elseif ($tallas->d > 0) {
                        $min_talla = "d"; 
                    } elseif ($tallas->e > 0) {
                        $min_talla = "e"; 
                    } elseif ($tallas->f > 0) {
                        $min_talla = "f"; 
                    } elseif ($tallas->g > 0) {
                        $min_talla = "g"; 
                    } elseif ($tallas->h > 0) {
                        $min_talla = "h"; 
                    } elseif ($tallas->i > 0) {
                        $min_talla = "i"; 
                    } elseif ($tallas->j > 0) {
                        $min_talla = "j"; 
                    } elseif ($tallas->k > 0) {
                        $min_talla = "k"; 
                    } elseif ($tallas->l > 0) {
                        $min_talla = "l"; 
                    }

                    if ($tallas->l > 0) {
                        $max_talla = "l"; 
                    } elseif ($tallas->k > 0) {
                        $max_talla = "k"; 
                    } elseif ($tallas->j > 0) {
                        $max_talla = "j"; 
                    } elseif ($tallas->i > 0) {
                        $max_talla = "i"; 
                    } elseif ($tallas->h > 0) {
                        $max_talla = "h"; 
                    } elseif ($tallas->g > 0) {
                        $max_talla = "g"; 
                    } elseif ($tallas->f > 0) {
                        $max_talla = "f"; 
                    } elseif ($tallas->e > 0) {
                        $max_talla = "e"; 
                    } elseif ($tallas->d > 0) {
                        $max_talla = "d"; 
                    } elseif ($tallas->c > 0) {
                        $max_talla = "c"; 
                    } elseif ($tallas->b > 0) {
                        $max_talla = "b"; 
                    } elseif ($tallas->a > 0) {
                        $max_talla = "a"; 
                    }
                }
            
            if ($genero == "2") {
                if ($mujer_plus == "7") {
                    $a = '12W';
                    $b = '14W';
                    $c = '16W';
                    $d = '18W';
                    $e = '20W';
                    $f = '22W';
                    $g = '24W';
                    $h = '26W';
                } else {
                    $a = '0/0';
                    $b = '1/2';
                    $c = '3/4';
                    $d = '5/6';
                    $e = '7/8';
                    $f = '9/10';
                    $g = '11/12';
                    $h = '13/14';
                    $i = '15/16';
                    $j = '17/18';
                    $k = '19/20';
                    $l = '21/22';
                }
            } else if ($genero == "3" || $genero == "4") {
                    $a = '2';
                    $b = '4';
                    $c = '6';
                    $d = '8';
                    $e = '10';
                    $f = '12';
                    $g = '14';
                    $h = '16';
                if ($referencia == $referencia1) {
                    switch ($producto->min) {
                        case "a":
                            $min_talla = "";
                            $max_talla = "";
                            break;
                        case "b":
                            $min_talla = "a";
                            $max_talla = "a";
                            break;
                        case "c":
                            $min_talla = "a";
                            $max_talla = "b";
                            break;
                        case "d":
                            $min_talla = "a";
                            $max_talla = "c";
                            break;
                        case "e":
                            $min_talla = "a";
                            $max_talla = "d";
                            break;
                        case "f":
                            $min_talla = "a";
                            $max_talla = "e";
                            break;
                        case "g":
                            $min_talla = "a";
                            $max_talla = "f";
                            break;
                        case "h":
                            $min_talla = "a";
                            $max_talla = "g";
                            break;
                    }

                }
            } else if ($genero == "1") {
                    $a = '28';
                    $b = '29';
                    $c = '30';
                    $d = '32';
                    $e = '34';
                    $f = '36';
                    $g = '38';
                    $h = '40';
                    $i = '42';
                    $j = '44';
                    $k = '46';
            }

            if ($talla == "General" && $hay_tallas == "si") {
                if ($min_talla == 'a') {
                    $min_talla = $a;
                } else if ($min_talla == 'b') {
                    $min_talla = $b;
                } else if ($min_talla == 'c') {
                    $min_talla = $c;
                } else if ($min_talla == 'd') {
                    $min_talla = $d;
                } else if ($min_talla == 'e') {
                    $min_talla = $e;
                } else if ($min_talla == 'f') {
                    $min_talla = $f;
                } else if ($min_talla == 'g') {
                    $min_talla = $g;
                } else if ($min_talla == 'h') {
                    $min_talla = $h;
                } else if ($min_talla == 'i') {
                    $min_talla = $i;
                } else if ($min_talla == 'j') {
                    $min_talla = $j;
                } else if ($min_talla == 'k') {
                    $min_talla = $k;
                } else if ($min_talla == 'l') {
                    $min_talla = $l;
                } 

                if ($max_talla == 'a') {
                    $max_talla = $a;
                } else if ($max_talla == 'b') {
                    $max_talla = $b;
                } else if ($max_talla == 'c') {
                    $max_talla = $c;
                } else if ($max_talla == 'd') {
                    $max_talla = $d;
                } else if ($max_talla == 'e') {
                    $max_talla = $e;
                } else if ($max_talla == 'f') {
                    $max_talla = $f;
                } else if ($max_talla == 'g') {
                    $max_talla = $g;
                } else if ($max_talla == 'h') {
                    $max_talla = $h;
                } else if ($max_talla == 'i') {
                    $max_talla = $i;
                } else if ($max_talla == 'j') {
                    $max_talla = $j;
                } else if ($max_talla == 'k') {
                    $max_talla = $k;
                } else if ($max_talla == 'l') {
                    $max_talla = $l;
                } 

            //    return $min_talla. ' - '.$max_talla;
                $talla = $min_talla. ' - '.$max_talla;
            } else {
                if ($talla == 'A') {
                    $talla = $a;
                } else if ($talla == 'B') {
                    $talla = $b;
                } else if ($talla == 'C') {
                    $talla = $c;
                } else if ($talla == 'D') {
                    $talla = $d;
                } else if ($talla == 'E') {
                    $talla = $e;
                } else if ($talla == 'F') {
                    $talla = $f;
                } else if ($talla == 'G') {
                    $talla = $g;
                } else if ($talla == 'H') {
                    $talla = $h;
                } else if ($talla == 'I') {
                    $talla = $i;
                } else if ($talla == 'J') {
                    $talla = $j;
                } else if ($talla == 'K') {
                    $talla = $k;
                } else if ($talla == 'L') {
                    $talla = $l;
                } 

            //    return $talla;

            }

            if ((strlen($skus->sku) <= 12)){
                $barcode = "https://barcode.tec-it.com/barcode.ashx?data=".$barcode_sku."&code=Code128&translate-esc=true&unit=Px&modulewidth=2.5&dpi=96";
            } else {
                $barcode = "https://barcode.tec-it.com/barcode.ashx?data=".$barcode_sku."&code=EAN13&translate-esc=true&unit=Px&modulewidth=2&dpi=96";
            }
/*
        $data[];
        for ($x=0; $x < 2; $x++) { 
            array_push($data, 'referencia'.$x => $skus->referencia_producto, 'sku'.$x => $barcode, 'talla'.$x => $talla, 'entalle_bragueta'.$x => $entalle_bragueta, 'entalle_piernas'.$x => $entalle_piernas, 'season'.$x => $season, 'wash'.$x => $wash, 'fabric'.$x => $fabric, 'cantidad'.$x => $cantidad);
        }
        array_push($data,'bucle' => 2);
        */

        $data = ['referencia' => $skus->referencia_producto, 'sku' => $barcode, 'talla' => $talla, 'entalle_bragueta' => $entalle_bragueta, 'entalle_piernas' => $entalle_piernas, 'season' => $season, 'wash' => $wash, 'fabric' => $fabric, 'cantidad' => $cantidad];
    //    $pdf = PDF::loadView('sistema.sku.skuImpresion', $data);
  
    //    return $pdf->stream('Etiquetas-123.pdf');
        return view('sistema.sku.skuImpresion', $data);

    }
    
}

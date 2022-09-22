<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SKU;
use App\Corte;
use App\Product;
use PHPUnit\Util\Json;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

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
        
        $skus = DB::table('sku')->leftJoin('corte', 'sku.producto_id', '=', 'corte.producto_id')->leftJoin('producto', 'sku.producto_id', '=', 'producto.id')
            ->select([
                'sku.producto_id', 'corte.numero_corte', 'corte.fecha_corte', 'corte.no_marcada', 'sku.sku', 'sku.referencia_producto', 'sku.talla'
            ]);

        return DataTables::of($skus)
        ///////////////////////////////////////////////
            ->addColumn('Expandir', function ($sku) {
                return "";
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
                if ($sku->no_marcada){
                    $marcada = substr($sku->no_marcada, 6, -3);
                } else {
                    $marcada = '';
                }
                return $marcada;  
            })
            ->editColumn('talla', function ($sku) {
                $producto = $sku->producto_id;
                $referencia = $sku->referencia_producto;
                $talla = $sku->talla;
                if($product = Product::where('id', $producto)->get()->first()) {
                    $referencia2 = $product->referencia_producto_2;
                    $referencia1 = $product->referencia_producto;
                    $genero = $product->genero;   
                    $mujer_plus = substr($referencia, 3, 1);
                    $min_talla = $product->min;   
                    $max_talla = $product->max;   
                    
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

                    if ($talla == "General") {
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
                        } 

                        return $talla;
                    }  
                }
             })
         //   ->rawColumns(['Corte', 'Fecha', 'Marcada'])
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
}

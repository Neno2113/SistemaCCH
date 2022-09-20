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
        $skus = SKU::query()->where('referencia_producto', '<>', '');
    //    $skus = SKU::query()->where('producto_id', '=', 161);
        return DataTables::eloquent($skus)
            /*
            ->addColumn('Editar', function ($sku) {
                $producto = $sku->producto_id;
                if(isset($producto)){
                    return '<button id="btnEdit" onclick="mostrar(' . $sku->id . ')" class="btn btn-danger btn-sm mr-1"> <i class="fas fa-eraser"></i></button>';
                }else{
                    return "";
                }
            })
            */
            ->addColumn('Expandir', function ($sku) {
                return "";
            })
            ->addColumn('Corte', function ($sku) {
                $producto = $sku->producto_id;
                if($corte = Corte::where('producto_id', $producto)->get()->first()) {
                    $num_corte = $corte->numero_corte;   
                } else {
                    $num_corte = '';
                }
                return $num_corte;
            })   
            ->addColumn('Fecha', function ($sku) {
                $producto = $sku->producto_id;
                if($corte = Corte::where('producto_id', $producto)->get()->first()) {
                    $fecha_corte = $corte->fecha_corte;   
                } else {
                    $fecha_corte = '';
                }
                return $fecha_corte;
            })
            ->addColumn('Marcada', function ($sku) {
                $producto = $sku->producto_id;
                if($corte = Corte::where('producto_id', $producto)->get()->first()) {
                    $marcada = substr($corte->no_marcada, 6, -3);
                } else {
                    $marcada = '';
                }
                return $marcada;
            })
            ->editColumn('talla', function ($sku) {
                $producto = $sku->producto_id;
                $referencia = $sku->referencia_producto;
                if($product = Product::where('id', $producto)->get()->first()) {
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
                    } else if ($genero == "3") {
                            $a = '2';
                            $b = '4';
                            $c = '6';
                            $d = '8';
                            $e = '10';
                            $f = '12';
                            $g = '14';
                            $h = '16';
                    } else if ($genero == "4") {
                            $a = '2';
                            $b = '4';
                            $c = '6';
                            $d = '8';
                            $e = '10';
                            $f = '12';
                            $g = '14';
                            $h = '16';
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
                    
                }
             })
            ->rawColumns(['Corte', 'Fecha', 'Marcada'])
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

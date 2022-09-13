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
                    $marcada = $corte->no_marcada;   
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
                //    $mujer_plus = Str::substr($referencia, 3, 4);
                    return substr($referencia, 3, 4);

                //    return $mujer_plus;
                    
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

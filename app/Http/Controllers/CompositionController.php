<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Composition;
use App\PermisoUsuario;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class CompositionController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre_composicion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            // $codgo_composicion = $request->input('codigo_composicion', true);
            $nombre_composicion = $request->input('nombre_composicion', true);

            $composition = new Composition();
            // $composition->codigo_composicion = $codgo_composicion;
            $composition->nombre_composicion = $nombre_composicion;


            $composition->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $composition
            ];
        }

        return response()->json($data, $data['code']);
    }


    public function show($id)
    {

        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Composicion')
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
        $composition = Composition::find($id);

        if (is_object($composition)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'composition' => $composition
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
            'nombre_composicion' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            // $codgo_composicion = $request->input('codigo_composicion', true);
            $nombre_composicion = $request->input('nombre_composicion', true);



            $composition = Composition::find($id);

            // $composition->codigo_composicion = $codgo_composicion;
            $composition->nombre_composicion = $nombre_composicion;


            $composition->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'composition' => $composition
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Composicion')
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
        $composition = Composition::find($id);

        if (!empty($composition)) {
            $composition->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'composition' => $composition
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

    public function compositions()
    {
        $compositions = Composition::query();

        return DataTables::eloquent($compositions)
            ->addColumn('Expandir', function ($composition) {
                return "";
            })
            ->addColumn('Opciones', function ($composition) {
                return '<button id="btnEdit" onclick="mostrar(' . $composition->id . ')" class="btn btn-warning btn-sm ml-2" > <i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $composition->id . ')" class="btn btn-danger btn-sm ml-2"> <i class="fas fa-eraser"></i></button>';
            })
           
            ->rawColumns(['Opciones', 'Eliminar'])
            ->make(true);
    }

    public function test_page(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello Word !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello_word.xlsx');
    }

    public function read_test(){
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader = $spreadsheet->load("UPC_code_1110.xlsx");
        $worksheet = $reader->getActiveSheet();
        $rows = [];
        foreach ($worksheet->getRowIterator() as $row){
            $cellIteratorr = $row->getCellIterator();
            $cellIteratorr->setIterateOnlyExistingCells(false);
            $cells = [];
            foreach ($cellIteratorr as $cell){
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }

        return $rows;

    }
}

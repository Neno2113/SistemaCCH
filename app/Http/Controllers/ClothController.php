<?php

namespace App\Http\Controllers;

use App\CategoriaTela;
use Illuminate\Http\Request;
use App\Cloth;
use App\Composition;
use App\PermisoUsuario;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
// use App\Imports\ImportRollos;
use App\RollosDetail;
use App\Rollos;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;

class ClothController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'suplidor' => 'required',
            'referencia' => 'required|unique:tela',
            'tipo_tela' => 'required',
            'composiciones' => 'required',
            'elasticidad_urdimbre' => 'required',
            'elasticidad_trama' => 'required',
            'encogimiento_trama' => 'required',
            'encogimiento_urdimbre' => 'required',
            'porcentaje_mat_1' => 'required',
            'fecha_compra' => 'required',
            'no_factura_compra' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id_user = \auth()->user()->id;
            $id_suplidor = $request->input('suplidor', true);
            $id_composiciones = $request->input('id_composiciones', true);
            $referencia = $request->input('referencia', true);
            $precio_usd = $request->input('precio_usd', true);
            $tipo_tela = $request->input('tipo_tela', true);
            $ancho_cortable = $request->input('ancho_cortable', true);
            $peso = $request->input('peso', true);
            $elasticidad_trama = $request->input('elasticidad_trama', true);
            $elasticidad_urdimbre = $request->input('elasticidad_urdimbre', true);
            $encogimiento_trama = $request->input('encogimiento_trama', true);
            $encogimiento_urdimbre = $request->input('encogimiento_urdimbre', true);
            $fecha_compra = $request->input('fecha_compra', true);
            $no_factura_compra = $request->input('no_factura_compra', true);
            $composicion = $request->input('composiciones', true);
            $composicion_2 = $request->input('composiciones_2', true);
            $composicion_3 = $request->input('composiciones_3', true);
            $composicion_4 = $request->input('composiciones_4', true);
            $composicion_5 = $request->input('composiciones_5', true);
            $porcentaje_mat_1 = $request->input('porcentaje_mat_1', true);
            $porcentaje_mat_2 = $request->input('porcentaje_mat_2', true);
            $porcentaje_mat_3 = $request->input('porcentaje_mat_3', true);
            $porcentaje_mat_4 = $request->input('porcentaje_mat_4', true);
            $porcentaje_mat_5 = $request->input('porcentaje_mat_5', true);


            $cloth = new Cloth();
            $cloth->user_id = $id_user;
            $cloth->id_suplidor = $id_suplidor;
            $cloth->id_composiciones = $id_composiciones;
            $cloth->referencia = $referencia;
            $cloth->precio_usd = trim($precio_usd, "USD_");
            $cloth->tipo_tela = $tipo_tela;
            $cloth->ancho_cortable = $ancho_cortable;
            $cloth->peso = $peso;
            $cloth->elasticidad_trama = trim($elasticidad_trama, "_%");
            $cloth->elasticidad_urdimbre = trim($elasticidad_urdimbre, "_%");
            $cloth->encogimiento_trama = trim($encogimiento_trama, "_%");
            $cloth->encogimiento_urdimbre = trim($encogimiento_urdimbre, "_%");

            if (!empty($composicion)) {
                $cloth->composicion = "$composicion-$porcentaje_mat_1";
            } else {
                $cloth->composicion = "";
            }

            if (!empty($composicion_2)) {
                $cloth->composicion_2 = "$composicion_2-$porcentaje_mat_2";
            } else {
                $cloth->composicion_2 = "";
            }

            if (!empty($composicion_3)) {
                $cloth->composicion_3 = "$composicion_3-$porcentaje_mat_3";
            } else {
                $cloth->composicion_3 = "";
            }

            if (!empty($composicion_4)) {
                $cloth->composicion_4 = "$composicion_4-$porcentaje_mat_4";
            } else {
                $cloth->composicion_4 = "";
            }

            if (!empty($composicion_5)) {
                $cloth->composicion_5 = "$composicion_5-$porcentaje_mat_5";
            } else {
                $cloth->composicion_5 = "";
            }

            $cloth->save();
            $id_tela = $cloth->id;

            $rollos = new Rollos();
            $rollos->id_user = $id_user;
            $rollos->id_suplidor = $id_suplidor;
            $rollos->fecha_compra = $fecha_compra;
            $rollos->no_factura_compra = $no_factura_compra;

            $rollos->save();
            $id_rollo = $rollos->id;

            $data = [
                'code' => 200,
                'status' => 'success',
                'tela' => $id_tela,
                'rollo' => $id_rollo
            ];
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
        $cloth = Cloth::find($id)->load('suplidor');

        $cloth->elasticidad_trama = number_format($cloth->elasticidad_trama);
        $cloth->elasticidad_urdimbre = number_format($cloth->elasticidad_urdimbre);
        $cloth->encogimiento_trama = number_format($cloth->encogimiento_trama);
        $cloth->encogimiento_urdimbre = number_format($cloth->encogimiento_urdimbre);
        $cloth->encogimiento_urdimbre = number_format($cloth->encogimiento_urdimbre);
        $cloth->ancho_cortable = number_format($cloth->ancho_cortable);

        $rollosdetails = RollosDetail::where('id_tela', $id)->get()->first();
        $rollo = Rollos::where('id', $rollosdetails->id_rollo)->get()->first();

        if (is_object($cloth)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'tela' => $cloth,
                'suplidor' => $cloth->suplidor,
                'rollo' => $rollo
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

    public function upload(Request $request)
    {
        
        //validar csv
        $validate = \Validator::make($request->all(), [
            'rollo' => 'required|mimes:csv,txt',
        ]);
        // Guardar la imagen
        if ($validate->fails()) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            $file = $request->file('rollo');  
            $id_rollo = $request->input('id_rollo');  
            $id_tela = $request->input('id_tela');
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
                    $numero = $importData[0]; //Get user names
                    $tono = $importData[1]; //Get user names
                    $longitud = $importData[2]; //Get the user emails
                    $j++;

                    try {
                        
                        $rollos_detail = new RollosDetail();

                        $rollos_detail->id_rollo = $id_rollo;
                        $rollos_detail->id_tela = $id_tela;
                        $rollos_detail->numero = $numero;
                        $rollos_detail->tono = $tono;
                        $rollos_detail->longitud = $longitud;

                        $rollos_detail->save();
                    
                    } catch (\Exception $e) {
                        //throw $th;
                    //    DB::rollBack();
                    }
                }
                $rollos = RollosDetail::where('id_rollo', $id_rollo)->where('id_tela', $id_tela)->get();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollos' => $rollos
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
/*
    public function selectTela(Request $request)
    {
        $id = $request->input('suplidor');
        $tela = Cloth::where('id_suplidor', $id)->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'tela' => $tela
        ];
        return response()->json($data);
    } */

    public function update(Request $request)
    {
        $validar = $request->validate([
            'id_suplidor' => 'required',
            'referencia' => 'required',
            'tipo_tela' => 'required|alpha'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $id_user = \auth()->user()->id;
            $id_suplidor = $request->input('id_suplidor', true);
            $id_composiciones = $request->input('id_composiciones', true);
            $referencia = $request->input('referencia', true);
            $precio_usd = $request->input('precio_usd', true);
            $tipo_tela = $request->input('tipo_tela', true);
            $ancho_cortable = $request->input('ancho_cortable', true);
            $peso = $request->input('peso', true);
            $elasticidad_trama = $request->input('elasticidad_trama', true);
            $elasticidad_urdimbre = $request->input('elasticidad_urdimbre', true);
            $encogimiento_trama = $request->input('encogimiento_trama', true);
            $encogimiento_urdimbre = $request->input('encogimiento_urdimbre', true);
            // $composicion = $request->input('composiciones', true);
            // $composicion_2 = $request->input('composiciones_2', true);
            // $composicion_3 = $request->input('composiciones_3', true);
            // $composicion_4 = $request->input('composiciones_4', true);
            // $composicion_5 = $request->input('composiciones_5', true);
            // $porcentaje_mat_1 = $request->input('porcentaje_mat_1', true);
            // $porcentaje_mat_2 = $request->input('porcentaje_mat_2', true);
            // $porcentaje_mat_3 = $request->input('porcentaje_mat_3', true);
            // $porcentaje_mat_4 = $request->input('porcentaje_mat_4', true);
            // $porcentaje_mat_5 = $request->input('porcentaje_mat_5', true);

            $cloth = Cloth::find($id);

            $cloth->user_id = $id_user;
            $cloth->id_suplidor = $id_suplidor;
            $cloth->id_composiciones = $id_composiciones;
            $cloth->referencia = $referencia;
            $cloth->precio_usd = trim($precio_usd, "USD_");
            $cloth->tipo_tela = $tipo_tela;
            $cloth->ancho_cortable = $ancho_cortable;
            $cloth->peso = $peso;
            $cloth->elasticidad_trama = trim($elasticidad_trama, "_%");
            $cloth->elasticidad_urdimbre = trim($elasticidad_urdimbre, "_%");
            $cloth->encogimiento_trama = trim($encogimiento_trama, "_%");
            $cloth->encogimiento_urdimbre = trim($encogimiento_urdimbre, "_%");

            // if (!empty($composicion)) {
            //     $cloth->composicion = "$composicion-$porcentaje_mat_1";
            // } else {
            //     $cloth->composicion = "";
            // }

            // if (!empty($composicion_2)) {
            //     $cloth->composicion_2 = "$composicion_2-$porcentaje_mat_2";
            // } else {
            //     $cloth->composicion_2 = "";
            // }

            // if (!empty($composicion_3)) {
            //     $cloth->composicion_3 = "$composicion_3-$porcentaje_mat_3";
            // } else {
            //     $cloth->composicion_3 = "";
            // }

            // if (!empty($composicion_4)) {
            //     $cloth->composicion_4 = "$composicion_4-$porcentaje_mat_4";
            // } else {
            //     $cloth->composicion_4 = "";
            // }

            // if (!empty($composicion_5)) {
            //     $cloth->composicion_5 = "$composicion_5-$porcentaje_mat_5";
            // } else {
            //     $cloth->composicion_5 = "";
            // }

            $cloth->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'tela' => $cloth
            ];
        }

        return response()->json($data, $data['code']);
    }
    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Telas')
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
        $cloth = Cloth::find($id);

        if (!empty($cloth)) {
            $cloth->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'tela' => $cloth
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

    public function selectSuplidor(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Supplier::select("id", "nombre", "contacto_suplidor")
                ->where('tipo_suplidor', 'LIKE', "Material")
                ->where('nombre', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectComposition(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Composition::select("id", "nombre_composicion")
                ->where('nombre_composicion', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function cloths()
    {
        $cloths = DB::table('tela')->join('suplidor', 'tela.id_suplidor', '=', 'suplidor.id')
            ->select([
                'tela.id', 'tela.referencia', 'suplidor.nombre', 'tela.precio_usd', 'tela.composicion', 'tela.composicion_2',
                'tela.composicion_3', 'tela.composicion_4', 'tela.composicion_5', 'tela.tipo_tela', 'tela.ancho_cortable', 'tela.peso',
                'tela.elasticidad_trama', 'tela.elasticidad_urdimbre', 'tela.encogimiento_trama', 'tela.encogimiento_urdimbre'
            ]);

        return DataTables::of($cloths)
            ->addColumn('Expandir', function ($cloth) {
                return "";
            })
            ->editColumn('nombre', function($cloth){
                return substr($cloth->nombre, 0, 20);
            })
            /*
            ->addColumn('Ver', function ($cloth) {
                return '<button onclick="ver(' . $cloth->id . ')" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></button>';
            }) */
            ->addColumn('Opciones', function ($cloth) {
            //    return '<button onclick="eliminar(' . $cloth->id . ')" class="btn btn-danger btn-sm mr-1"> <i class="fas fa-eraser fa-1x"></i></button>'.
                return '<button id="btnEdit" onclick="mostrar(' . $cloth->id . ')" class="btn btn-warning btn-sm ml-1" > <i class="fas fa-edit fa-1x"></i></button>';
            })
        //    ->rawColumns(['Ver', 'Opciones'])
            ->rawColumns(['Ver', 'Opciones'])
            ->make(true);
    }

    public function supplidorSelect(){
        $suplidor = Supplier::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'suplidor' => $suplidor
        ];

        return response()->json($data, $data['code']);
    }

    
    public function storeCategoriaTela(Request $request){

        $validar = $request->validate([
            'nombre' => 'required'
        ]);

        if(empty($validar)){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $nombre = $request->input('nombre');

            $categoria = new CategoriaTela();

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

    public function showCategoriasTela() {
        $tipos = CategoriaTela::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'categorias' => $tipos
        ];
        return response()->json($data, $data['code']);
    }

    public function destroyCategoriaTela($id){
        $categoria = CategoriaTela::find($id);

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cloth;
use App\Composition;
use App\Supplier;

class ClothController extends Controller
{
    public function store(Request $request)
    {
        $validar = $request->validate([
            'id_suplidor' => 'required',
            'id_composiciones' => 'required',
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
            
            $cloth = new Cloth();
            $cloth->id_user = $id_user;
            $cloth->id_suplidor = $id_suplidor;
            $cloth->id_composiciones = $id_composiciones;
            $cloth->referencia = $referencia;
            $cloth->precio_usd = $precio_usd;
            $cloth->tipo_tela = $tipo_tela;
            $cloth->ancho_cortable = $ancho_cortable;
            $cloth->peso = $peso;
            $cloth->elasticidad_trama = $elasticidad_trama;
            $cloth->elasticidad_urdimbre = $elasticidad_urdimbre;
            $cloth->encogimiento_trama = $encogimiento_trama;
            $cloth->encogimiento_urdimbre = $encogimiento_urdimbre;
          
            $cloth->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'tela' => $cloth
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function selectSuplidor(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Supplier::select("id", "nombre","contacto_suplidor")
                            ->where('nombre', 'LIKE',"%$search%")
                            ->get(); 
        }
        return response()->json($data);
    }

    public function selectComposition(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Composition::select("id", "nombre_composicion")
                            ->where('nombre_composicion', 'LIKE',"%$search%")
                            ->get(); 
        }
        return response()->json($data);
    }
}

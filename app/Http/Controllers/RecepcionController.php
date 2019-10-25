<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;
use App\Corte;
use App\Lavanderia;

class RecepcionController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'corte_id' => 'required',
            'id_lavanderia' => 'required',
            'fecha_recepcion' => 'required',
            'cantidad_recibida' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            
            $corte_id = $request->input('corte_id');
            $id_lavanderia = $request->input('id_lavanderia');
            $fecha_recepcion = $request->input('fecha_recepcion');
            $cantidad_recibida = $request->input('cantidad_recibida');
            $estandar_recibido = $request->input('estandar_recibido');

            $lavanderia = Lavanderia::find($id_lavanderia);
           
            $cantidad = $lavanderia->cantidad;
            $porciento = $cantidad + $cantidad_recibida;

            $pc_l = ($cantidad * 100) /($cantidad + $cantidad_recibida);
            $pc_r = ($cantidad_recibida * 100) /($cantidad + $cantidad_recibida);
            
            if($pc_r > 47.36  ){
                $lavanderia->recibido = 1;
                $lavanderia->save();

                $corte = Corte::find($corte_id);
                $corte->fase = 'Terminacion';
                $corte->save();
    
                $recepcion = new Recepcion();
                $recepcion->corte_id = $corte_id;
                $recepcion->id_lavanderia = $id_lavanderia;
                $recepcion->fecha_recepcion = $fecha_recepcion;
                $recepcion->cantidad_recibida = $cantidad_recibida;
                $recepcion->estandar_recibido = $estandar_recibido;
    
                $recepcion->save();
    
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'recepcion' => $recepcion
                ];
            }else{
                $data = [
                    'code' => 422,
                    'status' => 'error',
                    'message' => 'Este corte no puede pasar a Terminacion debido a que la cantidad recibida 
                    equivale a menos del 90% de la cantidad enviada.'
                ];
            }
           
        }

        return response()->json($data, $data['code']);
    }
    

    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('fase', 'LIKE', 'Lavanderia')
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectLavanderia(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Lavanderia::select("id", "numero_envio", "enviado", "recibido")
                ->where('enviado', 'LIKE', '1')
                ->where('recibido', 'LIKE', '0')
                ->where('numero_envio', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}

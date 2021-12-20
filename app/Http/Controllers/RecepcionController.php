<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;
use App\Corte;
use App\Lavanderia;
use App\Perdida;
use App\PermisoUsuario;
use App\TallasPerdidas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RecepcionController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'corte' => 'required',
            'numero_factura' => 'required',
            'fecha_recepcion' => 'required',
            'cantidad_recibida' => 'required|numeric'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $corte_id = $request->input('corte');
            $numero_factura = $request->input('numero_factura');
            $numero_recepcion = $request->input('numero_recepcion');
            $fecha_recepcion = $request->input('fecha_recepcion');
            $cantidad_recibida = $request->input('cantidad_recibida');
            $estandar_recibido = $request->input('estandar_recibido');
            $recibir_terminacion = $request->input('recibir_terminacion');
            $devolver_produccion = $request->input('devolver_produccion');
            $sec = $request->input('sec');

            // $lavanderia = Lavanderia::find($id_lavanderia);

            // $cantidad = $lavanderia->cantidad;
            // $porciento = $cantidad + $cantidad_recibida;

            // $pc_l = ($cantidad * 100) / ($cantidad + $cantidad_recibida);
            // $pc_r = ($cantidad_recibida * 100) / ($cantidad + $cantidad_recibida);

            // if ($pc_r > 47.36) {
            // $lavanderia->recibido = 1;
            // $lavanderia->save();

            $cantidad_enviada = Lavanderia::where('corte_id', $corte_id)
                ->get()->last();
            $total_enviado = $cantidad_enviada['total_enviado'];
            $total_devuelto = $cantidad_enviada['total_devuelto'];

            $corte = Corte::find($corte_id);

            $recepcion_total = Recepcion::where('corte_id', 'LIKE', "$corte_id")->get()->last();

            $perdida = Perdida::where('corte_id', 'LIKE', "$corte_id")
            ->where('tipo_perdida', 'LIKE', 'Normal')
            ->where('fase', 'LIKE', 'Lavanderia')
            ->select('id')->get();
            $perdida_id = array();

            $longitud = count($perdida);

            for ($i = 0; $i < $longitud; $i++) {
                array_push($perdida_id, $perdida[$i]['id']);
            }

            $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            $totales = array();

            $lent = count($talla_perdida);

            for ($i = 0; $i < $lent; $i++) {
                array_push($totales, $talla_perdida[$i]['total']);
            }
            $cant_perdida = array_sum($totales);
            $total_enviado = $total_enviado;

            if ($devolver_produccion == 1 && is_object($recepcion_total)) {
                $recepcion = Recepcion::where('corte_id', $corte_id)->get()->last();
                $total_recibido = $recepcion_total->total_recibido;
                $recibido_parcial = $recepcion_total->recibido_parcial;
                $pendiente = $recepcion->pendiente - $cant_perdida;
                $recepcion_total->total_recibido = $total_recibido - $cantidad_recibida;
                $recepcion_total->recibido_parcial = $recibido_parcial - $cantidad_recibida;
                $recepcion_total->pendiente = $pendiente + $cantidad_recibida;
                $recepcion_total->save();

            }
            if(!empty($recepcion_total)){
                $total_recibido = $recepcion_total['total_recibido'];
                $total_devuelto = $recepcion_total['total_devuelto'];

            } else {
                $total_recibido = 0;
                $total_devuelto = 0;
            }
            $total_porcentaje = $cantidad_recibida + $total_recibido;

            $porcentaje = ($total_porcentaje / $total_enviado ) * 100;

          
            // echo $total_porcentaje;
            // echo $total_enviado;
            if ($porcentaje > 90.00) {
                $corte->fase = 'Terminacion';
                $corte->save();
            }

            $recepcion = new Recepcion();
            $recepcion->corte_id = $corte_id;
            $recepcion->num_factura_rec = $numero_factura;
            $recepcion->numero_recepcion = $numero_recepcion;
            $recepcion->fecha_recepcion = $fecha_recepcion;
            $recepcion->recibido_parcial = $cantidad_recibida;
            $recepcion->total_recibido = $cantidad_recibida + $total_recibido;
            $recepcion->pendiente = $total_enviado - $cantidad_recibida - $total_recibido;
            $recepcion->estandar_recibido = $estandar_recibido;
            $recepcion->sec = $sec + 0.01;
            // $recepcion->pendiente = ($recepcion->pendiente < 0) ? 0 : $recepcion->pendiente;
            if($devolver_produccion == 1){
                $cantidad_enviada->total_enviado = $total_enviado - $cantidad_recibida;
                $cantidad_enviada->save();

                $recepcion->total_recibido = 0;
                $recepcion->devuelto_produccion = 1;
                $recepcion->total_devuelto = $cantidad_recibida + $total_devuelto;
            }

            $recepcion->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'recepcion' => $recepcion,
                'porcentaje' => $porcentaje,
                'enviado' => $total_enviado,
                'pendiente' => $recepcion->pendiente
            ];
            // } else {
            // $data = [
            //     'code' => 422,
            //     'status' => 'error',
            //     'message' => 'Este corte no puede pasar a Terminacion debido a que la cantidad recibida
            //     equivale a menos del 90% de la cantidad enviada.'
            // ];
            // }
        }

        return response()->json($data, $data['code']);
    }

    public function cantidad(Request $request)
    {
        $validate = $request->validate([
            'corte_id' => 'required'
        ]);

        if (empty($validate)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $corte_id = $request->input('corte_id');
            $lavanderia_id = $request->input('lavanderia_id');
            $lavanderia = Lavanderia::find($lavanderia_id);

            if(!empty($lavanderia)){
                $cantidad_parcial = $lavanderia['cantidad_parcial'];

            } else {
                $cantidad_parcial = 0;
            }

            $corte = Corte::find($corte_id);
            $cantidad_total = $corte['total'];

            $perdida = Perdida::where('corte_id', 'LIKE', "$corte_id")
                ->where('tipo_perdida', 'LIKE', 'Normal')
                ->where('fase', 'LIKE', 'Lavanderia')
                ->select('id')->get();
            $perdida_id = array();

            $longitud = count($perdida);

            for ($i = 0; $i < $longitud; $i++) {
                array_push($perdida_id, $perdida[$i]['id']);
            }

            $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            $totales = array();

            $lent = count($talla_perdida);

            for ($i = 0; $i < $lent; $i++) {
                array_push($totales, $talla_perdida[$i]['total']);
            }
            $cant_perdida = array_sum($totales);

            $cantidad_enviada = Lavanderia::where('corte_id', $corte_id)
                ->get()->last();
            $total_enviado = $cantidad_enviada['total_enviado'];
            $total_devuelto = $cantidad_enviada['total_devuelto'];
            // $cantidad_enviada->devuelto = 0;
            // $cantidad_enviada->save();

            $recepcion = Recepcion::where('corte_id', 'LIKE', "$corte_id")->get()->last();
            if(!empty($recepcion)){
                $total_recibido = $recepcion['total_recibido'];

            }else {
                $total_recibido = 0;
            }

            $data = [
                'code' => 200,
                'status' => 'success',
                'envio_parcial' => $cantidad_parcial,
                'total_cortado' => $cantidad_total,
                'perdidas' => $cant_perdida,
                'total_enviado' => $total_enviado,
                'total_recibido' => $total_recibido,
                'total_devuelto' => $total_devuelto

            ];
        }
        return \response()->json($data, $data['code']);
    }

    public function recepciones()
    {
        $recepciones = DB::table('recepcion')->join('corte', 'recepcion.corte_id', '=', 'corte.id')
            // ->join('lavanderia', 'recepcion.id_lavanderia', '=', 'lavanderia.id')
            ->select([
                'recepcion.id', 'recepcion.fecha_recepcion', 'recepcion.recibido_parcial', 'recepcion.estandar_recibido',
                'corte.numero_corte', 'recepcion.numero_recepcion', 'recepcion.pendiente', 'corte_id',
                'recepcion.total_recibido', 'recepcion.devuelto_produccion'
            ]);

        return DataTables::of($recepciones)
            ->addColumn('Expandir', function ($recepcion) {
                return "";
            })
            // ->editColumn('pendiente', function ($recepcion) {
            //     $perdida = Perdida::where('corte_id', 'LIKE', $recepcion->corte_id)
            //     ->where('tipo_perdida', 'LIKE', 'Normal')
            //     ->where('fase', 'LIKE', 'Lavanderia')
            //     ->select('id')->get();
            //     $perdida_id = array();

            //     $longitud = count($perdida);

            //     for ($i = 0; $i < $longitud; $i++) {
            //         array_push($perdida_id, $perdida[$i]['id']);
            //     }

            //     $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            //     $totales = array();

            //     $lent = count($talla_perdida);

            //     for ($i = 0; $i < $lent; $i++) {
            //         array_push($totales, $talla_perdida[$i]['total']);
            //     }
            //     $cant_perdida = array_sum($totales);

            //     return $recepcion->pendiente - $cant_perdida;
            // })
            ->editColumn('estandar_recibido', function ($recepcion) {
                return ($recepcion->estandar_recibido == 1 ? 'Si' : 'No');
            })
            ->editColumn('devuelto_produccion', function ($recepcion) {
                return ($recepcion->devuelto_produccion <> 0) ?  '<span class="badge badge-danger">Dev<i class="fas fa-arrow-left"></i> </span>':
                '<span class="badge badge-success">Recibido <i class="fas fa-check"></i> </span>';
            })
            ->editColumn('fecha_recepcion', function ($recepcion) {
                return date("d-m-20y", strtotime($recepcion->fecha_recepcion));
            })
            // ->editColumn('fecha_envio', function ($recepcion) {
            //     return date("d-m-20y", strtotime($recepcion->fecha_envio));
            // })

            // ->addColumn('lavanderia', function ($recepcion) {
            //     $lavanderia = Lavanderia::where('corte_id', $recepcion->corte_id)->get()->last()->load('suplidor');

            //     return (!empty( $lavanderia ) )? '<span class="badge badge-success">'.$lavanderia->suplidor->nombre .'</span>':
            //     '';
          
            // })
            ->addColumn('Opciones', function ($recepcion) {
                return
                    // '<button id="btnEdit" onclick="mostrar(' . $recepcion->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $recepcion->id . ')" class="btn btn-danger btn-sm ml-2"> <i class="fas fa-eraser"></i></button>' .
                    '<a href="imprimir/conduceRecepcion/' . $recepcion->id . '" class="btn btn-secondary btn-sm ml-2"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones', 'devuelto_produccion', 'lavanderia'])
            ->make(true);
    }

    public function show($id)
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Recepcion')
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
        $recepcion = Recepcion::find($id)->load('corte')
            ->load('lavanderia');

        if (is_object($recepcion)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'recepcion' => $recepcion
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


    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectCorteEdit(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('fase', 'LIKE', 'Lavanderia')
                ->where('fase', 'LIKE', 'Terminacion')
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
            $data = Lavanderia::select("id", "numero_envio", "enviado", "recibido", "total_enviado")
                ->where('enviado', 'LIKE', '1')
                // ->where('recibido', 'LIKE', '0')
                ->where('numero_envio', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectLavanderiaEdit(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Lavanderia::select("id", "numero_envio", "enviado", "recibido", "cantidad")
                ->where('enviado', 'LIKE', '1')
                ->where('recibido', 'LIKE', '1')
                ->where('numero_envio', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validar = $request->validate([
            'corte' => 'required',
            'numero_envio' => 'required',
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
            $id = $request->input('id');
            $corte_id = $request->input('corte');
            $id_lavanderia = $request->input('numero_envio');
            $fecha_recepcion = $request->input('fecha_recepcion');
            $cantidad_recibida = $request->input('cantidad_recibida');
            $estandar_recibido = $request->input('estandar_recibido');

            $lavanderia = Lavanderia::find($id_lavanderia);

            $cantidad = $lavanderia->cantidad;
            $porciento = $cantidad + $cantidad_recibida;

            $pc_l = ($cantidad * 100) / ($cantidad + $cantidad_recibida);
            $pc_r = ($cantidad_recibida * 100) / ($cantidad + $cantidad_recibida);

            if ($pc_r > 47.36) {
                $lavanderia->recibido = 1;
                $lavanderia->save();

                $corte = Corte::find($corte_id);
                $corte->fase = 'Terminacion';
                $corte->save();

                $recepcion = Recepcion::find($id);
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
            } else {
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
    
    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Recepcion')
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
        $recepcion = Recepcion::find($id);

        $id_corte = $recepcion['corte_id'];
        // $id_lavanderia = $recepcion['id_lavanderia'];

        $corte = Corte::find($id_corte);
        $corte->fase = 'Lavanderia';
        $corte->save();

        // $lavanderia = Lavanderia::find($id_lavanderia);
        // $lavanderia->recibido = 0;
        // $lavanderia->save();

        if (!empty($recepcion)) {
            $recepcion->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'recepcion' => $recepcion
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
        $recepcion = Recepcion::orderBy('sec', 'desc')->first();

        if (\is_object($recepcion)) {
            $sec = $recepcion->sec;
        }

        if (empty($sec)) {
            $sec = 0.00;

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

    public function imprimir($id)
    {
        $recepcion = Recepcion::find($id)->load('corte');
        $recepcion->fecha_recepcion = date("d/m/20y", strtotime($recepcion->fecha_recepcion));

        $corte_id = $recepcion->corte_id;

        $lavanderia = Lavanderia::where('corte_id', $corte_id)->get()->last();

        $pdf = \PDF::loadView('sistema.recepcion.conduceRecepcion', \compact('recepcion', 'lavanderia'));
        return $pdf->download('conduceRecepcion.pdf');
        return View('sistema.lavanderia.conduceRecepcion', \compact('recepcion', 'lavanderia'));
    }
}

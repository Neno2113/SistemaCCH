<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lavanderia;
use App\Corte;
use App\Talla;
use App\Supplier;
use App\SKU;
use App\Product;
use App\Perdida;
use App\Recepcion;
use App\TallasPerdidas;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class LavanderiaController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'sec' => 'required',
            'numero_envio' => 'required',
            'suplidor' => 'required',
            'corte' => 'required',
            // 'cantidad' => 'required',
            'receta_lavado' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $sec = $request->input('sec');
            $numero_envio = $request->input('numero_envio');
            $corte_id = $request->input('corte');
            $fecha_envio = $request->input('fecha_envio');
            $cantidad = $request->input('cantidad');
            $suplidor_id = $request->input('suplidor');
            $receta_lavado = $request->input('receta_lavado');
            $estandar_incluido = $request->input('estandar_incluido');
            $devuelto = $request->input('devuelto');
            $envio_nuevo = $request->input('envio_nuevo');
            $reparar_lav = $request->input('reparar_lav');
            $reparada_prod = $request->input('reparada_prod');

            $lavanderia = new Lavanderia();
            $corte = Corte::find($corte_id);
            $producto_id = $corte['producto_id'];
            $producto = Product::find($producto_id);
            $sku = SKU::where('talla', 'LIKE', 'General')
                ->where('producto_id', 'LIKE', "%$producto_id%")->get()->first();

            $sku_gen = $sku['id'];

            if (empty($sku_gen)) {
                $sku_gen = "";
            }
            $producto->enviado_lavanderia = 1;
            $producto->save();
            $cant_total = $corte['total'];

            $lavenderia_envio = Lavanderia::where('corte_id', 'LIKE', "$corte_id")->get()->last();

            $total_enviado = $lavenderia_envio['total_enviado'];
            $total_porcentaje = $total_enviado + $cantidad;
            // if($total_enviado)

            $porcentaje = ($total_porcentaje/$cant_total) * 100;

            if($porcentaje > 90.00){
                $corte->fase = 'Lavanderia';
                $corte->save();
            }

            $lavanderia->numero_envio = $numero_envio;
            $lavanderia->corte_id = $corte_id;
            $lavanderia->producto_id = $producto_id;
            $lavanderia->id_sku = $sku_gen;
            $lavanderia->suplidor_id = $suplidor_id;
            $lavanderia->fecha_envio = $fecha_envio;
            $lavanderia->cantidad_parcial = ($cantidad == "") ? $lavenderia_envio['cantidad_parcial'] : $cantidad;
            $lavanderia->cantidad = ($cantidad == "") ? $lavenderia_envio['cantidad'] : $cantidad;
            $lavanderia->total_enviado = $total_enviado + $cantidad;
            $lavanderia->total_devuelto = ($reparar_lav == 1) ? $cantidad : 0;

            $lavanderia->receta_lavado = $receta_lavado;
            $lavanderia->estandar_incluido = $estandar_incluido;
            $lavanderia->enviado = 1;
            $lavanderia->recibido = 0;
            $lavanderia->devuelto = ($cantidad == "") ? 0 : 1;
            $lavanderia->sec = $sec + 0.01;

            if($reparar_lav == 1){
                $recepcion = Recepcion::where('corte_id', $corte_id)->get()->last();
                $total_recibido = $recepcion->total_recibido;
                $recibido_parcial = $recepcion->recibido_parcial;
                $pendiente = $recepcion->pendiente;
                $recepcion->total_recibido = $total_recibido - $cantidad;
                $recepcion->recibido_parcial = $recibido_parcial - $cantidad;
                $recepcion->pendiente = $pendiente + $cantidad;
                $recepcion->save();

                $lavanderia->total_enviado = $total_enviado;

            }

            $lavanderia->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia,
                'porcentaje' => $porcentaje
            ];
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
        }else{

            $corte_id = $request->input('corte_id');


            $talla = Lavanderia::where('corte_id', 'LIKE', "$corte_id")->get()->last();
            $total = $talla['cantidad'];

            $corte = Corte::find($corte_id);
            $producto_id = $corte['producto_id'];
            $cantidad_total = $corte['total'];

            $perdida = Perdida::where('corte_id', 'LIKE', "$corte_id")
            ->where('tipo_perdida', 'LIKE', 'Normal')
            ->whereIn('fase', ['Produccion', 'Procesos secos'])
            ->select('id')->get();
            $perdida_id = array();

            $longitud = count($perdida);

            for ($i=0; $i < $longitud; $i++) {
                array_push($perdida_id, $perdida[$i]['id']);
            }

            $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            $totales = array();

            $lent = count($talla_perdida);

            for ($i=0; $i < $lent; $i++) {
                array_push($totales, $talla_perdida[$i]['total']);

            }
            $cant_perdida = array_sum($totales);

            $cantidad_enviada = Lavanderia::where('corte_id', $corte_id)
                                            ->Where('producto_id', $producto_id)
                                            ->get()->last();
            $total_parcial = $cantidad_enviada['cantidad_parcial'];
            $total_enviado = $cantidad_enviada['total_enviado'];

            // // print_r($cantidad_enviada);
            // var_dump($total_parcial);
            // die();

            $data = [
                'code' => 200,
                'status' => 'success',
                'total_cortado' => $cantidad_total,
                'total_enviado' => $total_enviado,
                'perdidas' => $cant_perdida,
                'parcial' => $total_parcial

            ];

        }
        return \response()->json($data, $data['code']);
    }

    public function lavanderias()
    {
        $lavanderia = DB::table('lavanderia')->join('corte', 'lavanderia.corte_id', '=', 'corte.id')
            ->join('producto', 'lavanderia.producto_id', '=', 'producto.id')
            ->join('suplidor', 'suplidor_id', '=', 'suplidor.id')
            ->select([
                'lavanderia.id', 'lavanderia.numero_envio', 'lavanderia.fecha_envio', 'lavanderia.receta_lavado',
                'lavanderia.cantidad', 'lavanderia.estandar_incluido', 'corte.numero_corte', 'corte.fase',
                'producto.referencia_producto', 'suplidor.nombre', 'lavanderia.enviado', 'lavanderia.total_enviado'
                , 'corte.total', 'lavanderia.cantidad_parcial', 'corte.id as id_corte', 'lavanderia.devuelto', 'lavanderia.total_devuelto'
            ]);

        return DataTables::of($lavanderia)
            ->addColumn('Expandir', function ($lavanderia) {
                return "";
            })
            ->editColumn('estandar_incluido', function ($lavanderia) {
                return ($lavanderia->estandar_incluido == 1 ? 'Si' : 'No');
            })
            ->editColumn('enviado', function ($lavanderia) {
                return ($lavanderia->enviado == 1 ? 'Si' : 'No');
            })
            ->editColumn('devuelto', function ($lavanderia) {
                return ($lavanderia->total_devuelto <> 0 ?  '<span class="badge badge-danger">Devuelto <i class="fas fa-check"></i> </span>':
                '<span class="badge badge-success">Enviado <i class="fas fa-check"></i> </span>'
            );
            })
            ->editColumn('total', function ($lavanderia) {

            $perdida = Perdida::where('corte_id', 'LIKE', "$lavanderia->id_corte")
            ->where('tipo_perdida', 'LIKE', 'Normal')
            ->whereIn('fase',  ['Produccion', 'Procesos secos'])
            // ->orWhere('fase', 'LIKE', 'Procesos secos')
            ->select('id')->get();
            $perdida_id = array();

            $longitud = count($perdida);

            for ($i=0; $i < $longitud; $i++) {
                array_push($perdida_id, $perdida[$i]['id']);
            }

            $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            $totales = array();

            $lent = count($talla_perdida);

            for ($i=0; $i < $lent; $i++) {
                array_push($totales, $talla_perdida[$i]['total']);

            }
            $cant_perdida = array_sum($totales);
            $cantidad_real = $lavanderia->total;
            return $cantidad_real - $cant_perdida;
            })
            ->editColumn('total_devuelto', function ($lavanderia) {

                $perdida = Perdida::where('corte_id', 'LIKE', "$lavanderia->id_corte")
                ->where('tipo_perdida', 'LIKE', 'Normal')
                ->whereIn('fase',  ['Produccion', 'Procesos secos'])
                // ->orWhere('fase', 'LIKE', 'Procesos secos')
                ->select('id')->get();
                $perdida_id = array();

                $longitud = count($perdida);

                for ($i=0; $i < $longitud; $i++) {
                    array_push($perdida_id, $perdida[$i]['id']);
                }

                $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
                $totales = array();

                $lent = count($talla_perdida);

                for ($i=0; $i < $lent; $i++) {
                    array_push($totales, $talla_perdida[$i]['total']);

                }
                $cant_perdida = array_sum($totales);
                $cantidad_real = $lavanderia->total - $cant_perdida;
                $total_enviado = $lavanderia->total_enviado;
                return ($cantidad_real - $total_enviado < 0 ) ? 0 : $cantidad_real - $total_enviado;
            })
            ->editColumn('fecha_envio', function ($lavanderia) {
                return date("d-m-20y", strtotime($lavanderia->fecha_envio));
            })
            ->addColumn('Ver', function ($lavanderia) {
                return '<button id="btnEdit" onclick="ver(' . $lavanderia->id . ')" class="btn btn-info btn-sm" > <i class="fas fa-eye"></i></button>';

            })
            ->addColumn('Opciones', function ($lavanderia) {
                return
                    // '<button id="btnEdit" onclick="mostrar(' . $lavanderia->id . ')" class="btn btn-warning btn-sm ml-1" > <i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $lavanderia->id . ')" class="btn btn-danger btn-sm mr-1 ml-1"> <i class="fas fa-eraser"></i></button>' .
                    '<a href="imprimir/conduce/' . $lavanderia->id . '" class="btn btn-secondary btn-sm  mr-1"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones', 'Ver', 'devuelto'])
            ->make(true);
    }

    public function DevolucionLavanderia()
    {
        $lavanderia = DB::table('lavanderia')->join('corte', 'lavanderia.corte_id', '=', 'corte.id')
            ->join('producto', 'lavanderia.producto_id', '=', 'producto.id')
            ->join('suplidor', 'suplidor_id', '=', 'suplidor.id')
            ->select([
                'lavanderia.id', 'lavanderia.numero_envio', 'lavanderia.fecha_envio', 'lavanderia.receta_lavado',
                'lavanderia.cantidad', 'lavanderia.estandar_incluido', 'corte.numero_corte', 'corte.fase',
                'producto.referencia_producto', 'suplidor.nombre', 'lavanderia.enviado', 'lavanderia.total_enviado'
                , 'corte.total', 'lavanderia.cantidad_parcial', 'corte.id as id_corte'
            ]);

        return DataTables::of($lavanderia)
            ->addColumn('Expandir', function ($lavanderia) {
                return "";
            })
            ->editColumn('estandar_incluido', function ($lavanderia) {
                return ($lavanderia->estandar_incluido == 1 ? 'Si' : 'No');
            })
            ->editColumn('enviado', function ($lavanderia) {
                return ($lavanderia->enviado == 1 ? 'Si' : 'No');
            })
            ->editColumn('total', function ($lavanderia) {

            $perdida = Perdida::where('corte_id', 'LIKE', "$lavanderia->id_corte")
            ->where('tipo_perdida', 'LIKE', 'Normal')
            ->where('fase', 'LIKE', 'Produccion')
            ->orWhere('fase', 'LIKE', 'Procesos secos')
            ->select('id')->get();
            $perdida_id = array();

            $longitud = count($perdida);

            for ($i=0; $i < $longitud; $i++) {
                array_push($perdida_id, $perdida[$i]['id']);
            }

            $talla_perdida = TallasPerdidas::whereIn('perdida_id', $perdida_id)->get();
            $totales = array();

            $lent = count($talla_perdida);

            for ($i=0; $i < $lent; $i++) {
                array_push($totales, $talla_perdida[$i]['total']);

            }
            $cant_perdida = array_sum($totales);
                $cantidad_real = $lavanderia->total;
                return $cantidad_real - $cant_perdida;
            })
            ->editColumn('fecha_envio', function ($lavanderia) {
                return date("d-m-20y", strtotime($lavanderia->fecha_envio));
            })
            ->addColumn('Ver', function ($lavanderia) {
                return '<button id="btnEdit" onclick="ver(' . $lavanderia->id . ')" class="btn btn-info btn-sm" > <i class="fas fa-eye"></i></button>';

            })
            ->addColumn('Opciones', function ($lavanderia) {
                return
                    // '<button id="btnEdit" onclick="mostrar(' . $lavanderia->id . ')" class="btn btn-warning btn-sm ml-1" > <i class="fas fa-edit"></i></button>' .
                    '<button onclick="eliminar(' . $lavanderia->id . ')" class="btn btn-danger btn-sm mr-1 ml-1"> <i class="fas fa-eraser"></i></button>' .
                    '<a href="imprimir/conduce/' . $lavanderia->id . '" class="btn btn-secondary btn-sm  mr-1"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones', 'Ver'])
            ->make(true);
    }


    public function show($id)
    {
        $lavanderia = Lavanderia::find($id)->load('corte')
            ->load('producto')
            ->load('suplidor');

        if (is_object($lavanderia)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ocurrio un error'
            ];
        }

        return \response()->json($data, $data['code']);
    }

    public function update(Request $request)
    {
        $validar = $request->validate([
            'cantidad' => 'required',
            'receta_lavado' => 'required'
        ]);

        if (empty($validar)) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $fecha_envio = $request->input('fecha_envio');
            $cantidad = $request->input('cantidad');
            $receta_lavado = $request->input('receta_lavado');
            $estandar_incluido = $request->input('estandar_incluido');
            $corte_id = $request->input('corte');
            $producto_id = $request->input('producto_id');
            $suplidor_id = $request->input('suplidor');

            $lavanderia = Lavanderia::find($id);
            $corte = Corte::find($corte_id);
            $producto_id = $corte['producto_id'];
            $total_enviado = $lavanderia->total_enviado;
            $parcial_enviado = $lavanderia->parcial_enviado;
            $total_enviado = $cantidad;

            $lavanderia->suplidor_id = $suplidor_id;
            $lavanderia->corte_id = $corte_id;
            $lavanderia->producto_id = $producto_id;
            $lavanderia->fecha_envio = $fecha_envio;
            $lavanderia->cantidad = $cantidad;
            $lavanderia->cantidad_parcial = $cantidad;
            $lavanderia->total_enviado = $total_enviado;
            $lavanderia->receta_lavado = $receta_lavado;
            $lavanderia->estandar_incluido = $estandar_incluido;

            $lavanderia->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $lavanderia = Lavanderia::find($id);

        if (!empty($lavanderia)) {
            $lavanderia->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia
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
                ->where('tipo_suplidor', 'LIKE', 'Lavanderia')
                ->where('nombre', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectProducto(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select("id", "referencia_producto", "referencia_producto_2")
                // ->where('enviado_lavanderia', 'LIKE', '0')
                ->where('referencia_producto', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectProductoEdit(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select("id", "referencia_producto", "referencia_producto_2")
                ->where('referencia_producto', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('fase', 'LIKE', 'Produccion')
                ->orWhere('fase', 'LIKE', 'Lavanderia')
                ->orWhere('fase', 'LIKE', 'Terminacion')
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
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }



    public function getDigits()
    {
        $lavanderia = Lavanderia::orderBy('sec', 'desc')->first();

        if (\is_object($lavanderia)) {
            $sec = $lavanderia->sec;
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
        $lavanderia = Lavanderia::find($id)->load('corte')
            ->load('sku')
            ->load('suplidor')
            ->load('producto');

        $lavanderia->enviado = 1;

        $pdf = \PDF::loadView('sistema.lavanderia.conduce', \compact('lavanderia'));
        return $pdf->download('conduce.pdf');
        return View('sistema.lavanderia.conduce', \compact('lavanderia'));
    }
}

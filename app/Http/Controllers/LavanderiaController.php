<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lavanderia;
use App\Corte;
use App\Supplier;
use App\SKU;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class LavanderiaController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'sec' => 'required',
            'numero_envio' => 'required',
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

            $sec = $request->input('sec');
            $numero_envio = $request->input('numero_envio');
            $corte_id = $request->input('corte_id');
            $producto_id = $request->input('producto_id');
            $fecha_envio = $request->input('fecha_envio');
            $cantidad = $request->input('cantidad');
            $suplidor_id = $request->input('suplidor_id');
            $receta_lavado = $request->input('receta_lavado');
            $estandar_incluido = $request->input('estandar_incluido');

            $lavanderia = new Lavanderia();
            $corte = Corte::find($corte_id);
            $sku = SKU::where('talla', 'LIKE', 'General')
                ->where('producto_id', 'LIKE', "%$producto_id%")->get()->first();

            $sku_gen = $sku['id'];

            if (empty($sku_gen)) {
                $sku_gen = "";
            }

            $corte->fase = 'Lavanderia';
            $corte->save();

            $lavanderia->numero_envio = $numero_envio;
            $lavanderia->corte_id = $corte_id;
            $lavanderia->producto_id = $producto_id;
            $lavanderia->id_sku = $sku_gen;
            $lavanderia->suplidor_id = $suplidor_id;
            $lavanderia->fecha_envio = $fecha_envio;
            $lavanderia->cantidad = $cantidad;
            $lavanderia->receta_lavado = $receta_lavado;
            $lavanderia->estandar_incluido = $estandar_incluido;
            $lavanderia->sec = $sec + 0.01;

            $lavanderia->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'lavanderia' => $lavanderia
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function lavanderias()
    {
        $lavanderia = DB::table('lavanderia')->join('corte', 'lavanderia.corte_id', '=', 'corte.id')
            ->join('producto', 'lavanderia.producto_id', '=', 'producto.id')
            ->join('suplidor', 'suplidor_id', '=', 'suplidor.id')
            ->select(['lavanderia.id', 'lavanderia.numero_envio', 'lavanderia.fecha_envio', 'lavanderia.receta_lavado', 'lavanderia.cantidad', 'lavanderia.estandar_incluido', 'corte.numero_corte', 'corte.fase'
            ,'producto.referencia_producto', 'suplidor.nombre']);

        return DataTables::of($lavanderia)
            ->addColumn('Expandir', function ($lavanderia) {
                return "";
            })
            ->editColumn('estandar_incluido', function ($lavanderia) {
                return ($lavanderia->estandar_incluido == 1 ? 'Si' : 'No');
            })
            ->addColumn('Opciones', function ($lavanderia) {
                return '<button id="btnEdit" onclick="mostrar(' . $lavanderia->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $lavanderia->id . ')" class="btn btn-danger btn-sm ml-2"> <i class="fas fa-eraser"></i></button>'.
                '<a href="imprimir/conduce/'.$lavanderia->id .'" class="btn btn-secondary btn-sm ml-2"> <i class="fas fa-print"></i></a>';
            })
            ->rawColumns(['Opciones'])
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

            $lavanderia = Lavanderia::find($id);
     
            $lavanderia->fecha_envio = $fecha_envio;
            $lavanderia->cantidad = $cantidad;
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

    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('fase', 'LIKE', 'Produccion')
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

        $pdf = \PDF::loadView('sistema.lavanderia.conduce', \compact('lavanderia'));
        return $pdf->download('conduce.pdf');
    }
}

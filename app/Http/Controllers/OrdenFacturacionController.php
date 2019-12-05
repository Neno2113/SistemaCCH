<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenFacturacion;
use App\ordenEmpaque;
use App\ordenPedido;
use App\ordenEmpaqueDetalle;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class OrdenFacturacionController extends Controller
{

    public function store(Request $request)
    {
        $validar = $request->validate([
            'no_orden_facturacion' => 'required',
            'orden_empaque_id' => 'required',
            'sec' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $no_orden_facturacion = $request->input('no_orden_facturacion');
            $orden_empaque_id = $request->input('orden_empaque_id');
            $sec = $request->input('sec');

            $orden_facturacion = new OrdenFacturacion();

            $orden_facturacion->no_orden_facturacion = $no_orden_facturacion;
            $orden_facturacion->orden_empaque_id = $orden_empaque_id;
            $orden_facturacion->user_id = \auth()->user()->id;
            $orden_facturacion->fecha = date('Y/m/d h:i:s');

            $orden_facturacion->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_facturacion' => $orden_facturacion
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetalle(Request $request){
        
    }


    public function empaqueSearch(Request $request)
    {
        $id = $request->input('id');

        $orden_empaque = ordenEmpaque::find($id);
        $orden_pedido_id = $orden_empaque->orden_pedido_id;
        $orden_pedido = ordenPedido::find($orden_pedido_id)->load('cliente')->load('sucursal');

        if (\is_object($orden_empaque)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'orden_empaque' => $orden_empaque,
                'orden_pedido' => $orden_pedido
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'no se encontro nada'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function empaqueDetail($id)
    {
        $ordenes = DB::table('orden_empaque_detalle')
            ->join('producto', 'orden_empaque_detalle.producto_id', 'producto.id')
            ->select([
                'orden_empaque_detalle.id', 'orden_empaque_detalle.a',
                'orden_empaque_detalle.b', 'orden_empaque_detalle.c', 'orden_empaque_detalle.d',
                'orden_empaque_detalle.e', 'orden_empaque_detalle.f', 'orden_empaque_detalle.f',
                'orden_empaque_detalle.g', 'orden_empaque_detalle.h', 'orden_empaque_detalle.i',
                'orden_empaque_detalle.j', 'orden_empaque_detalle.k', 'orden_empaque_detalle.l',
                'orden_empaque_detalle.total', 'orden_empaque_detalle.empacado', 'producto.referencia_producto'
            ])->where('orden_empaque_id', 'LIKE', $id);

        return DataTables::of($ordenes)
            ->addColumn('Opciones', function ($orden) {
                return ($orden->empacado == 0) ? '<span id="empacado_listo" class="badge badge-success">Agregado <i class="fas fa-check"></i> </span>' : '<a onclick="agregar(' . $orden->id . ')" id="guardar" class="btn btn-info btn-sm ml-1"> <i class="fas fa-file-invoice"></i></a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function selectEmpaque(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ordenEmpaque::select("id", "no_orden_empaque")
                ->where('no_orden_empaque', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }



    public function getDigits()
    {
        $orden = OrdenFacturacion::orderBy('sec', 'desc')->first();

        if (\is_object($orden)) {
            $sec = $orden->sec;
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
}

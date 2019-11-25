<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ordenPedido;
use Yajra\DataTables\Facades\DataTables;
use App\ordenPedidoDetalle;
use App\ordenEmpaque;
use App\Perdida;
use App\Almacen;
use App\TallasPerdidas;
use App\Product;

class ordenEmpaqueController extends Controller
{
    public function ordenesAprobacion()
    {
        $ordenes = DB::table('orden_pedido')->join('users', 'orden_pedido.user_aprobacion', 'users.id')
            ->join('cliente', 'orden_pedido.cliente_id', 'cliente.id')
            ->join('cliente_sucursales', 'orden_pedido.sucursal_id', 'cliente_sucursales.id')
            ->select([
                'orden_pedido.id', 'orden_pedido.fecha_aprobacion',
                'orden_pedido.no_orden_pedido', 'orden_pedido.fecha_entrega',
                'orden_pedido.detallada',
                'users.name', 'cliente.nombre_cliente', 'cliente_sucursales.nombre_sucursal', 'orden_pedido.corte_en_proceso',
                'orden_pedido.status_orden_pedido', 'orden_pedido.orden_proceso_impresa'
            ])->where('status_orden_pedido', 'LIKE', 'Vigente');

        return DataTables::of($ordenes)
            ->addColumn('Expandir', function () {
                return "";
            })
            ->addColumn('total', function ($orden) {
                $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $orden->id)->get();

                return $ordenDetalle->sum('total');
            })
            ->editColumn('detallada', function ($orden) {
                return ($orden->detallada == 1 ? 'Si' : 'No');
            })
            ->editColumn('fecha_entrega', function ($orden) {
                return date("d-m-20y", strtotime($orden->fecha_entrega));
            })
            ->editColumn('fecha_aprobacion', function ($orden) {
                return date("h:i:s d-m", strtotime($orden->fecha_aprobacion));
            })
            ->editColumn('status_orden_pedido', function ($orden) {
                if ($orden->status_orden_pedido == 'Vigente') {
                    return '<span class="badge badge-pill badge-success">Vigente</span>';
                } else if ($orden->status_orden_pedido == 'Cancelado') {
                    return '<span class="badge badge-pill badge-danger">Cancelada</span>';
                } else if ($orden->status_orden_pedido == 'Stanby') {
                    return '<span class="badge badge-pill badge-secondary">Stanby</span>';
                } else if ($orden->status_orden_pedido == 'Despachado') {
                    return '<span class="badge badge-pill badge-info">Stanby</span>';
                }
            })
            ->addColumn('Opciones', function ($orden) {
                return ($orden->detallada == '1') ?
                    '<a href="imprimir_empaque/' . $orden->id . '" class="btn btn-secondary btn-sm ml-1"> <i class="fas fa-print"></i></a>' :
                    '<button onclick="redistribuir(' . $orden->id . ')" class="btn btn-primary btn-sm ml-1" id="btn-status"> <i class="fas fa-random"></i></button>';
            })
            ->rawColumns(['Opciones', 'status_orden_pedido'])
            ->make(true);
    }

    public function imprimir($id)
    {
        //verificar numero antiguo de la secuencia;
        $numero_antiguo = DB::table('orden_empaque')->latest('updated_at')->first();

        if (empty($numero_antiguo) || $numero_antiguo == "") {
            $sec = 0.00;
            $id_orden_pedido = 0;
        } else {
            $sec = $numero_antiguo->sec;
        }

        $orden_pedido = ordenEmpaque::where('orden_pedido_id', $id)->get()->first();

        if (empty($orden_pedido) || $orden_pedido == "[]") {
             //Crear nuevo objeto de orden de empaque
             $orden_empaque = new ordenEmpaque();

             $orden_empaque->orden_pedido_id = $id;
             $next_sec = $sec + 0.01;
             $orden_empaque->no_orden_empaque = "OE - " . str_replace('.', '', $next_sec);
             $orden_empaque->fecha = date('Y/m/d h:i:s');
             $orden_empaque->sec = $sec + 0.01;
             $orden_empaque->save();
        } else {
            $orden_empaque = $orden_pedido;
           
           
        }

        //orden normal
        $orden = ordenPedido::find($id)->load('cliente')
            ->load('user')
            ->load('sucursal')
            ->load('producto');

        $orden_detalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->load('producto');

        $pdf = \PDF::loadView('sistema.ordenEmpaque.conduceEmpaque', \compact('orden', 'orden_detalle', 'orden_empaque'));
        return $pdf->download('conduce.pdf');
    }


    public function redistibucion($id){

        $orden = ordenPedido::find($id);

        $ordenDetalle = ordenPedidoDetalle::where('orden_pedido_id', $id)->get()->first();

        $producto_id = $ordenDetalle->producto_id;

        //perdidas
        $perdida = Perdida::where('tipo_perdida', 'LIKE', 'Normal')
            ->where('producto_id', $producto_id)->select('id')->get();

        $perdidas = array();

        $longitudPerdida = count($perdida);

        for ($i = 0; $i < $longitudPerdida; $i++) {
            array_push($perdidas, $perdida[$i]['id']);
        }


        $tallasPerdidas = TallasPerdidas::whereIn('perdida_id', $perdidas)->get()->load('perdida');


        //SEGUNDA
        $segunda = Perdida::where('tipo_perdida', 'LIKE', 'Segundas')
            ->where('producto_id', $producto_id)->select('id')->get();

        $segundas = array();

        $longitudSegunda = count($segunda);

        for ($i = 0; $i < $longitudSegunda; $i++) {
            array_push($segundas, $segunda[$i]['id']);
        }

        $tallasSegundas = TallasPerdidas::whereIn('perdida_id', $segundas)->get()->load('perdida');


        //Almacen
        $almacen = Almacen::where('producto_id', $producto_id)->select('id')->get();

        $almacenes = array();

        $longitudAlmacen = count($almacen);

        for ($i = 0; $i < $longitudAlmacen; $i++) {
            array_push($almacenes, $almacen[$i]['id']);
        }

        $tallasAlmacen = Almacen::whereIn('id', $almacenes)->get();

        $tallasOrdenes = ordenPedidoDetalle::where('producto_id', $producto_id)->get();

        //producto
        $producto = Product::find($producto_id);

        //calcular total real
        $a = $tallasAlmacen->sum('a') - $tallasPerdidas->sum('a') - $tallasSegundas->sum('a') - $tallasOrdenes->sum('a');
        $b = $tallasAlmacen->sum('b') - $tallasPerdidas->sum('b') - $tallasSegundas->sum('b') - $tallasOrdenes->sum('b');
        $c = $tallasAlmacen->sum('c') - $tallasPerdidas->sum('c') - $tallasSegundas->sum('c') - $tallasOrdenes->sum('c');
        $d = $tallasAlmacen->sum('d') - $tallasPerdidas->sum('d') - $tallasSegundas->sum('d') - $tallasOrdenes->sum('d');
        $e = $tallasAlmacen->sum('e') - $tallasPerdidas->sum('e') - $tallasSegundas->sum('e') - $tallasOrdenes->sum('e');
        $f = $tallasAlmacen->sum('f') - $tallasPerdidas->sum('f') - $tallasSegundas->sum('f') - $tallasOrdenes->sum('f');
        $g = $tallasAlmacen->sum('g') - $tallasPerdidas->sum('g') - $tallasSegundas->sum('g') - $tallasOrdenes->sum('g');
        $h = $tallasAlmacen->sum('h') - $tallasPerdidas->sum('h') - $tallasSegundas->sum('h') - $tallasOrdenes->sum('h');
        $i = $tallasAlmacen->sum('i') - $tallasPerdidas->sum('i') - $tallasSegundas->sum('i') - $tallasOrdenes->sum('i');
        $j = $tallasAlmacen->sum('j') - $tallasPerdidas->sum('j') - $tallasSegundas->sum('j') - $tallasOrdenes->sum('j');
        $k = $tallasAlmacen->sum('k') - $tallasPerdidas->sum('k') - $tallasSegundas->sum('k') - $tallasOrdenes->sum('k');
        $l = $tallasAlmacen->sum('l') - $tallasPerdidas->sum('l') - $tallasSegundas->sum('l') - $tallasOrdenes->sum('l');
        
        $a = ($a < 0 ? 0 : $a);
        $b = ($b < 0 ? 0 : $b);
        $c = ($c < 0 ? 0 : $c);
        $d = ($d < 0 ? 0 : $d);
        $e = ($e < 0 ? 0 : $e);
        $f = ($f < 0 ? 0 : $f);
        $g = ($g < 0 ? 0 : $g);
        $h = ($h < 0 ? 0 : $h);
        $i = ($i < 0 ? 0 : $i);
        $j = ($j < 0 ? 0 : $j);
        $k = ($k < 0 ? 0 : $k);
        $l = ($l < 0 ? 0 : $l);
        
        $total_alm = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
        
        //porcentaje
        $a_perc = ($a / $total_alm) * 100;
        $b_perc = ($b / $total_alm) * 100;
        $c_perc = ($c / $total_alm) * 100;
        $d_perc = ($d / $total_alm) * 100;
        $e_perc = ($e / $total_alm) * 100;
        $f_perc = ($f / $total_alm) * 100;
        $g_perc = ($g / $total_alm) * 100;
        $h_perc = ($h / $total_alm) * 100;
        $i_perc = ($i / $total_alm) * 100;
        $j_perc = ($j / $total_alm) * 100;
        $k_perc = ($k / $total_alm) * 100;
        $l_perc = ($l / $total_alm) * 100;

        $total_perc = $a_perc + $b_perc + $c_perc + $d_perc + $e_perc + $f_perc + $g_perc + $h_perc +
        $i_perc + $j_perc + $k_perc + $l_perc;

        //segundo calculo
        

        $data = [
            'code' => 200,
            'status' => 'success',
            'orden' => $orden,
            'cantidad' => $ordenDetalle->sum('cantidad'),
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
            'e' => $e,
            'f' => $f,
            'g' => $g,
            'h' => $h,
            'i' => $i,
            'j' => $j,
            'k' => $k,
            'l' => $l,
            'total_alm' => $total_alm,
            'a%' => $a_perc,
            'b%' => $b_perc,
            'c%' => $c_perc,
            'd%' => $d_perc,
            'e%' => $e_perc,
            'f%' => $f_perc,
            'g%' => $g_perc,
            'h%' => $h_perc,
            'i%' => $i_perc,
            'j%' => $j_perc,
            'k%' => $k_perc,
            'l%' => $l_perc,
            'total_perc' => $total_perc

        ];


        return response()->json($data, $data['code']);
    }
}

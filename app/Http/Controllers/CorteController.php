<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rollos;
use App\Corte;
use App\Talla;
use App\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CorteController extends Controller
{

    public function store(Request $request)
    {
        $validar = $request->validate([
            'numero_corte' => 'required',
            'producto' => 'required',
            'fecha_entrega' => 'required',
            'aprovechamiento' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $numero_corte = $request->input('numero_corte');
            $producto_id = $request->input('producto');
            // $fecha_corte = $request->input('fecha_corte');
            $no_marcada = $request->input('no_marcada');
            $ancho_marcada = $request->input('ancho_marcada');
            $largo_marcada = $request->input('largo_marcada');
            $aprovechamiento = $request->input('aprovechamiento');
            $fecha_entrega = $request->input('fecha_entrega');
            
            $sec = $request->input('sec');
            $fase = 'Produccion';

            $date = date('20y-m-d');

            $corte = new Corte();

            $corte->numero_corte = $numero_corte;
            $corte->producto_id = $producto_id;
            $corte->user_id = \auth()->user()->id;
            $corte->fecha_corte = $date;
            $corte->no_marcada = $no_marcada;
            $corte->largo_marcada = $largo_marcada;
            $corte->ancho_marcada = $ancho_marcada;
            $corte->aprovechamiento = trim($aprovechamiento, '%');
            $corte->fase = $fase;
            $corte->sec = $sec + 0.01;
            $corte->fecha_entrega = $fecha_entrega;

            $corte->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function cortes()
    {
        $cortes = DB::table('corte')->join('users', 'corte.user_id', '=', 'users.id')
            ->join('producto', 'corte.producto_id', '=', 'producto.id')
            ->select(['corte.id', 'users.name', 'users.surname', 'corte.numero_corte', 'producto.referencia_producto'
            , 'producto.referencia_producto_2', 'corte.fecha_corte', 'corte.no_marcada', 'corte.ancho_marcada', 'corte.largo_marcada',
            'corte.aprovechamiento', 'corte.fase', 'corte.total', 'corte.fecha_entrega']);

        return DataTables::of($cortes)
            ->addColumn('Expandir', function ($corte) {
                return "";
            })
            ->editColumn('name', function ($corte) {
                return "$corte->name $corte->surname";
            })
            ->editColumn('fecha_corte', function ($corte) {
                return date("d-m-20y", strtotime($corte->fecha_corte));
            })
            ->addColumn('Opciones', function ($corte) {
                if($corte->fase != "Produccion"){
                    return '<button id="btnEdit" onclick="mostrar(' . $corte->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>';
                }else{
                    return '<button id="btnEdit" onclick="mostrar(' . $corte->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $corte->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
                }
                
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }



    public function rollos()
    {
        $cond = null;
        $rollos = DB::table('rollos')->join('tela', 'rollos.id_tela', '=', 'tela.id')
            ->select(['rollos.id', 'tela.referencia', 'rollos.codigo_rollo', 'rollos.longitud_yarda', 'rollos.num_tono'])
            ->where('corte_utilizado', $cond);

        return DataTables::of($rollos)
            ->addColumn('Editar', function ($rollo) {
                return '<button id="btnEdit" onclick="asignar(' . $rollo->id . ')" class="btn btn-warning" > <i class="fas fa-marker"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
    }


    public function show($id)
    {
        $corte = Corte::find($id)->load('producto');

        if (is_object($corte)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
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
            'producto' => 'required',
            'aprovechamiento' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $producto_id = $request->input('producto');
            $no_marcada = $request->input('no_marcada');
            $ancho_marcada = $request->input('ancho_marcada');
            $largo_marcada = $request->input('largo_marcada');
            $aprovechamiento = $request->input('aprovechamiento');
            
            $corte = Corte::find($id);

            $corte->producto_id = $producto_id;
            $corte->no_marcada = $no_marcada;
            $corte->ancho_marcada = $ancho_marcada;
            $corte->largo_marcada = $largo_marcada;
            $corte->aprovechamiento = trim($aprovechamiento, '%');
           
            $corte->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $corte = Corte::find($id);

        if (!empty($corte)) {
            $corte->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => $corte
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
        $corte = Corte::orderBy('sec', 'desc')->first();

        if (\is_object($corte)) {
            $sec = $corte->sec;
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

    public function selectProduct(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select("id", "referencia_producto")
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
            $data = Corte::join('producto', 'corte.producto_id', '=', 'producto.id')
                ->select("corte.id", "corte.numero_corte", "corte.fase", "producto.referencia_producto")
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }


    public function testSelect2(){
        $productos = Product::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'productos' => $productos
        ];

        return response()->json($data, $data['code']);
    }

    public function asignar($id, Request $request)
    {
        $rollo = Rollos::find($id);

        $numero_corte = $request->input('numero_corte');

        if (!empty($rollo)) {
            $corte_utilizado = $rollo->corte_utilizado;
        
            if ($corte_utilizado == NULL || $corte_utilizado == '') {
                $rollo->corte_utilizado = $numero_corte;

                $rollo->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'rollo' => $rollo
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Rollo ya asignado!!'
                ];
             }
        } else {

            $data = [
                'code' => 500,
                'status' => 'error',
                'message' => 'Ocurrio un error!!'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function corte_home(){
        $corte = Corte::where('fase', 'LIKE', 'Produccion')
        ->orwhere('fase', 'LIKE', 'Lavanderia')
        ->orwhere('fase', 'LIKE', 'Terminacion')->count();

        $data = [
            'code' => 200,
            'status' => 'success',
            'corte' => $corte
        ];

        return response()->json($data, $data['code']);
    }

    public function verificarCorte(Request $request){

        $validar = $request->validate([
            'numero_corte' => 'unique:corte',
           
        ]);
        if(!empty($validar)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'corte' => 'Test'
            ];
        
        }
        return response()->json($data, $data['code']);   
    }
}

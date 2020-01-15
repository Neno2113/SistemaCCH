<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Perdida;
use App\Product;
use App\TallasPerdidas;
use App\Talla;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PerdidaController extends Controller
{

    public function store(Request $request)
    {
        $validar = $request->validate([
            'no_perdida' => 'required',
            'corte' => 'required',
            'fecha' => 'required',
            'tipo_perdida' => 'required',
            'fase' => 'required',
            'motivo' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $corte_id = $request->input('corte');
            $fecha = $request->input('fecha');
            $tipo_perdida = $request->input('tipo_perdida');
            $fase = $request->input('fase');
            $motivo = $request->input('motivo');
            $no_perdida = $request->input('no_perdida');
            $sec = $request->input('sec');
            // $perdida_x = $request->input('perdida_x');
            // $producto_id = $request->input('producto_id');

        
            $perdida = new Perdida();
            $corte = Corte::find($corte_id);
            $producto_id = $corte['producto_id'];


            $perdida->corte_id = $corte_id;
            $perdida->fecha = $fecha;
            $perdida->tipo_perdida = $tipo_perdida;
            $perdida->fase = $fase;
            $perdida->user_id = \auth()->user()->id;
            $perdida->motivo = $motivo;
            $perdida->no_perdida = $no_perdida;
            $perdida->sec = $sec + 0.01;
            $perdida->producto_id = $producto_id;
            // $perdida->perdida_x = $perdida_x;

            $perdida->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'perdida' => $perdida
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeTalla(Request $request)
    {
        $validar = $request->validate([
            'perdida_id' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $perdida_id = $request->input('perdida_id');
            $a = $request->input('a');
            $b = $request->input('b');
            $c = $request->input('c');
            $d = $request->input('d');
            $e = $request->input('e');
            $f = $request->input('f');
            $g = $request->input('g');
            $h = $request->input('h');
            $i = $request->input('i');
            $j = $request->input('j');
            $k = $request->input('k');
            $l = $request->input('l');
            $x = $request->input('talla_x');


            $a = intval(trim($a, "_"));
            $b = intval(trim($b, "_"));
            $c = intval(trim($c, "_"));
            $d = intval(trim($d, "_"));
            $e = intval(trim($e, "_"));
            $f = intval(trim($f, "_"));
            $g = intval(trim($g, "_"));
            $h = intval(trim($h, "_"));
            $i = intval(trim($i, "_"));
            $j = intval(trim($j, "_"));
            $k = intval(trim($k, "_"));
            $l = intval(trim($l, "_"));
            $x = intval(trim($x, "_"));
            
            $total = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l+$x;
        
            $tallas = new TallasPerdidas();

            $tallas->perdida_id = $perdida_id;
            $tallas->a = $a;
            $tallas->b = $b;
            $tallas->c = $c;
            $tallas->d = $d;
            $tallas->e = $e;
            $tallas->f = $f;
            $tallas->g = $g;
            $tallas->h = $h;
            $tallas->i = $i;
            $tallas->j = $j;
            $tallas->k = $k;
            $tallas->l = $l;
            $tallas->talla_x = $x;
         
            $tallas->total = $total;

            $tallas->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'talla_perdida' => $tallas
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function perdidas()
    {
        $perdidas = DB::table('perdidas')->join('corte', 'perdidas.corte_id', '=', 'corte.id')
            ->join('producto', 'perdidas.producto_id', '=', 'producto.id')
            ->select(['perdidas.id', 'perdidas.no_perdida', 'perdidas.tipo_perdida', 'perdidas.fecha', 'perdidas.fase'
            , 'perdidas.motivo', 'producto.referencia_producto', 'corte.numero_corte']);

        return DataTables::of($perdidas)
            ->addColumn('Expandir', function ($product) {
                return "";
            })
            ->editColumn('fecha', function ($perdida) {
                return date("d-m-20y", strtotime($perdida->fecha));
            })
            ->addColumn('Opciones', function ($perdida) {
                return '<button id="btnEdit" onclick="mostrar(' . $perdida->id . ')" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></button>'.
                '<button onclick="eliminar(' . $perdida->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>'.
                '<a href="imprimir/perdida/' . $perdida->id . '" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Perdida"><i class="fas fa-file-alt"></i></a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function show($id)
    {
        $perdida = Perdida::find($id)->load('corte')
            ->load('producto');
            // ->load('talla');

        $talla_perdida = TallasPerdidas::where('perdida_id', $id)->get()->first();  


        if (is_object($perdida)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'perdida' => $perdida,
                'tallas' => $talla_perdida
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
            'no_perdida' => 'required',
            'fecha' => 'required',
            'tipo_perdida' => 'required',
            'fase' => 'required',
            'motivo' => 'required'
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
            $fecha = $request->input('fecha');
            $tipo_perdida = $request->input('tipo_perdida');
            $fase = $request->input('fase');
            $motivo = $request->input('motivo');
            $no_perdida = $request->input('no_perdida');
            $sec = $request->input('sec');
            $perdida_x = $request->input('perdida_x');
        
            $perdida = Perdida::find($id);

            $perdida->corte_id = $corte_id;
            $perdida->fecha = $fecha;
            $perdida->tipo_perdida = $tipo_perdida;
            $perdida->fase = $fase;
            $perdida->motivo = $motivo;
            $perdida->no_perdida = $no_perdida;
            $perdida->sec = $sec + 0.01;
            $perdida->perdida_x = $perdida_x;

            $perdida->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'perdida' => $perdida
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function updateTallas(Request $request)
    {
        $validar = $request->validate([
            'perdida_id' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $perdida_id = $request->input('perdida_id');
            $a = $request->input('a');
            $b = $request->input('b');
            $c = $request->input('c');
            $d = $request->input('d');
            $e = $request->input('e');
            $f = $request->input('f');
            $g = $request->input('g');
            $h = $request->input('h');
            $i = $request->input('i');
            $j = $request->input('j');
            $k = $request->input('k');
            $l = $request->input('l');
            $x = $request->input('talla_x');

            //Validar numeros
            $a = intval(trim($a, "_"));
            $b = intval(trim($b, "_"));
            $c = intval(trim($c, "_"));
            $d = intval(trim($d, "_"));
            $e = intval(trim($e, "_"));
            $f = intval(trim($f, "_"));
            $g = intval(trim($g, "_"));
            $h = intval(trim($h, "_"));
            $i = intval(trim($i, "_"));
            $j = intval(trim($j, "_"));
            $k = intval(trim($k, "_"));
            $l = intval(trim($l, "_"));
            $x = intval(trim($x, "_"));
            

            $total = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l; 
        
            $tallas = TallasPerdidas::where('perdida_id', $perdida_id)->get()->first();

            $tallas->a = $a;
            $tallas->b = $b;
            $tallas->c = $c;
            $tallas->d = $d;
            $tallas->e = $e;
            $tallas->f = $f;
            $tallas->g = $g;
            $tallas->h = $h;
            $tallas->i = $i;
            $tallas->j = $j;
            $tallas->k = $k;
            $tallas->l = $l;
            $tallas->talla_x = $x;
            $tallas->total = $total;

            $tallas->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'talla_perdida' => $tallas
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $perdida = Perdida::find($id);

        if (!empty($perdida)) {
            $perdida->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'perdida' => $perdida
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



    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::join('producto', 'corte.producto_id', 'producto.id')
                ->select("corte.id", "corte.numero_corte", "corte.fase", "producto.referencia_producto")
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function getDigits()
    {
        $perdida = Perdida::orderBy('sec', 'desc')->first();

        if (\is_object($perdida)) {
            $sec = $perdida->sec;
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

    public function verificarFecha(Request $request){
        $corte_id = $request->input('corte_id');

        $fecha_corte = Corte::find($corte_id);

        $producto_id = $fecha_corte->producto_id;

        $producto = Product::find($producto_id);

        //buscar cortes con la misma referencia producto
        $corte = Corte::where('id', $corte_id)
        ->where('fase', 'LIKE', 'Terminacion')
        ->select('id', 'total')->get();
    
        $cortes = array();

        $longitud = count($corte);

        for ($i = 0; $i < $longitud; $i++) {
            array_push($cortes, $corte[$i]['id']);
        }
        //buscar cantidades de tallas con el array de id de cortes
        $tallas = Talla::whereIn('corte_id', $cortes)->get()->load('corte');

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

        //producto
        $producto = Product::find($producto_id);

        //calcular total real
        $a = $tallas->sum('a') - $tallasPerdidas->sum('a');
        $b = $tallas->sum('b') - $tallasPerdidas->sum('b');
        $c = $tallas->sum('c') - $tallasPerdidas->sum('c');
        $d = $tallas->sum('d') - $tallasPerdidas->sum('d');
        $e = $tallas->sum('e') - $tallasPerdidas->sum('e');
        $f = $tallas->sum('f') - $tallasPerdidas->sum('f');
        $g = $tallas->sum('g') - $tallasPerdidas->sum('g');
        $h = $tallas->sum('h') - $tallasPerdidas->sum('h');
        $i = $tallas->sum('i') - $tallasPerdidas->sum('i');
        $j = $tallas->sum('j') - $tallasPerdidas->sum('j');
        $k = $tallas->sum('k') - $tallasPerdidas->sum('k');
        $l = $tallas->sum('l') - $tallasPerdidas->sum('l'); 

        //Validacion de numeros negativos
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

        $total_real = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
        
        $data = [
            'code' => 200,
            'status' => 'success',
            'corte' => date("d-m-20y", strtotime($fecha_corte->fecha_corte)),
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
            'total' => $total_real
        ];

        return response()->json($data, $data['code']);
    }

    public function imprimir($id){

        $perdida = Perdida::find($id)
        ->load('producto')
        ->load('corte')
        ->load('user');

        $genero = substr($perdida->producto->referencia_producto, 1,1);
        $genero_plus = substr($perdida->producto->referencia_producto, 3,1);
        // echo $genero;
        // die();

        $detalle = TallasPerdidas::where('perdida_id', $id)->get();

        $pdf = \PDF::loadView('sistema.perdidas.documentoPerdida', \compact('perdida', 'detalle', 'genero', 'genero_plus'))->setPaper('a4');
        return $pdf->download('docPerdida.pdf');
        return View('sistema.perdidas.documentoPerdida', \compact('perdida', 'detalle', 'genero', 'genero_plus'));

    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientBranch;
use App\ClienteDistribucion;
use App\CurvaProducto;
use App\PermisoUsuario;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre_cliente' => 'required|unique:cliente',
            'codigo_cliente' => 'required',
         //   'rnc' => 'required',
            'contacto_cliente_principal' => 'required|alpha',
            'telefono_1' => 'required',
            'celular_principal' => 'required'
         //   'email_principal' => 'required|email',
         //   'condiciones_credito' => 'required',
         //   'calle' => 'required',
        //    'sector' => 'required',
        //    'provincia' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $nombre_cliente = $request->input('nombre_cliente' );
            $codigo_cliente = $request->input('codigo_cliente');
            $calle = $request->input('calle', true);
            $sector = $request->input('sector');
            $provincia = $request->input('provincia');
            $sitios_cercanos = $request->input('sitios_cercanos');
            $contacto_cliente_principal = $request->input('contacto_cliente_principal', true);
            $rnc = $request->input('rnc');
            $telefono_1 = $request->input('telefono_1', true);
        //    $telefono_2 = $request->input('telefono_2', true);
        //    $telefono_3 = $request->input('telefono_3', true);
            $celular_principal = $request->input('celular_principal', true);
            $email_principal = $request->input('email_principal', true);
            $condiciones_credito = $request->input('condiciones_credito', true);
            $autorizaciones_credito_req = $request->input('autorizaciones_credito_req', true);
            $notas = $request->input('notas', true);
            $redistribucion_tallas = $request->input('redistribucion_tallas', true);
            $factura_desglosada_talla = $request->input('factura_desglosada_talla', true);
            $acepta_segundas = $request->input('acepta_segundas', true);


            $cliente = new Client();
            $cliente->nombre_cliente = $nombre_cliente;
            $cliente->codigo_cliente = $codigo_cliente;
            $cliente->calle = $calle;
            $cliente->sector = $sector;
            $cliente->provincia = $provincia;
            $cliente->sitios_cercanos = $sitios_cercanos;
            $cliente->rnc = trim($rnc, "_");
            $cliente->contacto_cliente_principal = $contacto_cliente_principal;
            $cliente->telefono_1 = $telefono_1;
        //    $cliente->telefono_2 = $telefono_2;
        //    $cliente->telefono_3 = $telefono_3;
            $cliente->celular_principal = $celular_principal;
            $cliente->email_principal = $email_principal;
            $cliente->condiciones_credito = $condiciones_credito;
            $cliente->autorizacion_credito_req = $autorizaciones_credito_req;
            $cliente->notas = $notas;
            $cliente->redistribucion_tallas = $redistribucion_tallas;
            $cliente->factura_desglosada_talla = $factura_desglosada_talla;
            $cliente->acepta_segundas = $acepta_segundas;
            $cliente->save();


            // $branch_principal = new ClientBranch();
            // $branch_principal->cliente_id = $cliente->id;
            // $branch_principal->nombre_sucursal = 'Principal';
            // $branch_principal->save();
         

            $data = [
                'code' => 200,
                'status' => 'success',
                'cliente' => $cliente
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function show($id)
    {
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Cliente')
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
        
        $client = Client::find($id);

        if (is_object($client)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'client' => $client
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
            'id' => 'required',
            'nombre_cliente' => 'required',
            'contacto_cliente_principal' => 'required',
            'telefono_1' => 'required',
            'email_principal' => 'required|email',
            'condiciones_credito' => 'required',
            'calle' => 'required',
            'sector' => 'required',
            'provincia' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $nombre_cliente = $request->input('nombre_cliente', true);
            $codigo_cliente = $request->input('codigo_cliente');
            $calle = $request->input('calle', true);
            $sector = $request->input('sector');
            $provincia = $request->input('provincia');
            $sitios_cercanos = $request->input('sitios_cercanos');
            $rnc = $request->input('rnc');
            $contacto_cliente_principal = $request->input('contacto_cliente_principal', true);
            $telefono_1 = $request->input('telefono_1', true);
            $telefono_2 = $request->input('telefono_2', true);
            $telefono_3 = $request->input('telefono_3', true);
            $celular_principal = $request->input('celular_principal', true);
            $email_principal = $request->input('email_principal', true);
            $condiciones_credito = $request->input('condiciones_credito', true);
            $autorizaciones_credito_req = $request->input('autorizaciones_credito_req', true);
            $notas = $request->input('notas', true);
            $redistribucion_tallas = $request->input('redistribucion_tallas', true);
            $factura_desglosada_talla = $request->input('factura_desglosada_talla', true);
            $acepta_segundas = $request->input('acepta_segundas', true);

            $client = Client::find($id);

            $client->nombre_cliente = $nombre_cliente;
            $client->codigo_cliente = $codigo_cliente;
            $client->calle = $calle;
            $client->sector = $sector;
            $client->provincia = $provincia;
            $client->sitios_cercanos = $sitios_cercanos;
            $client->contacto_cliente_principal = $contacto_cliente_principal;
            $client->rnc = $rnc;
            $client->telefono_1 = $telefono_1;
            $client->telefono_2 = $telefono_2;
            $client->telefono_3 = $telefono_3;
            $client->celular_principal = $celular_principal;
            $client->email_principal = $email_principal;
            $client->condiciones_credito = $condiciones_credito;
            $client->autorizacion_credito_req = $autorizaciones_credito_req;
            $client->notas = $notas;
            $client->redistribucion_tallas = $redistribucion_tallas;
            $client->factura_desglosada_talla = $factura_desglosada_talla;
            $client->acepta_segundas = $acepta_segundas;


            $client->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'client' => $client
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Cliente')
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
        $client = Client::find($id);

        if (!empty($client)) {
            $client->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'client' => $client
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

    public function clients()
    {
        $clients = Client::query();

        return DataTables::eloquent($clients)
            ->addColumn('Expandir', function ($client) {
                return "";
            })
            ->addColumn('Ver', function ($client) {
                return '<button onclick="ver(' . $client->id . ')" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></button>';
            })
            ->editColumn('autorizacion_credito_req', function ($client) {
                return ($client->autorizacion_credito_req == 1 ? 'Si' : 'No');
            })
            ->editColumn('redistribucion_tallas', function ($client) {
                return ($client->redistribucion_tallas == 1 ? 'Si' : 'No');
            })
            ->editColumn('condiciones_credito', function ($client) {
                if($client->condiciones_credito == '60' ){
                    return $client->condiciones_credito . ' dias'; 
                } else if($client->condiciones_credito == '90' ){
                    return $client->condiciones_credito . ' dias';
                } else if($client->condiciones_credito == '120' ){   
                    return $client->condiciones_credito . ' dias';
                }else if($client->condiciones_credito == '0' ){   
                    return 'Al contado';
                } else if($client->condiciones_credito == '30' ){   
                    return $client->condiciones_credito . ' dias';
                }
            })
            ->editColumn('factura_desglosada_talla', function ($client) {
                return ($client->factura_desglosada_talla == 1 ? 'Si' : 'No');
            })
            ->editColumn('acepta_segundas', function ($client) {
                return ($client->acepta_segundas == 1 ? 'Si' : 'No');
            })
            ->addColumn('Opciones', function ($client) {
                return '<button onclick="eliminar(' . $client->id . ')" class="btn btn-danger btn-sm mr-1"> <i class="fas fa-eraser"></i></button>'.
                '<button id="btnEdit" onclick="mostrar(' . $client->id . ')" class="btn btn-warning btn-sm ml-1" > <i class="fas fa-edit"></i></button>';
            })
            ->rawColumns(['Ver', 'Opciones'])
            ->make(true);
    }


    public function storeDistribution (Request $request){

        $validar = $request->validate([
            'producto' => 'required',
         
        ]);

        if(empty($validar)){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('producto');
            $cliente = $request->input('cliente');
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

            //validaciones
            $a = trim($a, "_");
            $b = trim($b, "_");
            $c = trim($c, "_");
            $d = trim($d, "_");
            $e = trim($e, "_");
            $f = trim($f, "_");
            $g = trim($g, "_");
            $h = trim($h, "_");
            $i = trim($i, "_");
            $j = trim($j, "_");
            $k = trim($k, "_");
            $l = trim($l, "_");


            $distribucion = new ClienteDistribucion();
            if(empty($cliente)){
                $select = DB::select("SHOW TABLE STATUS LIKE 'cliente'");
                $nextId = $select[0]->Auto_increment;

                $distribucion->cliente_id = $nextId;
            } else {
                $distribucion->cliente_id = $cliente;
            }

            $distribucion->producto = $id;
            $distribucion->a = ($a == "" ? 0 : $a);
            $distribucion->b = ($b == "" ? 0 : $b);
            $distribucion->c = ($c == "" ? 0 : $c);
            $distribucion->d = ($d == "" ? 0 : $d);
            $distribucion->e = ($e == "" ? 0 : $e);
            $distribucion->f = ($f == "" ? 0 : $f);
            $distribucion->g = ($g == "" ? 0 : $g);
            $distribucion->h = ($h == "" ? 0 : $h);
            $distribucion->i = ($i == "" ? 0 : $i);
            $distribucion->j = ($j == "" ? 0 : $j);
            $distribucion->k = ($k == "" ? 0 : $k);
            $distribucion->l = ($l == "" ? 0 : $l);

            $distribucion->save();
            
            $data = [
                'code' => 200,
                'status' => 'success',
                'distribucion' => $distribucion->load('producto')
            ];
           
        
        }

        return response()->json($data, $data['code']);
    }

    public function checkDistribution(Request $request){
        

        $cliente = $request->input('cliente');
        $producto = $request->input('id');
        $unico = ClienteDistribucion::where('cliente_id', $cliente)
        ->where('producto', $producto)
        ->get()->first();


        if(empty($unico)){  
            $curva_producto = CurvaProducto::where('producto_id', $request->input('id'))->first();

            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'paso',
                'curva' => $curva_producto,
                'a' => str_replace('.00', '', $curva_producto->a),
                'b' => str_replace('.00', '', $curva_producto->b),
                'c' => str_replace('.00', '', $curva_producto->c),
                'd' => str_replace('.00', '', $curva_producto->d),
                'e' => str_replace('.00', '', $curva_producto->e),
                'f' => str_replace('.00', '', $curva_producto->f),
                'g' => str_replace('.00', '', $curva_producto->g),
                'h' => str_replace('.00', '', $curva_producto->h),
                'i' => str_replace('.00', '', $curva_producto->i),
                'j' => str_replace('.00', '', $curva_producto->j),
                'k' => str_replace('.00', '', $curva_producto->k),
                'l' => str_replace('.00', '', $curva_producto->l),
            ];
           
        } else {
            $data = [
                'code' => 200,
                'status' => 'validation',
                'message' => 'No paso'
            ];
           
           
        }
        return response()->json($data, $data['code']);
    }

    public function Select2Producto()
    {
        $productos = Product::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'productos' => $productos
        ];

        return response()->json($data, $data['code']);
    }

    public function distribucionCLiente(Request $request) 
    {
        $id = $request->input('id');

        if(empty($id)){
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'No se envio el cliente'
            ];
        } else {
            $distri = ClienteDistribucion::where('cliente_id', $id)->get()->load('producto');

            for ($i=0 ; $i < count($distri) ; $i++ ) { 
               str_replace('.00', '', $distri[$i]['a']);
               str_replace('.00', '', $distri[$i]['b']);
               str_replace('.00', '', $distri[$i]['c']);
               str_replace('.00', '', $distri[$i]['d']);
               str_replace('.00', '', $distri[$i]['e']);
               str_replace('.00', '', $distri[$i]['f']);
               str_replace('.00', '', $distri[$i]['g']);
               str_replace('.00', '', $distri[$i]['h']);
               str_replace('.00', '', $distri[$i]['i']);
               str_replace('.00', '', $distri[$i]['j']);
               str_replace('.00', '', $distri[$i]['k']);
               str_replace('.00', '', $distri[$i]['l']);
            }

            $data = [
                'code' => 200,
                'status' => 'success',
                'distribucion' => $distri
            ];
        }  

    


        return response()->json($data, $data['code']);
    }

    public function destroyDistribucion($id)
    {
        $distribucion = ClienteDistribucion::find($id);

        if (!empty($distribucion)) {
            $distribucion->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'distribucion' => $distribucion
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

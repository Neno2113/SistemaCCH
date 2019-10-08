<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre_cliente' => 'required',
            'direccion_principal' => 'required',
            'contacto_cliente_principal' => 'required',
            'telefono_1' => 'required',
            'email_principal' => 'required|email',
            'condiciones_credito' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
           
            $nombre_cliente = $request->input('nombre_cliente', true);
            $direccion_principal = $request->input('direccion_principal', true);
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
           

            $cliente = new Client();
            $cliente->nombre_cliente = $nombre_cliente;
            $cliente->direccion_principal = $direccion_principal;
            $cliente->contacto_cliente_principal = $contacto_cliente_principal;
            $cliente->telefono_1 = $telefono_1;
            $cliente->telefono_2 = $telefono_2;
            $cliente->telefono_3 = $telefono_3;
            $cliente->celular_principal = $celular_principal;
            $cliente->email_principal = $email_principal;
            $cliente->condiciones_credito = $condiciones_credito;
            $cliente->autorizacion_credito_req = $autorizaciones_credito_req;
            $cliente->notas = $notas;
            $cliente->redistribucion_tallas = $redistribucion_tallas;
            $cliente->factura_desglosada_talla = $factura_desglosada_talla;

            $cliente->save();

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
            'direccion_principal' => 'required',
            'contacto_cliente_principal' => 'required',
            'telefono_1' => 'required',
            'email_principal' => 'required|email',
            'condiciones_credito' => 'required'
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
            $direccion_principal = $request->input('direccion_principal', true);
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

            

            $client = Client::find($id);
            
            $client->nombre_cliente = $nombre_cliente;
            $client->direccion_principal = $direccion_principal;
            $client->contacto_cliente_principal = $contacto_cliente_principal;
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
           

            $client->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'client' => $client
            ];
        }

        return response()->json($data, $data['code']);
       
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

    public function clients(){
        $clients = Client::query();

        return DataTables::eloquent($clients)
            ->addColumn('Editar', function ($client) {
                return '<button id="btnEdit" onclick="mostrar(' . $client->id . ')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->editColumn('autorizacion_credito_req', function ($client) {
                return ($client->autorizacion_credito_req == 1 ? 'Si' : 'No');
            })
            ->editColumn('redistribucion_tallas', function ($client) {
                return ($client->redistribucion_tallas == 1 ? 'Si' : 'No');
            })
            ->editColumn('factura_desglosada_talla', function ($client) {
                return ($client->factura_desglosada_talla == 1 ? 'Si' : 'No');
            })
            ->addColumn('Eliminar', function ($client) {
                return '<button onclick="eliminar(' . $client->id . ')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);

    }
}

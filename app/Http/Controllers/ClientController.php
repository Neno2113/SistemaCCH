<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

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
}

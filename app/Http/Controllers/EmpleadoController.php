<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;

class EmpleadoController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'telefono_1' => 'required',
            'email' => 'required|email',
            'cargo' => 'required',
            'departamento' => 'required',
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

            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $calle = $request->input('calle', true);
            $sector = $request->input('sector');
            $provincia = $request->input('provincia');
            $sitios_cercanos = $request->input('sitios_cercanos');
            $cedula = $request->input('cedula');
            $cargo = $request->input('cargo');
            $telefono_1 = $request->input('telefono_1');
            $telefono_2 = $request->input('telefono_2');
            $email = $request->input('email');
            $tipo_contrato = $request->input('tipo_contrato');
        


            $empleado = new Empleado();
            $empleado->nombre = $nombre;
            $empleado->apellido = $apellido;
            $empleado->calle = $calle;
            $empleado->sector = $sector;
            $empleado->provincia = $provincia;
            $empleado->sitios_cercanos = $sitios_cercanos;
            $empleado->cedula = $cedula;
            $empleado->cargo = $cargo;
            $empleado->telefono_1 = $telefono_1;
            $empleado->telefono_2 = $telefono_2;
            $empleado->email = $email;
            $empleado->tipo_contrato = $tipo_contrato;
         

            $empleado->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'cliente' => $cliente
            ];
        }

        return response()->json($data, $data['code']);
    }
}

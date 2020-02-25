<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Empleado;
use App\EmpleadoDetalle;

class EmpleadoController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|unique:empleado',
            'telefono_1' => 'required',
            'email' => 'required|email|unique:empleado',
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
            $departamento = $request->input('departamento');
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
            $empleado->departamento = $departamento;
            $empleado->telefono_1 = $telefono_1;
            $empleado->telefono_2 = $telefono_2;
            $empleado->email = $email;
            $empleado->tipo_contrato = $tipo_contrato;


            $empleado->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado' => $empleado
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function storeDetalle(Request $request)
    {

        $validar = $request->validate([
            'id' => 'required|numeric',
            'forma_pago' => 'required',
            'banco_tarjeta_cobro' => 'required',
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $id = $request->input('id');
            $forma_pago = $request->input('forma_pago');
            $sueldo = $request->input('sueldo');
            $valor_hora = $request->input('valor_hora');
            $banco_tarjeta_cobro = $request->input('banco_tarjeta_cobro');
            $no_cuenta = $request->input('no_cuenta');
            $nss = $request->input('nss');
            $casado = $request->input('casado');
            $nombre_esposa = $request->input('nombre_esposa');
            $telefono_esposa = $request->input('telefono_esposa');
            $esposa_seguro = $request->input('esposa_seguro');
            $cantidad_dependientes = $request->input('cantidad_dependientes');
            $nombre_dependiente_1 = $request->input('nombre_dependiente_1');
            $nombre_dependiente_2 = $request->input('nombre_dependiente_2');
            $nombre_dependiente_3 = $request->input('nombre_dependiente_3');
            $nombre_dependiente_4 = $request->input('nombre_dependiente_4');
            $nombre_dependiente_5 = $request->input('nombre_dependiente_5');
            $nombre_dependiente_6 = $request->input('nombre_dependiente_6');
            $nombre_dependiente_7 = $request->input('nombre_dependiente_7');
            $dependiente_1_nss = $request->input('dependiente_1_nss');
            $dependiente_2_nss = $request->input('dependiente_2_nss');
            $dependiente_3_nss = $request->input('dependiente_3_nss');
            $dependiente_4_nss = $request->input('dependiente_4_nss');
            $dependiente_5_nss = $request->input('dependiente_5_nss');
            $dependiente_6_nss = $request->input('dependiente_6_nss');
            $dependiente_7_nss = $request->input('dependiente_7_nss');


            if (preg_match('/_/', $sueldo)) {
                $sueldo = trim($sueldo, "RD$");
            } else {
                $sueldo = trim($sueldo, "RD$");
                $sueldo = str_replace(',', '', $sueldo);
            }

            //actualizar tabla principal
            $empleado = Empleado::find($id);
            $empleado->casado = $casado;
            $empleado->forma_pago = $forma_pago;
            $empleado->sueldo = $sueldo;
            $empleado->valor_hora = trim($valor_hora, "RD$");
            $empleado->banco_tarjeta_cobro = $banco_tarjeta_cobro;
            $empleado->no_cuenta = $no_cuenta;
            $empleado->detallado = 1;
            $empleado->save();


            $empleado_detalle = new EmpleadoDetalle();
            $empleado_detalle->empleado_id = $id;
            $empleado_detalle->nss = $nss;
            $empleado_detalle->nombre_esposa = $nombre_esposa;
            $empleado_detalle->telefono_esposa = $telefono_esposa;
            $empleado_detalle->esposa_en_nss = $esposa_seguro;
            $empleado_detalle->cantidad_dependientes = $cantidad_dependientes;
            $empleado_detalle->nombre_dependiente_1 = $nombre_dependiente_1;
            $empleado_detalle->nombre_dependiente_2 = $nombre_dependiente_2;
            $empleado_detalle->nombre_dependiente_3 = $nombre_dependiente_3;
            $empleado_detalle->nombre_dependiente_4 = $nombre_dependiente_4;
            $empleado_detalle->nombre_dependiente_5 = $nombre_dependiente_5;
            $empleado_detalle->nombre_dependiente_6 = $nombre_dependiente_6;
            $empleado_detalle->nombre_dependiente_7 = $nombre_dependiente_7;
            $empleado_detalle->dependiente_1_nss = $dependiente_1_nss;
            $empleado_detalle->dependiente_2_nss = $dependiente_2_nss;
            $empleado_detalle->dependiente_3_nss = $dependiente_3_nss;
            $empleado_detalle->dependiente_4_nss = $dependiente_4_nss;
            $empleado_detalle->dependiente_5_nss = $dependiente_5_nss;
            $empleado_detalle->dependiente_6_nss = $dependiente_6_nss;
            $empleado_detalle->dependiente_7_nss = $dependiente_7_nss;


            $empleado_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado_detalle' => $empleado_detalle,
                'empleado' => $empleado
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function empleados()
    {
        $empleados = Empleado::query();

        return DataTables::eloquent($empleados)
            ->addColumn('Expandir', function ($empleado) {
                return "";
            })
            ->addColumn('Ver', function ($empleado) {
                return '<button onclick="ver(' . $empleado->id . ')" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></button>';
            })
            ->editColumn('nombre', function ($empleado) {
                return $empleado->nombre." ".$empleado->apellido;
            })
            ->editColumn('cargo', function ($empleado) {
                return substr($empleado->cargo, 0, 20);
            })
            ->addColumn('Opciones', function ($empleado) {
                if($empleado->detallado == 1){
                    return '<button id="btnEdit" onclick="mostrar(' . $empleado->id . ')" class="btn btn-warning btn-sm mr-1 ml-1" ><i class="fas fa-user-edit"></i></button>'.
                    '<button onclick="eliminar(' . $empleado->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
                }else{
                    return '<button id="btnEdit" onclick="show(' . $empleado->id . ')" class="btn btn-primary btn-sm mr-1" ><i class="fas fa-address-card"></i></button>'.
                    '<button id="btnEdit" onclick="mostrar(' . $empleado->id . ')" class="btn btn-warning btn-sm mr-1 ml-1" ><i class="fas fa-user-edit"></i></button>'.
                    '<button onclick="eliminar(' . $empleado->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
                }
            })
            ->rawColumns(['Ver', 'Opciones'])
            ->make(true);
    }


    public function show($id)
    {
        $empleado = Empleado::find($id);

        if (is_object($empleado)) {
            $empleado_detalle = EmpleadoDetalle::where('empleado_id', $id)
            ->get()
            ->first();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado' => $empleado,
                'empleado_detalle' => $empleado_detalle
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
            'id' => 'required|numeric',
            'forma_pago' => 'required',
            'banco_tarjeta_cobro' => 'required',
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
            $id = $request->input('id');
            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $calle = $request->input('calle');
            $sector = $request->input('sector');
            $provincia = $request->input('provincia');
            $sitios_cercanos = $request->input('sitios_cercanos');
            $cedula = $request->input('cedula');
            $cargo = $request->input('cargo');
            $departamento = $request->input('departamento');
            $telefono_1 = $request->input('telefono_1');
            $telefono_2 = $request->input('telefono_2');
            $email = $request->input('email');
            $tipo_contrato = $request->input('tipo_contrato');
            $forma_pago = $request->input('forma_pago');
            $sueldo = $request->input('sueldo');
            $valor_hora = $request->input('valor_hora');
            $banco_tarjeta_cobro = $request->input('banco_tarjeta_cobro');
            $no_cuenta = $request->input('no_cuenta');
            $nss = $request->input('nss');
            $casado = $request->input('casado');
            $nombre_esposa = $request->input('nombre_esposa');
            $telefono_esposa = $request->input('telefono_esposa');
            $esposa_seguro = $request->input('esposa_seguro');
            $cantidad_dependientes = $request->input('cantidad_dependientes');
            $nombre_dependiente_1 = $request->input('nombre_dependiente_1');
            $nombre_dependiente_2 = $request->input('nombre_dependiente_2');
            $nombre_dependiente_3 = $request->input('nombre_dependiente_3');
            $nombre_dependiente_4 = $request->input('nombre_dependiente_4');
            $nombre_dependiente_5 = $request->input('nombre_dependiente_5');
            $nombre_dependiente_6 = $request->input('nombre_dependiente_6');
            $nombre_dependiente_7 = $request->input('nombre_dependiente_7');
            $dependiente_1_nss = $request->input('dependiente_1_nss');
            $dependiente_2_nss = $request->input('dependiente_2_nss');
            $dependiente_3_nss = $request->input('dependiente_3_nss');
            $dependiente_4_nss = $request->input('dependiente_4_nss');
            $dependiente_5_nss = $request->input('dependiente_5_nss');
            $dependiente_6_nss = $request->input('dependiente_6_nss');
            $dependiente_7_nss = $request->input('dependiente_7_nss');

            $empleado = Empleado::find($id);

            if (preg_match('/_/', $sueldo)) {
                $sueldo = trim($sueldo, "RD$");
            } else {
                $sueldo = trim($sueldo, "RD$");
                $sueldo = str_replace(',', '', $sueldo);
            }

            //Actualizar empleado
            $empleado->nombre = $nombre;
            $empleado->apellido = $apellido;
            $empleado->calle = $calle;
            $empleado->sector = $sector;
            $empleado->provincia = $provincia;
            $empleado->sitios_cercanos = $sitios_cercanos;
            $empleado->cedula = $cedula;
            $empleado->cargo = $cargo;
            $empleado->departamento = $departamento;
            $empleado->telefono_1 = $telefono_1;
            $empleado->telefono_2 = $telefono_2;
            $empleado->email = $email;
            $empleado->tipo_contrato = $tipo_contrato;
            $empleado->casado = $casado;
            $empleado->forma_pago = $forma_pago;
            $empleado->sueldo = $sueldo;
            $empleado->valor_hora = trim($valor_hora, "RD$");
            $empleado->banco_tarjeta_cobro = $banco_tarjeta_cobro;
            $empleado->no_cuenta = $no_cuenta;
            $empleado->save();

            //Actualizar detalle
            $empleado_detalle  = EmpleadoDetalle::where('empleado_id', $id)
            ->get()
            ->first();

            $empleado_detalle->nss = $nss;
            $empleado_detalle->nombre_esposa = $nombre_esposa;
            $empleado_detalle->telefono_esposa = $telefono_esposa;
            $empleado_detalle->esposa_en_nss = $esposa_seguro;
            $empleado_detalle->cantidad_dependientes = $cantidad_dependientes;
            $empleado_detalle->nombre_dependiente_1 = $nombre_dependiente_1;
            $empleado_detalle->nombre_dependiente_2 = $nombre_dependiente_2;
            $empleado_detalle->nombre_dependiente_3 = $nombre_dependiente_3;
            $empleado_detalle->nombre_dependiente_4 = $nombre_dependiente_4;
            $empleado_detalle->nombre_dependiente_5 = $nombre_dependiente_5;
            $empleado_detalle->nombre_dependiente_6 = $nombre_dependiente_6;
            $empleado_detalle->nombre_dependiente_7 = $nombre_dependiente_7;
            $empleado_detalle->dependiente_1_nss = $dependiente_1_nss;
            $empleado_detalle->dependiente_2_nss = $dependiente_2_nss;
            $empleado_detalle->dependiente_3_nss = $dependiente_3_nss;
            $empleado_detalle->dependiente_4_nss = $dependiente_4_nss;
            $empleado_detalle->dependiente_5_nss = $dependiente_5_nss;
            $empleado_detalle->dependiente_6_nss = $dependiente_6_nss;
            $empleado_detalle->dependiente_7_nss = $dependiente_7_nss;

            $empleado_detalle->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado' => $empleado,
                'empleado_detalle' => $empleado_detalle
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id)
    {
        $empleado = Empleado::find($id);

        if (!empty($empleado)) {
            $empleado->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado' => $empleado
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

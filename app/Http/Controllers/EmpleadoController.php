<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Empleado;
use App\EmpleadoDetalle;
use App\PermisoUsuario;

//cristobal
use Illuminate\Support\Facades\Hash;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Response;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class EmpleadoController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|unique:empleado',
            'telefono_2' => 'required',
            'email' => 'email|unique:empleado',
        //    'cargo' => 'required',

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
            $calle = $request->input('calle');
            $sector = $request->input('sector');
            $provincia = $request->input('provincia');
            $sitios_cercanos = $request->input('sitios_cercanos');
            $cedula = $request->input('cedula');
            $password = str_replace('-','',$cedula);
            $cedula = $request->input('cedula');
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $telefono_1 = $request->input('telefono_1');
            $telefono_2 = $request->input('telefono_2');
            $email = $request->input('email');
            
            $estado_civil = $request->input('estado_civil');
            $referencia = $request->input('referencia');

            $fecha_ingreso = $request->input('fecha_ingreso');
            $condicion_medica = $request->input('condicion_medica');
            $nombre_esposa = $request->input('nombre_esposa');
            $telefono_esposa = $request->input('telefono_esposa');
            $esposa_asegurada_si = $request->input('esposa_asegurada_si');
            $esposa_asegurada_no = $request->input('esposa_asegurada_no');
            $cantidad_dependientes = $request->input('cantidad_dependientes');

            for ($i=0; $i < $cantidad_dependientes; $i++) { 
                $nombre_dependiente_[$i] = $request->input('nombre_dependiente_'.[$i]);
                $parentesco_dependiente_[$i] = $request->input('parentesco_dependiente_'.[$i]);
                $edad_dependiente_[$i] = $request->input('edad_dependiente_'.[$i]);
            }
            
            $nombre_ref1 = $request->input('nombre_ref1');
            $parentesco_ref1 = $request->input('parentesco_ref1');
            $telefono_ref1 = $request->input('telefono_ref1');
            $nombre_ref2 = $request->input('nombre_ref2');
            $parentesco_ref2 = $request->input('parentesco_ref2');
            $telefono_ref2 = $request->input('telefono_ref2');
            $primaria = $request->input('primaria');
            $bachiller = $request->input('bachiller');
            $nivel_superior = $request->input('nivel_superior');
            $grado_titulo = $request->input('grado_titulo');
            $especialidad = $request->input('especialidad');
            $fecha_exp = $request->input('fecha_exp');
            $cargo_experiencia_1 = $request->input('cargo_experiencia_1');
            $cargo_experiencia_2 = $request->input('cargo_experiencia_2');
            $tiempo_experiencia_1 = $request->input('tiempo_experiencia_1');
            $tiempo_experiencia_2 = $request->input('tiempo_experiencia_2');
            $empresa_experiencia_1 = $request->input('empresa_experiencia_1');
            $empresa_experiencia_2 = $request->input('empresa_experiencia_2');
            $supervisor_experiencia_1 = $request->input('supervisor_experiencia_1');
            $supervisor_experiencia_2 = $request->input('supervisor_experiencia_2');
            $telefono_experiencia_1 = $request->input('telefono_experiencia_1');
            $telefono_experiencia_2 = $request->input('telefono_experiencia_2');
            
            $tipo_contrato = $request->input('tipo_contrato');
            $forma_pago = $request->input('forma_pago');
            $sueldo = $request->input('sueldo');
            $valor_hora = $request->input('valor_hora');
            $banco_tarjeta_cobro = $request->input('banco_tarjeta_cobro');
            $no_cuenta = $request->input('no_cuenta');
            $nss = $request->input('nss');
            
            $codigo = $request->input('codigo');
            $cargo = $request->input('cargo');
            $departamento = $request->input('departamento');

            $pwd = Hash::make($password);

            $user = new User();
            $user->name = $nombre;
            $user->surname = $apellido;
            $user->email = $email;
            $user->password = $pwd;
            $user->codigo = $codigo;
            $user->role = $departamento;
            $user->telefono = $telefono_1;
            $user->celular = $telefono_2;
            $user->direccion = $calle;
            $user->fecha_nacimiento = $fecha_nacimiento;
            $user->first_login = 1;
            $user->avatar = $avatar;

            $user->save();
            $user_id = $user->id;

            $empleado = new Empleado();
            $empleado->user_id = $user_id;
            $empleado->nombre = $nombre;
            $empleado->apellido = $apellido;
            $empleado->codigo = $codigo;
            $empleado->calle = $calle;
            $empleado->sector = $sector;
            $empleado->provincia = $provincia;
            $empleado->sitios_cercanos = $sitios_cercanos;
            $empleado->telefono_1 = $telefono_1;
            $empleado->telefono_2 = $telefono_2;
            $empleado->email = $email;
            $empleado->cedula = $cedula;
            $empleado->fecha_nacimiento = $fecha_nacimiento;
            $empleado->departamento = $departamento;
            $empleado->estado_civil = $estado_civil;
            $empleado->cargo = $cargo;
            $empleado->fecha_contratacion = $fecha_ingreso;
            $empleado->tipo_contrato = $tipo_contrato;
            $empleado->forma_pago = $forma_pago;
            $empleado->sueldo = $sueldo;
            $empleado->valor_hora = $valor_hora;
            $empleado->banco_tarjeta_cobro = $banco_tarjeta_cobro;
            $empleado->no_cuenta = $no_cuenta;
            $empleado->nss = $nss;
            $empleado->cantidad_dependientes = $cantidad_dependientes;
            $empleado->condicion_medica = $condicion_medica;

            $empleado->save();
        

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user,
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
        
            ->editColumn('nombre', function ($empleado) {
                return $empleado->nombre." ".$empleado->apellido;
            })
            ->editColumn('cargo', function ($empleado) {
                return substr($empleado->cargo, 0, 20);
            })
            ->editColumn('fecha_nacimiento', function ($user){
                $bDay = new DateTime($user->fecha_nacimiento);
                $today = new DateTime(date('m.d.y'));
                $diff = $today->diff($bDay);
                return $diff->y;
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
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Empleados')
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
            $fecha_nacimiento = $request->input('fecha_nacimiento');
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
            $empleado->fecha_nacimiento = $fecha_nacimiento;
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

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Empleados')
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

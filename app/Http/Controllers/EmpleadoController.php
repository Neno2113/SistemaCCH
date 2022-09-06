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

use App\Factura;
use Illuminate\Support\Facades\DB;
use PDF;
//use Validator,Redirect,Response,File;

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
            'celular' => 'required',
            'fecha_nacimiento' => 'after:1950-01-01'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $nombre = strtoupper($request->input('nombre'));
            $apellido = strtoupper($request->input('apellido'));
            $calle = strtoupper($request->input('calle'));
            $sector = strtoupper($request->input('sector'));
            $provincia = strtoupper($request->input('provincia'));
            $sitios_cercanos = strtoupper($request->input('sitios_cercanos'));
            $cedula = $request->input('cedula');
            $cedula_sin_guion = $request->input('cedula_sin_guion');
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $telefono_1 = $request->input('telefono_1');
            $celular = $request->input('celular');
            $email = strtoupper($request->input('email'));
            $avatar = $request->input('avatar');
            
            $estado_civil = $request->input('estado_civil');
            $referencia = strtoupper($request->input('referencia'));

            $fecha_ingreso = $request->input('fecha_ingreso');
            $condicion_medica = strtoupper($request->input('condicion_medica'));
            $nombre_esposa = strtoupper($request->input('nombre_esposa'));
            $telefono_esposa = $request->input('telefono_esposa');
            $esposa_en_nss = $request->input('esposa_en_nss');

            $cantidad_dependientes = $request->input('cantidad_dependientes');         

            $nombre_dependiente_0 = strtoupper($request->input('nombre_dependiente_0'));
            $parentesco_dependiente_0 = strtoupper($request->input('parentesco_dependiente_0'));
            $edad_dependiente_0 = $request->input('edad_dependiente_0');
            $nombre_dependiente_1 = strtoupper($request->input('nombre_dependiente_1'));
            $parentesco_dependiente_1 = strtoupper($request->input('parentesco_dependiente_1'));
            $edad_dependiente_1 = $request->input('edad_dependiente_1');
            $nombre_dependiente_2 = strtoupper($request->input('nombre_dependiente_2'));
            $parentesco_dependiente_2 = strtoupper($request->input('parentesco_dependiente_2'));
            $edad_dependiente_2 = $request->input('edad_dependiente_2');
            $nombre_dependiente_3 = strtoupper($request->input('nombre_dependiente_3'));
            $parentesco_dependiente_3 = strtoupper($request->input('parentesco_dependiente_3'));
            $edad_dependiente_3 = $request->input('edad_dependiente_3');
            $nombre_dependiente_4 = strtoupper($request->input('nombre_dependiente_4'));
            $parentesco_dependiente_4 = strtoupper($request->input('parentesco_dependiente_4'));
            $edad_dependiente_4 = $request->input('edad_dependiente_4');
            $nombre_dependiente_5 = strtoupper($request->input('nombre_dependiente_5'));
            $parentesco_dependiente_5 = strtoupper($request->input('parentesco_dependiente_5'));
            $edad_dependiente_5 = $request->input('edad_dependiente_5');
            $nombre_dependiente_6 = strtoupper($request->input('nombre_dependiente_6'));
            $parentesco_dependiente_6 = strtoupper($request->input('parentesco_dependiente_6'));
            $edad_dependiente_6 = $request->input('edad_dependiente_6');

            $nombre_ref1 = strtoupper($request->input('nombre_ref1'));
            $parentesco_ref1 = strtoupper($request->input('parentesco_ref1'));
            $telefono_ref1 = $request->input('telefono_ref1');
            $nombre_ref2 = strtoupper($request->input('nombre_ref2'));
            $parentesco_ref2 = strtoupper($request->input('parentesco_ref2'));
            $telefono_ref2 = $request->input('telefono_ref2');
            $primaria = strtoupper($request->input('primaria'));
            $bachiller = strtoupper($request->input('bachiller'));
            $nivel_superior = strtoupper($request->input('nivel_superior'));
            $grado_titulo = strtoupper($request->input('grado_titulo'));
            $especialidad = strtoupper($request->input('especialidad'));
            $fecha_exp = $request->input('fecha_exp');
            $cargo_experiencia_1 = strtoupper($request->input('cargo_experiencia_1'));
            $cargo_experiencia_2 = strtoupper($request->input('cargo_experiencia_2'));
            $tiempo_experiencia_1 = strtoupper($request->input('tiempo_experiencia_1'));
            $tiempo_experiencia_2 = strtoupper($request->input('tiempo_experiencia_2'));
            $empresa_experiencia_1 = strtoupper($request->input('empresa_experiencia_1'));
            $empresa_experiencia_2 = strtoupper($request->input('empresa_experiencia_2'));
            $supervisor_experiencia_1 = strtoupper($request->input('supervisor_experiencia_1'));
            $supervisor_experiencia_2 = strtoupper($request->input('supervisor_experiencia_2'));
            $telefono_experiencia_1 = $request->input('telefono_experiencia_1');
            $telefono_experiencia_2 = $request->input('telefono_experiencia_2');
            
            $tipo_contrato = $request->input('tipo_contrato');
            $forma_pago = strtoupper($request->input('forma_pago'));
            $sueldo = $request->input('sueldo');
            $valor_hora = $request->input('valor_hora');
            $banco_tarjeta_cobro = $request->input('banco_tarjeta_cobro');
            $no_cuenta = $request->input('no_cuenta');
            $nss = $request->input('nss');
            
            $codigo = $request->input('codigo');
            $cargo = $request->input('cargo');
            $departamento = strtoupper($request->input('departamento'));

            $pwd = Hash::make($cedula_sin_guion);

            $user = new User();
            $user->name = $nombre;
            $user->surname = $apellido;
            $user->email = $email;
            $user->password = $pwd;
            $user->codigo = $codigo;
            $user->role = $departamento;
            $user->telefono = $telefono_1;
            $user->celular = $celular;
            $user->direccion = $calle;
            $user->fecha_nacimiento = $fecha_nacimiento;
            $user->first_login = '1';
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
            $empleado->celular = $celular;
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
            
            $empleado->condicion_medica = $condicion_medica;

            $empleado->save();
            $empleado_id = $empleado->id;

            $empleado_detalle = new EmpleadoDetalle();
            $empleado_detalle->empleado_id = $empleado_id;
            $empleado_detalle->user_id = $user_id;
            $empleado_detalle->cantidad_dependientes = $cantidad_dependientes;
            $empleado_detalle->nombre_esposa = $nombre_esposa;
            $empleado_detalle->telefono_esposa = $telefono_esposa;
            $empleado_detalle->esposa_en_nss = $esposa_en_nss;
            
            $empleado_detalle->nombre_dependiente_0 = $nombre_dependiente_0;
            $empleado_detalle->parentesco_dependiente_0 = $parentesco_dependiente_0;
            $empleado_detalle->edad_dependiente_0 = $edad_dependiente_0;
            $empleado_detalle->nombre_dependiente_1 = $nombre_dependiente_1;
            $empleado_detalle->parentesco_dependiente_1 = $parentesco_dependiente_1;
            $empleado_detalle->edad_dependiente_1 = $edad_dependiente_1;
            $empleado_detalle->nombre_dependiente_2 = $nombre_dependiente_2;
            $empleado_detalle->parentesco_dependiente_2 = $parentesco_dependiente_2;
            $empleado_detalle->edad_dependiente_2 = $edad_dependiente_2;
            $empleado_detalle->nombre_dependiente_3 = $nombre_dependiente_3;
            $empleado_detalle->parentesco_dependiente_3 = $parentesco_dependiente_3;
            $empleado_detalle->edad_dependiente_3 = $edad_dependiente_3;
            $empleado_detalle->nombre_dependiente_4 = $nombre_dependiente_4;
            $empleado_detalle->parentesco_dependiente_4 = $parentesco_dependiente_4;
            $empleado_detalle->edad_dependiente_4 = $edad_dependiente_4;
            $empleado_detalle->nombre_dependiente_5 = $nombre_dependiente_5;
            $empleado_detalle->parentesco_dependiente_5 = $parentesco_dependiente_5;
            $empleado_detalle->edad_dependiente_5 = $edad_dependiente_5;
            $empleado_detalle->nombre_dependiente_6 = $nombre_dependiente_6;
            $empleado_detalle->parentesco_dependiente_6 = $parentesco_dependiente_6;
            $empleado_detalle->edad_dependiente_6 = $edad_dependiente_6;
           
            $empleado_detalle->nombre_ref1 = $nombre_ref1;
            $empleado_detalle->parentesco_ref1 = $parentesco_ref1;
            $empleado_detalle->telefono_ref1 = $telefono_ref1;
            $empleado_detalle->nombre_ref2 = $nombre_ref2;
            $empleado_detalle->parentesco_ref2 = $parentesco_ref2;
            $empleado_detalle->telefono_ref2 = $telefono_ref2;
            $empleado_detalle->primaria = $primaria;
            $empleado_detalle->bachiller = $bachiller;
            $empleado_detalle->nivel_superior = $nivel_superior;
            $empleado_detalle->grado_titulo = $grado_titulo;
            $empleado_detalle->especialidad = $especialidad;
            $empleado_detalle->fecha_exp = $fecha_exp;
            $empleado_detalle->cargo_experiencia_1 = $cargo_experiencia_1;
            $empleado_detalle->tiempo_experiencia_1 = $tiempo_experiencia_1;
            $empleado_detalle->empresa_experiencia_1 = $empresa_experiencia_1;
            $empleado_detalle->supervisor_experiencia_1 = $supervisor_experiencia_1;
            $empleado_detalle->telefono_experiencia_1 = $telefono_experiencia_1;
            $empleado_detalle->cargo_experiencia_2  = $cargo_experiencia_2;
            $empleado_detalle->tiempo_experiencia_2 = $tiempo_experiencia_2;
            $empleado_detalle->empresa_experiencia_2 = $empresa_experiencia_2;
            $empleado_detalle->supervisor_experiencia_2 = $supervisor_experiencia_2;
            $empleado_detalle->telefono_experiencia_2 = $telefono_experiencia_2;
            
            $empleado_detalle->save();
        

            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $user,
                'empleado' => $empleado,
                'empleado_detalle' => $empleado_detalle
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
                return substr($empleado->nombre, 0, 10)." ".substr($empleado->apellido, 0, 9);
            })
            /*
            ->editColumn('cargo', function ($empleado) {
                return substr($empleado->cargo, 0, 20);
            }) */
            ->editColumn('tiempo_laborando', function ($empleado){
                $bDay = new DateTime($empleado->fecha_contratacion);
                $today = new DateTime(date('y.m.d'));
                $diff = $today->diff($bDay);
                $days = $diff->format('%a Días');
                return $days;
             })
            ->addColumn('Opciones', function ($empleado) {
            /*    if($empleado->detallado == 1){ 
                    return '<button id="btnEdit" onclick="mostrar(' . $empleado->id . ')" class="btn btn-warning btn-sm mr-1 ml-1" ><i class="fas fa-user-edit"></i></button>';
                //    '<button onclick="eliminar(' . $empleado->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
                 }else{ */
                //    return '<button id="btnEdit" onclick="show(' . $empleado->id . ')" class="btn btn-primary btn-sm mr-1" ><i class="fas fa-address-card"></i></button>'.
                    return '<a href="imprimir_empleado/empleado/' . $empleado->id . '" class="btn btn-primary btn-sm ml-1"> <i class="fas fa-print"></i></a>'.
                    '<button id="btnEdit" onclick="mostrar(' . $empleado->id . ')" class="btn btn-warning btn-sm mr-1 ml-1" ><i class="fas fa-user-edit"></i></button>';
                //    '<button onclick="eliminar(' . $empleado->id . ')" class="btn btn-danger btn-sm ml-1"> <i class="fas fa-eraser"></i></button>';
           //      } 
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

            $user_id = $empleado_detalle->user_id;
            $user = User::where('id', $user_id)
            ->get()
            ->first();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado' => $empleado,
                'empleado_detalle' => $empleado_detalle,
                'user' => $user
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

    public function upload(Request $request)
    {
        //validar la imagen
        $validate = \Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpg,jpeg,png',

        ]);
        // Guardar la imagen
        if ($validate->fails()) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => $validate->errors()
            ];
        } else {
            $avatar = $request->file('avatar');
            $image_name_1 = time() . $avatar->getClientOriginalName();
            // echo $id;
            // die();


            if (!empty($avatar)) {
            \Storage::disk('avatar')->put($image_name_1, \File::get($avatar));
            } else {
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'WTF'
                ];
            }


            $data = [
                'code' => 200,
                'status' => 'success',
                'avatar' =>$image_name_1
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function update(Request $request)
    {
        $validar = $request->validate([
            'id' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'fecha_nacimiento' => 'after:1950-01-01'
        
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {

            $id = $request->input('id');
            $nombre = strtoupper($request->input('nombre'));   
                  
            $apellido = strtoupper($request->input('apellido'));
            $calle = strtoupper($request->input('calle'));
            $sector = strtoupper($request->input('sector'));
            $provincia = strtoupper($request->input('provincia'));
            $sitios_cercanos = strtoupper($request->input('sitios_cercanos'));
            $cedula = $request->input('cedula');
            $cedula_sin_guion = $request->input('cedula_sin_guion');
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $telefono_1 = $request->input('telefono_1');
            $celular = $request->input('celular');
            $email = strtoupper($request->input('email'));
            $avatar = $request->input('avatar');
            
            $estado_civil = $request->input('estado_civil');
            $referencia = strtoupper($request->input('referencia'));

            $fecha_ingreso = $request->input('fecha_ingreso');
            $condicion_medica = strtoupper($request->input('condicion_medica'));
            $nombre_esposa = strtoupper($request->input('nombre_esposa'));
            $telefono_esposa = $request->input('telefono_esposa');
            $esposa_en_nss = $request->input('esposa_en_nss');

            $cantidad_dependientes = $request->input('cantidad_dependientes');         

            $nombre_dependiente_0 = strtoupper($request->input('nombre_dependiente_0'));
            $parentesco_dependiente_0 = strtoupper($request->input('parentesco_dependiente_0'));
            $edad_dependiente_0 = $request->input('edad_dependiente_0');
            $nombre_dependiente_1 = strtoupper($request->input('nombre_dependiente_1'));
            $parentesco_dependiente_1 = strtoupper($request->input('parentesco_dependiente_1'));
            $edad_dependiente_1 = $request->input('edad_dependiente_1');
            $nombre_dependiente_2 = strtoupper($request->input('nombre_dependiente_2'));
            $parentesco_dependiente_2 = strtoupper($request->input('parentesco_dependiente_2'));
            $edad_dependiente_2 = $request->input('edad_dependiente_2');
            $nombre_dependiente_3 = strtoupper($request->input('nombre_dependiente_3'));
            $parentesco_dependiente_3 = strtoupper($request->input('parentesco_dependiente_3'));
            $edad_dependiente_3 = $request->input('edad_dependiente_3');
            $nombre_dependiente_4 = strtoupper($request->input('nombre_dependiente_4'));
            $parentesco_dependiente_4 = strtoupper($request->input('parentesco_dependiente_4'));
            $edad_dependiente_4 = $request->input('edad_dependiente_4');
            $nombre_dependiente_5 = strtoupper($request->input('nombre_dependiente_5'));
            $parentesco_dependiente_5 = strtoupper($request->input('parentesco_dependiente_5'));
            $edad_dependiente_5 = $request->input('edad_dependiente_5');
            $nombre_dependiente_6 = strtoupper($request->input('nombre_dependiente_6'));
            $parentesco_dependiente_6 = strtoupper($request->input('parentesco_dependiente_6'));
            $edad_dependiente_6 = $request->input('edad_dependiente_6');

            $nombre_ref1 = strtoupper($request->input('nombre_ref1'));
            $parentesco_ref1 = strtoupper($request->input('parentesco_ref1'));
            $telefono_ref1 = $request->input('telefono_ref1');
            $nombre_ref2 = strtoupper($request->input('nombre_ref2'));
            $parentesco_ref2 = strtoupper($request->input('parentesco_ref2'));
            $telefono_ref2 = $request->input('telefono_ref2');
            $primaria = strtoupper($request->input('primaria'));
            $bachiller = strtoupper($request->input('bachiller'));
            $nivel_superior = strtoupper($request->input('nivel_superior'));
            $grado_titulo = strtoupper($request->input('grado_titulo'));
            $especialidad = strtoupper($request->input('especialidad'));
            $fecha_exp = $request->input('fecha_exp');
            $cargo_experiencia_1 = strtoupper($request->input('cargo_experiencia_1'));
            $cargo_experiencia_2 = strtoupper($request->input('cargo_experiencia_2'));
            $tiempo_experiencia_1 = strtoupper($request->input('tiempo_experiencia_1'));
            $tiempo_experiencia_2 = strtoupper($request->input('tiempo_experiencia_2'));
            $empresa_experiencia_1 = strtoupper($request->input('empresa_experiencia_1'));
            $empresa_experiencia_2 = strtoupper($request->input('empresa_experiencia_2'));
            $supervisor_experiencia_1 = strtoupper($request->input('supervisor_experiencia_1'));
            $supervisor_experiencia_2 = strtoupper($request->input('supervisor_experiencia_2'));
            $telefono_experiencia_1 = $request->input('telefono_experiencia_1');
            $telefono_experiencia_2 = $request->input('telefono_experiencia_2');
            
            $tipo_contrato = $request->input('tipo_contrato');
            $forma_pago = strtoupper($request->input('forma_pago'));
            $sueldo = $request->input('sueldo');
            $valor_hora = $request->input('valor_hora');
            $banco_tarjeta_cobro = strtoupper($request->input('banco_tarjeta_cobro'));
            $no_cuenta = $request->input('no_cuenta');
            $nss = $request->input('nss');
            
            $codigo = $request->input('codigo');
            $cargo = $request->input('cargo');
            $departamento = strtoupper($request->input('departamento'));
            

            $empleado = Empleado::find($id);

            /*
            if (preg_match('/_/', $sueldo)) {
                $sueldo = trim($sueldo, "RD$");
            } else {
                $sueldo = trim($sueldo, "RD$");
                $sueldo = str_replace(',', '', $sueldo);
            }
            */

            //Actualizar empleado
            $empleado->nombre = $nombre;
            
            $empleado->apellido = $apellido;
            $empleado->codigo = $codigo;
            $empleado->calle = $calle;
            $empleado->sector = $sector;
            $empleado->provincia = $provincia;
            $empleado->sitios_cercanos = $sitios_cercanos;
            $empleado->telefono_1 = $telefono_1;
            $empleado->celular = $celular;
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
            $empleado->condicion_medica = $condicion_medica;
            
            $empleado->save();

            //Actualizar detalle
            $empleado_detalle  = EmpleadoDetalle::where('empleado_id', $id)
            ->get()
            ->first();

            $empleado_detalle->cantidad_dependientes = $cantidad_dependientes;
            $empleado_detalle->nombre_esposa = $nombre_esposa;
            $empleado_detalle->telefono_esposa = $telefono_esposa;
            $empleado_detalle->esposa_en_nss = $esposa_en_nss;
            
            $empleado_detalle->nombre_dependiente_0 = $nombre_dependiente_0;
            $empleado_detalle->parentesco_dependiente_0 = $parentesco_dependiente_0;
            $empleado_detalle->edad_dependiente_0 = $edad_dependiente_0;
            $empleado_detalle->nombre_dependiente_1 = $nombre_dependiente_1;
            $empleado_detalle->parentesco_dependiente_1 = $parentesco_dependiente_1;
            $empleado_detalle->edad_dependiente_1 = $edad_dependiente_1;
            $empleado_detalle->nombre_dependiente_2 = $nombre_dependiente_2;
            $empleado_detalle->parentesco_dependiente_2 = $parentesco_dependiente_2;
            $empleado_detalle->edad_dependiente_2 = $edad_dependiente_2;
            $empleado_detalle->nombre_dependiente_3 = $nombre_dependiente_3;
            $empleado_detalle->parentesco_dependiente_3 = $parentesco_dependiente_3;
            $empleado_detalle->edad_dependiente_3 = $edad_dependiente_3;
            $empleado_detalle->nombre_dependiente_4 = $nombre_dependiente_4;
            $empleado_detalle->parentesco_dependiente_4 = $parentesco_dependiente_4;
            $empleado_detalle->edad_dependiente_4 = $edad_dependiente_4;
            $empleado_detalle->nombre_dependiente_5 = $nombre_dependiente_5;
            $empleado_detalle->parentesco_dependiente_5 = $parentesco_dependiente_5;
            $empleado_detalle->edad_dependiente_5 = $edad_dependiente_5;
            $empleado_detalle->nombre_dependiente_6 = $nombre_dependiente_6;
            $empleado_detalle->parentesco_dependiente_6 = $parentesco_dependiente_6;
            $empleado_detalle->edad_dependiente_6 = $edad_dependiente_6;
           
            $empleado_detalle->nombre_ref1 = $nombre_ref1;
            $empleado_detalle->parentesco_ref1 = $parentesco_ref1;
            $empleado_detalle->telefono_ref1 = $telefono_ref1;
            $empleado_detalle->nombre_ref2 = $nombre_ref2;
            $empleado_detalle->parentesco_ref2 = $parentesco_ref2;
            $empleado_detalle->telefono_ref2 = $telefono_ref2;
            $empleado_detalle->primaria = $primaria;
            $empleado_detalle->bachiller = $bachiller;
            $empleado_detalle->nivel_superior = $nivel_superior;
            $empleado_detalle->grado_titulo = $grado_titulo;
            $empleado_detalle->especialidad = $especialidad;
            $empleado_detalle->fecha_exp = $fecha_exp;
            $empleado_detalle->cargo_experiencia_1 = $cargo_experiencia_1;
            $empleado_detalle->tiempo_experiencia_1 = $tiempo_experiencia_1;
            $empleado_detalle->empresa_experiencia_1 = $empresa_experiencia_1;
            $empleado_detalle->supervisor_experiencia_1 = $supervisor_experiencia_1;
            $empleado_detalle->telefono_experiencia_1 = $telefono_experiencia_1;
            $empleado_detalle->cargo_experiencia_2  = $cargo_experiencia_2;
            $empleado_detalle->tiempo_experiencia_2 = $tiempo_experiencia_2;
            $empleado_detalle->empresa_experiencia_2 = $empresa_experiencia_2;
            $empleado_detalle->supervisor_experiencia_2 = $supervisor_experiencia_2;
            $empleado_detalle->telefono_experiencia_2 = $telefono_experiencia_2;

            $empleado_detalle->save();

            //Actualizar usuario
            $user_id = $empleado_detalle->user_id;
            $user = User::where('id', $user_id)
            ->get()
            ->first();
            
            $user->name = $nombre;
            $user->surname = $apellido;
            $user->email = $email;
            $user->avatar = $avatar;
//            $user->password = $pwd;
            $user->codigo = $codigo;
            $user->role = $departamento;
            $user->telefono = $telefono_1;
            $user->celular = $celular;
            $user->direccion = $calle;
            $user->fecha_nacimiento = $fecha_nacimiento;
            $user->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'empleado' => $empleado,
                'empleado_detalle' => $empleado_detalle,
                'user' => $user
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

    public function imprimir($id)
    {
        //orden normal
        $empleado = Empleado::find($id);
        $nombre = $empleado->nombre;
        $apellido = $empleado->apellido;
        $codigo = $empleado->codigo; 
        $calle = $empleado->calle;
        $sector = $empleado->sector;
        $provincia = $empleado->provincia;
        $sitios_cercanos = $empleado->sitios_cercanos;
        $telefono_1 = $empleado->telefono_1;
        $celular = $empleado->celular;
        $email = $empleado->email;
        $cedula = $empleado->cedula;
        $fecha_nacimiento =$empleado->fecha_nacimiento;
        $departamento = $empleado->departamento;
        $estado_civil = $empleado->estado_civil;
        $cargo = $empleado->cargo;
        $fecha_ingreso = $empleado->fecha_contratacion;
        $tipo_contrato = $empleado->tipo_contrato;
        $forma_pago = $empleado->forma_pago;
        $sueldo = $empleado->sueldo;
        $valor_hora = $empleado->valor_hora;
        $banco_tarjeta_cobro = $empleado->banco_tarjeta_cobro;
        $no_cuenta = $empleado->no_cuenta;
        $nss = $empleado->nss;
        $condicion_medica = $empleado->condicion_medica;
        $fecha_termino_contrato = $empleado->fecha_termino_contrato;

        $empleado_detalle  = EmpleadoDetalle::where('empleado_id', $id)
        ->get()
        ->first();
        $user_id = $empleado_detalle->user_id;

        $user = User::where('id', $user_id)
        ->get()
        ->first();
        $avatar = $user->avatar;

        $nombre_esposa = $empleado_detalle->nombre_esposa;
        $telefono_esposa = $empleado_detalle->telefono_esposa;
        $esposa_en_nss = $empleado_detalle->esposa_en_nss;
        $cantidad_dependientes = $empleado_detalle->cantidad_dependientes;
        $nombre_dependiente_0 = $empleado_detalle->nombre_dependiente_0;
        $parentesco_dependiente_0 = $empleado_detalle->parentesco_dependiente_0;
        $edad_dependiente_0 = $empleado_detalle->edad_dependiente_0;
        $nombre_dependiente_1 = $empleado_detalle->nombre_dependiente_1;
        $parentesco_dependiente_1 = $empleado_detalle->parentesco_dependiente_1;
        $edad_dependiente_1 = $empleado_detalle->edad_dependiente_1;
        $nombre_dependiente_2 = $empleado_detalle->nombre_dependiente_2;
        $parentesco_dependiente_2 = $empleado_detalle->parentesco_dependiente_2;
        $edad_dependiente_2 = $empleado_detalle->edad_dependiente_2;
        $nombre_dependiente_3 = $empleado_detalle->nombre_dependiente_3;
        $parentesco_dependiente_3 = $empleado_detalle->parentesco_dependiente_3;
        $edad_dependiente_3 = $empleado_detalle->edad_dependiente_3;
        $nombre_dependiente_4 = $empleado_detalle->nombre_dependiente_4;
        $parentesco_dependiente_4 = $empleado_detalle->parentesco_dependiente_4;
        $edad_dependiente_4 = $empleado_detalle->edad_dependiente_4;
        $nombre_dependiente_5 = $empleado_detalle->nombre_dependiente_5;
        $parentesco_dependiente_5 = $empleado_detalle->parentesco_dependiente_5;
        $edad_dependiente_5 = $empleado_detalle->edad_dependiente_5;
        $nombre_dependiente_6 = $empleado_detalle->nombre_dependiente_6;
        $parentesco_dependiente_6 = $empleado_detalle->parentesco_dependiente_6;
        $edad_dependiente_6 = $empleado_detalle->edad_dependiente_6;
    
        $nombre_ref1 = $empleado_detalle->nombre_ref1;
        $parentesco_ref1 = $empleado_detalle->parentesco_ref1;
        $telefono_ref1 = $empleado_detalle->telefono_ref1;
        $nombre_ref2 = $empleado_detalle->nombre_ref2;
        $parentesco_ref2 = $empleado_detalle->parentesco_ref2;
        $telefono_ref2 = $empleado_detalle->telefono_ref2;

        $cargo_experiencia_1 = $empleado_detalle->cargo_experiencia_1;
        $tiempo_experiencia_1 = $empleado_detalle->tiempo_experiencia_1;
        $empresa_experiencia_1 = $empleado_detalle->empresa_experiencia_1;
        $supervisor_experiencia_1 = $empleado_detalle->supervisor_experiencia_1;
        $telefono_experiencia_1 = $empleado_detalle->telefono_experiencia_1;
        $cargo_experiencia_2 = $empleado_detalle->cargo_experiencia_2;
        $tiempo_experiencia_2 = $empleado_detalle->tiempo_experiencia_2;
        $empresa_experiencia_2 = $empleado_detalle->empresa_experiencia_2;
        $supervisor_experiencia_2 = $empleado_detalle->supervisor_experiencia_2;
        $telefono_experiencia_2 = $empleado_detalle->telefono_experiencia_2;

        $primaria = $empleado_detalle->primaria;
        $bachiller = $empleado_detalle->bachiller;
        $nivel_superior = $empleado_detalle->nivel_superior;
        $grado_titulo = $empleado_detalle->grado_titulo;
        $especialidad = $empleado_detalle->especialidad;
        $fecha_exp = $empleado_detalle->fecha_exp;

        $data = ['nombre' => $nombre, 'apellido' => $apellido, 'codigo' => $codigo, 'calle' => $calle, 'sector' => $sector, 'provincia' => $provincia, 'sitios_cercanos' => $sitios_cercanos, 'telefono_1' => $telefono_1, 'celular' => $celular, 'email' => $email, 'cedula' => $cedula,
        'estado_civil' => $estado_civil, 'departamento' => $departamento, 'fecha_nacimiento' => $fecha_nacimiento, 'fecha_ingreso' => $fecha_ingreso, 'cargo' => $cargo, 'tipo_contrato' => $tipo_contrato, 'nss' => $nss, 'forma_pago' => $forma_pago, 'nombre_ref1' => $nombre_ref1, 
        'parentesco_ref1' => $parentesco_ref1, 'telefono_ref1' => $telefono_ref1, 'nombre_ref2' => $nombre_ref2, 'parentesco_ref2' => $parentesco_ref2, 'telefono_ref2' => $telefono_ref2, 'telefono_ref2' => $telefono_ref2, 'nombre_esposa' => $nombre_esposa, 
        'telefono_esposa' => $telefono_esposa, 'esposa_en_nss' => $esposa_en_nss, 'cantidad_dependientes' => $cantidad_dependientes, 'nombre_dependiente_0' => $nombre_dependiente_0, 'parentesco_dependiente_0' => $parentesco_dependiente_0, 'edad_dependiente_0' => $edad_dependiente_0,
        'nombre_dependiente_1' => $nombre_dependiente_1, 'parentesco_dependiente_1' => $parentesco_dependiente_1, 'edad_dependiente_1' => $edad_dependiente_1, 'nombre_dependiente_2' => $nombre_dependiente_2, 'parentesco_dependiente_2' => $parentesco_dependiente_2, 
        'edad_dependiente_2' => $edad_dependiente_2, 'nombre_dependiente_3' => $nombre_dependiente_3, 'parentesco_dependiente_3' => $parentesco_dependiente_3, 'edad_dependiente_3' => $edad_dependiente_3, 'nombre_dependiente_4' => $nombre_dependiente_4, 
        'parentesco_dependiente_4' => $parentesco_dependiente_4, 'edad_dependiente_4' => $edad_dependiente_4, 'nombre_dependiente_5' => $nombre_dependiente_5, 'parentesco_dependiente_5' => $parentesco_dependiente_5, 'edad_dependiente_5' => $edad_dependiente_5,
        'nombre_dependiente_6' => $nombre_dependiente_6, 'parentesco_dependiente_6' => $parentesco_dependiente_6, 'edad_dependiente_6' => $edad_dependiente_6, 'condicion_medica' => $condicion_medica, 'cargo_experiencia_1' => $cargo_experiencia_1, 
        'tiempo_experiencia_1' => $tiempo_experiencia_1, 'empresa_experiencia_1' => $empresa_experiencia_1, 'supervisor_experiencia_1' => $supervisor_experiencia_1, 'telefono_experiencia_1' => $telefono_experiencia_1, 'cargo_experiencia_2' => $cargo_experiencia_2, 
        'tiempo_experiencia_2' => $tiempo_experiencia_2, 'empresa_experiencia_2' => $empresa_experiencia_2, 'supervisor_experiencia_2' => $supervisor_experiencia_2, 'telefono_experiencia_2' => $telefono_experiencia_2, 'primaria' => $primaria, 'bachiller' => $bachiller,
        'nivel_superior' => $nivel_superior, 'grado_titulo' => $grado_titulo, 'especialidad' => $especialidad, 'fecha_exp' => $fecha_exp, 'cargo' => $cargo, 'tipo_contrato' => $tipo_contrato, 'forma_pago' => $forma_pago, 'sueldo' => $sueldo, 'valor_hora' => $valor_hora,
        'banco_tarjeta_cobro' => $banco_tarjeta_cobro, 'no_cuenta' => $no_cuenta, 'fecha_termino_contrato' => $fecha_termino_contrato, 'avatar' => 'src="avatar/'.$avatar.'"'
    ];
    //    $pdf = PDF::loadView('sistema.empleado.empleadoImpresion', compact('data'));
        $pdf = PDF::loadView('sistema.empleado.empleadoImpresion', $data);
  
    //    return $pdf->download('prueba.pdf');
        return $pdf->stream('Empleado-'.$nombre.'-'.$apellido.'.pdf');
    //    return View('sistema.empleado.empleadoImpresion', $data);
        
    }

}


    

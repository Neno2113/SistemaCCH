<?php

namespace App\Http\Controllers;

use App\PermisoUsuario;
use Illuminate\Http\Request;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required|unique:suplidor',
        //    'rnc' => 'required',
            'codigo_suplidor' => 'required',
            'calle' => 'required',
            'pais' => 'required'
        //    'contacto_suplidor' => 'required',
        //    'telefono_1' => 'required',
        //    'email' => 'required|email',
        //    'terminos_de_pago' => 'required',
        //    'tipo_suplidor' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $nombre = $request->input('nombre', true);
            /////////////////////////////////////
            $espAbrev = substr_count($nombre, ' ');

            if ($espAbrev = 1){

                $palabras = explode(" ", $nombre);
                $abreviacion = substr($palabras[0],0,1).substr($palabras[1],0,2);

            } elseif ($espAbrev > 1){

                $palabras = explode(" ", $nombre);
                $abreviacion = substr($palabras[0],0,1).substr($palabras[1],0,1).substr($palabras[2],0,1);

            } else {

                $abreviacion = substr($nombre,0,3);
            }

            /////////////////////////////////////

            $codigo_suplidor = $request->input('codigo_suplidor', true);
            $calle = $request->input('calle', true);
            $sector = $request->input('sector', true);
            $provincia = $request->input('provincia', true);
            $pais = $request->input('pais', true);
            $sitios_cercanos = $request->input('sitios_cercanos', true);
            $contacto_suplidor = $request->input('contacto_suplidor', true);
            $telefono_1 = $request->input('telefono_1', true);
            $rnc = $request->input('rnc');
            $telefono_2 = $request->input('telefono_2', true);
            $celular = $request->input('celular', true);
            $email = $request->input('email', true);
            $tipo_suplidor = $request->input('tipo_suplidor', true);
            $terminos_pago = $request->input('terminos_de_pago', true);
            $nota = $request->input('nota', true);

            $suplidor = new Supplier();
            $suplidor->nombre = $nombre;
            $suplidor->codigo_suplidor = $codigo_suplidor;
            $suplidor->rnc = trim($rnc, "_");
            $suplidor->calle = $calle;
            $suplidor->sector = $sector;
            $suplidor->provincia = $provincia;
            $suplidor->pais = $pais;
            $suplidor->sitios_cercanos = $sitios_cercanos;
            $suplidor->contacto_suplidor = $contacto_suplidor;
            $suplidor->telefono_1 = $telefono_1;
            $suplidor->telefono_2 = $telefono_2;
            $suplidor->celular = $celular;
            $suplidor->email = $email;
            $suplidor->tipo_suplidor = $tipo_suplidor;
            $suplidor->terminos_de_pago = $terminos_pago;
            $suplidor->nota = $nota;
            $suplidor->abreviacion = $abreviacion;
            

            $suplidor->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'suplidor' => $suplidor
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function show($id)
    {

        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Suplidores')
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

        $supplier = Supplier::find($id);

        if (is_object($supplier)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'supplier' => $supplier
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
            'nombre' => 'required',
        //    'rnc' => 'required',
            'calle' => 'required',
            'pais' => 'required'
        //    'contacto_suplidor' => 'required',
        //    'telefono_1' => 'required',
        //    'email' => 'required|email',
        //    'terminos_de_pago' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $id = $request->input('id', true);
            $nombre = $request->input('nombre', true);
            $codigo_suplidor = $request->input('codigo_suplidor', true);
            $rnc = $request->input('rnc');
            $calle = $request->input('calle', true);
            $sector = $request->input('sector', true);
            $provincia = $request->input('provincia', true);
            $pais = $request->input('pais', true);
            $sitios_cercanos = $request->input('sitios_cercanos', true);
            $contacto_suplidor = $request->input('contacto_suplidor', true);
            $telefono_1 = $request->input('telefono_1', true);
            $telefono_2 = $request->input('telefono_2', true);
            $celular = $request->input('celular', true);
            $email = $request->input('email', true);
            $terminos_pago = $request->input('terminos_de_pago', true);
            $tipo_suplidor = $request->input('tipo_suplidor', true);
            $nota = $request->input('nota', true);

            $supplier = Supplier::find($id);

            $supplier->nombre = $nombre;
            $supplier->codigo_suplidor = $codigo_suplidor;
            $supplier->calle = $calle;
            $supplier->sector = $sector;
            $supplier->provincia = $provincia;
            $supplier->pais = $pais;
            $supplier->sitios_cercanos = $sitios_cercanos;
            $supplier->rnc = trim($rnc, "_");
            $supplier->contacto_suplidor = $contacto_suplidor;
            $supplier->telefono_1 = $telefono_1;
            $supplier->telefono_2 = $telefono_2;
            $supplier->celular = $celular;
            $supplier->email = $email;
            $supplier->tipo_suplidor = $tipo_suplidor;
            $supplier->terminos_de_pago = $terminos_pago;
            $supplier->nota = $nota;


            $supplier->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'supplier' => $supplier
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function checkDestroy(){
        //Chekcing if the user has access to this function
        $user_loginId = Auth::user()->id;
        $user_login = PermisoUsuario::where('user_id', $user_loginId)->where('permiso', 'Suplidores')
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
        $supplier = Supplier::find($id);

        if (!empty($supplier)) {
            $supplier->delete();

            $data = [
                'code' => 200,
                'status' => 'success',
                'supplier' => $supplier
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

    public function suppliers()
    {
        $suppliers = Supplier::query();

        return DataTables::eloquent($suppliers)
            ->addColumn('Expandir', function ($cloth) {
                return "";
            })
            ->addColumn('Ver', function ($supplier) {
                return '<button onclick="ver(' . $supplier->id . ')" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></button>';
            })
            ->addColumn('Opciones', function ($supplier) {
                return '<button onclick="eliminar(' . $supplier->id . ')" class="btn btn-danger btn-sm"> <i class="fas fa-eraser"></i></button>'.
                '<button id="btnEdit" onclick="mostrar(' . $supplier->id . ')" class="btn btn-warning btn-sm ml-1" > <i class="fas fa-edit"></i></button>';
            })
            ->rawColumns(['Ver', 'Opciones'])
            ->make(true);
    }
}

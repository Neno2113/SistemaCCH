<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function store(Request $request)
    {

        $validar = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'contacto_suplidor' => 'required',
            'telefono_1' => 'required',
            'email' => 'required|email',
            'terminos_de_pago' => 'required'
        ]);

        if (empty($validar)) {

            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error en la validacion de datos'
            ];
        } else {
            $nombre = $request->input('nombre', true);
            $direccion = $request->input('direccion', true);
            $contacto_suplidor = $request->input('contacto_suplidor', true);
            $telefono_1 = $request->input('telefono_1', true);
            $telefono_2 = $request->input('telefono_2', true);
            $celular = $request->input('celular', true);
            $email = $request->input('email', true);
            $terminos_pago = $request->input('terminos_de_pago', true);
            $nota = $request->input('nota', true);
            
            $suplidor = new Supplier();
            $suplidor->nombre = $nombre;
            $suplidor->direccion = $direccion;
            $suplidor->contacto_suplidor = $contacto_suplidor;
            $suplidor->telefono_1 = $telefono_1;
            $suplidor->telefono_2 = $telefono_2;
            $suplidor->celular = $celular;
            $suplidor->email = $email;
            $suplidor->terminos_de_pago = $terminos_pago;
            $suplidor->nota = $nota;
          

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
            'direccion' => 'required',
            'contacto_suplidor' => 'required',
            'telefono_1' => 'required',
            'email' => 'required|email',
            'terminos_de_pago' => 'required'
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
            $direccion = $request->input('direccion', true);
            $contacto_suplidor = $request->input('contacto_suplidor', true);
            $telefono_1 = $request->input('telefono_1', true);
            $telefono_2 = $request->input('telefono_2', true);
            $celular = $request->input('celular', true);
            $email = $request->input('email', true);
            $terminos_pago = $request->input('terminos_de_pago', true);
            $nota = $request->input('nota', true);

            $supplier = Supplier::find($id);
            
            $supplier->nombre = $nombre;
            $supplier->direccion = $direccion;
            $supplier->contacto_suplidor = $contacto_suplidor;
            $supplier->telefono_1 = $telefono_1;
            $supplier->telefono_2 = $telefono_2;
            $supplier->celular = $celular;
            $supplier->email = $email;
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


    public function destroy($id){
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

}

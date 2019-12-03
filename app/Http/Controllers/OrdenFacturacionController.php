<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenFacturacion;
use App\ordenEmpaque;

class OrdenFacturacionController extends Controller
{

    public function selectEmpaque(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ordenEmpaque::select("id", "no_orden_empaque")
                ->where('no_orden_empaque', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }



    public function getDigits()
    {
        $orden = OrdenFacturacion::orderBy('sec', 'desc')->first();

        if (\is_object($orden)) {
            $sec = $orden->sec;
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
}

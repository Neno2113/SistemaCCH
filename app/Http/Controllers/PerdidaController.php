<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corte;
use App\Perdida;

class PerdidaController extends Controller
{
    


    public function selectCorte(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Corte::select("id", "numero_corte", "fase")
                ->where('numero_corte', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}

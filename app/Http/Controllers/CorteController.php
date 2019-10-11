<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cloth;
use App\Rollos;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CorteController extends Controller
{
    
    public function rollos(){

        $rollos = DB::table('rollos')->join('tela', 'rollos.id_tela', '=', 'tela.id')
        ->select(['rollos.id', 'tela.referencia','rollos.codigo_rollo','rollos.longitud_yarda']);

        return DataTables::of($rollos)
            ->addColumn('Editar', function ($rollo) {
                return '<button id="btnEdit" onclick="mostrar(' . $rollo->id . ')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
    }
}

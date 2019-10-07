<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users', function() {

    $users = App\User::query();
    
    return DataTables::eloquent($users)
            ->addColumn('Editar', function($user){
               return '<button id="btnEdit" onclick="mostrar('.$user->id.')" class="btn btn-warning"> <i class="fas fa-user-edit"></i></button>';
            })
            ->addColumn('Eliminar', function($user){
                return '<button onclick="eliminar('.$user->id.')" class="btn btn-danger"> <i class="fas fa-user-times"></i></button>';
            })
            
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
})->name('datatable.users');


Route::get('compositions', function() {

    $compositions = App\Composition::query();
    
    return DataTables::eloquent($compositions)
            ->addColumn('Editar', function($composition){
               return '<button id="btnEdit" onclick="mostrar('.$composition->id.')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function($composition){
                return '<button onclick="eliminar('.$composition->id.')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
})->name('datatable.compositions');

Route::get('suppliers', function() {

    $suppliers = App\Supplier::query();
    
    return DataTables::eloquent($suppliers)
            ->addColumn('Editar', function($supplier){
               return '<button id="btnEdit" onclick="mostrar('.$supplier->id.')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function($supplier){
                return '<button onclick="eliminar('.$supplier->id.')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
})->name('datatable.compositions');

Route::get('clients', function() {

    $clients = App\Client::query();
    
    return DataTables::eloquent($clients)
            ->addColumn('Editar', function($client){
               return '<button id="btnEdit" onclick="mostrar('.$client->id.')" class="btn btn-warning" > <i class="fas fa-edit"></i></button>';
            })
            ->editColumn('autorizacion_credito_req', function($client){
                return ($client->autorizacion_credito_req == 1 ? 'Si': 'No');
            })
            ->editColumn('redistribucion_tallas', function($client){
                return ($client->redistribucion_tallas == 1 ? 'Si': 'No');
            })
            ->editColumn('factura_desglosada_talla', function($client){
                return ($client->factura_desglosada_talla == 1 ? 'Si': 'No');
            })
            ->addColumn('Eliminar', function($client){
                return '<button onclick="eliminar('.$client->id.')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
})->name('datatable.compositions');



Route::get('branches', function() {

    $branches = App\ClientBranch::query();
    
    return DataTables::eloquent($branches)
            ->addColumn('Editar', function($branch){
               return '<button id="btnEdit" onclick="mostrar('.$branch->id.')" class="btn btn-warning"> <i class="fas fa-edit"></i></button>';
            })
            ->addColumn('Eliminar', function($branch){
                return '<button onclick="eliminar('.$branch->id.')" class="btn btn-danger"> <i class="fas fa-eraser"></i></button>';
            })
            
            ->rawColumns(['Editar', 'Eliminar'])
            ->make(true);
})->name('datatable.branches');
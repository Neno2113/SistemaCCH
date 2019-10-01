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
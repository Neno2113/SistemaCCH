<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBranch extends Model
{
    protected $table = 'cliente_sucursales';

    protected $fillable = [
        'cliente_id','codigo_sucursal','nombre_sucursal','telefono_sucursal','direccion'
    ];

    public function cliente(){
        return $this->belongsTo('App\User', 'cliente_id');
    }


}

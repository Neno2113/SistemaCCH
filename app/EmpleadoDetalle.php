<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoDetalle extends Model
{
    protected $table = 'empleado_detalle';

    protected $fillable = [
        'id', 'empleado_id', 'nombre_esposa', 'telefono_esposa', 'esposa_en_nss', 'cantidad_dependientes'
    ];
    /*
    public function empleado()
    {
        return $this->belongsTo('App\Empleado', 'empleado_id');
    }
    */
}

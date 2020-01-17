<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoDetalle extends Model
{
    protected $table = 'empleado_detalle';

    protected $fillable = [
        'id', 'empleado_id', 'nss', 'nombre_esposa', 'telefono_esposa', 'esposa_en_nss', 'cantidad_dependientes',
        'dependiente_1_nss','dependiente_2_nss','dependiente_3_nss','dependiente_4_nss','dependiente_5_nss','dependiente_6_nss',
        'dependiente_7_nss','nombre_dependiente_1','nombre_dependiente_2','nombre_dependiente_3','nombre_dependiente_4',
        'nombre_dependiente_5','nombre_dependiente_6','nombre_dependiente_7'
    ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado', 'empleado_id');
    }
}

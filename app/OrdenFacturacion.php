<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenFacturacion extends Model
{
    protected $table = 'orden_facturacion';

    protected $fillable = [
        'id', 'orden_empaque_id', 'no_orden_facturacion', 'fecha'
    ];

    public function orden_empaque()
    {
        return $this->belongsTo('App\ordenEmpaque', 'orden_empaque_id');
    }
}

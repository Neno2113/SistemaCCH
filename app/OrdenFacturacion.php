<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenFacturacion extends Model
{
    protected $table = 'orden_facturacion';

    protected $fillable = [
        'id', 'orden_empaque_id', 'cliente_id', 'sucursal_id', 'no_orden_facturacion', 'fecha'
    ];

    public function orden_empaque()
    {
        return $this->belongsTo('App\ordenEmpaque', 'orden_empaque_id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Client', 'cliente_id');
    }

    public function sucursal()
    {
        return $this->belongsTo('App\ClientBranch', 'sucursal_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenFacturacionDetalle extends Model
{
    protected $table = 'orden_facturacion_detalle';

    protected $fillable = [
        'id', 'orden_facturacion_id', 'producto_id', 'user_id', 'a', 'b', 'c', 'd', 'e', 'f',
        'g', 'h', 'i', 'j', 'k', 'l', 'total', 'precio', 'cant_bultos'
    ];

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }
}

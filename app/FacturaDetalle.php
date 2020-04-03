<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = 'factura_detalle';

    protected $fillable = [
        'id', 'factura_id', 'producto_id', 'cantidad', 'precio'
    ];

    public function producto()
    {
        return $this->belongsTo('App\Articulo', 'producto_id');
    }

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'factura_id');
    }
}

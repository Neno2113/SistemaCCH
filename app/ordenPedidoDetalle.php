<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenPedidoDetalle extends Model
{
    protected $table = 'orden_pedido_detalle';

    protected $fillable = [
        'id', 'orden_pedido_id', 'producto_id', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
        'j', 'k', 'l', 'total', 'cantidad'
    ];

    public function ordenPedido()
    {
        return $this->belongsTo('App\ordenPedido', 'orden_pedido_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }
}

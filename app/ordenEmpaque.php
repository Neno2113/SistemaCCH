<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenEmpaque extends Model
{
    protected $table = 'orden_empaque';

    protected $fillable = [
        'id', 'orden_pedido_id', 'no_orden_empaque', 'fecha', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
        'j', 'k', 'l', 'cantidad', 'total'
    ];


    public function orden_pedido()
    {
        return $this->belongsTo('App\ordenPedido', 'orden_pedido_id');
    }
}

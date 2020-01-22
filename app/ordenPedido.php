<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenPedido extends Model
{
    protected $table = 'orden_pedido';

    protected $fillable = [
        'id', 'cliente_id', 'sucursal_id', 'no_orden_pedido', 'fecha', 'fecha_entrega', 'notas',
        'generado_internamente', 'estado_aprobacion', 'fecha_aprobacion', 'status_orden_pedido',
        'precio', 'detallada'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Client', 'cliente_id');
    }

    public function sucursal()
    {
        return $this->belongsTo('App\ClientBranch', 'sucursal_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function vendedor()
    {
        return $this->belongsTo('App\Empleado', 'vendedor_id');
    }
}

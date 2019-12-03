<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenEmpaqueDetalle extends Model
{
    protected $table = 'orden_empaque_detalle';

    protected $fillable = [
        'id', 'orden_empaque_id', 'user_id', 'producto_id', 'fecha_hora'
    ];

    public function orden_empaque()
    {
        return $this->belongsTo('App\ordenEmpaque', 'orden_empaque_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function producto(){
        return $this->belongsTo('App\Product', 'producto_id');
    }
}

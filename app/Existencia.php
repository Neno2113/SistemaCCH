<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    protected $table = 'existencias';

    protected $fillable = [
        'id', 'producto_id', 'corte_id', 'almacen_id', 'perdida_id', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'total'
    ];

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }

    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'almacen_id');
    }

    public function perdida()
    {
        return $this->belongsTo('App\Perdida', 'perdida_id');
    }
}

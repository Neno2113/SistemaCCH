<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlmacenDetalle extends Model
{
    protected $table = 'almacen_detalle';

    protected $fillable = [
        'id', 'almacen_id', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l'
    ];


    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'almacen_id');
    }

}

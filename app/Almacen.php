<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';

    protected $fillable = [
        'id', 'corte_id', 'producto_id', 'user_id',  'codigo_almacen', 'a', 'b', 'c', 'd', 'f', 'g', 'h', 'i', 'j', 
        'k', 'l', 'usado_surva'           
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }
}

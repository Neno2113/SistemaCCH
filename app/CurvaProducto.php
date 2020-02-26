<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurvaProducto extends Model
{
    protected $table = 'curva_producto';

    protected $fillable = [
        'id', 'producto_id', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'
    ];
}

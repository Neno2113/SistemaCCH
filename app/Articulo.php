<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'producto_articulo';

    protected $fillable = [
        'id', 'nombre', 'descripcion', 'tipo_articulo'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $table = 'categorias_producto';

    protected $fillable = ['tipo', 'indice', 'nombre'];
}

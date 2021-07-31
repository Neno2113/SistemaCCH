<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtributosProducto extends Model
{
    protected $table = 'atributos_producto';

    protected $fillable = [ 'indice', 'nombre'];
}

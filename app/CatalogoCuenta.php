<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogoCuenta extends Model
{
    protected $table = 'catalogo_cuenta';

    protected $fillable = [
        'id', 'codigo', 'tipo_cuenta', 'descripcion'
    ];
}

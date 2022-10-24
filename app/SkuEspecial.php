<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkuEspecial extends Model
{
    protected $table = 'sku_especial';

    protected $fillable = [
        'id', 'producto_id', 'referencia_producto', 'sku_especial', 'talla', 'cantidad', 'cliente_id', 'nombre_cliente'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    protected $table = 'sku';


    protected $fillable = [
        'id', 'sku', 'talla'
    ];
}

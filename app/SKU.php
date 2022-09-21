<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    protected $table = 'sku';


    protected $fillable = [
        'id', 'producto_id', 'sku', 'talla', 'created_at', 'updated_at'
    ];

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'producto_id');
    }
}

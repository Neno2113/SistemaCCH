<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'tallas';

    protected $fillable = [
        'corte_id', 'a', 'b', 'c', 'd', 'f', 'g', 'h', 'i', 'j', 'k','l','total' 
    ];

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }
}

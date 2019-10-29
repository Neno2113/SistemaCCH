<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perdida extends Model
{
    protected $table = 'perdidas';

    protected $fillable = [
        'id', 'corte_id', 'producto_id', 'talla_id', 'no_perdida', 'tipo_perdida', 'fecha',
        'fase', 'motivo', 'perdida_x'
    ];

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }

    public function talla()
    {
        return $this->belongsTo('App\Talla', 'talla_id');
    }
}

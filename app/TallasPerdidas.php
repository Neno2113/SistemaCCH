<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallasPerdidas extends Model
{
    protected $table = 'tallas_perdidas';

    protected $fillable = [
        'id', 'perdidas_id', 'a','b','c','d','e','f','g','h','i','j','k','l', 'talla_x'
    ];

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }

    public function perdida()
    {
        return $this->belongsTo('App\Perdida', 'perdida_id');
    }
}

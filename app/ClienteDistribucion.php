<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class ClienteDistribucion extends Model 
{

    protected $table = 'cliente_distribucion';

    protected $fillable = [
        'id', 'cliente_id', 'producto', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i','j',
        'k', 'l'
    ];


    public function cliente()
    {
        return $this->belongsTo('App\Client', 'cliente_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto');
    }

}

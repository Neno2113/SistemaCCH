<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curva extends Model
{
    protected $table = 'curva';

    protected $fillable = [
        'id', 'producto_id', 'a' ,'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'
    ];
}

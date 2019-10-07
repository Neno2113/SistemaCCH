<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    protected $table = 'composiciones';


    protected $fillable = [
        'id', 'codigo_composicion', 'nombre_composicion'
    ];

    public function telas()
    {
        return $this->hasMany('App\Cloth');
    }
        
    
}

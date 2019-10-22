<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lavanderia extends Model
{
    protected $table = 'lavanderia';

    protected $fillable = [
        'id', 'numero_envio', 'corte_id', 'fecha_envio', 'receta_lavado', 'cantidad',
        'estandar_incluido'
    ];

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }
}

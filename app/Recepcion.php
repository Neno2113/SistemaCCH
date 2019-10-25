<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    protected $table = 'recepcion';

    protected $fillable = [
        'id','numero_recepcion', 'id_lavanderia', 'corte_id', 'fecha_recepcion', 'cantidad_recibida',
        'estandar_recibido'
    ];

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }

    public function lavanderia()
    {
        return $this->belongsTo('App\Lavanderia', 'id_lavanderia');
    }
}

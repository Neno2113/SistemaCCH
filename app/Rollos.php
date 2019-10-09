<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rollos extends Model
{
    protected $table = 'rollos';

    protected $fillable = [
        'id', 'id_suplidor', 'id_tela', 'codigo_rollo', 'num_tono', 'fecha_compra', 'longitud_yarda', 
        'corte_utilizado'
    ];

    public function suplidor()
    {
        return $this->belongsTo('App\Supplier', 'id_suplidor');
    }

    public function tela()
    {
        return $this->belongsTo('App\Cloth', 'id_tela');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RollosDetail extends Model
{
    protected $table = 'rollos_detail';

    protected $fillable = ['id_rollo', 'numero', 'tono', 'longitud', 'corte_utilizado'];

    public function rollos()
    {
        return $this->belongsTo('App\Rollos', 'id_rollo');
    }

    public function telas()
    {
        return $this->belongsTo('App\Cloth', 'id_tela');
    }
}

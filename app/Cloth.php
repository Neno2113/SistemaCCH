<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cloth extends Model
{
    protected $table = 'tela';

    protected $fillable = [
        'id_suplidor', 'id_composiciones', 'referencia','precio_usd','tipo_tela','ancho_cortable','peso',
        'elasticidad_trama','elasticidad_urdimbre','encogimiento_trama','encogimiento_urdimbre'
    ];

    public function composition()
    {
        return $this->belongsTo('App\Composition', 'id_composiciones');
    }

    public function suplidor()
    {
        return $this->belongsTo('App\Supplier', 'id_suplidor');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

}

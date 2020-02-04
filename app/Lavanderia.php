<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lavanderia extends Model
{
    protected $table = 'lavanderia';

    protected $fillable = [
        'id', 'numero_envio', 'corte_id', 'fecha_envio', 'receta_lavado', 'cantidad',
        'estandar_incluido', 'envio_reparar', 'envio_raparada_lav'
    ];

    public function corte()
    {
        return $this->belongsTo('App\Corte', 'corte_id');
    }

    public function suplidor()
    {
        return $this->belongsTo('App\Supplier', 'suplidor_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }

    public function sku()
    {
        return $this->belongsTo('App\SKU', 'id_sku');
    }
}

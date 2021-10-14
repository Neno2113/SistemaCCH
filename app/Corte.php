<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    protected $table = 'corte';

    protected $fillable = [
        'id', 'tela_id', 'producto_id','fecha_corte', 'no_marcada','ancho_cortable', 'largo_marcada',
        'aprovechamiento', 'fase', 'sec', 'fecha_creacion', 'fecha_entrega'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tela()
    {
        return $this->belongsTo('App\Cloth', 'tela_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Product', 'producto_id');
    }
}

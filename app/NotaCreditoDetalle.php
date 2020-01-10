<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaCreditoDetalle extends Model
{
    protected $table = 'nota_credito_detalle';

    protected $fillable = [
        'id', 'a','b','c', 'nota_credito_id',
        'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'
    ];


    public function notaCredito()
    {
        return $this->belongsTo('App\NotaCredito', 'nota_credito_id' );
    }
}

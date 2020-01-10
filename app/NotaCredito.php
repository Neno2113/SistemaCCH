<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaCredito extends Model
{
    protected $table = 'nota_credito';

    protected $fillable = [
        'id', 'factura_id', 'no_nota_credito', 'fecha', 'hora_impresion', 'precio_lista_factura', 'tipo_nota_credito', 'sec'
    ];

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'factura_id');
    }
}

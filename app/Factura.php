<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';

    protected $fillable = [
        'id', 'orden_facturacion_id', 'no_factura', 'tipo_factura', 'fecha', 'fecha_impresion',
        'comprobante_fiscal', 'precio_factura', 'descuento', 'itbis', 'total', 'sec'
    ];

    public function orden_facturacion()
    {
        return $this->belongsTo('App\ordenFacturacion', 'orden_facturacion_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Client', 'cliente_id');
    }

    public function sucursal()
    {
        return $this->belongsTo('App\ClientBranch', 'sucursal_id');
    }
    public function empleado()
    {
        return $this->belongsTo('App\Empleado', 'vendedor');
    }
}

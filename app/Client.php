<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'nombre_cliente', 'direccion_principal','contacto_cliente_principal','telefono_1',
        'celular_principal','email_principal','condiciones_credito','autorizacion_credito_req','notas','redistribucion_tallas',
        'factura_desglosada_talla', 'acepta_segundas', 'rnc'
    ];

    public function clienteSucursal(){
        
        return $this->hasMany('App\ClientBranch');
    }

    public function clienteDistribucion(){
        
        return $this->hasMany('App\ClienteDistribucion');
    }


}

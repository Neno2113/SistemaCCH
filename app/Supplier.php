<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suplidor';

    protected $fillable = [
        'id', 'nombre', 'direccion', 'contacto_suplidor', 'telefono_1', 'telefono_2','celular',
        'email','terminos_de_pago','nota', 'tipo_suplidor'
    ];


    public function telas()
    {
        return $this->hasMany('App\Cloth');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'producto';

    protected $fillable = [
        'id', 'id_user', 'referencia_producto', 'descripcion', 'ubicacion', 'imagen_frente', 'imagen_trasero',
        'imagen_perfil','imagen_bolsillo', 'tono', 'intensidad_proceso_seco', 'atributo_no_1', 'atributo_no_2',
        'atributo_no_3', 'precio_lista', 'precio_venta_publico' 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

}

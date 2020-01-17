<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';

    protected $fillable = [
        'id', 'nombre', 'apellido', 'calle', 'sector', 'provincia', 'sitios_cercanos', 'telefono_1',
        'telefono_2', 'email', 'cedula', 'departamento', 'casado', 'cargo', 'fecha_contratacion',
        'fecha_termino_contrato', 'tipo_contrato', 'forma_pago', 'sueldo', 'valor_hora', 'banco_tarjeta_cobro',
        'no_cuenta'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table = 'historico_laboral';

    protected $fillable = [
        'id', 'empleado_id', 'user_id', 'fecha', 'evento'
    ];
    
}

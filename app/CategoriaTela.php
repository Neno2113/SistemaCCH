<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaTela extends Model
{
    protected $table = 'categoria_tela';

    protected $fillable = ['nombre'];
}

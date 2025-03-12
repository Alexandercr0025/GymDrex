<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    //
    protected $fillable = ['nombre', 'slogan', 'email', 'celular', 'descripcion', 'contenido'];
}

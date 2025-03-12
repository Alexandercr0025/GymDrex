<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['nombres', 'apellidos', 'dni', 'fecha_nacimiento', 'email', 'celular',
    'codigo', 'imagen', 'fecha_inicio', 'fecha_fin', 'coach', 'fecha_inicio_coach', 'fecha_fin_coach'];
}

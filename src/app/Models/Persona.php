<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'tabla_persona';
    protected $primaryKey = 'cedula_identidad';
    protected $fillable = ['cedula_identidad', 'nombres', 'apellidos', 'correo', 'telefono', 'direccion_habitacion'];
}

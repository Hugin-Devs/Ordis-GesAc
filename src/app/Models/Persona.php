<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'tabla_persona';
    protected $primaryKey = 'cedula_identidad';
    protected $fillable = ['cedula_identidad', 'nombres', 'apellidos', 'correo', 'telefono', 'direccion_habitacion'];

    public function user()
    {
        return $this->hasOne(User::class, 'cedula_persona_fk', 'cedula_identidad');
    }
}

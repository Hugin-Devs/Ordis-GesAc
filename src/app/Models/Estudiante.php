<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'tabla_estudiante';
    protected $primaryKey = 'id_estudiante';
    protected $fillable = ['cedula_persona_fk', 'es_becado'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'tabla_asignatura';
    protected $primaryKey = 'id_asignatura';
    protected $fillable = ['id_fase_fk', 'nombre_asignatura', 'descripcion'];
}

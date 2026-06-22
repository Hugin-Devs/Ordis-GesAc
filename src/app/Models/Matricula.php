<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'tabla_matricula';
    protected $primaryKey = 'id_matricula';
    protected $fillable = ['id_estudiante_fk', 'id_periodo_fk', 'id_fase_fk', 'fecha_inscripcion', 'estado_matricula'];
}

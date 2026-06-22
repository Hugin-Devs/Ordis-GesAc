<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    protected $table = 'tabla_periodo_academico';
    protected $primaryKey = 'id_periodo';
    protected $fillable = ['nombre_periodo', 'fecha_inicio', 'fecha_fin', 'estado'];
}

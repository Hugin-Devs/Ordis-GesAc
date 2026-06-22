<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEvaluacion extends Model
{
    protected $table = 'tabla_plan_evaluacion';
    protected $primaryKey = 'id_evaluacion';
    protected $fillable = ['id_profesor_asignatura_fk', 'nombre_evaluacion', 'descripcion_evaluacion', 'porcentaje_peso', 'fecha_estimada'];
}

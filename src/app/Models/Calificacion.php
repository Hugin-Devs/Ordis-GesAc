<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'tabla_calificacion';
    protected $primaryKey = 'id_calificacion';
    protected $fillable = ['id_detalle_matricula_fk', 'id_evaluacion_fk', 'nota_obtenida', 'observaciones'];
}

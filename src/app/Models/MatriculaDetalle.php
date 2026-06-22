<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatriculaDetalle extends Model
{
    protected $table = 'tabla_matricula_detalle';
    protected $primaryKey = 'id_detalle';
    protected $fillable = ['id_matricula_fk', 'id_profesor_asignatura_fk', 'estado_asignatura', 'nota_final_definitiva'];
}

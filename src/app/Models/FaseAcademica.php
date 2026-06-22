<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaseAcademica extends Model
{
    protected $table = 'tabla_fase_academica';
    protected $primaryKey = 'id_fase';
    protected $fillable = ['id_programa_fk', 'nombre_fase', 'tipo_fase', 'orden_secuencia'];
}

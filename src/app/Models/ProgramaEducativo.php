<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaEducativo extends Model
{
    protected $table = 'tabla_programa_educativo';
    protected $primaryKey = 'id_programa';
    protected $fillable = ['nombre_programa', 'descripcion'];
}

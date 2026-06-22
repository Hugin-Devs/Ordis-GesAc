<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'tabla_profesor';
    protected $primaryKey = 'id_profesor';
    protected $fillable = ['cedula_persona_fk'];
}

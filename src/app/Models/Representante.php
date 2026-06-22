<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    protected $table = 'tabla_representante';
    protected $primaryKey = 'id_representante';
    protected $fillable = ['cedula_persona_fk'];
}

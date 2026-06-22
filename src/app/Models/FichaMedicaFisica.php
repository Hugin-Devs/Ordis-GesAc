<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaMedicaFisica extends Model
{
    protected $table = 'tabla_ficha_medica_fisica';
    protected $primaryKey = 'id_ficha';
    protected $fillable = ['cedula_persona_fk', 'tipo_sangre', 'peso', 'talla_camisa', 'talla_pantalon', 'talla_zapato', 'alergias', 'discapacidades', 'afecciones_cronicas'];
    protected $casts = [
        'alergias' => 'array',
        'discapacidades' => 'array',
        'afecciones_cronicas' => 'array',
    ];
}

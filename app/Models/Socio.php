<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dni',
        'fecha_nac',
        'telefono',
        'direccion',
        'localidad',
        'seguro_medico',
        'tel_emergencia',
        'fecha_inscripcion',
        'activo',
    ];
}

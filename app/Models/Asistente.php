<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asistente extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cuit',
        'condicion_fiscal',
        'email',
        'telefono',
        'direccion',
        'localidad',
        'activo',
    ];
}

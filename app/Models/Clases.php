<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clases extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_costo',
        'costo',
        'activo',
    ];
}

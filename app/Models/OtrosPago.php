<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtrosPago extends Model
{
    //
    use HasFactory;

    protected $table = 'otros_pagos';

    protected $fillable = [
        'fecha',
        'socio_id',
        'descripcion',
        'importe',
    ];

    // Relación con Socio
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

}

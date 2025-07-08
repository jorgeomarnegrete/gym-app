<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{

    protected $table = 'suscripciones';

    protected $fillable = [
        'socio_id',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'monto',
        'activo',
        'observaciones',
        'forma_pago',
        'modalidad',
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
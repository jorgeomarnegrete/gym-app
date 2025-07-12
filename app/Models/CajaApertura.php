<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CajaApertura extends Model
{
    use HasFactory;

    protected $table = 'caja_aperturas';

    protected $fillable = [
        'fecha',
        'hora',
        'monto_inicial',
        'usuario',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'time',
        'monto_inicial' => 'decimal:2',
    ];

    // 🔍 Scope para encontrar la apertura actual
    public function scopeHoy($query)
    {
        return $query->whereDate('fecha', today());
    }
}
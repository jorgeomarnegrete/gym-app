<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CajaMovimiento extends Model
{
    //
    use HasFactory;

    protected $table = 'caja_movimientos';

    protected $fillable = [
        'fecha',
        'monto',
        'concepto',
        'tipo',
        'socio_id',
        'recibo_numero',
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2',
    ];

    // Relación opcional con el socio
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    // Scope para filtrar ingresos
    public function scopeIngresos($query)
    {
        return $query->where('tipo', 'ingreso');
    }

    // Scope para filtrar egresos
    public function scopeEgresos($query)
    {
        return $query->where('tipo', 'egreso');
    }

}

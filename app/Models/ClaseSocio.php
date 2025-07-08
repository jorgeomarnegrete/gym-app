<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaseSocio extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'socio_id',
        'clase_id',
        'asistente_id',
        'fecha',
        'asistio',
    ];

    // Relaciones
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function clase()
    {
        return $this->belongsTo(Clases::class);
    }

    public function asistente()
    {
        return $this->belongsTo(Asistente::class);
    }

    
}

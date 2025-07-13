<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Numerador extends Model
{
    use HasFactory;

    protected $table = 'numeradores';

    protected $fillable = ['nombre', 'ultimo_numero'];

    public $timestamps = true;
}
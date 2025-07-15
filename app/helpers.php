<?php

use App\Models\Numerador;

if (!function_exists('generarNumero')) {
    function generarNumero(string $nombre = 'recibo_caja'): string
    {
        $registro = Numerador::firstOrCreate(
            ['nombre' => $nombre],
            ['ultimo_numero' => 0]
        );

        $registro->increment('ultimo_numero');

        $numero = str_pad($registro->ultimo_numero, 5, '0', STR_PAD_LEFT);
        $prefijo = strtoupper(substr($nombre, 0, 1));

        return "{$prefijo}-{$numero}";
    }
}


if (!function_exists('formatearMonto')) {
    function formatearMonto(float $monto): string
    {
        return '$ ' . number_format($monto, 2, ',', '.');
    }
}


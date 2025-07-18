<?php

use App\Models\Numerador;
use Illuminate\Support\Facades\Storage;
use App\Models\OtrosPago;
use Illuminate\Support\Carbon;


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

if (!function_exists('guardarReciboPDF')) {
    function guardarReciboPDF(string $numeroRecibo, string $contenidoPDF): string
    {
        $filename = "{$numeroRecibo}.pdf";

        // Asegurarse que la carpeta exista
        if (!Storage::disk('recibos')->exists('/')) {
            Storage::disk('recibos')->makeDirectory('/');
        }

        // Guardar el archivo
        Storage::disk('recibos')->put($filename, $contenidoPDF);

        // Devolver la URL pública
        return Storage::disk('recibos')->url($filename);
    }
}

if (!function_exists('registrarOtroPago')) {
    function registrarOtroPago(int $socioId, string $medio, float $importe, ?Carbon $fecha = null): void
    {
        $descripcion = generarDescripcionPago($medio);

        OtrosPago::create([
            'fecha' => $fecha ?? today(),
            'socio_id' => $socioId,
            'descripcion' => $descripcion,
            'importe' => $importe,
        ]);
    }
}

if (!function_exists('generarDescripcionPago')) {
    function generarDescripcionPago(string $medio): string
    {
        return "Pago con {$medio}";
    }
}



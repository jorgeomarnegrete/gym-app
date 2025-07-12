<?php

namespace App\Http\Controllers;

use App\Models\CajaApertura;
use Illuminate\Http\Request;

class CajaAperturaController extends Controller
{
    public function store(Request $request)
    {
        // Verifica si ya se abrió hoy
        if (CajaApertura::whereDate('fecha', today())->exists()) {
            return back()->withErrors(['error' => 'Ya existe una apertura registrada para hoy.']);
        }

        // Registra la apertura
        CajaApertura::create([
            'fecha' => today(),
            'hora' => now()->format('H:i:s'),
            'monto_inicial' => $request->monto_inicial ?? 0,
            'usuario' => $request->usuario ?? 'Caja',

        ]);

        return redirect()
            ->route('caja.index') // o donde veas la caja
            ->with('success', 'Caja abierta correctamente para hoy.');
    }
}

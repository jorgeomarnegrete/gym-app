<?php

namespace App\Http\Controllers;

use App\Models\OtrosPago;
use Illuminate\Http\Request;

class OtrosPagosController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'fecha' => 'required|date',
            'medio' => 'required|string',
            'importe' => 'required|numeric|min:0',
        ]);

        $descripcion = "Pago con {$validated['medio']}";

        OtrosPago::create([
            'fecha' => $validated['fecha'],
            'socio_id' => $validated['socio_id'],
            'descripcion' => $descripcion,
            'importe' => $validated['importe'],
        ]);

        return response()->json(['success' => true]);
    }


}

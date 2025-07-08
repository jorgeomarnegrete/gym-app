<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Models\Socio;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
       if ($request->filled('q')) {
            $q = $request->input('q');
            $suscripciones = Suscripcion::whereHas('socio', function ($query) use ($q) {
                                $query->where('nombre', 'like', "%{$q}%");
                            })
                            ->orderByDesc('fecha_inicio')
                            ->paginate(10)
                            ->withQueryString();
        } else {
            $suscripciones = Suscripcion::orderByDesc('fecha_inicio')->paginate(10);
    }

    return view('suscripciones.index', compact('suscripciones'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $suscripcion = new Suscripcion();
        $socios = Socio::orderBy('nombre')->get();

        return view('suscripciones.create', compact('suscripcion', 'socios') + [
            'action' => route('suscripciones.store'),
            'method' => 'POST',
            'submit' => 'Guardar',
        ]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'socio_id' => ['required', 'exists:socios,id'],
            'tipo' => ['required', 'in:1,2,3,4'],
            'forma_pago' => ['required', 'in:1,2,3,4'],
            'modalidad' => ['nullable', 'in:presencial,virtual,hibrida'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'monto' => ['required', 'numeric', 'min:0'],
            'observaciones' => ['nullable', 'string', 'max:1000'],
        ], [
            'socio_id.required' => 'Seleccioná un socio.',
            'socio_id.exists' => 'El socio seleccionado no existe.',
            'tipo.required' => 'Seleccioná un tipo de suscripción.',
            'forma_pago.required' => 'Seleccioná una forma de pago.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin no puede ser anterior a la de inicio.',
            'monto.required' => 'Debe especificarse un monto.',
        ]);

        Suscripcion::create($validated + [
            'activo' => $request->has('activo'),
        ]);

        return redirect()
            ->route('suscripciones.index')
            ->with('success', 'Suscripción creada correctamente.');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suscripcion $suscripcion)
    {
        $socios = Socio::orderBy('nombre')->get();

        return view('suscripciones.edit', [
            'suscripcion' => $suscripcion,
            'action' => route('suscripciones.update', $suscripcion),
            'method' => 'PUT',
            'submit' => 'Actualizar',
            'socios' => $socios,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suscripcion $suscripcion)
{
    $validated = $request->validate([
        'socio_id' => ['required', 'exists:socios,id'],
        'tipo' => ['required', 'in:1,2,3,4'],
        'forma_pago' => ['required', 'in:1,2,3,4'],
        'modalidad' => ['nullable', 'in:presencial,virtual,hibrida'],
        'fecha_inicio' => ['required', 'date'],
        'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
        'monto' => ['required', 'numeric', 'min:0'],
        'observaciones' => ['nullable', 'string', 'max:1000'],
    ]);

    $suscripcion->update($validated + [
        'activo' => $request->has('activo'),
    ]);

    return redirect()
        ->route('suscripciones.index')
        ->with('success', 'Suscripción actualizada correctamente.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

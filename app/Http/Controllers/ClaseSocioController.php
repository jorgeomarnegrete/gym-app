<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use App\Models\Socio;
use App\Models\ClaseSocio;
use App\Models\Clases;

use Illuminate\Http\Request;

class ClaseSocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $q = $request->input('q');

            $clasesocios = ClaseSocio::with(['socio', 'clase', 'asistente'])
                ->whereHas('socio', function ($query) use ($q) {
                    $query->where('nombre', 'like', "%{$q}%");
                })
                ->orderByDesc('fecha')
                ->paginate(10)
                ->withQueryString();
        } else {
            $clasesocios = ClaseSocio::with(['socio', 'clase', 'asistente'])
                ->orderByDesc('fecha')
                ->paginate(10);
        }

        return view('clasesocios.index', compact('clasesocios'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clasesocio = new ClaseSocio();
        $socios = Socio::orderBy('nombre')->get();
        $asistentes = Asistente::orderBy('nombre')->get();
        $clases = Clases::orderBy('nombre')->get();
        //return $clasesocio;

        return view('clasesocios.create', compact('clasesocio', 'socios', 'asistentes', 'clases') + [
            'action' => route('clasesocios.store'),
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
            'clase_id' => ['required', 'exists:clases,id'],
            'asistente_id' => ['required', 'exists:asistentes,id'],
            'fecha' => ['required', 'date'],
            'asistio' => ['nullable', 'boolean'],
        ], [
            'socio_id.required' => 'Seleccioná un socio.',
            'clase_id.required' => 'Seleccioná una clase.',
            'asistente_id.required' => 'Seleccioná un asistente.',
            'fecha.required' => 'La fecha es obligatoria.',
        ]);

        ClaseSocio::create([
            'socio_id' => $validated['socio_id'],
            'clase_id' => $validated['clase_id'],
            'asistente_id' => $validated['asistente_id'],
            'fecha' => $validated['fecha'],
            'asistio' => $request->has('asistio'), // Usa el hidden + checkbox que ya tenés
        ]);

        return redirect()
            ->route('clasesocios.index')
            ->with('success', 'Clase registrada correctamente.');

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
    public function edit(string $id)
    {
        //
        $clasesocio = ClaseSocio::findOrFail($id);

        $socios = Socio::orderBy('nombre')->get();
        $clases = Clases::orderBy('nombre')->get();
        $asistentes = Asistente::orderBy('nombre')->get();

        return view('clasesocios.edit', compact('clasesocio', 'socios', 'clases', 'asistentes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClaseSocio $clasesocio)
    {
            //
            $validated = $request->validate([
            'socio_id' => ['required', 'exists:socios,id'],
            'clase_id' => ['required', 'exists:clases,id'],
            'asistente_id' => ['required', 'exists:asistentes,id'],
            'fecha' => ['required', 'date'],
            'asistio' => ['nullable', 'boolean'],
            ], [
            'socio_id.required' => 'Seleccioná un socio.',
            'clase_id.required' => 'Seleccioná una clase.',
            'asistente_id.required' => 'Seleccioná un asistente.',
            'fecha.required' => 'La fecha es obligatoria.',
            ]);

            $clasesocio->update([
            'socio_id' => $validated['socio_id'],
            'clase_id' => $validated['clase_id'],
            'asistente_id' => $validated['asistente_id'],
            'fecha' => $validated['fecha'],
            'asistio' => $request->has('asistio'), // Checkbox + hidden = cobertura total
            ]);

        return redirect()
            ->route('clasesocios.index')
            ->with('success', 'Clase actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

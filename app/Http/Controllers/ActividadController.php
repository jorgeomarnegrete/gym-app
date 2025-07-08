<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->filled('q')) {
            $q = $request->input('q');
            $actividades = Actividad::where('nombre', 'like', "%{$q}%")
                        ->orderBy('nombre')
                        ->paginate(10)
                        ->withQueryString();
        } else {
            $actividades = Actividad::orderBy('nombre')->paginate(10);
        }

        //return $actividades;
        return view('actividades.index', compact('actividades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('actividades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'             => 'required|string|max:255',
        ]);

        Actividad::create($validated);

         return redirect()
            ->route('actividades.index') // o donde prefieras
            ->with('success', 'La actividad fue creada exitosamente ✅');

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
        $actividad = Actividad::findOrFail($id);
        return view('actividades.edit', compact('actividad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $actividad = Actividad::findOrFail($id);

        $validated = $request->validate([
            'nombre'             => 'required|string|max:255',
        ]);

        $actividad->update($validated);

        return redirect()
            ->route('actividades.index')
            ->with('success', 'Los datos de actividad fueron actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

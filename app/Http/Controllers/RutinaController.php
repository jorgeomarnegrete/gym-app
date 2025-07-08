<?php

namespace App\Http\Controllers;

use App\Models\Rutina;
use Illuminate\Http\Request;

class RutinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->filled('q')) {
            $q = $request->input('q');
            $rutinas = Rutina::where('nombre', 'like', "%{$q}%")
                        ->orderBy('nombre')
                        ->paginate(10)
                        ->withQueryString();
        } else {
            $rutinas = Rutina::orderBy('nombre')->paginate(10);
        }

        //return $actividades;
        return view('rutinas.index', compact('rutinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('rutinas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Rutina::create($validated);

         return redirect()
            ->route('rutinas.index') // o donde prefieras
            ->with('success', 'La rutina fue creada exitosamente ✅');return $request;
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
        $rutina = Rutina::findOrFail($id);
        return view('rutinas.edit', compact('rutina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rutina = Rutina::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $rutina->update($validated);

        return redirect()
            ->route('rutinas.index')
            ->with('success', 'Los datos de rutinas fueron actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

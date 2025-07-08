<?php

namespace App\Http\Controllers;

use App\Models\Clases;
use Illuminate\Http\Request;

class ClasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $q = $request->input('q');
            $clases = Clases::where('nombre', 'like', "%{$q}%")
                        ->orderBy('nombre')
                        ->paginate(10)
                        ->withQueryString();
        } else {
            $clases = Clases::orderBy('nombre')->paginate(10);
        }

        //return $clases;
        return view('clases.index', compact('clases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('clases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nombre'        => 'required|string|max:255',
            'tipo_costo'    => 'required|in:1,2,3',
            'costo'         => 'required|numeric|min:0|max:999999999.99',
            'activo'        => 'nullable',
        ]);

        $validated['activo'] = $request->has('activo');

        Clases::create($validated);

         return redirect()
            ->route('clases.index') // o donde prefieras
            ->with('success', 'La clase fue creada exitosamente ✅');

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
        $clases = Clases::findOrFail($id);
        return view('clases.edit', compact('clases'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $clase = Clases::findOrFail($id);

        $validated = $request->validate([
            'nombre'        => 'required|string|max:255',
            'tipo_costo'    => 'required|in:1,2,3',
            'costo'         => 'required|numeric|min:0|max:999999999.99',
            'activo'        => 'nullable',
        ]);

        $validated['activo'] = $request->has('activo');

        $clase->update($validated);

        return redirect()
            ->route('clases.index')
            ->with('success', 'Los datos del asistente fueron actualizados correctamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

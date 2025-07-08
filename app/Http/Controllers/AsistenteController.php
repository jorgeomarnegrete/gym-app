<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use Illuminate\Http\Request;

class AsistenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       if ($request->filled('q')) {
            $q = $request->input('q');
            $asistentes = Asistente::where('nombre', 'like', "%{$q}%")
                       ->orWhere('cuit', 'like', "%{$q}%")
                        ->orderBy('nombre')
                        ->paginate(10)
                        ->withQueryString();
        } else {
            $asistentes = Asistente::orderBy('nombre')->paginate(10);
        }

        //return $asistentes;
        return view('asistentes.index', compact('asistentes'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //return "Estamos aca";
        return view('asistentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $validated = $request->validate([
            'nombre'             => 'required|string|max:255',
            'cuit'               => 'required|string|max:20',
            'condicion_fiscal'   => 'required|in:1,2,3',
            'email'              => 'required|string|max:50',
            'telefono'           => 'nullable|string|max:30',
            'direccion'          => 'required|string|max:255',
            'localidad'          => 'required|string|max:255',
            'activo'             => 'nullable',
        ]);

        $validated['activo'] = $request->has('activo');

        Asistente::create($validated);

         return redirect()
            ->route('asistentes.index') // o donde prefieras
            ->with('success', 'El asistente fue creado exitosamente ✅');

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
        $asistente = Asistente::findOrFail($id);
        return view('asistentes.edit', compact('asistente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $asistente = Asistente::findOrFail($id);

        $validated = $request->validate([
            'nombre'             => 'required|string|max:255',
            'cuit'               => 'required|string|max:20',
            'condicion_fiscal'   => 'required|in:1,2,3',
            'email'              => 'required|string|max:50',
            'telefono'           => 'nullable|string|max:30',
            'direccion'          => 'required|string|max:255',
            'localidad'          => 'required|string|max:255',
            'activo'             => 'nullable',
        ]);

        $validated['activo'] = $request->has('activo');

        $asistente->update($validated);

        return redirect()
            ->route('asistentes.index')
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

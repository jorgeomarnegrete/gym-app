<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       

        if ($request->filled('q')) {
            $q = $request->input('q');
            $socios = Socio::where('nombre', 'like', "%{$q}%")
                       ->orWhere('dni', 'like', "%{$q}%")
                        ->orderBy('nombre')
                        ->paginate(10)
                        ->withQueryString();
        } else {
            $socios = Socio::orderBy('nombre')->paginate(10);
        }


        return view('socios.index', compact('socios'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('socios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'             => 'required|string|max:255',
            'dni'                => 'required|string|max:20',
            'fecha_nac'          => 'required|date_format:d/m/Y',
            'fecha_inscripcion'  => 'required|date_format:d/m/Y',
            'telefono'           => 'nullable|string|max:30',
            'direccion'          => 'required|string|max:255',
            'localidad'          => 'required|string|max:255',
            'seguro_medico'      => 'required|string|max:255',
            'tel_emergencia'     => 'required|string|max:30',
            'activo'             => 'nullable',
        ]);

        // Convertimos fechas
        $validated['fecha_nac'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['fecha_nac'])->format('Y-m-d');
        $validated['fecha_inscripcion'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['fecha_inscripcion'])->format('Y-m-d');

        // Booleano explícito
        $validated['activo'] = $request->has('activo');

        // ¡Ahora sí! Guardamos al socio
        Socio::create($validated);

        // Redireccionamos con feedback
        return redirect()
            ->route('socios.index') // o donde prefieras
            ->with('success', 'El socio fue creado exitosamente ✅');
    }

    /**
     * Display the specified resource.
     */
    public function show(Socio $socio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    //public function edit(Socio $socio)
    public function edit($id)
    {
        //
        $socio = Socio::findOrFail($id);
        return view('socios.edit', compact('socio'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $socio = Socio::findOrFail($id);

        $fecha = \Carbon\Carbon::createFromFormat('d/m/Y', $request->fecha_nac)->format('Y-m-d'); 
        $fecha2 = \Carbon\Carbon::createFromFormat('d/m/Y', $request->fecha_inscripcion)->format('Y-m-d'); 

        $validated = $request->validate([
            'nombre'        => 'required|string|max:255',
            'dni'           => 'required|string|max:20',
            'telefono'      => 'nullable|string|max:20',
            'direccion'     => 'nullable|string|max:255',
            'localidad'     => 'nullable|string|max:255',
            'seguro_medico' => 'nullable|string|max:255',
            'tel_emergencia'=> 'nullable|string|max:255',
            'activo'   => 'nullable',
        // Agregá tus campos nuevos acá también
        ]);

        $validated['fecha_nac'] = $fecha;
        $validated['fecha_inscripcion'] = $fecha2;
        $validated['activo'] = $request->has('activo'); // Esto devuelve true o false

        $socio->update($validated);

        return redirect()
            ->route('socios.index')
            ->with('success', 'Los datos del socio fueron actualizados correctamente.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Socio $socio)
    {
        //
    }
}

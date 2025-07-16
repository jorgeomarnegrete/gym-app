<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Suscripcion;
use App\Models\Socio;
use App\Models\CajaMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            $suscripcion = Suscripcion::create($validated + [
                'activo' => $request->has('activo'),
            ]);

            if ((int) $validated['forma_pago'] === 1) {
                $numeroRecibo = generarNumero('recibo_caja');

                CajaMovimiento::create([
                    'fecha' => today(),
                    'monto' => $validated['monto'],
                    'tipo' => 'ingreso',
                    'socio_id' => $validated['socio_id'],
                    'recibo_numero' => $numeroRecibo,
                    'concepto' => 'Pago suscripción',
                ]);

                $pdf = Pdf::loadView('pdf.recibo', [
                    'numero' => $numeroRecibo,
                    'fecha' => today()->format('d/m/Y'),
                    'socio' => Socio::find($validated['socio_id']),
                    'monto' => formatearMonto($validated['monto']),
                    'concepto' => 'Pago suscripción',
                ]);

                $urlRecibo = guardarReciboPDF($numeroRecibo, $pdf->output());



            }

            DB::commit();

            return redirect()
                    ->route('suscripciones.index')
                    ->with('recibo_url', $urlRecibo)
                    ->with('success', 'Suscripción creada correctamente.');


        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('suscripciones.index')
                ->with('error', 'Ocurrió un error al registrar la suscripción. Intentá nuevamente.');
        }
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

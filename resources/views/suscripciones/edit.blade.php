<x-app-layout>
    <link rel="stylesheet" href="{{ asset('mio.css') }}">

    <x-slot name="header">
        <h2 class="h2_m">
            Editar Suscripción
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <x-form-suscripcion 
            :action="route('suscripciones.update', $suscripcion)" 
            method="PUT" 
            :submit="'Actualizar'" 
            :suscripcion="$suscripcion" 
            :socios="$socios"
        />
    </div>
</x-app-layout>
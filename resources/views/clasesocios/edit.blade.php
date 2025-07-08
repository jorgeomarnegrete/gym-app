<x-app-layout>
    <link rel="stylesheet" href="{{ asset('mio.css') }}">

    <x-slot name="header">
        <h2 class="h2_m">Editar Clase por socio</h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <x-form-clasesocio 
            :action="route('clasesocios.update', $clasesocio->id)" 
            method="PUT" 
            :submit="'Actualizar'"
            :clasesocio="$clasesocio"
            :socios="$socios"
            :asistentes="$asistentes"
            :clases="$clases"
        />
    </div>
</x-app-layout>
<x-app-layout>
    <link rel="stylesheet" href="{{ asset('mio.css') }}">

    <x-slot name="header">
        <h2 class="h2_m">Nuevo Socio</h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <x-form-socio :action="route('socios.store')" method="POST" :submit="'Guardar'" />
    </div>

    <script src="{{ asset('validar-fechas-socios.js') }}"></script>
</x-app-layout>
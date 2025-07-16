<x-app-layout>
    <link rel="stylesheet" href="{{ asset('mio.css') }}">
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white leading-tight">
                Listado de Suscripciones
            </h2 class="h2_m">
            <a href="{{ route('suscripciones.create') }}" class="btn_green">+ Nueva Suscripción</a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('suscripciones.index') }}" class="mb-4">
            <input type="text" name="q" value="{{ request('q') }}"
                placeholder="Buscar por socio"
                class="border px-4 py-2 rounded w-64" />
            <button type="submit" class="btn_b" id="btn_busc">Buscar</button>
        </form>
    </div>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($suscripciones->count())
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-md">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-left text-xs uppercase tracking-wide text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Socio</th>
                            <th class="px-4 py-3">Tipo</th>
                            <th class="px-4 py-3">Forma de Pago</th>
                            <th class="px-4 py-3">Monto</th>
                            <th class="px-4 py-3">Inicio</th>
                            <th class="px-4 py-3">Fin</th>
                            <th class="px-4 py-3">Activo</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-800 dark:text-gray-100">
                        @foreach($suscripciones as $suscripcion)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $suscripcion->socio->nombre ?? '—' }}</td>
                                <td class="px-4 py-2">
                                    @switch($suscripcion->tipo)
                                        @case(1) Mensual @break
                                        @case(2) Diario @break
                                        @case(3) Por Clase @break
                                        @case(4) Free Pass @break
                                        @default —
                                    @endswitch
                                </td>
                                <td class="px-4 py-2">
                                    @switch($suscripcion->forma_pago)
                                        @case(1) Efectivo @break
                                        @case(2) Transferencia @break
                                        @case(3) Débito @break
                                        @case(4) Crédito @break
                                        @default —
                                    @endswitch
                                </td>
                                <td class="px-4 py-2">${{ number_format($suscripcion->monto, 2, ',', '.') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($suscripcion->fecha_inicio)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($suscripcion->fecha_fin)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ $suscripcion->activo ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('suscripciones.edit', $suscripcion->id) }}" class="text-indigo-600 hover:underline">✏️ Editar</a>
                                    <form action="{{ route('suscripciones.destroy', $suscripcion->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Eliminar esta suscripción?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-300 mt-4">No hay suscripciones registradas aún.</p>
        @endif
    </div>

    <div class="mt-4">
        {{ $suscripciones->links() }}
    </div>
    
    @if(session('recibo_url'))
        <a id="abrir-recibo" href="{{ session('recibo_url') }}" target="_blank" style="display: none;"></a>
        <script>
            document.getElementById('abrir-recibo').click();
        </script>
    @endif


</x-app-layout>
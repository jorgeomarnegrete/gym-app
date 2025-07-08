<x-app-layout>
    <link rel="stylesheet" href="{{ asset('mio.css') }}">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white leading-tight">
                Listado de Asistentes
            </h2 class="h2_m">
            <a href="{{ route('asistentes.create') }}" class="btn_green">+ Nuevo Asistente</a>
        </div>
    </x-slot>
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('asistentes.index') }}" class="mb-4">
            <input type="text" name="q" value="{{ request('q') }}"
                placeholder="Buscar por nombre o CUIT"
                class="border px-4 py-2 rounded w-64" />
            <button type="submit" class="btn_b" id="btn_busc">Buscar</button>
        </form>

    </div>
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($asistentes->count())
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-md">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-left text-xs uppercase tracking-wide text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">CUIT</th>
                            <th class="px-4 py-3">Direccion</th>
                            <th class="px-4 py-3">Localidad</th>
                            <th class="px-4 py-3">Teléfono</th>
                            <th class="px-4 py-3">Activo</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-800 dark:text-gray-100">
                        @foreach($asistentes as $asistente)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $asistente->nombre }}</td>
                                <td class="px-4 py-2">{{ $asistente->cuit }}</td>
                                <td class="px-4 py-2">{{ $asistente->direccion }}</td>
                                <td class="px-4 py-2">{{ $asistente->localidad }}</td>
                                <td class="px-4 py-2">{{ $asistente->telefono }}</td>
                                <td class="px-4 py-2">
                                    @if($asistente->activo)
                                        <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Sí</span>
                                    @else
                                        <span class="inline-block px-2 py-1 text-xs bg-red-100 text-red-800 rounded">No</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('asistentes.edit', $asistente->id) }}" class="text-indigo-600 hover:underline">✏️ Editar</a>
                                    <form action="{{ route('asistentes.destroy', $asistente->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Eliminar este asistente?')">
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
            <p class="text-gray-500 dark:text-gray-300 mt-4">No hay asistentes cargados aún.</p>
        @endif
    </div>
    <div class="mt-4">
        {{ $asistentes->links() }}
    </div>

</x-app-layout>
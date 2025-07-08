<x-app-layout>
    <link rel="stylesheet" href="{{ asset('mio.css') }}">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white leading-tight">
                Listado de Actividades
            </h2 class="h2_m">
            <a href="{{ route('actividades.create') }}" class="btn_green">+ Nueva Actividad</a>
        </div>
    </x-slot>
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('actividades.index') }}" class="mb-4">
            <input type="text" name="q" value="{{ request('q') }}"
                placeholder="Buscar por nombre"
                class="border px-4 py-2 rounded w-64" />
            <button type="submit" class="btn_b" id="btn_busc">Buscar</button>
        </form>

    </div>
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($actividades->count())
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-md">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-left text-xs uppercase tracking-wide text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-800 dark:text-gray-100">
                        @foreach($actividades as $actividad)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $actividad->nombre }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('actividades.edit', $actividad->id) }}" class="text-indigo-600 hover:underline">✏️ Editar</a>
                                    <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Eliminar esta actividad?')">
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
            <p class="text-gray-500 dark:text-gray-300 mt-4">No hay actividades cargadas aún.</p>
        @endif
    </div>
    <div class="mt-4">
        {{ $actividades->links() }}
    </div>

</x-app-layout>
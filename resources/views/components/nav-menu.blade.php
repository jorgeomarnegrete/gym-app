 
 
 
 <nav x-data="{ open: false }"
     class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow">

    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        <!-- Logo izquierda -->
        <div class="shrink-0">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="h-10 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Título centro -->
        <div class="flex-1 flex justify-center">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Sistema de gestión de Gimnasio Versión 1.0
            </h1>
        </div>

        <!-- Usuario derecha -->
        <div class="hidden sm:flex sm:items-center sm:space-x-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-800 dark:hover:text-white focus:outline-none transition">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586
                                l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414
                                0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

    </div>
</nav>

<nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <div class="text-lg font-bold">Gym-App</div>

        <div class="flex space-x-6 items-center">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:underline focus:outline-none">
                    Archivos ▾
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white text-black rounded shadow-md z-10">
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Dashboard</a>
                    <a href="{{ route('socios.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Socios</a>
                    <a href="{{ route('asistentes.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Asistentes</a>
                    <a href="{{ route('actividades.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Actividades</a>
                    <a href="{{ route('clases.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Clases</a>
                    <a href="{{ route('rutinas.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Rutinas</a>
                </div>
            </div>
        </div>

        <div class="flex space-x-6 items-center">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:underline focus:outline-none">
                    Gestión ▾
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white text-black rounded shadow-md z-10">
                    <a href="{{ route('suscripciones.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Suscripciones</a>
                    <a href="{{ route('clasesocios.index') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black">Clases/Socios</a>
                </div>
            </div>
        </div>

    </div>
</nav>

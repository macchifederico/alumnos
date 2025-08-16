<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Acceso Rápido
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="/admin/alumnos"
               class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex items-center space-x-6">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <div>
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gestión de Alumnos</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Ver y administrar estudiantes</p>
                    </div>
                </div>
            </a>

            <a href="/admin/cursos"
               class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex items-center space-x-6">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                    <div>
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gestión de Cursos</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Ver y administrar cursos</p>
                    </div>
                </div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

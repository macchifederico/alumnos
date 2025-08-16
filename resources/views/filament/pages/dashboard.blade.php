<x-filament-panels::page>
    <div class="space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                📚 Sistema de Gestión de Alumnos
            </h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                Escritorio Principal
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($this->getHeaderWidgets() as $widget)
                @livewire($widget)
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        ⚡ Accesos Rápidos
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('filament.admin.resources.alumnos.index') }}"
                           class="flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                            <span class="text-2xl mr-3">👥</span>
                            <div>
                                <div class="font-medium text-blue-900 dark:text-blue-100">Gestionar Alumnos</div>
                                <div class="text-sm text-blue-600 dark:text-blue-300">Ver, crear y editar estudiantes</div>
                            </div>
                        </a>
                        <a href="{{ route('filament.admin.resources.cursos.index') }}"
                           class="flex items-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors">
                            <span class="text-2xl mr-3">📖</span>
                            <div>
                                <div class="font-medium text-green-900 dark:text-green-100">Gestionar Cursos</div>
                                <div class="text-sm text-green-600 dark:text-green-300">Ver, crear y editar cursos</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        📊 Estado del Sistema
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Cursos Vigentes:</span>
                            <span class="font-medium text-green-600">{{ \App\Models\Curso::where('vigencia', '>=', now())->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Cursos Vencidos:</span>
                            <span class="font-medium text-red-600">{{ \App\Models\Curso::where('vigencia', '<', now())->count() }}</span>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Última actualización: {{ now()->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>


<x-filament::page>
    <div class="space-y-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Proyecto Prácticas</h1>

        <ul class="space-y-3">
            <li>
                <a href="http://proyecto-practicas.test/documentacion" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Documentación Técnica</strong>
                </a>
            </li>

            <li class="pt-4 border-t border-gray-300 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200">Ayuda Usuarios</h3>
            </li>

            <li>
                <a href="http://proyecto-practicas.test/dashboard/documentacion-tutor-docente" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Rol Tutor Docente</strong>
                </a>
            </li>
            <li>
                <a href="http://proyecto-practicas.test/dashboard/documentacion-tutor-laboral" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Rol Tutor Laboral</strong>
                </a>
            </li>
            <li>
                <a href="http://proyecto-practicas.test/dashboard/documentacion-alumno" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Rol Alumno</strong>
                </a>
            </li>
            <li class="pt-4 border-t border-gray-300 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200">API</h3>
            </li>

            <li>
                <a href="{{ url('/api/usuarios') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Usuarios</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/tareas') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Tareas</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/asignaturas') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Asignaturas</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/cursos') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Cursos</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/titulaciones') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Titulaciones</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/empresas') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Empresas</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/creadores') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Creadores</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/plugins') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Plugins</strong>
                </a>
            </li>
            <li>
                <a href="{{ url('/api/incidencias') }}" target="_blank"
                   class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                    <strong class="text-gray-900 dark:text-white">Incidencias</strong>
                </a>

            </li>
            <li class="pt-4 border-t border-gray-300 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200">Incidencias</h3>
            </li>
            @forelse ($incidencias as $incidencia)
                <li>
                    <a href="{{ route('incidencias.show', $incidencia) }}" target="_blank"
                       class="block px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition">
                        <strong class="text-gray-900 dark:text-white">{{ $incidencia->titulo }}</strong>
                    </a>
                </li>
            @empty
                <li class="text-gray-600 dark:text-gray-400">No hay incidencias registradas.</li>
            @endforelse
        </ul>
    </div>
</x-filament::page>

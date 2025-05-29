<x-filament::page>
    <div class="prose dark:prose-invert max-w-none dark:text-white">
        <p>Los usuarios con rol <strong>Tutor Docente</strong> tienen una visión académica del seguimiento del alumnado. Su acceso es solo de lectura, pero con mayor alcance que el tutor laboral.</p>

        <h2>Permisos</h2>
        <p>Solo lectura. No pueden crear, editar ni eliminar información.</p>

        <h2>Recursos visibles</h2>
        <ul>
            <li><strong>Usuarios:</strong> Su propio perfil y los alumnos asignados como tutor docente o aquellos a los que imparte clase.</li>
            <li><strong>Tareas:</strong>
                <ul>
                    <li>De alumnos que tenga asignados como tutor docente.</li>
                    <li>De alumnos a los que imparte clase, solo si la tarea está asociada a una asignatura que él imparte.</li>
                </ul>
            </li>
            <li><strong>Empresas:</strong> Aquellas en las que estén sus alumnos como tutor docente o como profesor.</li>
            <li><strong>Asignaturas:</strong> Solo las asignaturas que él mismo imparte.</li>
            <li><strong>Cursos:</strong> Aquellos que contienen asignaturas que él imparte.</li>
            <li><strong>Titulaciones:</strong> Las titulaciones que contienen cursos con asignaturas que él imparte.</li>
        </ul>
    </div>
</x-filament::page>

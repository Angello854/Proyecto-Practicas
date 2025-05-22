<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agregar claves foráneas en la tabla 'alumnos'
        Schema::table('alumnos', function (Blueprint $table) {
            // Si las columnas ya existen, las podemos agregar de esta forma
            $table->foreignId('tutor_docente_id')->nullable()->constrained('tutores_docentes')->onDelete('cascade');
            $table->foreignId('tutor_laboral_id')->nullable()->constrained('tutores_laborales')->onDelete('cascade');
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->onDelete('cascade');
        });

        // Agregar la clave foránea en la tabla 'tareas'
        Schema::table('tareas', function (Blueprint $table) {
            // La columna 'alumno_id' debe existir antes de agregar la clave foránea
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Eliminar claves foráneas en la tabla 'alumnos'
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropForeign(['tutor_docente_id']);
            $table->dropForeign(['tutor_laboral_id']);
            $table->dropForeign(['empresa_id']);
        });

        // Eliminar clave foránea en la tabla 'tareas'
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign(['alumno_id']);
        });
    }
};

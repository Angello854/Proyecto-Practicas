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
        Schema::table('tables', function (Blueprint $table) {
            Schema::table('tutores', function (Blueprint $table) {
                $table->dropColumn('tutor_docente_id');
            });

            Schema::table('titulacion', function (Blueprint $table) {
                $table->dropColumn('curso_id');
            });

            Schema::table('cursos', function (Blueprint $table) {
                $table->dropColumn('asignatura_id');
            });

            Schema::table('asignaturas', function (Blueprint $table) {
                $table->dropColumn('tutor_docente_id');
            });

            Schema::table('tareas', function (Blueprint $table) {
                $table->dropColumn('asignatura');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};

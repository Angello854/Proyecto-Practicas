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
        // Eliminar las tablas antiguas si existen
        Schema::dropIfExists('alumno_tutor-docente');
        Schema::dropIfExists('alumno_profesor');

        // Crear nueva tabla alumno_profesor
        Schema::create('alumno_profesor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_profesor');
    }
};

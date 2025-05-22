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
        Schema::create('asignatura_profesor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignatura_id')->constrained()->onDelete('cascade');
            $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::dropIfExists('alumno_tutor_docente');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutores', function (Blueprint $table) {
            //
        });
    }
};

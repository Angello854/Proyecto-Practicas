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
        Schema::create('alumno_tutor_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_docente_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_tutor_docente');
    }
};

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
        Schema::create('asignatura_tutor_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignatura_id')->constrained()->onDelete('cascade');
            $table->foreignId('tutor_docente_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignatura_tutor_docente');
    }
};

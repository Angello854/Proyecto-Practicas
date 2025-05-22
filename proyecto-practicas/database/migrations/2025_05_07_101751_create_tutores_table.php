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
        Schema::create('tutores', function (Blueprint $table) {
            $table->id('alumno_id')->primary();
            $table->id('tutor_laboral_id');
            $table->id('tutor_docente_id');
            $table->id('empresa_id');
            $table->foreign('alumno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tutor_docente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tutor_laboral_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};

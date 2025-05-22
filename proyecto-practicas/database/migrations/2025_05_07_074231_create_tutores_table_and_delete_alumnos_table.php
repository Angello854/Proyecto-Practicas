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
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign(['alumno_id']);
        });
        Schema::dropIfExists('alumnos');

        Schema::create('tutores', function (Blueprint $table) {
            $table->unsignedBigInteger('alumno_id')->primary();
            $table->foreign('alumno_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tutor_laboral_id')->nullable();
            $table->unsignedBigInteger('tutor_docente_id')->nullable();
            $table->foreign('tutor_laboral_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tutor_docente_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores_table_and_delete_alumnos');
    }
};

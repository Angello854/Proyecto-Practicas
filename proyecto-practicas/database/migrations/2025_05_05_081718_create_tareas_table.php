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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->date('fecha');

            $table->json('asignatura')->nullable();

            $table->string('aprendizaje')->nullable();
            $table->string('refuerzo')->nullable();

            $table->unsignedTinyInteger('horas');
            $table->enum('materiales', ['equipo propio', 'ordenador empresa']);

            $table->text('comentarios')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};

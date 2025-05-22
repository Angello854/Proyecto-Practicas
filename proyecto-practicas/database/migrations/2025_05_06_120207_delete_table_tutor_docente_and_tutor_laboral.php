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
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropForeign(['tutor_docente_id']);
            $table->dropForeign(['tutor_laboral_id']);
            $table->dropForeign(['empresa_id']);
        });
        Schema::dropIfExists('tutores_laborales');
        Schema::dropIfExists('tutores_docentes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

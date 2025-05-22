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
            $table->dropColumn(['tutor_docente_id']);
            $table->dropColumn(['tutor_laboral_id']);
            $table->foreignId('tutor_docente_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_laboral_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            //
        });
    }
};

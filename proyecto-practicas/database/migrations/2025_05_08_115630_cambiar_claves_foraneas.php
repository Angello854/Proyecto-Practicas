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
        Schema::table('tutores', function (Blueprint $table) {

            $table->dropForeign(['tutor_docente_id']);
            $table->dropForeign(['tutor_laboral_id']);
            $table->dropForeign(['empresa_id']);


            $table->foreign('tutor_docente_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tutor_laboral_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

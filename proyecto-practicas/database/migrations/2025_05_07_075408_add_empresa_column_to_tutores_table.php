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
            Schema::table('tutores', function (Blueprint $table) {
                $table->unsignedBigInteger('empresa_id')->nullable()->after('tutor_docente_id');

                $table->foreign('empresa_id')
                    ->references('id')
                    ->on('empresas')
                    ->onDelete('set null'); // o 'cascade' según el comportamiento deseado
            });
        });
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

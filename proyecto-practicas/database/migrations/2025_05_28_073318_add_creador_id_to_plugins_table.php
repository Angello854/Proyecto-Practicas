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
        Schema::table('plugins', function (Blueprint $table) {
            $table->dropColumn('creador');
            $table->foreignId('creador_id')
                ->constrained('creadores')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plugins', function (Blueprint $table) {
            //
        });
    }
};

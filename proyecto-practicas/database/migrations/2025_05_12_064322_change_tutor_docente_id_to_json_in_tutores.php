<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tutores', function (Blueprint $table) {
            Schema::table('tutores', function ($table) {
                $table->dropForeign(['tutor_docente_id']);
            });

            DB::statement('ALTER TABLE tutores ALTER COLUMN tutor_docente_id DROP DEFAULT;');
            DB::statement('ALTER TABLE tutores ALTER COLUMN tutor_docente_id TYPE json USING to_json(tutor_docente_id);');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutores', function (Blueprint $table) {
            DB::statement('ALTER TABLE tutores ALTER COLUMN tutor_docente_id TYPE integer USING (tutor_docente_id::integer);');
        });
    }
};

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
        Schema::dropIfExists('git_issues_has_reactions');
        Schema::dropIfExists('git_issues_has_labels');
        Schema::dropIfExists('git_issues');
        Schema::dropIfExists('git_issue_owners');
        Schema::dropIfExists('git_repos');
        Schema::dropIfExists('git_orgs');
        Schema::dropIfExists('git_reactions');
        Schema::dropIfExists('git_labels');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};

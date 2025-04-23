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
        Schema::table('captive_portal_designs', function (Blueprint $table) {
            $table->text('terms_content')->nullable()->after('show_terms');
            $table->text('privacy_content')->nullable()->after('terms_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('captive_portal_designs', function (Blueprint $table) {
            $table->dropColumn('terms_content');
            $table->dropColumn('privacy_content');
        });
    }
};

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
        Schema::table('location_settings', function (Blueprint $table) {
            $table->foreignId('portal_design_id')
                ->nullable()
                ->after('location_id')
                ->constrained('captive_portal_designs')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_settings', function (Blueprint $table) {
            $table->dropForeign(['portal_design_id']);
            $table->dropColumn('portal_design_id');
        });
    }
};

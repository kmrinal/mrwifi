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
        Schema::connection('radius')->table('radacct', function (Blueprint $table) {
            $table->integer('location_id')->nullable()->after('username')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('radius')->table('radacct', function (Blueprint $table) {
            $table->dropColumn('location_id');
        });
    }
};

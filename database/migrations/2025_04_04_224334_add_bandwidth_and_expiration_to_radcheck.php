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
        Schema::connection('radius')->table('radcheck', function (Blueprint $table) {
            $table->integer('location_id')->nullable()->after('username');
            $table->integer('download_bandwidth')->nullable()->after('location_id');
            $table->integer('upload_bandwidth')->nullable()->after('download_bandwidth');
            $table->timestamp('expiration_time')->nullable()->after('upload_bandwidth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('radius')->table('radcheck', function (Blueprint $table) {
            $table->dropColumn('location_id');
            $table->dropColumn('download_bandwidth');
            $table->dropColumn('upload_bandwidth');
            $table->dropColumn('expiration_time');
        });
    }
};

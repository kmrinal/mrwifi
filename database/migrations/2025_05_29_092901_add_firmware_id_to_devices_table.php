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
        Schema::table('devices', function (Blueprint $table) {
            $table->unsignedBigInteger('firmware_id')->nullable()->after('firmware_version')
                  ->comment('Reference to the current firmware installed on device');
            
            // Add foreign key constraint
            $table->foreign('firmware_id')->references('id')->on('firmware')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['firmware_id']);
            $table->dropColumn('firmware_id');
        });
    }
};

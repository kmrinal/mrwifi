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
        Schema::table('firmware', function (Blueprint $table) {
            $table->string('model')->nullable()->after('name')->comment('Device model this firmware is for');
            
            // Add index for better performance
            $table->index('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('firmware', function (Blueprint $table) {
            $table->dropIndex(['model']);
            $table->dropColumn('model');
        });
    }
};

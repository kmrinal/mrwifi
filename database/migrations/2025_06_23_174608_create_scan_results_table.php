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
        Schema::create('scan_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('scan_id'); // This will match the device's scan_counter
            $table->enum('status', ['initiated', 'started', 'scanning_2g', 'scanning_5g', 'completed', 'failed'])->default('initiated');
            
            // 2.4G scan results
            $table->json('scan_results_2g')->nullable();
            $table->unsignedTinyInteger('optimal_channel_2g')->nullable();
            $table->unsignedInteger('nearby_networks_2g')->default(0);
            $table->enum('interference_level_2g', ['low', 'medium', 'high'])->nullable();
            
            // 5G scan results
            $table->json('scan_results_5g')->nullable();
            $table->unsignedTinyInteger('optimal_channel_5g')->nullable();
            $table->unsignedInteger('nearby_networks_5g')->default(0);
            $table->enum('interference_level_5g', ['low', 'medium', 'high'])->nullable();
            
            // Error handling
            $table->text('error_message')->nullable();
            
            // Timestamps
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['device_id', 'scan_id']);
            $table->index(['device_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_results');
    }
};

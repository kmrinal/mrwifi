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
        Schema::create('guest_network_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mac_address');
            $table->foreignId('location_id')->constrained();
            $table->timestamp('expiration_time')->nullable();
            $table->integer('download_bandwidth')->nullable();
            $table->integer('upload_bandwidth')->nullable();
            $table->boolean('blocked')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_network_users');
    }
};

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
        Schema::create('firmware', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Firmware name/version');
            $table->string('model')->nullable()->comment('Device model this firmware is for');
            $table->string('file_name')->comment('Original uploaded file name');
            $table->string('file_path')->comment('Path where the file is stored');
            $table->string('md5sum', 32)->comment('MD5 checksum of the file');
            $table->unsignedBigInteger('file_size')->comment('File size in bytes');
            $table->boolean('is_enabled')->default(true)->comment('Enable/disable firmware');
            $table->text('description')->nullable()->comment('Firmware description');
            $table->string('version')->nullable()->comment('Firmware version/release date');
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index('is_enabled');
            $table->index('md5sum');
            $table->index('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmware');
    }
};

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
        Schema::create('captive_portal_designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('theme_color')->default('#7367f0');
            $table->string('welcome_message')->default('Welcome to our WiFi');
            $table->text('login_instructions')->nullable();
            $table->string('button_text')->default('Connect to WiFi');
            $table->boolean('show_terms')->default(true);
            $table->string('location_logo_path')->nullable();
            $table->string('background_image_path')->nullable();
            $table->json('additional_settings')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
        
        // Add relationship column to locations table
        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('captive_portal_design_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captive_portal_designs');
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['captive_portal_design_id']);
            $table->dropColumn('captive_portal_design_id');
        });
    }
};

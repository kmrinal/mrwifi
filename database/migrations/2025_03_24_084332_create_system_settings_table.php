<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            
            // Captive Portal Settings
            $table->string('default_essid')->default('MrWiFi-Guest');
            $table->string('default_password')->default('Welcome123!');
            $table->string('default_guest_essid')->default('MrWiFi-Guest');
            
            $table->integer('portal_timeout')->default(1440); // Min
            $table->integer('idle_timeout')->default(30); // Minutes
            $table->integer('bandwidth_limit')->default(5); // Mbps
            $table->integer('user_limit')->default(50);
            $table->boolean('enable_terms')->default(true);
            
            // RADIUS Configuration
            $table->string('radius_ip')->nullable();
            $table->integer('radius_port')->default(1812);
            $table->string('radius_secret')->nullable();
            $table->integer('accounting_port')->default(1813);
            
            // Company Information
            $table->string('company_name')->default('Mr WiFi');
            $table->string('company_website')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('support_phone')->nullable();
            
            // Logo & Images
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('splash_background_path')->nullable();
            
            // Portal Customization
            $table->string('primary_color')->default('#7367f0');
            $table->string('secondary_color')->default('#82868b');
            $table->string('font_family')->default('montserrat');
            $table->string('portal_theme')->default('light');
            
            // Email Configuration
            $table->string('smtp_server')->nullable();
            $table->integer('smtp_port')->default(587);
            $table->string('sender_email')->nullable();
            $table->string('smtp_password')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
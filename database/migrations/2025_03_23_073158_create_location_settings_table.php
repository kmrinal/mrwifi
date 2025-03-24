<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            
            // Basic WiFi settings
            $table->string('wifi_name')->nullable();
            $table->string('wifi_password')->nullable();
            $table->boolean('wifi_visible')->default(true);
            $table->string('wifi_security_type')->default('wpa2-psk'); // wpa2-psk, wpa-wpa2-psk, wpa3-psk, wep
            
            // Captive Portal settings
            $table->boolean('captive_portal_enabled')->default(false);
            $table->string('captive_portal_ssid')->nullable();
            $table->boolean('captive_portal_visible')->default(true);
            $table->string('captive_auth_method')->default('click-through'); // click-through, password, sms, email, social
            $table->string('captive_portal_password')->nullable();
            $table->string('redirect_url')->nullable();
            $table->integer('session_timeout')->default(60); // In minutes
            $table->integer('idle_timeout')->default(15); // In minutes
            
            // Bandwidth and rate limiting
            $table->integer('bandwidth_limit')->nullable(); // In Mbps
            $table->integer('download_limit')->nullable(); // In Mbps
            $table->integer('upload_limit')->nullable(); // In Mbps
            $table->boolean('rate_limiting_enabled')->default(false);
            $table->integer('max_devices_per_user')->default(1);
            
            // Radio settings
            $table->string('country_code')->default('US');
            $table->integer('transmit_power_2g')->default(15); // In dBm
            $table->integer('transmit_power_5g')->default(17); // In dBm
            $table->integer('channel_2g')->nullable();
            $table->integer('channel_5g')->nullable();
            $table->integer('channel_width_2g')->default(40); // In MHz
            $table->integer('channel_width_5g')->default(80); // In MHz
            
            // Access control
            $table->string('mac_filter_mode')->default('allow-all'); // allow-all, allow-listed, block-listed
            $table->json('mac_filter_list')->nullable();
            $table->boolean('web_filter_enabled')->default(false);
            $table->json('web_filter_domains')->nullable();
            
            // Network settings
            $table->boolean('password_wifi_enabled')->default(true);
            $table->string('password_wifi_ip_mode')->default('static'); // static, dhcp
            $table->string('password_wifi_ip')->nullable();
            $table->string('password_wifi_netmask')->nullable();
            $table->boolean('password_wifi_dhcp_enabled')->default(true);
            $table->string('password_wifi_dhcp_start')->nullable();
            $table->string('password_wifi_dhcp_end')->nullable();
            
            // Captive portal IP settings
            $table->string('captive_portal_ip')->nullable();
            $table->string('captive_portal_netmask')->nullable();
            $table->boolean('captive_portal_dhcp_enabled')->default(true);
            $table->string('captive_portal_dhcp_start')->nullable();
            $table->string('captive_portal_dhcp_end')->nullable();
            
            // Quality of service
            $table->boolean('qos_enabled')->default(false);
            $table->string('traffic_priority')->default('high'); // high, medium, low
            $table->integer('reserved_bandwidth')->default(70); // In percentage
            
            // User data and analytics
            $table->boolean('collect_user_data')->default(false);
            $table->boolean('terms_enabled')->default(false);
            $table->text('terms_content')->nullable();
            $table->boolean('social_login_enabled')->default(false);
            $table->json('enabled_social_platforms')->nullable();
            
            // Theme and UI settings
            $table->string('theme_color')->default('#3B82F6');
            $table->string('logo_url')->nullable();
            $table->text('welcome_message')->nullable();
            $table->string('captive_portal_design')->default('default');
            
            // System settings
            $table->boolean('analytics_enabled')->default(true);
            
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
        Schema::dropIfExists('location_settings');
    }
};
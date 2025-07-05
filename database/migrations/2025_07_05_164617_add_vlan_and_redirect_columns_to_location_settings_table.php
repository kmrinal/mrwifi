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
        Schema::table('location_settings', function (Blueprint $table) {
            // Add VLAN settings for password WiFi
            $table->integer('password_wifi_vlan')->nullable()->after('password_wifi_dhcp_end');
            
            // Add VLAN settings for captive portal
            $table->integer('captive_portal_vlan')->nullable()->after('captive_portal_dhcp_end');
            
            // Add redirect settings for captive portal
            $table->string('captive_portal_redirect')->nullable()->after('captive_portal_vlan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_settings', function (Blueprint $table) {
            $table->dropColumn(['password_wifi_vlan', 'captive_portal_vlan', 'captive_portal_redirect']);
        });
    }
};

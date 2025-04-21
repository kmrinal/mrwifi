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
            $table->string('captive_portal_gateway')->nullable()->after('captive_portal_netmask');
            // Captive DNS Settings, password DNS
            $table->string('captive_portal_dns1')->nullable()->after('captive_portal_gateway');
            $table->string('captive_portal_dns2')->nullable()->after('captive_portal_dns1');
            $table->string('password_wifi_dns1')->nullable()->after('password_wifi_dhcp_end');
            $table->string('password_wifi_dns2')->nullable()->after('password_wifi_dns1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_settings', function (Blueprint $table) {
            $table->dropColumn([
                'captive_portal_gateway',
                'captive_portal_dns1',
                'captive_portal_dns2',
                'password_wifi_dns1',
                'password_wifi_dns2'
            ]);
        });
    }
};

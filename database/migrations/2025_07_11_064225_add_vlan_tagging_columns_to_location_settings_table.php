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
            $table->string('captive_portal_vlan_tagging')->default('disabled')->after('captive_portal_redirect');
            $table->string('password_wifi_vlan_tagging')->default('disabled')->after('captive_portal_vlan_tagging');
            $table->boolean('vlan_enabled')->default(false)->after('password_wifi_vlan_tagging');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_settings', function (Blueprint $table) {
            $table->dropColumn(['captive_portal_vlan_tagging', 'password_wifi_vlan_tagging', 'vlan_enabled']);
        });
    }
};

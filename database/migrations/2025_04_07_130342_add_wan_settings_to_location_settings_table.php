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
            // WAN Connection Type
            $table->string('wan_connection_type')->default('dhcp'); // dhcp, static, pppoe
            
            // Static IP Settings
            $table->string('wan_ip_address')->nullable();
            $table->string('wan_netmask')->nullable();
            $table->string('wan_gateway')->nullable();
            $table->string('wan_primary_dns')->nullable();
            $table->string('wan_secondary_dns')->nullable();
            
            // PPPoE Settings
            $table->string('wan_pppoe_username')->nullable();
            $table->string('wan_pppoe_password')->nullable();
            $table->string('wan_pppoe_service_name')->nullable();
            
            // Additional WAN Settings
            $table->boolean('wan_enabled')->default(true);
            $table->string('wan_mac_address')->nullable();
            $table->integer('wan_mtu')->default(1500);
            $table->boolean('wan_nat_enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_settings', function (Blueprint $table) {
            $table->dropColumn([
                'wan_connection_type',
                'wan_ip_address',
                'wan_netmask',
                'wan_gateway',
                'wan_primary_dns',
                'wan_secondary_dns',
                'wan_pppoe_username',
                'wan_pppoe_password',
                'wan_pppoe_service_name',
                'wan_enabled',
                'wan_mac_address',
                'wan_mtu',
                'wan_nat_enabled'
            ]);
        });
    }
};

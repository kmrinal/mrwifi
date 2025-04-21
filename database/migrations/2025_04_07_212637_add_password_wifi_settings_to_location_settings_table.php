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
            $table->string('password_wifi_ip_type')->default(false)->default('static')->after('password_wifi_enabled');
            $table->string('password_wifi_ssid')->nullable(false)->default('monsieur-wifi');
            $table->string('password_wifi_password')->nullable(false)->default('abcd1234');
            $table->string('password_wifi_security')->nullable(false)->default('wpa2-psk');
            $table->string('password_wifi_cipher_suites')->nullable(false)->default('CCMP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_settings', function (Blueprint $table) {
            $table->dropColumn('password_wifi_ip_type');
            $table->dropColumn('password_wifi_ssid');
            $table->dropColumn('password_wifi_password');
            $table->dropColumn('password_wifi_security');
            $table->dropColumn('password_wifi_cipher_suites');
        });
    }
};

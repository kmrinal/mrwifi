<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update all NULL values with default values
        $this->updateNullValues();
        
        // Then alter the columns to set the defaults at the database level
        Schema::table('location_settings', function (Blueprint $table) {
            // Basic WiFi settings
            $table->string('wifi_name')->default('MrWiFi Network')->change();
            $table->string('wifi_password')->default('password123')->change();
            
            // Captive Portal settings
            $table->string('captive_portal_ssid')->default('MrWiFi Guest')->change();
            $table->string('captive_portal_password')->default('guest123')->change();
            $table->string('redirect_url')->default('https://mrwifi.com/welcome')->change();
            
            // Bandwidth and rate limiting
            $table->integer('bandwidth_limit')->default(100)->change(); // 100 Mbps
            $table->integer('download_limit')->default(50)->change(); // 50 Mbps
            $table->integer('upload_limit')->default(25)->change(); // 25 Mbps
            
            // Radio settings
            $table->integer('channel_2g')->default(6)->change();
            $table->integer('channel_5g')->default(36)->change();
            
            // Access control - JSON fields will stay nullable, but we'll update them
            
            // Network settings
            $table->string('password_wifi_ip')->default('192.168.1.1')->change();
            $table->string('password_wifi_netmask')->default('255.255.255.0')->change();
            $table->string('password_wifi_dhcp_start')->default('192.168.1.100')->change();
            $table->string('password_wifi_dhcp_end')->default('192.168.1.200')->change();
            $table->string('password_wifi_dns1')->default('8.8.8.8')->change();
            $table->string('password_wifi_dns2')->default('8.8.4.4')->change();
            
            // Captive portal IP settings
            $table->string('captive_portal_ip')->default('192.168.2.1')->change();
            $table->string('captive_portal_netmask')->default('255.255.255.0')->change();
            $table->string('captive_portal_gateway')->default('192.168.2.1')->change();
            $table->string('captive_portal_dns1')->default('8.8.8.8')->change();
            $table->string('captive_portal_dns2')->default('8.8.4.4')->change();
            $table->string('captive_portal_dhcp_start')->default('192.168.2.100')->change();
            $table->string('captive_portal_dhcp_end')->default('192.168.2.200')->change();
            
            // Theme and UI settings
            $table->string('logo_url')->default('/images/default-logo.png')->change();
            $table->text('welcome_message')->change(); // Text columns cannot have defaults in MySQL
            
            // WAN Settings
            $table->string('wan_ip_address')->default('192.168.0.2')->change();
            $table->string('wan_netmask')->default('255.255.255.0')->change();
            $table->string('wan_gateway')->default('192.168.0.1')->change();
            $table->string('wan_primary_dns')->default('8.8.8.8')->change();
            $table->string('wan_secondary_dns')->default('8.8.4.4')->change();
            $table->string('wan_pppoe_username')->default('user')->change();
            $table->string('wan_pppoe_password')->default('password')->change();
            $table->string('wan_pppoe_service_name')->default('Internet')->change();
            $table->string('wan_mac_address')->default('00:00:00:00:00:00')->change();
        });
    }

    /**
     * Update all NULL values with default values
     */
    private function updateNullValues(): void
    {
        $defaultValues = [
            // Basic WiFi settings
            'wifi_name' => 'MrWiFi Network',
            'wifi_password' => 'password123',
            
            // Captive Portal settings
            'captive_portal_ssid' => 'MrWiFi Guest',
            'captive_portal_password' => 'guest123',
            'redirect_url' => 'https://mrwifi.com/welcome',
            
            // Bandwidth and rate limiting
            'bandwidth_limit' => 100,
            'download_limit' => 50,
            'upload_limit' => 25,
            
            // Radio settings
            'channel_2g' => 6,
            'channel_5g' => 36,
            
            // Access control
            'mac_filter_list' => '[]',
            'web_filter_domains' => '[]',
            
            // Network settings
            'password_wifi_ip' => '192.168.1.1',
            'password_wifi_netmask' => '255.255.255.0',
            'password_wifi_dhcp_start' => '192.168.1.100',
            'password_wifi_dhcp_end' => '192.168.1.200',
            'password_wifi_dns1' => '8.8.8.8',
            'password_wifi_dns2' => '8.8.4.4',
            
            // Captive portal IP settings
            'captive_portal_ip' => '192.168.2.1',
            'captive_portal_netmask' => '255.255.255.0',
            'captive_portal_gateway' => '192.168.2.1',
            'captive_portal_dns1' => '8.8.8.8',
            'captive_portal_dns2' => '8.8.4.4',
            'captive_portal_dhcp_start' => '192.168.2.100',
            'captive_portal_dhcp_end' => '192.168.2.200',
            
            // User data and analytics
            'enabled_social_platforms' => '["facebook", "google"]',
            'terms_content' => 'By using our WiFi service, you agree to our terms and conditions.',
            
            // Theme and UI settings
            'logo_url' => '/images/default-logo.png',
            'welcome_message' => 'Welcome to MrWiFi Network',
            
            // WAN Settings
            'wan_ip_address' => '192.168.0.2',
            'wan_netmask' => '255.255.255.0',
            'wan_gateway' => '192.168.0.1',
            'wan_primary_dns' => '8.8.8.8',
            'wan_secondary_dns' => '8.8.4.4',
            'wan_pppoe_username' => 'user',
            'wan_pppoe_password' => 'password',
            'wan_pppoe_service_name' => 'Internet',
            'wan_mac_address' => '00:00:00:00:00:00',
        ];
        
        // Update all nullable fields with default values
        foreach ($defaultValues as $column => $defaultValue) {
            DB::table('location_settings')
                ->whereNull($column)
                ->update([$column => $defaultValue]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No specific rollback needed since we're just setting defaults
    }
}; 
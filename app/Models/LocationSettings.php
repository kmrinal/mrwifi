<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        // Basic WiFi settings
        'wifi_name',
        'wifi_password',
        'wifi_visible',
        'wifi_security_type',
        
        // Captive Portal settings
        'captive_portal_enabled',
        'captive_portal_ssid',
        'captive_portal_visible',
        'captive_auth_method',
        'captive_portal_password',
        'redirect_url',
        'session_timeout',
        'idle_timeout',
        
        // Bandwidth and rate limiting
        'bandwidth_limit',
        'download_limit',
        'upload_limit',
        'rate_limiting_enabled',
        'max_devices_per_user',
        
        // Radio settings
        'country_code',
        'transmit_power_2g',
        'transmit_power_5g',
        'channel_2g',
        'channel_5g',
        'channel_width_2g',
        'channel_width_5g',
        
        // Access control
        'mac_filter_mode',
        'mac_filter_list',
        'web_filter_enabled',
        'web_filter_domains',
        'web_filter_categories',
        
        // Network settings
        'password_wifi_enabled',
        'password_wifi_ssid',
        'password_wifi_password',
        'password_wifi_security',
        'password_wifi_cipher_suites',
        'password_wifi_ip_mode',
        'password_wifi_ip',
        'password_wifi_netmask',
        'password_wifi_dhcp_enabled',
        'password_wifi_dhcp_start',
        'password_wifi_dhcp_end',
        
        // Captive portal IP settings
        'captive_portal_ip',
        'captive_portal_netmask',
        'captive_portal_gateway',
        'captive_portal_dhcp_enabled',
        'captive_portal_dhcp_start',
        'captive_portal_dhcp_end',
        
        // Quality of service
        'qos_enabled',
        'traffic_priority',
        'reserved_bandwidth',
        
        // User data and analytics
        'collect_user_data',
        'terms_enabled',
        'terms_content',
        'social_login_enabled',
        'enabled_social_platforms',
        
        // Theme and UI settings
        'theme_color',
        'logo_url',
        'welcome_message',
        'captive_portal_design',
        
        // System settings
        'analytics_enabled',
        
        // WAN Settings
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
        'wan_nat_enabled',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Boolean casts
        'wifi_visible' => 'boolean',
        'captive_portal_enabled' => 'boolean',
        'captive_portal_visible' => 'boolean',
        'rate_limiting_enabled' => 'boolean',
        'web_filter_enabled' => 'boolean',
        'password_wifi_enabled' => 'boolean',
        'password_wifi_dhcp_enabled' => 'boolean',
        'captive_portal_dhcp_enabled' => 'boolean',
        'qos_enabled' => 'boolean',
        'collect_user_data' => 'boolean',
        'terms_enabled' => 'boolean',
        'social_login_enabled' => 'boolean',
        'analytics_enabled' => 'boolean',
        
        // JSON casts
        'enabled_social_platforms' => 'json',
        'mac_filter_list' => 'json',
        'web_filter_domains' => 'json',
        'web_filter_categories' => 'json',
        
        // Integer casts
        'session_timeout' => 'integer',
        'idle_timeout' => 'integer',
        'bandwidth_limit' => 'integer',
        'download_limit' => 'integer',
        'upload_limit' => 'integer',
        'max_devices_per_user' => 'integer',
        'transmit_power_2g' => 'integer',
        'transmit_power_5g' => 'integer',
        'channel_2g' => 'integer',
        'channel_5g' => 'integer',
        'channel_width_2g' => 'integer',
        'channel_width_5g' => 'integer',
        'reserved_bandwidth' => 'integer',
        
        // WAN Settings casts
        'wan_enabled' => 'boolean',
        'wan_nat_enabled' => 'boolean',
        'wan_mtu' => 'integer',
    ];

    /**
     * Get the location that owns the settings.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the device associated with the location settings.
     */
    public function device()
    {
        return $this->hasOneThrough(Device::class, Location::class, 'id', 'location_id', 'location_id');
    }

    /**
     * Check if the captive portal feature is active.
     *
     * @return bool
     */
    public function isCaptivePortalActive()
    {
        return $this->captive_portal_enabled && $this->location && $this->location->status === 'active';
    }

    /**
     * Get the full URL for the logo with fallback to default.
     *
     * @return string
     */
    public function getLogoUrlAttribute($value)
    {
        return !empty($value) ? $value : config('app.url') . '/images/default-logo.png';
    }

    /**
     * Check if data collection is allowed based on settings and privacy regulations.
     *
     * @return bool
     */
    public function isDataCollectionAllowed()
    {
        // Respect explicit settings first
        if (!$this->collect_user_data) {
            return false;
        }

        // Here you could implement additional checks based on the location country
        // and applicable privacy laws like GDPR for EU locations, etc.
        return true;
    }

    /**
     * Get the web filter categories as a collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWebFilterCategoriesCollection()
    {
        if (!$this->web_filter_categories || !is_array($this->web_filter_categories)) {
            return collect();
        }
        
        return Category::whereIn('id', $this->web_filter_categories)
                       ->enabled()
                       ->ordered()
                       ->get();
    }

    /**
     * Get the blocked domains based on selected categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBlockedDomainsFromCategories()
    {
        if (!$this->web_filter_enabled || !$this->web_filter_categories) {
            return collect();
        }
        
        return BlockedDomain::whereIn('category_id', $this->web_filter_categories)
                           ->active()
                           ->get();
    }

    /**
     * Check if web filtering is active and configured.
     *
     * @return bool
     */
    public function isWebFilteringActive()
    {
        return $this->web_filter_enabled && 
               ($this->web_filter_categories || $this->web_filter_domains);
    }

    /**
     * Determine if a guest device should be granted access based on current settings.
     *
     * @param array $deviceData Information about the device requesting access
     * @return bool
     */
    public function shouldAllowAccess($deviceData)
    {
        // Example implementation - this would be customized based on your business logic
        if (!$this->captive_portal_enabled) {
            return true; // Open network, always allow
        }
        
        if ($this->max_devices_per_user > 0) {
            // Here you would check the current device count for the user
            // For illustration only:
            // $currentDeviceCount = UserDevice::where('user_id', $deviceData['user_id'])->count();
            // if ($currentDeviceCount >= $this->max_devices_per_user) {
            //     return false;
            // }
        }
        
        return true;
    }
}

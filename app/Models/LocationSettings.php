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
        // WiFi Network Settings
        'wifi_name',
        'wifi_password',
        'broadcast_ssid',
        'encryption_type',
        'wifi_channel',
        'wifi_bandwidth',
        'qos_enabled',
        
        // Captive Portal Settings
        'captive_portal_enabled',
        'redirect_url',
        'session_timeout',
        'idle_timeout',
        'bandwidth_limit_up',
        'bandwidth_limit_down',
        'data_cap_limit',
        'data_cap_period',
        
        // User Experience Settings
        'collect_user_data',
        'terms_enabled',
        'terms_content',
        'privacy_policy_content',
        'social_login_enabled',
        'enabled_social_platforms',
        'email_login_enabled',
        'phone_login_enabled',
        'verification_required',
        
        // Access Control
        'access_control_enabled',
        'allowed_domains',
        'blocked_domains',
        'content_filtering_level',
        'rate_limiting_enabled',
        'max_devices_per_user',
        'device_expiration_time',
        
        // Branding and Customization
        'theme_color',
        'secondary_color',
        'logo_url',
        'background_image_url',
        'welcome_message',
        'success_message',
        'footer_text',
        
        // Analytics and Reporting
        'analytics_enabled',
        'google_analytics_id',
        'custom_analytics_script',
        'data_retention_days',
        
        // Advanced Settings
        'timezone',
        'login_attempts_limit',
        'admin_notification_email',
        'maintenance_mode',
        'hotspot_type',
        'api_access_enabled',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Boolean casts
        'captive_portal_enabled' => 'boolean',
        'broadcast_ssid' => 'boolean',
        'qos_enabled' => 'boolean',
        'collect_user_data' => 'boolean',
        'terms_enabled' => 'boolean',
        'social_login_enabled' => 'boolean',
        'email_login_enabled' => 'boolean',
        'phone_login_enabled' => 'boolean',
        'verification_required' => 'boolean',
        'access_control_enabled' => 'boolean',
        'rate_limiting_enabled' => 'boolean',
        'analytics_enabled' => 'boolean',
        'api_access_enabled' => 'boolean',
        'maintenance_mode' => 'boolean',
        
        // JSON casts
        'enabled_social_platforms' => 'json',
        'allowed_domains' => 'json',
        'blocked_domains' => 'json',
        
        // Integer casts
        'wifi_channel' => 'integer',
        'session_timeout' => 'integer',
        'idle_timeout' => 'integer',
        'bandwidth_limit_up' => 'integer',
        'bandwidth_limit_down' => 'integer',
        'data_cap_limit' => 'integer',
        'max_devices_per_user' => 'integer',
        'login_attempts_limit' => 'integer',
        'data_retention_days' => 'integer',
        
        // Other casts
        'device_expiration_time' => 'datetime',
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

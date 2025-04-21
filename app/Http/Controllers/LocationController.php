<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Device;
use App\Models\LocationSettings;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // For web routes only, API routes already have middleware defined
        if (request()->is('api/*')) {
            // Don't apply middleware for API routes
        } else {
            $this->middleware('auth');
            $this->middleware('role:admin');
        }
    }

    /**
     * Display a listing of the locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get locations with their associated devices
        $locations = Location::with('device')->get();
        
        // Determine online status for each location's device
        $locationsWithStatus = $locations->map(function ($location) {
            // Create a new array with location data
            $locationData = $location->toArray();
            
            // Default status is offline
            $locationData['online_status'] = 'offline';
            
            // Check if device exists and has last_seen timestamp
            if ($location->device && $location->device->last_seen) {
                $lastSeen = new \DateTime($location->device->last_seen);
                $now = new \DateTime();
                $interval = $now->getTimestamp() - $lastSeen->getTimestamp();
                
                // If last_seen is within 90 seconds, device is online
                if ($interval <= 90) {
                    $locationData['online_status'] = 'online';
                }
                
                // Add last_seen timestamp to the response
                $locationData['last_seen'] = $location->device->last_seen;
            }
            $locationData['users'] = 0;
            $locationData['data_usage'] = 0;
            $locationData['settings'] = LocationSettings::where('location_id', $location->id)->first();
            return $locationData;
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Locations fetched successfully',
            'locations' => $locationsWithStatus
        ]);
    }

    /**
     * Show the form for creating a new location.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Store location request received');
        Log::info($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
            'manager_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'mac_address' => 'required|string|max:255|unique:devices,mac_address',
            // 'device_name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:devices,serial_number',
        ]);

        // Create a new device
        $device = new Device();
        // $mac_address = strtoupper($request->mac_address);
        $mac_address = str_replace(':', '-', $request->mac_address);
        $device->name = $request->mac_address;
        $device->mac_address = $mac_address;
        $device->configuration_version = 1;
        if ($request->serial_number) {
            $device->serial_number = $request->serial_number;
        } else {
            $device->serial_number = Str::random(20);
        }
        $device->device_key = Str::random(20);
        $device->device_secret = Str::random(30);
        $device->save();

        // Create the location with the device
        $location = new Location($request->except(['mac_address', 'device_name', 'serial_number']));
        $location->device_id = $device->id;
        $location->user_id = Auth::id();
        $location->save();

        // Create the location settings
        $locationSettings = new LocationSettings();
        $locationSettings->location_id = $location->id;
        // Get values from system settings and set default values
        $systemSettings = SystemSetting::first();
        $locationSettings->captive_portal_enabled = true;
        $locationSettings->wifi_name = $systemSettings->default_essid;
        $locationSettings->wifi_password = $systemSettings->default_password;
        $locationSettings->captive_portal_ssid = 'Mr WiFi Guest';
        $locationSettings->wifi_security_type = 'WPA2';
        // $locationSettings->wifi_channel = 1;
        // $locationSettings->wifi_bandwidth = '20MHz';
        // $locationSettings->wifi_channel_width = '20MHz';
        // $locationSettings->wifi_channel_width_5g = '20MHz';
        
        $locationSettings->captive_portal_visible = true;
        $locationSettings->captive_portal_enabled = true;
        $locationSettings->save();

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Location and device created successfully.',
            'location' => $location,
            'device' => $device
        ]);
    }

    /**
     * Display the specified location.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        $device = Device::find($location->device_id);
        $locationSettings = LocationSettings::where('location_id', $id)->first();
        $locationData = $location->toArray();
        $locationData['settings'] = $locationSettings;
        $locationData['device'] = $device;
        $device->is_online = false;
        // If device last_seen is older than 90 seconds, set device online to false
        if ($device->last_seen) {
            $now = new \DateTime();
            $lastSeen = new \DateTime($device->last_seen);
            $interval = $now->getTimestamp() - $lastSeen->getTimestamp();
            if ($interval <= 90) {
                $device->is_online = true;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Location fetched successfully',
            'location' => $locationData
        ]);
    }

    /**
     * Show the form for editing the specified location.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $location_id)
    {
        Log::info('Update location request received');
        Log::info($request->all());

        // Check if it's a settings update
        if ($request->has('settings') && $request->has('settings_type')) {
            $settingsType = $request->input('settings_type');
            $settings = $request->input('settings');
            $location = Location::find($location_id);
            $increment_version = 0;
            $device = Device::find($location->device_id);
            Log::info('settings: ');
            Log::info($settings);
            Log::info('settingsType: ' . $settingsType);
            
            try {
                // Find the location settings
                $locationSettings = LocationSettings::where('location_id', $location_id)->first();
                
                // If settings don't exist, create them
                if (!$locationSettings) {
                    $locationSettings = new LocationSettings();
                    $locationSettings->location_id = $location_id;
                }
                
                // Handle different types of settings
                if ($settingsType === 'captive' || $settingsType === 'captive_portal') {
                    // Update captive portal settings
                    if (isset($settings['captive_portal_ssid'])) {
                        if ($settings['captive_portal_ssid'] !== $locationSettings->captive_portal_ssid) {
                            $increment_version = 1;
                            Log::info('Captive portal ssid updated');
                        }
                        $locationSettings->captive_portal_ssid = $settings['captive_portal_ssid'];
                    }
                    
                    if (isset($settings['captive_portal_visible'])) {
                        // Convert both values to boolean for proper comparison
                        $newValue = (bool)$settings['captive_portal_visible'];
                        $oldValue = (bool)$locationSettings->captive_portal_visible;
                        
                        if ($newValue !== $oldValue) {
                            $increment_version = 1;
                            Log::info('Captive portal visible updated');
                            Log::info('New value: ' . ($newValue ? 1 : 0));
                            Log::info('Old value: ' . ($oldValue ? 1 : 0));
                        }
                        $locationSettings->captive_portal_visible = $newValue;
                        Log::info('Captive portal visible updated to: ' . ($newValue ? 1 : 0));
                    }
                    
                    if (isset($settings['captive_portal_enabled'])) {
                        if ($settings['captive_portal_enabled'] !== $locationSettings->captive_portal_enabled) {
                            $increment_version = 1;
                            Log::info('Captive portal enabled updated');
                        }
                        $locationSettings->captive_portal_enabled = $settings['captive_portal_enabled'];
                    }

                    if (isset($settings['captive_portal_ip'])) {
                        if ($settings['captive_portal_ip'] !== $locationSettings->captive_portal_ip) {
                            $increment_version = 1;
                            Log::info('Captive portal ip updated');
                        }
                        $locationSettings->captive_portal_ip = $settings['captive_portal_ip'];
                    }

                    if (isset($settings['captive_portal_netmask'])) {
                        if ($settings['captive_portal_netmask'] !== $locationSettings->captive_portal_netmask) {
                            $increment_version = 1;
                            Log::info('Captive portal netmask updated');
                        }
                        $locationSettings->captive_portal_netmask = $settings['captive_portal_netmask'];
                    }

                    if (isset($settings['captive_portal_gateway'])) {
                        if ($settings['captive_portal_gateway'] !== $locationSettings->captive_portal_gateway) {
                            $increment_version = 1;
                            Log::info('Captive portal gateway updated');
                        }
                        $locationSettings->captive_portal_gateway = $settings['captive_portal_gateway'];
                    }

                    if (isset($settings['captive_auth_method'])) {
                        if ($settings['captive_auth_method'] !== $locationSettings->captive_auth_method) {
                            $increment_version = 1;
                            Log::info('Captive portal auth method updated');
                        }
                        $locationSettings->captive_auth_method = $settings['captive_auth_method'];
                        if ($settings['captive_auth_method'] === 'password') {
                            $locationSettings->captive_portal_password = $settings['captive_portal_password'];
                        }
                    
                        if (isset($settings['captive_social_auth_method'])) {
                            if ($settings['captive_social_auth_method'] !== $locationSettings->captive_social_auth_method) {
                                $increment_version = 1;
                                Log::info('Captive portal social auth method updated');
                            }
                            $locationSettings->captive_social_auth_method = $settings['captive_social_auth_method'];
                        }
                    }
                    if (isset($settings['captive_portal_dns1'])) {
                        if ($settings['captive_portal_dns1'] !== $locationSettings->captive_portal_dns1) {
                            $increment_version = 1;
                            Log::info('Captive portal dns1 updated');
                        }
                        $locationSettings->captive_portal_dns1 = $settings['captive_portal_dns1'];
                    }

                    if (isset($settings['captive_portal_dns2'])) {
                        if ($settings['captive_portal_dns2'] !== $locationSettings->captive_portal_dns2) {
                            $increment_version = 1;
                            Log::info('Captive portal dns2 updated');
                        }
                        $locationSettings->captive_portal_dns2 = $settings['captive_portal_dns2'];
                    }
                
                    // Session settings
                    if (isset($settings['session_timeout'])) {
                        $locationSettings->session_timeout = $settings['session_timeout'];
                    }
                    
                    if (isset($settings['idle_timeout'])) {
                        $locationSettings->idle_timeout = $settings['idle_timeout'];
                    }
                    
                    // Access control
                    if (isset($settings['access_control_enabled'])) {
                        // Convert both values to boolean for proper comparison
                        $newValue = (bool)$settings['access_control_enabled'];
                        $oldValue = (bool)$locationSettings->web_filter_enabled;
                        
                        if ($newValue !== $oldValue) {
                            $increment_version = 1;
                            Log::info('Access control enabled updated');
                            Log::info($newValue);
                            Log::info($oldValue);
                        }
                        $locationSettings->web_filter_enabled = $newValue;
                    }
                    
                    if (isset($settings['allowed_domains'])) {
                        if ($settings['allowed_domains'] !== $locationSettings->web_filter_domains) {
                            $increment_version = 1;
                            Log::info('Allowed domains updated');
                        }
                        $locationSettings->web_filter_domains = $settings['allowed_domains'];
                    }
                    
                    // Bandwidth settings
                    if (isset($settings['captive_download_limit'])) {
                        if ($settings['captive_download_limit'] !== $locationSettings->download_limit) {
                            # $increment_version = 1;
                            Log::info('Bandwidth limit up updated');
                        }
                        $locationSettings->download_limit = $settings['captive_download_limit'];
                    }
                    
                    if (isset($settings['captive_upload_limit'])) {
                        if ($settings['captive_upload_limit'] !== $locationSettings->upload_limit) {
                            # $increment_version = 1;
                            Log::info('Bandwidth limit down updated');
                        }
                        $locationSettings->upload_limit = $settings['captive_upload_limit'];
                    }
                    
                    // Captive Portal Design ID
                    if (isset($settings['captive_portal_design'])) {
                        if ($settings['captive_portal_design'] !== $locationSettings->captive_portal_design) {
                            Log::info('Captive portal design updated from ' . 
                                $locationSettings->captive_portal_design . ' to ' . 
                                $settings['captive_portal_design']);
                        }
                        $locationSettings->captive_portal_design = $settings['captive_portal_design'];
                    }
                    
                    Log::info('Updating captive portal settings for location: ' . $location->id);
                } 
                elseif ($settingsType === 'wifi') {
                    // Update secured WiFi settings
                    if (isset($settings['wifi_name'])) {
                        if ($settings['wifi_name'] !== $locationSettings->wifi_name) {
                            $increment_version = 1;
                            Log::info('Wifi name updated');
                        }
                        $locationSettings->wifi_name = $settings['wifi_name'];
                    }
                    
                    if (isset($settings['wifi_password'])) {
                        if ($settings['wifi_password'] !== $locationSettings->wifi_password) {
                            $increment_version = 1;
                            Log::info('Wifi password updated');
                        }
                        $locationSettings->wifi_password = $settings['wifi_password'];
                    }
                    
                    if (isset($settings['encryption_type'])) {
                        if ($settings['encryption_type'] !== $locationSettings->wifi_security_type) {
                            $increment_version = 1;
                            Log::info('Wifi security type updated');
                        }
                        $locationSettings->wifi_security_type = $settings['encryption_type'];
                    }
                    
                    // Access control for secured WiFi
                    if (isset($settings['access_control_enabled'])) {
                        if ($settings['access_control_enabled'] !== $locationSettings->web_filter_enabled) {
                            $increment_version = 1;
                            Log::info('Access control enabled updated');
                        }
                        $locationSettings->web_filter_enabled = $settings['access_control_enabled'];
                    }
                    
                    if (isset($settings['blocked_domains'])) {
                        if ($settings['blocked_domains'] !== $locationSettings->web_filter_domains) {
                            $increment_version = 1;
                            Log::info('Blocked domains updated');
                        }
                        $locationSettings->web_filter_domains = $settings['blocked_domains'];
                    }
                    
                    Log::info('Updating secured WiFi settings for location: ' . $location->id);
                }
                elseif ($settingsType === 'router') {
                    // Update router settings
                    if (isset($settings['wifi_country'])) {
                        if ($settings['wifi_country'] !== $locationSettings->country_code) {
                            $increment_version = 1;
                            Log::info('Wifi country updated');
                        }
                        $locationSettings->country_code = $settings['wifi_country'];
                    }
                    
                    if (isset($settings['power_level_2g'])) {
                        if ($settings['power_level_2g'] !== $locationSettings->transmit_power_2g) {
                            $increment_version = 1;
                            Log::info('Power level 2g updated');
                        }
                        $locationSettings->transmit_power_2g = $settings['power_level_2g'];
                    }
                    
                    if (isset($settings['power_level_5g'])) {
                        if ($settings['power_level_5g'] !== $locationSettings->transmit_power_5g) {
                            $increment_version = 1;
                            Log::info('Power level 5g updated');
                        }
                        $locationSettings->transmit_power_5g = $settings['power_level_5g'];
                    }
                    
                    if (isset($settings['channel_width_2g'])) {
                        if ($settings['channel_width_2g'] !== $locationSettings->channel_width_2g) {
                            $increment_version = 1;
                            Log::info('Channel width 2g updated');
                        }
                        $locationSettings->channel_width_2g = $settings['channel_width_2g'];
                    }
                    
                    if (isset($settings['channel_width_5g'])) {
                        if ($settings['channel_width_5g'] !== $locationSettings->channel_width_5g) {
                            $increment_version = 1;
                            Log::info('Channel width 5g updated');
                        }
                        $locationSettings->channel_width_5g = $settings['channel_width_5g'];
                    }
                    
                    if (isset($settings['channel_2g'])) {
                        if ($settings['channel_2g'] !== $locationSettings->channel_2g) {
                            $increment_version = 1;
                            Log::info('Channel 2g updated');
                        }
                        $locationSettings->channel_2g = $settings['channel_2g'];
                    }
                    
                    if (isset($settings['channel_5g'])) {
                        if ($settings['channel_5g'] !== $locationSettings->channel_5g) {
                            $increment_version = 1;
                            Log::info('Channel 5g updated');
                        }
                        $locationSettings->channel_5g = $settings['channel_5g'];
                    }
                    
                    Log::info('Updating router settings for location: ' . $location->id);
                }
                elseif ($settingsType === 'wan') {
                    // Update WAN settings
                    if (isset($settings['wan_connection_type'])) {
                        if ($settings['wan_connection_type'] !== $locationSettings->wan_connection_type) {
                            $increment_version = 1;
                            Log::info('WAN connection type updated');
                        }
                        $locationSettings->wan_connection_type = $settings['wan_connection_type'];
                    }

                    if (isset($settings['wan_enabled'])) {
                        if ($settings['wan_enabled'] !== $locationSettings->wan_enabled) {
                            $increment_version = 1;
                            Log::info('WAN enabled status updated');
                        }
                        $locationSettings->wan_enabled = $settings['wan_enabled'];
                    }

                    if (isset($settings['wan_nat_enabled'])) {
                        if ($settings['wan_nat_enabled'] !== $locationSettings->wan_nat_enabled) {
                            $increment_version = 1;
                            Log::info('WAN NAT status updated');
                        }
                        $locationSettings->wan_nat_enabled = $settings['wan_nat_enabled'];
                    }

                    // Static IP settings
                    if ($settings['wan_connection_type'] === 'static') {
                        if (isset($settings['wan_ip_address'])) {
                            if ($settings['wan_ip_address'] !== $locationSettings->wan_ip_address) {
                                $increment_version = 1;
                                Log::info('WAN IP address updated');
                            }
                            $locationSettings->wan_ip_address = $settings['wan_ip_address'];
                        }

                        if (isset($settings['wan_netmask'])) {
                            if ($settings['wan_netmask'] !== $locationSettings->wan_netmask) {
                                $increment_version = 1;
                                Log::info('WAN netmask updated');
                            }
                            $locationSettings->wan_netmask = $settings['wan_netmask'];
                        }

                        if (isset($settings['wan_gateway'])) {
                            if ($settings['wan_gateway'] !== $locationSettings->wan_gateway) {
                                $increment_version = 1;
                                Log::info('WAN gateway updated');
                            }
                            $locationSettings->wan_gateway = $settings['wan_gateway'];
                        }

                        if (isset($settings['wan_primary_dns'])) {
                            if ($settings['wan_primary_dns'] !== $locationSettings->wan_primary_dns) {
                                $increment_version = 1;
                                Log::info('WAN primary DNS updated');
                            }
                            $locationSettings->wan_primary_dns = $settings['wan_primary_dns'];
                        }

                        if (isset($settings['wan_secondary_dns'])) {
                            if ($settings['wan_secondary_dns'] !== $locationSettings->wan_secondary_dns) {
                                $increment_version = 1;
                                Log::info('WAN secondary DNS updated');
                            }
                            $locationSettings->wan_secondary_dns = $settings['wan_secondary_dns'];
                        }
                    }

                    // PPPoE settings
                    if ($settings['wan_connection_type'] === 'pppoe') {
                        if (isset($settings['wan_pppoe_username'])) {
                            if ($settings['wan_pppoe_username'] !== $locationSettings->wan_pppoe_username) {
                                $increment_version = 1;
                                Log::info('WAN PPPoE username updated');
                            }
                            $locationSettings->wan_pppoe_username = $settings['wan_pppoe_username'];
                        }

                        if (isset($settings['wan_pppoe_password'])) {
                            if ($settings['wan_pppoe_password'] !== $locationSettings->wan_pppoe_password) {
                                $increment_version = 1;
                                Log::info('WAN PPPoE password updated');
                            }
                            $locationSettings->wan_pppoe_password = $settings['wan_pppoe_password'];
                        }

                        if (isset($settings['wan_pppoe_service_name'])) {
                            if ($settings['wan_pppoe_service_name'] !== $locationSettings->wan_pppoe_service_name) {
                                $increment_version = 1;
                                Log::info('WAN PPPoE service name updated');
                            }
                            $locationSettings->wan_pppoe_service_name = $settings['wan_pppoe_service_name'];
                        }
                    }

                    Log::info('Updating WAN settings for location: ' . $location->id);
                } elseif ($settingsType === 'password' || $settingsType === 'password_network') {
                    Log::info('Updating password network settings for location: ' . $location->id);
                    // Update password network settings
                    if (isset($settings['password_wifi_enabled'])) {
                        if ($settings['password_wifi_enabled'] !== $locationSettings->password_wifi_enabled) {
                            $increment_version = 1;
                            Log::info('Password network enabled status updated');
                        }
                        $locationSettings->password_wifi_enabled = $settings['password_wifi_enabled'];
                    }

                    if (isset($settings['password_wifi_ssid'])) {
                        if ($settings['password_wifi_ssid'] !== $locationSettings->password_wifi_ssid) {
                            $increment_version = 1;
                            Log::info('Password network SSID updated');
                        }
                        $locationSettings->password_wifi_ssid = $settings['password_wifi_ssid'];
                    }

                    if (isset($settings['password_wifi_password'])) {
                        if ($settings['password_wifi_password'] !== $locationSettings->password_wifi_password) {
                            $increment_version = 1;
                            Log::info('Password network password updated');
                        }
                        $locationSettings->password_wifi_password = $settings['password_wifi_password'];
                    }

                    if (isset($settings['password_wifi_security'])) {
                        if ($settings['password_wifi_security'] !== $locationSettings->password_wifi_security) {
                            $increment_version = 1;
                            Log::info('Password network security updated');
                        }
                        $locationSettings->password_wifi_security = $settings['password_wifi_security'];
                    }

                    if (isset($settings['password_wifi_cipher_suites'])) {
                        if ($settings['password_wifi_cipher_suites'] !== $locationSettings->password_wifi_cipher_suites) {
                            $increment_version = 1;
                            Log::info('Password network cipher suites updated');
                        }
                        $locationSettings->password_wifi_cipher_suites = $settings['password_wifi_cipher_suites'];
                    }

                    if (isset($settings['password_wifi_ip_mode'])) {
                        if ($settings['password_wifi_ip_mode'] !== $locationSettings->password_wifi_ip_mode) {
                            $increment_version = 1;
                            Log::info('Password network IP mode updated');
                        }
                        $locationSettings->password_wifi_ip_mode = $settings['password_wifi_ip_mode'];
                    }

                    if (isset($settings['password_wifi_ip'])) {
                        if ($settings['password_wifi_ip'] !== $locationSettings->password_wifi_ip) {
                            $increment_version = 1;
                            Log::info('Password network IP updated');
                        }
                        $locationSettings->password_wifi_ip = $settings['password_wifi_ip'];
                    }

                    if (isset($settings['password_wifi_netmask'])) {
                        if ($settings['password_wifi_netmask'] !== $locationSettings->password_wifi_netmask) {
                            $increment_version = 1;
                            Log::info('Password network netmask updated');
                        }
                        $locationSettings->password_wifi_netmask = $settings['password_wifi_netmask'];
                    }

                    if (isset($settings['password_wifi_gateway'])) {
                        if ($settings['password_wifi_gateway'] !== $locationSettings->password_wifi_gateway) {
                            $increment_version = 1;
                            Log::info('Password network gateway updated');
                        }
                        $locationSettings->password_wifi_gateway = $settings['password_wifi_gateway'];
                    }

                    if (isset($settings['password_wifi_dhcp_enabled'])) {
                        if ($settings['password_wifi_dhcp_enabled'] !== $locationSettings->password_wifi_dhcp_enabled) {
                            $increment_version = 1;
                            Log::info('Password network DHCP enabled updated');
                        }
                        $locationSettings->password_wifi_dhcp_enabled = $settings['password_wifi_dhcp_enabled'];
                    }

                    if (isset($settings['password_wifi_dhcp_start'])) {
                        if ($settings['password_wifi_dhcp_start'] !== $locationSettings->password_wifi_dhcp_start) {
                            $increment_version = 1;
                            Log::info('Password network DHCP start updated');
                        }
                        $locationSettings->password_wifi_dhcp_start = $settings['password_wifi_dhcp_start'];
                    }

                    if (isset($settings['password_wifi_dhcp_end'])) {
                        if ($settings['password_wifi_dhcp_end'] !== $locationSettings->password_wifi_dhcp_end) {
                            $increment_version = 1;
                            Log::info('Password network DHCP end updated');
                        }
                        $locationSettings->password_wifi_dhcp_end = $settings['password_wifi_dhcp_end'];
                    }


                    Log::info('Updating password network settings for location: ' . $location->id);
                } elseif ($settingsType === 'location_info') {
                    Log::info('Updating location info settings for location: ' . $location->id);
                    if (isset($settings['name'])) {
                        if ($settings['name'] !== $location->name) {
                            // $increment_version = 1;
                            Log::info('Location name updated');
                        }
                        $location->name = $settings['name'];
                    }

                    if (isset($settings['address'])) {
                        if ($settings['address'] !== $location->address) {
                            // $increment_version = 1;
                            Log::info('Location address updated');
                        }
                        $location->address = $settings['address'];
                    }

                    if (isset($settings['city'])) {
                        if ($settings['city'] !== $location->city) {
                            // $increment_version = 1;
                            Log::info('Location city updated');
                        }
                        $location->city = $settings['city'];
                    }

                    if (isset($settings['state'])) {
                        if ($settings['state'] !== $location->state) {
                            // $increment_version = 1;
                            Log::info('Location state updated');
                        }
                        $location->state = $settings['state'];
                    }

                    if (isset($settings['country'])) {
                        if ($settings['country'] !== $location->country) {
                            // $increment_version = 1;
                            Log::info('Location country updated');
                        }
                        $location->country = $settings['country'];
                    }

                    if (isset($settings['manager_name'])) {
                        if ($settings['manager_name'] !== $location->manager_name) {
                            // $increment_version = 1;
                            Log::info('Location manager name updated');
                        }
                        $location->manager_name = $settings['manager_name'];
                    }

                    if (isset($settings['contact_email'])) {
                        if ($settings['contact_email'] !== $location->contact_email) {
                            // $increment_version = 1;
                            Log::info('Location contact email updated');
                        }
                        $location->contact_email = $settings['contact_email'];
                    }

                    if (isset($settings['contact_phone'])) {
                        if ($settings['contact_phone'] !== $location->contact_phone) {
                            // $increment_version = 1;
                            Log::info('Location contact phone updated');
                        }
                        $location->contact_phone = $settings['contact_phone'];
                    }

                    if (isset($settings['status'])) {
                        if ($settings['status'] !== $location->status) {
                            // $increment_version = 1;
                            Log::info('Location status updated');
                        }
                        $location->status = $settings['status'];
                    }

                    if (isset($settings['description'])) {
                        if ($settings['description'] !== $location->description) {
                            // $increment_version = 1;
                            Log::info('Location description updated');
                        }
                        $location->description = $settings['description'];
                    }

                    if (isset($settings['latitude'])) {
                        if ($settings['latitude'] !== $location->latitude) {
                            // $increment_version = 1;
                            Log::info('Location latitude updated');
                        }
                        $location->latitude = $settings['latitude'];
                    }

                    if (isset($settings['longitude'])) {
                        if ($settings['longitude'] !== $location->longitude) {
                            // $increment_version = 1;
                            Log::info('Location longitude updated');
                        }
                        $location->longitude = $settings['longitude'];
                    }


                }
                if ($increment_version == 1) {
                    // $locationSettings->configuration_version = $locationSettings->configuration_version + 1;
                    $device->configuration_version = $device->configuration_version + 1;
                    $device->save();
                }
                // Save the settings
                $locationSettings->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Settings updated successfully',
                    'location' => $location,
                    'settings' => $locationSettings

                ]);
            } catch (\Exception $e) {
                Log::error('Error updating location settings: ' . $e->getMessage());
                
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating settings: ' . $e->getMessage()
                ], 500);
            }
        }
        
        // If it's not a settings update, handle regular location update
        // (This part could be implemented later for updating location details)
        return response()->json([
            'success' => false,
            'message' => 'No settings update detected'
        ]);
    }

    /**
     * Remove the specified location from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json([
            'success' => true,
            'message' => 'Location deleted successfully'
        ]);
    }

    public function updateGeneral(Request $request, $location_id)
    {
        Log::info('Update general location information received');
        Log::info($request->all());
        
        try {
            $location = Location::find($location_id);
            
            if (!$location) {
                return response()->json([
                    'success' => false,
                    'message' => 'Location not found'
                ], 404);
            }
            
            // Validate the request data
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'address' => 'sometimes|nullable|string',
                'city' => 'sometimes|nullable|string|max:255',
                'state' => 'sometimes|nullable|string|max:255',
                'country' => 'sometimes|nullable|string|max:255',
                'postal_code' => 'sometimes|nullable|string|max:255',
                'latitude' => 'sometimes|nullable|numeric',
                'longitude' => 'sometimes|nullable|numeric',
                'description' => 'sometimes|nullable|string',
                'manager_name' => 'sometimes|nullable|string|max:255',
                'contact_email' => 'sometimes|nullable|email|max:255',
                'contact_phone' => 'sometimes|nullable|string|max:255',
                'status' => 'sometimes|nullable|string|in:active,inactive,maintenance',
            ]);
            Log::info('Validated data: ');
            Log::info($validated);
            // Update the location with validated data
            $location->update($validated);
            
            // Get associated data
            $device = Device::find($location->device_id);
            $locationSettings = LocationSettings::where('location_id', $location_id)->first();
            
            // Prepare response data
            $locationData = $location->toArray();
            $locationData['settings'] = $locationSettings;
            $locationData['device'] = $device;
            
            return response()->json([
                'success' => true,
                'message' => 'Location information updated successfully',
                'location' => $locationData
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating general location information: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating location information: ' . $e->getMessage()
            ], 500);
        }
    }
}
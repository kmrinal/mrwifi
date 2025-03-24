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
            
            try {
                // Find the location settings
                $locationSettings = LocationSettings::where('location_id', $location_id)->first();
                
                // If settings don't exist, create them
                if (!$locationSettings) {
                    $locationSettings = new LocationSettings();
                    $locationSettings->location_id = $location_id;
                }
                
                // Handle different types of settings
                if ($settingsType === 'captive') {
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
                            Log::info('New value: ' . ($newValue ? 'true' : 'false'));
                            Log::info('Old value: ' . ($oldValue ? 'true' : 'false'));
                        }
                        $locationSettings->captive_portal_visible = $newValue;
                    }
                    
                    if (isset($settings['captive_portal_enabled'])) {
                        if ($settings['captive_portal_enabled'] !== $locationSettings->captive_portal_enabled) {
                            $increment_version = 1;
                            Log::info('Captive portal enabled updated');
                        }
                        $locationSettings->captive_portal_enabled = $settings['captive_portal_enabled'];
                    }
                    
                    // Authentication settings
                    // if (isset($settings['social_login_enabled'])) {
                    //     $locationSettings->social_login_enabled = $settings['social_login_enabled'];
                    // }
                    
                    // if (isset($settings['email_login_enabled'])) {
                    //     $locationSettings->email_login_enabled = $settings['email_login_enabled'];
                    // }
                    
                    // if (isset($settings['verification_required'])) {
                    //     $locationSettings->verification_required = $settings['verification_required'];
                    // }
                    
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
                    if (isset($settings['bandwidth_limit_up'])) {
                        if ($settings['bandwidth_limit_up'] !== $locationSettings->upload_limit) {
                            # $increment_version = 1;
                            Log::info('Bandwidth limit up updated');
                        }
                        $locationSettings->upload_limit = $settings['bandwidth_limit_up'];
                    }
                    
                    if (isset($settings['bandwidth_limit_down'])) {
                        if ($settings['bandwidth_limit_down'] !== $locationSettings->download_limit) {
                            # $increment_version = 1;
                            Log::info('Bandwidth limit down updated');
                        }
                        $locationSettings->download_limit = $settings['bandwidth_limit_down'];
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
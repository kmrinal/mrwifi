<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Location;
use App\Models\SystemSetting;
use App\Models\LocationSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Remove all middleware assignments from here
        // Middleware will be defined in routes files instead
    }

    /**
     * Display a listing of the devices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new device.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created device in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices',
            'mac_address' => 'required|string|max:255|unique:devices',
            'firmware_version' => 'nullable|string|max:255',
        ]);

        $device = new Device($request->all());
        
        // Generate device key and secret
        $device->device_key = Str::random(32);
        $device->device_secret = Str::random(64);
        
        $device->save();

        return redirect()->route('devices.index')
            ->with('success', 'Device created successfully.');
    }

    /**
     * Display the specified device.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified device.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    /**
     * Update the specified device in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'mac_address' => 'required|string|max:255|unique:devices,mac_address,' . $device->id,
            'firmware_version' => 'nullable|string|max:255',
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')
            ->with('success', 'Device updated successfully');
    }

    /**
     * Remove the specified device from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')
            ->with('success', 'Device deleted successfully');
    }

    public function getSettings($device_key, $device_secret)
    {
        $device = Device::where('device_key', $device_key)->where('device_secret', $device_secret)->first();
        if (!$device) {
            return response()->json(['error' => 'Invalid device credentials'], 401);
        }

        $location = Location::where('device_id', $device->id)->first();
        if (!$location) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        $settings = LocationSettings::where('location_id', $location->id)->first();
        if (!$settings) {
            return response()->json(['error' => 'Settings not found'], 404);
        }

        $settings->wifi_name = $settings->password_wifi_ssid;
        $settings->wifi_password = $settings->password_wifi_password;

        $system_settings = SystemSetting::first();
        $radius_settings = [
            'radius_ip' => $system_settings->radius_ip,
            'radius_port' => $system_settings->radius_port,
            'radius_secret' => $system_settings->radius_secret,
            'accounting_port' => $system_settings->accounting_port,
        ];

        $whitelist_domains = env('GUEST_WHITELIST_DOMAINS');
        $whitelist_servers = env('GUEST_WHITELIST_SERVERS');
        // if settings.captive_auth_method is set to social and captive_social_auth_method is set to twitter then return whitelist_domains as ['twitter.com']
        if ($settings->captive_auth_method == 'social' && $settings->captive_social_auth_method == 'google') {
            $whitelist_domains = $whitelist_domains . ',' . env('GOOGLE_WHITELIST_DOMAINS');
            $whitelist_servers = $whitelist_servers . ',' . env('GOOGLE_WHITELIST_SERVERS');
        }

        if ($settings->captive_auth_method == 'social' && $settings->captive_social_auth_method == 'facebook') {
            $whitelist_domains = $whitelist_domains . ',' . env('FACEBOOK_WHITELIST_DOMAINS');
            $whitelist_servers = $whitelist_servers . ',' . env('FACEBOOK_WHITELIST_SERVERS');
        }

        $whitelist_domains = rtrim($whitelist_domains, ',');
        $whitelist_servers = rtrim($whitelist_servers, ',');
        
        $guest_settings = [
            'login_url' => env('GUEST_LOGIN_URL'),
            'whitelist_servers' => $whitelist_servers,
            'whitelist_domains' => $whitelist_domains,
        ];

        return response()->json(
            [
                'status' => 'success',
                'location' => $location,
                'settings' => $settings,
                'radius_settings' => $radius_settings,
                'guest_settings' => $guest_settings
            ]
        );
    }

    public function heartbeat($device_key, $device_secret)
    {
        $device = Device::where('device_key', $device_key)->where('device_secret', $device_secret)->first();
        if (!$device) {
            return response()->json(['error' => 'Invalid device credentials'], 401);
        }

        // Update the last_seen field
        $device->last_seen = now();
        $device->save();

        $location = Location::where('device_id', $device->id)->first();
        if (!$location) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        $settings = LocationSettings::where('location_id', $location->id)->first();
        
        return response()->json(['status' => 'success', 'config_version' => $device->configuration_version]);
    }

    public function verify($mac_address, $verification_code)
    {
        if ($verification_code !== env('VERIFICATION_CODE')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized verification code'
            ], 401);
        }
        $mac_address = strtoupper($mac_address);
        // Replace : with -
        $mac_address = str_replace(':', '-', $mac_address);
        $device = Device::select('id', 'mac_address', 'device_key', 'device_secret', 'configuration_version')->where('mac_address', $mac_address)->first();
        if (!$device) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized device'
            ], 401);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Device verified successfully',
            'device' => $device
        ]);
    }
    
}
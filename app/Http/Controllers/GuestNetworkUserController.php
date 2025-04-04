<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\LocationSettings;
use App\Models\GuestNetworkUser;
use Validator;


class GuestNetworkUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function info(Request $request, $location_id)
    {
        $request = $request->all();
        $request['location_id'] = $location_id;

        $validator = Validator::make($request, [
            'location_id' => 'required|exists:locations,id',
            'mac_address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $locationId = $location_id;
        if (isset($request['mac_address'])) {
            $macAddress = $request['mac_address'];
            $user = GuestNetworkUser::where('location_id', $locationId)
            ->where('mac_address', $macAddress)
            ->first();  
        } else {
            $user = null;
        }

        $location = Location::with('settings')
            ->select('id', 'name', 'description')
            ->find($locationId);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }

        // Access captive portal settings
        $captivePortalSettings = $location->settings->only([
            'captive_portal_enabled',
            'captive_portal_ssid',
            'captive_portal_visible',
            'captive_auth_method',
            'session_timeout',
            'idle_timeout',
            'redirect_url',
            'terms_enabled',
            'terms_content',
            'theme_color',
            'logo_url',
            'welcome_message',
            'captive_portal_design',
        ]);

        $brand = [
            'name' => env('APP_BRAND_NAME'),
            'logo_url' => env('APP_BRAND_LOGO'),
            'welcome_message' => env('APP_BRAND_WELCOME_MESSAGE'),
            'terms_of_service_url' => env('APP_BRAND_TERMS_OF_SERVICE_URL'),
            'privacy_policy_url' => env('APP_BRAND_PRIVACY_POLICY_URL'),
        ];
        // Create a filtered version of the location object
        $locationData = [
            'id' => $location->id,
            'name' => $location->name,
            'description' => $location->description,
            'settings' => $captivePortalSettings
        ];

        return response()->json([
            'success' => true,
            'message' => 'User found',
            'location' => $locationData,
            'user' => $user,
            'brand' => $brand
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request = $request->all();
        $validator = Validator::make($request, [
            'location_id' => 'required|exists:locations,id',
            'mac_address' => 'nullable|string|max:255',
            'login_method' => 'required|string|in:email,sms,social,click-through',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'social_platform' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request['login_method'] == 'email') {
            if (!$request['email']) {   
                return response()->json([
                    'success' => false,
                    'message' => 'Email is required'
                ], 422);
            }
        } else if ($request['login_method'] == 'sms') {
            if (!$request['phone'] || !$request['otp']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Phone and OTP are required'
                ], 422);
            }
        } else if ($request['login_method'] == 'social') {
            if (!$request['social_platform']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Social platform is required'
                ], 422);
            }
        }
        
        $location_id = $request['location_id'];
        $mac_address = $request['mac_address'];
        $login_method = $request['login_method'];
        $location = Location::find($location_id);
        $location_settings = $location->settings;

        // get if mac is already in the database
        $user = GuestNetworkUser::where('location_id', $location_id)
        ->where('mac_address', $mac_address)
        ->first();

        if (!$user) {
            $user = GuestNetworkUser::create([
                'location_id' => $location_id,
                'mac_address' => $mac_address,
                'blocked' => false,
            ]);
        }

        // Update user with email, phone, and social platform if it is as per login_method
        if ($login_method == 'email') {
            $user->email = $request['email'];
        } else if ($login_method == 'sms') {
            $user->phone = $request['phone'];
        }

        $user->expiration_time = now()->addMinutes($location_settings->session_timeout); 
        $user->download_bandwidth = $location_settings->download_limit;
        $user->upload_bandwidth = $location_settings->upload_limit;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User logged in',
            'user' => $user
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

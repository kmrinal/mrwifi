<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\GuestNetworkUserController;
use App\Http\Controllers\CaptivePortalDesignController;
use App\Http\Controllers\FirmwareController;
use App\Http\Controllers\CategoryController;

// Public routes (no auth required)
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

// Protected routes (auth required)
Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello, World!']);
});

Route::group(['prefix' => 'devices'], function () {
    Route::get('/', [DeviceController::class, 'index']);
    Route::post('/', [DeviceController::class, 'store']);
    Route::get('/{device}', [DeviceController::class, 'show']);
    Route::put('/{device}', [DeviceController::class, 'update']);
    Route::delete('/{device}', [DeviceController::class, 'destroy']);
    Route::post('/{device}/reboot', [DeviceController::class, 'reboot'])->middleware('auth:api');
});

Route::get('/devices/{device_key}/{device_secret}/settings', [DeviceController::class, 'getSettings']);
Route::get('/devices/{device_key}/{device_secret}/heartbeat', [DeviceController::class, 'heartbeat']);
Route::get('/devices/{device_key}/{device_secret}/firmware', [FirmwareController::class, 'getDeviceFirmware']);

// Route::get('/devices/{mac_address}/{verification_code}/info', [DeviceController::class, 'info']);

Route::get('/devices/{mac_address}/{verification_code}/verify', [DeviceController::class, 'verify']);   

Route::group(['middleware' => 'auth:api', 'prefix' => 'locations'], function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/', [LocationController::class, 'store']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::put('/{id}', [LocationController::class, 'update']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
    Route::put('/{location_id}/general', [LocationController::class, 'updateGeneral']);
    // Location settings routes
    Route::get('/{id}/settings', [LocationController::class, 'getSettings']);
    Route::put('/{id}/settings', [LocationController::class, 'updateSettings']);
    // Channel scan route
    Route::get('/{id}/channel-scan', [LocationController::class, 'channelScan']);
    // Firmware update route
    Route::post('/{id}/update-firmware', [LocationController::class, 'updateFirmware']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'system-settings'], function () {
    Route::get('/', [SystemSettingController::class, 'index']);
    Route::post('/', [SystemSettingController::class, 'update']);
    Route::post('/test-email', [SystemSettingController::class, 'testEmail']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'captive-portal-designs'], function () {
    Route::post('/', [CaptivePortalDesignController::class, 'get_all']);
    Route::get('/', [CaptivePortalDesignController::class, 'get_all']);
    Route::get('/{captivePortalDesign}', [CaptivePortalDesignController::class, 'show']);
    Route::post('/create', [CaptivePortalDesignController::class, 'create']);
    Route::put('/{captivePortalDesign}', [CaptivePortalDesignController::class, 'update']);
    Route::delete('/{captivePortalDesign}', [CaptivePortalDesignController::class, 'destroy']);
    Route::post('/{captivePortalDesign}/duplicate', [CaptivePortalDesignController::class, 'duplicate']);
});

// Firmware routes (protected with auth)
Route::group(['middleware' => 'auth:api', 'prefix' => 'firmware'], function () {
    Route::get('/', [FirmwareController::class, 'index']);
    Route::post('/', [FirmwareController::class, 'store']);
    Route::get('/enabled', [FirmwareController::class, 'enabled']);
    Route::get('/models', [FirmwareController::class, 'models']);
    Route::get('/model/{model}', [FirmwareController::class, 'byModel']);
    Route::get('/{firmware}', [FirmwareController::class, 'show']);
    Route::put('/{firmware}', [FirmwareController::class, 'update']);
    Route::delete('/{firmware}', [FirmwareController::class, 'destroy']);
    Route::get('/{firmware}/download', [FirmwareController::class, 'download']);
    Route::post('/{firmware}/toggle-status', [FirmwareController::class, 'toggleStatus']);
    Route::post('/{firmware}/verify', [FirmwareController::class, 'verify']);
});

// Category routes (protected with auth)
Route::group(['middleware' => 'auth:api', 'prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/enabled', [CategoryController::class, 'enabled']);
});

Route::post('/captive-portal/{location_id}/info', [GuestNetworkUserController::class, 'info']);
Route::get('/captive-portal/{location_id}/info', [GuestNetworkUserController::class, 'info']);
Route::post('/captive-portal/login', [GuestNetworkUserController::class, 'login']);
Route::post('/captive-portal/twitter-login', [GuestNetworkUserController::class, 'twitterLogin']);

Route::get('/locations/{location}/guest-users', [GuestNetworkUserController::class, 'index']);
Route::resource('/guest-users', GuestNetworkUserController::class);

// Guest Network User routes
Route::post('/location/{location_id}/guest/info', [GuestNetworkUserController::class, 'info']);
Route::post('/guest/login', [GuestNetworkUserController::class, 'login']);
Route::post('/guest/request-otp', [GuestNetworkUserController::class, 'requestOtp']);
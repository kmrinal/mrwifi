<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptivePortalController;
use App\Http\Controllers\DomainBlockingController;
use App\Http\Controllers\CategoryController;

// Display the login form
Route::get('/', function () {
    return view('login');
})->name('login.show');

Route::get('/tos', function () {
    return view('tos');
})->name('tos');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms-of-service');

// Handle login submission
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Add logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/devices', function () {
    return view('devices');
})->name('devices');

Route::get('/accounts', function () {
    return view('accounts');
})->name('accounts');

Route::get('/locations', function () {
    return view('locations');
})->name('locations');

Route::get('/locations/{location}', function () {
    return view('location-details');
})->name('location-details');

Route::get('/system-settings', function () {
    return view('system-settings');
})->name('system-settings');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/location-details', function () {
    return view('location-details');
})->name('location-details');

Route::get('/location-analytics', function () {
    return view('location-analytics');
})->name('location-analytics');

// Domain Blocking Routes
Route::get('/domain-blocking', [DomainBlockingController::class, 'index'])->name('domain-blocking');
Route::resource('blocked-domains', DomainBlockingController::class)->except(['create', 'edit']);
Route::resource('categories', CategoryController::class)->except(['create', 'edit']);

// Additional Domain Blocking API routes
Route::prefix('api/domain-blocking')->group(function () {
    Route::post('/bulk-delete', [DomainBlockingController::class, 'bulkDelete'])->name('domain-blocking.bulk-delete');
    Route::post('/import', [DomainBlockingController::class, 'import'])->name('domain-blocking.import');
    Route::get('/export', [DomainBlockingController::class, 'export'])->name('domain-blocking.export');
    Route::post('/categories/{category}/toggle', [DomainBlockingController::class, 'toggleCategory'])->name('domain-blocking.toggle-category');
    Route::get('/stats', [DomainBlockingController::class, 'stats'])->name('domain-blocking.stats');
    Route::post('/check-domain', [DomainBlockingController::class, 'checkDomain'])->name('domain-blocking.check-domain');
});

// Additional Category API routes
Route::prefix('api/categories')->group(function () {
    Route::post('/{category}/toggle', [CategoryController::class, 'toggle'])->name('categories.toggle');
    Route::post('/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
    Route::get('/{category}/stats', [CategoryController::class, 'stats'])->name('categories.stats');
});

Route::get('/firmware', function () {
    return view('firmware');
})->name('firmware');

Route::get('/analytics', function () {
    return view('analytics');
})->name('analytics');

Route::get('/captive-portals', function () {
    return view('captive-portals');
})->name('captive-portals');

Route::get('/guest-login', function () {
    $responseState = request('res', 'notyet');
    
    if ($responseState === 'success') {
        return view('guest-login-success');
    } else if ($responseState === 'failed') {
        return view('guest-login-failed');
    } else if ($responseState === 'already') {
        return view('already-logged-in');
    } else {
        // Default to 'notyet' state
        return view('guest-login');
    }
})->name('guest-login');

Route::get('/email-login/{location}/{mac_address}', function () {
    return view('email-login');
})->name('email-login');

Route::get('/sms-login/{location}/{mac_address}', function () {
    return view('sms-login');
})->name('sms-login');

Route::get('/social-login/facebook/{location}/{mac_address}', function () {
    return view('facebook-login');
})->name('facebook-login');

Route::get('/social-login/facebook-callback', function () {
    return view('facebook-login-callback');
})->name('facebook-login-callback');

Route::get('/social-login/twitter/{location}/{mac_address}', function () {
    return view('twitter-login');
})->name('twitter-login');

Route::get('/social-login/twitter-callback', function () {
    return view('twitter-login-callback');
})->name('twitter-login-callback');

Route::get('/social-login/google/{location}/{mac_address}', function () {
    return view('google-login');
})->name('google-login');

Route::get('/social-login/google-callback', function () {
    return view('google-login-callback');
})->name('google-login-callback');


Route::get('/click-login/{location}/{mac_address}', function () {
    return view('click-login');
})->name('click-login');

Route::get('/password-login/{location}/{mac_address}', function () {
    return view('password-login');
})->name('password-login');



// Captive Portal routes
Route::get('/captive-portal/{location_id}', [CaptivePortalController::class, 'showLoginPage']);
Route::post('/captive-portal/login', [CaptivePortalController::class, 'login']);
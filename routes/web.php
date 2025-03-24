<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Display the login form
Route::get('/', function () {
    return view('login');
})->name('login.show');

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

Route::get('/domain-blocking', function () {
    return view('domain-blocking');
})->name('domain-blocking');

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
    return view('guest-login');
})->name('guest-login');
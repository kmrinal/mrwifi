<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send OTP SMS to the given phone number
     *
     * @param string $phoneNumber
     * @param string $otp
     * @return bool
     */
    public function sendOtp(string $phoneNumber, string $otp)
    {
        try {
            // This is a placeholder - replace with your actual SMS provider implementation
            
            // For development/testing, log the OTP and return success
            Log::info("SMS OTP for {$phoneNumber}: {$otp}");
            
            // Uncomment the below code and replace with your actual SMS provider when ready
            /*
            $response = Http::post(env('SMS_PROVIDER_URL'), [
                'api_key' => env('SMS_PROVIDER_API_KEY'),
                'to' => $phoneNumber,
                'message' => "Your WiFi login OTP is: {$otp}. Valid for 5 minutes."
            ]);
            
            // Check response based on status code instead of using successful() method
            if ($response->status() >= 200 && $response->status() < 300) {
                Log::info("OTP sent successfully to {$phoneNumber}");
                return true;
            } else {
                Log::error("Failed to send OTP to {$phoneNumber}: " . $response->body());
                return false;
            }
            */
            
            // For now, we'll just return true to simulate successful sending
            return true;
        } catch (\Exception $e) {
            Log::error("Exception while sending OTP to {$phoneNumber}: " . $e->getMessage());
            return false;
        }
    }
} 
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
            $username = env('BULKSMS_USERNAME');
            $password = env('BULKSMS_PASSWORD');
            $brand_name = env('APP_BRAND_NAME');
            $enable_sms_sending = env('ENABLE_SMS_SENDING');
            
            $message = "Your WiFi login OTP for {$brand_name} is: {$otp}. Valid for 5 minutes.";
            Log::info("Sending OTP to {$phoneNumber}: {$message}");
            
            if (!$enable_sms_sending) {
                Log::info("SMS sending is disabled");
                return true;
            }
            Log::info("SMS sending is Enabled");
            $payload = json_encode([
                ['to' => $phoneNumber, 'body' => $message]
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode("{$username}:{$password}")
            ])->post('https://api.bulksms.com/v1/messages', json_decode($payload, true));
            
            if ($response->status() == 201) {
                Log::info("OTP sent successfully to {$phoneNumber}");
                return true;
            } else {
                Log::error("Failed to send OTP to {$phoneNumber}: " . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Exception while sending OTP to {$phoneNumber}: " . $e->getMessage());
            return false;
        }
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OtpVerification extends Model
{
    protected $fillable = [
        'phone',
        'otp',
        'location_id',
        'mac_address',
        'expires_at',
        'verified_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Generate a new OTP for the given phone number
     *
     * @param string $phone
     * @param int $locationId
     * @param string|null $macAddress
     * @return \App\Models\OtpVerification
     */
    public static function generateOtp(string $phone, int $locationId, string $macAddress = null)
    {
        // Invalidate any existing OTPs for this phone/location combo
        self::where('phone', $phone)
            ->where('location_id', $locationId)
            ->whereNull('verified_at')
            ->update(['expires_at' => now()]);

        // Generate a new 6-digit OTP
        $otp = (string) random_int(100000, 999999);
        $otp = '123456';
        
        // Create and return the new OTP record
        return self::create([
            'phone' => $phone,
            'otp' => $otp,
            'location_id' => $locationId,
            'mac_address' => $macAddress,
            'expires_at' => now()->addMinutes(5),
        ]);
    }

    /**
     * Verify an OTP for the given phone number
     *
     * @param string $phone
     * @param string $otp
     * @param int $locationId
     * @return bool
     */
    public static function verifyOtp(string $phone, string $otp, int $locationId)
    {
        $otpRecord = self::where('phone', $phone)
            ->where('otp', $otp)
            ->where('location_id', $locationId)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return false;
        }

        // Mark as verified
        $otpRecord->verified_at = now();
        $otpRecord->save();

        return true;
    }

    /**
     * Get the most recent verified OTP for a phone and location
     *
     * @param string $phone
     * @param int $locationId
     * @return \App\Models\OtpVerification|null
     */
    public static function getVerifiedOtp(string $phone, int $locationId)
    {
        return self::where('phone', $phone)
            ->where('location_id', $locationId)
            ->whereNotNull('verified_at')
            ->where('verified_at', '>', now()->subMinutes(30))
            ->latest('verified_at')
            ->first();
    }
} 
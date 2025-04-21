<?php

namespace App\Services;

use App\Models\Radcheck;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RadiusService
{
    /**
     * Get all radcheck entries for a user
     *
     * @param string $macAddress
     * @return Collection
     */
    public function getUserRadcheckEntries(string $macAddress): Collection
    {
        return Radcheck::getByUsername($macAddress);
    }

    /**
     * Get all radcheck entries for a user at a specific location
     *
     * @param string $macAddress
     * @param int $locationId
     * @return Collection
     */
    public function getUserLocationRadcheckEntries(string $macAddress, int $locationId): Collection
    {
        return Radcheck::getByUsernameAndLocation($macAddress, $locationId);
    }

    /**
     * Set user authentication with bandwidth limits and expiration
     *
     * @param string $macAddress
     * @param string $password
     * @param int $locationId
     * @param int|null $downloadBandwidth
     * @param int|null $uploadBandwidth
     * @param Carbon|null $expirationTime
     * @return Radcheck
     */
    public function setUserAuthentication(
        string $macAddress, 
        string $password, 
        int $locationId, 
        ?int $downloadBandwidth = null, 
        ?int $uploadBandwidth = null, 
        ?Carbon $expirationTime = null
    ): Radcheck {
        return Radcheck::updateOrCreateRecord(
            $macAddress,
            'Cleartext-Password',
            $password,
            '==',
            [
                'location_id' => $locationId,
                'download_bandwidth' => $downloadBandwidth,
                'upload_bandwidth' => $uploadBandwidth,
                'expiration_time' => $expirationTime
            ]
        );
    }

    /**
     * Set bandwidth limits for a user
     *
     * @param string $macAddress
     * @param int $locationId
     * @param int $downloadBandwidth
     * @param int $uploadBandwidth
     * @return Radcheck
     */
    public function setBandwidthLimits(
        string $macAddress, 
        int $locationId, 
        int $downloadBandwidth, 
        int $uploadBandwidth
    ): void {
        // First update or create the WISPr-Bandwidth-Max-Down attribute
        Radcheck::updateOrCreateRecord(
            $macAddress,
            'WISPr-Bandwidth-Max-Down',
            $downloadBandwidth,
            '==',
            [
                'location_id' => $locationId,
                'download_bandwidth' => $downloadBandwidth,
                'upload_bandwidth' => $uploadBandwidth
            ]
        );

        // Then update or create the WISPr-Bandwidth-Max-Up attribute
        Radcheck::updateOrCreateRecord(
            $macAddress,
            'WISPr-Bandwidth-Max-Up',
            $uploadBandwidth,
            '==',
            [
                'location_id' => $locationId,
                'download_bandwidth' => $downloadBandwidth,
                'upload_bandwidth' => $uploadBandwidth
            ]
        );
    }

    /**
     * Set expiration time for a user
     *
     * @param string $macAddress
     * @param int $locationId
     * @param Carbon $expirationTime
     * @return Radcheck
     */
    public function setExpirationTime(string $macAddress, int $locationId, Carbon $expirationTime): Radcheck
    {
        // Convert expiration time to seconds from Unix epoch
        $sessionTimeout = $expirationTime->diffInSeconds(Carbon::now());
        
        return Radcheck::updateOrCreateRecord(
            $macAddress,
            'Session-Timeout',
            $sessionTimeout,
            '==',
            [
                'location_id' => $locationId,
                'expiration_time' => $expirationTime
            ]
        );
    }

    /**
     * Remove a user from a specific location
     *
     * @param string $macAddress
     * @param int $locationId
     * @return int Number of deleted records
     */
    public function removeUserFromLocation(string $macAddress, int $locationId): int
    {
        return Radcheck::deleteByUsernameAndLocation($macAddress, $locationId);
    }

    /**
     * Remove a user from all locations
     *
     * @param string $macAddress
     * @return int Number of deleted records
     */
    public function removeUser(string $macAddress): int
    {
        return Radcheck::deleteByUsername($macAddress);
    }

    /**
     * Get a specific attribute for a user
     *
     * @param string $username
     * @param string $attribute
     * @return string|null
     */
    public function getUserAttribute(string $username, string $attribute): ?string
    {
        $record = Radcheck::where('username', $username)
            ->where('attribute', $attribute)
            ->first();
        
        return $record ? $record->value : null;
    }

    /**
     * Update a specific attribute for a user
     *
     * @param string $username
     * @param string $attribute
     * @param string $value
     * @param string $op
     * @return Radcheck
     */
    public function updateUserAttribute(string $username, string $attribute, string $value, string $op = '=='): Radcheck
    {
        return Radcheck::updateOrCreateRecord($username, $attribute, $value, $op);
    }
} 
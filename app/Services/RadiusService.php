<?php

namespace App\Services;

use App\Models\Radcheck;
use Illuminate\Support\Collection;

class RadiusService
{
    /**
     * Get all radcheck entries for a user
     *
     * @param string $username
     * @return Collection
     */
    public function getUserRadcheckEntries(string $username): Collection
    {
        return Radcheck::getByUsername($username);
    }

    /**
     * Set password for a user
     *
     * @param string $username
     * @param string $password
     * @return Radcheck
     */
    public function setUserPassword(string $username, string $password): Radcheck
    {
        return Radcheck::updateOrCreateRecord(
            $username,
            'Cleartext-Password',
            $password
        );
    }

    /**
     * Set maximum download bandwidth in bits per second
     *
     * @param string $username
     * @param int $maxDownload
     * @return Radcheck
     */
    public function setMaxDownloadSpeed(string $username, int $maxDownload): Radcheck
    {
        return Radcheck::updateOrCreateRecord(
            $username,
            'WISPr-Bandwidth-Max-Down',
            $maxDownload
        );
    }

    /**
     * Set maximum upload bandwidth in bits per second
     *
     * @param string $username
     * @param int $maxUpload
     * @return Radcheck
     */
    public function setMaxUploadSpeed(string $username, int $maxUpload): Radcheck
    {
        return Radcheck::updateOrCreateRecord(
            $username,
            'WISPr-Bandwidth-Max-Up',
            $maxUpload
        );
    }

    /**
     * Set session timeout in seconds
     *
     * @param string $username
     * @param int $timeout
     * @return Radcheck
     */
    public function setSessionTimeout(string $username, int $timeout): Radcheck
    {
        return Radcheck::updateOrCreateRecord(
            $username,
            'Session-Timeout',
            $timeout
        );
    }

    /**
     * Remove all radcheck entries for a user
     *
     * @param string $username
     * @return int Number of deleted records
     */
    public function removeUser(string $username): int
    {
        return Radcheck::deleteByUsername($username);
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
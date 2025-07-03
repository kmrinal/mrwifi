<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'model',
        'serial_number',
        'mac_address',
        'firmware_version',
        'firmware_id',
        'last_seen',
        'configuration_version',
        'device_key',
        'device_secret',
        'reboot_count',
        'scan_counter',
        'uptime',
    ];

    /**
     * Get the locations associated with the device.
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get the scan results associated with the device.
     */
    public function scanResults()
    {
        return $this->hasMany(ScanResult::class);
    }

    /**
     * Increment the scan counter and return the new value.
     */
    public function incrementScanCounter()
    {
        $this->increment('scan_counter');
        return $this->scan_counter;
    }
}

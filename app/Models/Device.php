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
    ];

    /**
     * Get the locations associated with the device.
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}

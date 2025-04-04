<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LocationSettings;
class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'description',
        'manager_name',
        'contact_email',
        'contact_phone',
        'status',
        'device_id',
        'user_id',
    ];

    /**
     * Get the device associated with the location.
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Get the user that manages this location.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function settings()
    {
        return $this->hasOne(LocationSettings::class);
    }
}

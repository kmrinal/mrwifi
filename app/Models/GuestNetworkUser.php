<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestNetworkUser extends Model
{
    protected $fillable = [
        'name',
        'mac_address',
        'location_id',
        'expiration_time',
        'download_bandwidth',
        'upload_bandwidth',
        'blocked'
    ];
    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

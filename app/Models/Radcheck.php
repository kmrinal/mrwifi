<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radcheck extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'radius';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'radcheck';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'attribute',
        'op',
        'value',
        'location_id',
        'download_bandwidth',
        'upload_bandwidth',
        'expiration_time',
        'idle_timeout'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiration_time' => 'datetime',
    ];

    /**
     * Get records by username
     *
     * @param string $username
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByUsername(string $username)
    {
        return self::where('username', $username)->get();
    }

    /**
     * Get records by username and location_id
     *
     * @param string $username
     * @param int $locationId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByUsernameAndLocation(string $username, int $locationId)
    {
        return self::where('username', $username)
            ->where('location_id', $locationId)
            ->get();
    }

    /**
     * Update or create a radcheck record
     *
     * @param string $username
     * @param string $attribute
     * @param string $value
     * @param string $op
     * @param array $additional
     * @return \App\Models\Radcheck
     */
    public static function updateOrCreateRecord(string $username, string $attribute, string $value, string $op = '==', array $additional = [])
    {
        $data = ['value' => $value, 'op' => $op];
        
        if (!empty($additional)) {
            $data = array_merge($data, $additional);
        }
        
        $conditions = ['username' => $username, 'attribute' => $attribute];
        
        // Add location_id to the conditions if it exists in additional data
        if (isset($additional['location_id'])) {
            $conditions['location_id'] = $additional['location_id'];
        }
        
        return self::updateOrCreate($conditions, $data);
    }

    /**
     * Delete all records for a specific username
     *
     * @param string $username
     * @return int
     */
    public static function deleteByUsername(string $username)
    {
        return self::where('username', $username)->delete();
    }
    
    /**
     * Delete records for a specific username and location
     *
     * @param string $username
     * @param int $locationId
     * @return int
     */
    public static function deleteByUsernameAndLocation(string $username, int $locationId)
    {
        return self::where('username', $username)
            ->where('location_id', $locationId)
            ->delete();
    }
} 
//         return self::where('username', $username)->delete();
//     }
// } 
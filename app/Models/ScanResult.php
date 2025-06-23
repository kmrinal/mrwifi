<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScanResult extends Model
{
    use HasFactory;

    // Scan status constants
    const STATUS_INITIATED = 'initiated';
    const STATUS_STARTED = 'started';
    const STATUS_SCANNING_2G = 'scanning_2g';
    const STATUS_SCANNING_5G = 'scanning_5g';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'device_id',
        'scan_id',
        'status',
        'scan_results_2g',
        'scan_results_5g',
        'optimal_channel_2g',
        'optimal_channel_5g',
        'nearby_networks_2g',
        'nearby_networks_5g',
        'interference_level_2g',
        'interference_level_5g',
        'error_message',
        'started_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scan_results_2g' => 'array',
        'scan_results_5g' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the device that owns the scan result.
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Get all available status options.
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_INITIATED,
            self::STATUS_STARTED,
            self::STATUS_SCANNING_2G,
            self::STATUS_SCANNING_5G,
            self::STATUS_COMPLETED,
            self::STATUS_FAILED,
        ];
    }

    /**
     * Check if scan is in progress.
     */
    public function isInProgress()
    {
        return in_array($this->status, [
            self::STATUS_INITIATED,
            self::STATUS_STARTED,
            self::STATUS_SCANNING_2G,
            self::STATUS_SCANNING_5G,
        ]);
    }

    /**
     * Check if scan is completed.
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if scan failed.
     */
    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Mark scan as started.
     */
    public function markAsStarted()
    {
        $this->update([
            'status' => self::STATUS_STARTED,
            'started_at' => now(),
        ]);
    }

    /**
     * Update 2.4G scan results.
     */
    public function update2GScanResults($results)
    {
        $this->update([
            'status' => self::STATUS_SCANNING_5G,
            'scan_results_2g' => $results['scan_results'] ?? [],
            'optimal_channel_2g' => $results['optimal_channel'] ?? null,
            'nearby_networks_2g' => $results['nearby_networks'] ?? 0,
            'interference_level_2g' => $results['interference_level'] ?? null,
        ]);
    }

    /**
     * Update 5G scan results and mark as completed.
     */
    public function update5GScanResults($results)
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'scan_results_5g' => $results['scan_results'] ?? [],
            'optimal_channel_5g' => $results['optimal_channel'] ?? null,
            'nearby_networks_5g' => $results['nearby_networks'] ?? 0,
            'interference_level_5g' => $results['interference_level'] ?? null,
            'completed_at' => now(),
        ]);
    }

    /**
     * Mark scan as failed.
     */
    public function markAsFailed($errorMessage = null)
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'error_message' => $errorMessage,
            'completed_at' => now(),
        ]);
    }
}

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
        $scanData = $results['scan_results'] ?? [];
        $optimalChannel = $this->calculateOptimalChannel2G($scanData);
        
        $this->update([
            'status' => self::STATUS_SCANNING_5G,
            'scan_results_2g' => $scanData,
            'optimal_channel_2g' => $optimalChannel,
            'nearby_networks_2g' => $results['nearby_networks'] ?? 0,
            'interference_level_2g' => $results['interference_level'] ?? null,
        ]);
    }

    /**
     * Update 5G scan results and mark as completed.
     */
    public function update5GScanResults($results)
    {
        $scanData = $results['scan_results'] ?? [];
        $optimalChannel = $this->calculateOptimalChannel5G($scanData);
        
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'scan_results_5g' => $scanData,
            'optimal_channel_5g' => $optimalChannel,
            'nearby_networks_5g' => $results['nearby_networks'] ?? 0,
            'interference_level_5g' => $results['interference_level'] ?? null,
            'completed_at' => now(),
        ]);
    }

    /**
     * Calculate optimal 2.4GHz channel based on scan results.
     * Analyzes network density and signal strength per channel to find the best option.
     */
    private function calculateOptimalChannel2G($scanData)
    {
        if (empty($scanData)) {
            return 6; // Default to channel 6 if no data
        }

        // Group networks by channel and calculate scores
        $channelScores = [];
        $channelCounts = [];
        
        foreach ($scanData as $network) {
            $channel = $network['channel'];
            $signal = $network['signal'];
            
            if (!isset($channelScores[$channel])) {
                $channelScores[$channel] = 0;
                $channelCounts[$channel] = 0;
            }
            
            // Score based on signal strength (higher signal = more interference)
            // Convert signal to positive value for scoring (weaker signals are better)
            $channelScores[$channel] += abs($signal);
            $channelCounts[$channel]++;
        }
        
        // Find channel with lowest interference (lowest average signal + network count penalty)
        $optimalChannel = 6; // Default
        $bestScore = PHP_INT_MAX;
        
        foreach ($channelScores as $channel => $totalSignal) {
            $networkCount = $channelCounts[$channel];
            $avgSignal = $totalSignal / $networkCount;
            
            // Score = average signal strength + penalty for network density
            $score = $avgSignal + ($networkCount * 10); // 10 dBm penalty per network
            
            if ($score < $bestScore) {
                $bestScore = $score;
                $optimalChannel = $channel;
            }
        }
        
        // Ensure it's a valid 2.4GHz channel (1-14)
        if ($optimalChannel < 1 || $optimalChannel > 14) {
            return 6; // Default to channel 6
        }

        return (int) $optimalChannel;
    }

    /**
     * Calculate optimal 5GHz channel based on scan results.
     * Analyzes network density and signal strength per channel to find the best option.
     */
    private function calculateOptimalChannel5G($scanData)
    {
        if (empty($scanData)) {
            return 36; // Default to channel 36 if no data
        }

        // Group networks by channel and calculate scores
        $channelScores = [];
        $channelCounts = [];
        
        foreach ($scanData as $network) {
            $channel = $network['channel'];
            $signal = $network['signal'];
            
            if (!isset($channelScores[$channel])) {
                $channelScores[$channel] = 0;
                $channelCounts[$channel] = 0;
            }
            
            // Score based on signal strength (higher signal = more interference)
            // Convert signal to positive value for scoring (weaker signals are better)
            $channelScores[$channel] += abs($signal);
            $channelCounts[$channel]++;
        }
        
        // Find channel with lowest interference (lowest average signal + network count penalty)
        $optimalChannel = 36; // Default
        $bestScore = PHP_INT_MAX;
        
        foreach ($channelScores as $channel => $totalSignal) {
            $networkCount = $channelCounts[$channel];
            $avgSignal = $totalSignal / $networkCount;
            
            // Score = average signal strength + penalty for network density
            $score = $avgSignal + ($networkCount * 10); // 10 dBm penalty per network
            
            if ($score < $bestScore) {
                $bestScore = $score;
                $optimalChannel = $channel;
            }
        }
        
        // Ensure it's a valid 5GHz channel
        $valid5GChannels = [36, 40, 44, 48, 52, 56, 60, 64, 100, 104, 108, 112, 116, 120, 124, 128, 132, 136, 140, 144, 149, 153, 157, 161, 165];
        if (!in_array((int) $optimalChannel, $valid5GChannels)) {
            return 36; // Default to channel 36
        }

        return (int) $optimalChannel;
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

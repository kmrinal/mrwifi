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
     * Calculate optimal 2.4GHz channel based on scan results for 40MHz channel width.
     * Analyzes 40MHz channel bonding and adjacent channel interference to find the best option.
     */
    private function calculateOptimalChannel2G($scanData)
    {
        if (empty($scanData)) {
            return 6; // Default to channel 6 if no data
        }

        // Build channel interference map
        $channelInterference = [];
        foreach ($scanData as $network) {
            $channel = $network['channel'];
            $signal = abs($network['signal']); // Convert to positive value
            
            if (!isset($channelInterference[$channel])) {
                $channelInterference[$channel] = [];
            }
            $channelInterference[$channel][] = $signal;
        }

        // Valid 40MHz channel pairs for 2.4GHz (primary + secondary)
        // Each pair represents [primary_channel, secondary_channel]
        $valid40MHzPairs = [
            [1, 5],   // Channels 1+5
            [2, 6],   // Channels 2+6  
            [3, 7],   // Channels 3+7
            [4, 8],   // Channels 4+8
            [5, 9],   // Channels 5+9
            [6, 10],  // Channels 6+10
            [7, 11],  // Channels 7+11
        ];

        $bestPrimaryChannel = 6; // Default
        $lowestScore = PHP_INT_MAX;

        foreach ($valid40MHzPairs as [$primaryChannel, $secondaryChannel]) {
            $totalScore = $this->calculate40MHzInterferenceScore(
                $primaryChannel, 
                $secondaryChannel, 
                $channelInterference
            );

            if ($totalScore < $lowestScore) {
                $lowestScore = $totalScore;
                $bestPrimaryChannel = $primaryChannel;
            }
        }

        return (int) $bestPrimaryChannel;
    }

    /**
     * Calculate interference score for a 40MHz channel pair.
     * 
     * @param int $primaryChannel
     * @param int $secondaryChannel  
     * @param array $channelInterference
     * @return float
     */
    private function calculate40MHzInterferenceScore($primaryChannel, $secondaryChannel, $channelInterference)
    {
        $totalScore = 0;

        // Channels to analyze with their interference weights
        $channelsToAnalyze = [
            // Direct interference (100% weight)
            $primaryChannel => 1.0,
            $secondaryChannel => 1.0,
            
            // Adjacent channel interference (50% weight for ±1, 25% weight for ±2)
            $primaryChannel - 1 => 0.5,
            $primaryChannel + 1 => 0.5,
            $primaryChannel - 2 => 0.25,
            $primaryChannel + 2 => 0.25,
            $secondaryChannel - 1 => 0.5,
            $secondaryChannel + 1 => 0.5,
            $secondaryChannel - 2 => 0.25,
            $secondaryChannel + 2 => 0.25,
        ];

        foreach ($channelsToAnalyze as $channel => $weight) {
            // Skip invalid channels (outside 1-14 range)
            if ($channel < 1 || $channel > 14) {
                continue;
            }

            if (isset($channelInterference[$channel])) {
                $signals = $channelInterference[$channel];
                $networkCount = count($signals);
                $avgSignal = array_sum($signals) / $networkCount;
                
                // Score = (average signal strength + network density penalty) * interference weight
                $channelScore = ($avgSignal + ($networkCount * 10)) * $weight;
                $totalScore += $channelScore;
            }
        }

        return $totalScore;
    }

    /**
     * Calculate optimal 5GHz channel based on scan results for 160MHz channel width.
     * Analyzes 160MHz channel bonding and adjacent channel interference to find the best option.
     */
    private function calculateOptimalChannel5G($scanData)
    {
        if (empty($scanData)) {
            return 36; // Default to channel 36 if no data
        }

        // Build channel interference map
        $channelInterference = [];
        foreach ($scanData as $network) {
            $channel = $network['channel'];
            $signal = abs($network['signal']); // Convert to positive value
            
            if (!isset($channelInterference[$channel])) {
                $channelInterference[$channel] = [];
            }
            $channelInterference[$channel][] = $signal;
        }

        // Valid 160MHz channel blocks for 5GHz
        // Each block represents 8 consecutive 20MHz channels that form a 160MHz channel
        // Format: [primary_channel, [all_channels_in_160MHz_block]]
        $valid160MHzBlocks = [
            // Block 1: Channels 36-64 (UNII-1 band)
            [36, [36, 40, 44, 48, 52, 56, 60, 64]],
            
            // Block 2: Channels 100-128 (UNII-2A/2B band) 
            [100, [100, 104, 108, 112, 116, 120, 124, 128]],
            
            // Block 3: Channels 149-177 (UNII-3 band)
            // Note: Channel 177 might not be available in all regions
            [149, [149, 153, 157, 161, 165, 169, 173, 177]],
        ];

        $bestPrimaryChannel = 36; // Default
        $lowestScore = PHP_INT_MAX;

        foreach ($valid160MHzBlocks as [$primaryChannel, $channelBlock]) {
            $totalScore = $this->calculate160MHzInterferenceScore(
                $primaryChannel,
                $channelBlock,
                $channelInterference
            );

            if ($totalScore < $lowestScore) {
                $lowestScore = $totalScore;
                $bestPrimaryChannel = $primaryChannel;
            }
        }

        return (int) $bestPrimaryChannel;
    }

    /**
     * Calculate interference score for a 160MHz channel block.
     * 
     * @param int $primaryChannel
     * @param array $channelBlock All 8 channels in the 160MHz block
     * @param array $channelInterference
     * @return float
     */
    private function calculate160MHzInterferenceScore($primaryChannel, $channelBlock, $channelInterference)
    {
        $totalScore = 0;
        $channelsToAnalyze = [];

        // Direct interference on all 8 channels in the 160MHz block (100% weight)
        foreach ($channelBlock as $channel) {
            $channelsToAnalyze[$channel] = 1.0;
        }

        // Adjacent channel interference
        // Add channels ±4, ±8 from the block boundaries for adjacent channel interference
        $minChannel = min($channelBlock);
        $maxChannel = max($channelBlock);
        
        // Lower adjacent channels (50% weight for ±4, 25% weight for ±8)
        $channelsToAnalyze[$minChannel - 4] = 0.5;
        $channelsToAnalyze[$minChannel - 8] = 0.25;
        
        // Upper adjacent channels (50% weight for ±4, 25% weight for ±8)  
        $channelsToAnalyze[$maxChannel + 4] = 0.5;
        $channelsToAnalyze[$maxChannel + 8] = 0.25;

        // Valid 5GHz channels for boundary checking
        $valid5GChannels = [36, 40, 44, 48, 52, 56, 60, 64, 100, 104, 108, 112, 116, 120, 124, 128, 132, 136, 140, 144, 149, 153, 157, 161, 165, 169, 173, 177];

        foreach ($channelsToAnalyze as $channel => $weight) {
            // Skip invalid channels (not in valid 5GHz channel list)
            if (!in_array($channel, $valid5GChannels)) {
                continue;
            }

            if (isset($channelInterference[$channel])) {
                $signals = $channelInterference[$channel];
                $networkCount = count($signals);
                $avgSignal = array_sum($signals) / $networkCount;
                
                // Score = (average signal strength + network density penalty) * interference weight
                $channelScore = ($avgSignal + ($networkCount * 10)) * $weight;
                $totalScore += $channelScore;
            }
        }

        return $totalScore;
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

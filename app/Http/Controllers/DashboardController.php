<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Device;
use App\Models\Radacct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // API routes are already protected with 'auth:api' middleware in routes/api.php
        // Web route for dashboard view doesn't need auth since it's handled on frontend
    }

    /**
     * Show the dashboard view (static)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Get dashboard overview data via API
     *
     * @return \Illuminate\Http\Response
     */
    public function getOverview()
    {
        try {
            // Get all locations with their devices
            $locations = Location::with('device')->get();
            
            // Calculate location statistics
            $totalLocations = $locations->count();
            $onlineLocations = 0;
            $offlineLocations = 0;
            
            // Process each location to determine online status and get usage data
            $locationsData = $locations->map(function ($location) use (&$onlineLocations, &$offlineLocations) {
                $locationData = $location->toArray();
                $locationData['online_status'] = 'offline';
                
                // Check device online status
                if ($location->device && $location->device->last_seen) {
                    $lastSeen = new \DateTime($location->device->last_seen);
                    $now = new \DateTime();
                    $interval = $now->getTimestamp() - $lastSeen->getTimestamp();
                    
                    if ($interval <= 90) {
                        $locationData['online_status'] = 'online';
                        $onlineLocations++;
                    } else {
                        $offlineLocations++;
                    }
                } else {
                    $offlineLocations++;
                }
                
                // Get today's usage data for this location
                $today = Carbon::now()->startOfDay();
                $dataUsage = Radacct::getLocationDataUsage($location->id, $today);
                $activeSessions = Radacct::getActiveSessions($location->id);
                
                $locationData['users'] = $activeSessions->count();
                $locationData['unique_users_today'] = $dataUsage['unique_users'];
                $locationData['data_usage_gb'] = $dataUsage['total_gb'];
                $locationData['total_sessions'] = $dataUsage['total_sessions'];
                $locationData['device'] = $location->device;
                
                return $locationData;
            });
            
            // Calculate network-wide statistics
            $totalActiveUsers = $locationsData->sum('users');
            $totalDataUsageGB = $locationsData->sum('data_usage_gb');
            $totalDataUsageTB = round($totalDataUsageGB / 1024, 2);
            
            // Calculate overall uptime percentage
            $uptimePercentage = $totalLocations > 0 ? round(($onlineLocations / $totalLocations) * 100, 1) : 0;
            
            return response()->json([
                'success' => true,
                'data' => [
                    'locations' => [
                        'total' => $totalLocations,
                        'online' => $onlineLocations,
                        'offline' => $offlineLocations,
                        'data' => $locationsData
                    ],
                    'network_stats' => [
                        'routers_online' => $onlineLocations,
                        'routers_total' => $totalLocations,
                        'active_users' => $totalActiveUsers,
                        'data_used_tb' => $totalDataUsageTB,
                        'uptime_percentage' => $uptimePercentage
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error loading dashboard overview data: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading dashboard data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get network analytics data via API
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAnalytics(Request $request)
    {
        try {
            $period = $request->input('period', '7'); // Default 7 days
            
            // Calculate date range based on period
            $endDate = Carbon::now();
            switch ($period) {
                case '1':
                    $startDate = Carbon::now()->startOfDay();
                    break;
                case '7':
                    $startDate = Carbon::now()->subDays(7);
                    break;
                case '30':
                    $startDate = Carbon::now()->subDays(30);
                    break;
                case '90':
                    $startDate = Carbon::now()->subDays(90);
                    break;
                default:
                    $startDate = Carbon::now()->subDays(7);
            }
            
            $locations = Location::with('device')->get();
            
            $analyticsStats = [
                'total_users' => 0,
                'total_data_gb' => 0,
                'total_sessions' => 0,
                'uptime' => 0
            ];
            
            $onlineCount = 0;
            
            foreach ($locations as $location) {
                $periodUsage = Radacct::getLocationDataUsage($location->id, $startDate, $endDate);
                $analyticsStats['total_users'] += $periodUsage['unique_users'];
                $analyticsStats['total_data_gb'] += $periodUsage['total_gb'];
                $analyticsStats['total_sessions'] += $periodUsage['total_sessions'];
                
                // Check if location is online for uptime calculation
                if ($location->device && $location->device->last_seen) {
                    $lastSeen = new \DateTime($location->device->last_seen);
                    $now = new \DateTime();
                    $interval = $now->getTimestamp() - $lastSeen->getTimestamp();
                    
                    if ($interval <= 90) {
                        $onlineCount++;
                    }
                }
            }
            
            $analyticsStats['uptime'] = $locations->count() > 0 ? 
                round(($onlineCount / $locations->count()) * 100, 1) : 0;
            
            return response()->json([
                'success' => true,
                'data' => [
                    'period' => $period,
                    'date_range' => [
                        'start' => $startDate->format('Y-m-d'),
                        'end' => $endDate->format('Y-m-d')
                    ],
                    'analytics' => [
                        'total_users' => $analyticsStats['total_users'],
                        'data_usage_gb' => round($analyticsStats['total_data_gb'], 1),
                        'total_sessions' => $analyticsStats['total_sessions'],
                        'uptime' => $analyticsStats['uptime']
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error loading dashboard analytics data: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading analytics data: ' . $e->getMessage()
            ], 500);
        }
    }
} 
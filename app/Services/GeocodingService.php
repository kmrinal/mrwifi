<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    private $apiKey;
    private $baseUrl = 'https://maps.googleapis.com/maps/api/geocode/json';

    public function __construct()
    {
        $this->apiKey = config('app.google_maps_key', env('GOOGLE_MAPS_KEY'));
    }

    /**
     * Geocode an address to get latitude and longitude
     *
     * @param string $address
     * @param string|null $city
     * @param string|null $state
     * @param string|null $country
     * @param string|null $postalCode
     * @return array|null Returns ['lat' => float, 'lng' => float] or null if geocoding fails
     */
    public function geocodeAddress($address, $city = null, $state = null, $country = null, $postalCode = null)
    {
        if (empty($this->apiKey)) {
            Log::warning('Google Maps API key not configured for geocoding');
            return null;
        }

        // Build the full address string
        $fullAddress = $this->buildFullAddress($address, $city, $state, $country, $postalCode);
        
        if (empty($fullAddress)) {
            Log::info('No address provided for geocoding');
            return null;
        }

        try {
            Log::info('Attempting to geocode address: ' . $fullAddress);
            
            $response = Http::get($this->baseUrl, [
                'address' => $fullAddress,
                'key' => $this->apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['status'] === 'OK' && !empty($data['results'])) {
                    $location = $data['results'][0]['geometry']['location'];
                    
                    Log::info('Geocoding successful for address: ' . $fullAddress, [
                        'lat' => $location['lat'],
                        'lng' => $location['lng']
                    ]);
                    
                    return [
                        'lat' => $location['lat'],
                        'lng' => $location['lng'],
                        'formatted_address' => $data['results'][0]['formatted_address']
                    ];
                } else {
                    Log::warning('Geocoding failed for address: ' . $fullAddress, [
                        'status' => $data['status'],
                        'error_message' => $data['error_message'] ?? 'No error message provided'
                    ]);
                }
            } else {
                Log::error('HTTP request failed for geocoding', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred during geocoding', [
                'message' => $e->getMessage(),
                'address' => $fullAddress
            ]);
        }

        return null;
    }

    /**
     * Build a full address string from components
     *
     * @param string|null $address
     * @param string|null $city
     * @param string|null $state
     * @param string|null $country
     * @param string|null $postalCode
     * @return string
     */
    private function buildFullAddress($address, $city, $state, $country, $postalCode)
    {
        $addressParts = array_filter([
            $address,
            $city,
            $state,
            $country,
            $postalCode
        ]);

        return implode(', ', $addressParts);
    }

    /**
     * Reverse geocode latitude and longitude to get address
     *
     * @param float $latitude
     * @param float $longitude
     * @return array|null Returns address components or null if reverse geocoding fails
     */
    public function reverseGeocode($latitude, $longitude)
    {
        if (empty($this->apiKey)) {
            Log::warning('Google Maps API key not configured for reverse geocoding');
            return null;
        }

        try {
            Log::info('Attempting to reverse geocode coordinates', [
                'lat' => $latitude,
                'lng' => $longitude
            ]);
            
            $response = Http::get($this->baseUrl, [
                'latlng' => $latitude . ',' . $longitude,
                'key' => $this->apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['status'] === 'OK' && !empty($data['results'])) {
                    $result = $data['results'][0];
                    
                    Log::info('Reverse geocoding successful', [
                        'formatted_address' => $result['formatted_address']
                    ]);
                    
                    return [
                        'formatted_address' => $result['formatted_address'],
                        'address_components' => $result['address_components']
                    ];
                } else {
                    Log::warning('Reverse geocoding failed', [
                        'status' => $data['status'],
                        'error_message' => $data['error_message'] ?? 'No error message provided'
                    ]);
                }
            } else {
                Log::error('HTTP request failed for reverse geocoding', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred during reverse geocoding', [
                'message' => $e->getMessage(),
                'lat' => $latitude,
                'lng' => $longitude
            ]);
        }

        return null;
    }
} 
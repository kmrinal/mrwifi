# Address to Latitude/Longitude Geocoding

This document explains the automatic address-to-coordinates geocoding functionality implemented in the MrWiFi application.

## Overview

The application now automatically converts addresses to latitude and longitude coordinates using Google Maps Geocoding API. This happens automatically when:

1. Creating a new location with address information
2. Updating a location's address information

## Configuration

### Environment Variables

Make sure your `.env` file contains the Google Maps API key:

```env
GOOGLE_MAPS_KEY=your_google_maps_api_key_here
```

### API Key Setup

1. Go to the [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the Geocoding API
4. Create credentials (API Key) for the Geocoding API
5. Optionally, restrict the API key to only the Geocoding API for security
6. Add the API key to your `.env` file

## How It Works

### Automatic Geocoding

The system automatically attempts to geocode addresses in the following scenarios:

#### When Creating a Location

If you provide address information (address, city, state, country, or postal_code) but don't provide latitude and longitude, the system will:

1. Combine all address components into a full address string
2. Send a request to Google Maps Geocoding API
3. Extract the latitude and longitude from the response
4. Store the coordinates with the location

#### When Updating a Location

If you update any address fields without providing new latitude/longitude coordinates, the system will:

1. Use the updated address information
2. Geocode the new address
3. Update the latitude and longitude automatically

### Manual Testing

You can test the geocoding functionality using the test endpoint:

```http
POST /api/locations/test-geocode
Content-Type: application/json
Authorization: Bearer your_jwt_token

{
    "address": "1600 Amphitheatre Parkway",
    "city": "Mountain View",
    "state": "CA",
    "country": "USA",
    "postal_code": "94043"
}
```

Expected response:
```json
{
    "success": true,
    "message": "Geocoding successful",
    "data": {
        "lat": 37.4219999,
        "lng": -122.0840575,
        "formatted_address": "1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA"
    }
}
```

## Implementation Details

### GeocodingService Class

The `App\Services\GeocodingService` class handles all geocoding operations:

- `geocodeAddress()` - Converts address to coordinates
- `reverseGeocode()` - Converts coordinates to address (for future use)
- `buildFullAddress()` - Combines address components

### LocationController Integration

The geocoding is integrated into:

- `store()` method - For new locations
- `updateGeneral()` method - For location updates
- `testGeocode()` method - For testing

### Error Handling

The system gracefully handles geocoding failures:

- If the API key is missing, a warning is logged and the location is created without coordinates
- If the geocoding request fails, the error is logged and the location is created/updated without coordinates
- If the address cannot be geocoded, a warning is logged

### Logging

All geocoding operations are logged for debugging:

- Successful geocoding attempts with coordinates
- Failed geocoding attempts with error details
- Missing API key warnings

## API Response Examples

### Successful Location Creation with Geocoding

```json
{
    "success": true,
    "message": "Location and device created successfully.",
    "location": {
        "id": 1,
        "name": "Test Location",
        "address": "1600 Amphitheatre Parkway",
        "city": "Mountain View",
        "state": "CA",
        "country": "USA",
        "latitude": 37.4219999,
        "longitude": -122.0840575,
        // ... other fields
    },
    "device": {
        // ... device information
    }
}
```

### Location Update with Address Change

When updating address fields, the coordinates are automatically updated:

```http
PUT /api/locations/1/general
{
    "address": "1 Hacker Way",
    "city": "Menlo Park",
    "state": "CA"
}
```

Response includes updated coordinates:
```json
{
    "success": true,
    "message": "Location information updated successfully",
    "location": {
        "id": 1,
        "address": "1 Hacker Way",
        "city": "Menlo Park",
        "state": "CA",
        "latitude": 37.4815551,
        "longitude": -122.1526736,
        // ... other fields
    }
}
```

## Limitations

1. **Rate Limits**: Google Maps Geocoding API has rate limits. For high-volume applications, consider implementing caching or rate limiting.

2. **API Costs**: Google Maps Geocoding API charges per request after the free tier. Monitor usage in the Google Cloud Console.

3. **Accuracy**: Geocoding accuracy depends on the completeness and accuracy of the provided address information.

4. **Internet Connection**: Geocoding requires an active internet connection to reach Google's servers.

## Troubleshooting

### Common Issues

1. **"Geocoding failed" errors**
   - Check that `GOOGLE_MAPS_KEY` is set correctly in `.env`
   - Verify the API key has access to the Geocoding API
   - Check the application logs for detailed error messages

2. **Locations created without coordinates**
   - This is normal behavior when geocoding fails
   - Check logs to understand why geocoding failed
   - Coordinates can be added later by updating the location with address information

3. **"OVER_QUERY_LIMIT" errors**
   - You've exceeded the API rate limits or quotas
   - Check your Google Cloud Console for usage and billing information
   - Consider implementing request throttling

### Debug Logs

Check the application logs for geocoding-related messages:

```bash
tail -f storage/logs/laravel.log | grep -i geocod
```

Log entries include:
- `Attempting to geocode address: [address]`
- `Geocoding successful for address: [address]`
- `Geocoding failed for address: [address]`
- `Google Maps API key not configured for geocoding` 
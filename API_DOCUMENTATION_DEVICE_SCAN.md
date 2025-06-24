# Device Scan API Documentation

## Overview
This document provides comprehensive API documentation for the device scanning functionality. The scanning system allows devices to perform WiFi channel scans and report results back to the server.

## Authentication
All device-to-server communication requires authentication using device credentials:
- `device_key`: 32-character random string
- `device_secret`: 64-character random string

## Workflow Overview
1. **Initiate Scan**: Server initiates a scan for a specific location
2. **Device Polls**: Device checks for new scan requests via heartbeat
3. **Update Started**: Device notifies server that scan has started
4. **2.4GHz Results**: Device sends 2.4GHz scan results
5. **5GHz Results**: Device sends 5GHz scan results (automatically completes scan)
6. **Error Handling**: Device can report scan failures at any stage

## Scan Status Flow
```
initiated → started → scanning_5g → completed
     ↓           ↓           ↓
   failed ← failed ← failed
```

## API Endpoints

### 1. Initiate Scan (Server-side)
**Used by**: Web application to start a scan
```
POST /api/locations/{location_id}/scan/initiate
```

**Headers:**
```
Content-Type: application/json
Authorization: Bearer {token}
```

**Response:**
```json
{
    "message": "Channel scan initiated successfully",
    "data": {
        "scan_id": 12345,
        "scan_result_id": 67890,
        "status": "initiated",
        "device_id": 1
    }
}
```

---

### 2. Get Scan Status (Server-side)
**Used by**: Web application to check scan progress
```
GET /api/locations/{location_id}/scan/{scan_id}/status
```

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "data": {
        "scan_id": 12345,
        "status": "completed",
        "progress": 100,
        "scan_results_2g": [
            {
                "channel": 1,
                "signal": -77,
                "bssid": "64:FB:92:76:BE:7E",
                "ssid": "PPC1BE72-2.4G"
            },
            {
                "channel": 6,
                "signal": -21,
                "bssid": "9C:A2:F4:E9:1F:42",
                "ssid": "Tik-Tak"
            }
        ],
        "scan_results_5g": [
            {
                "channel": 36,
                "signal": -42,
                "bssid": "9E:A2:F4:E9:1F:43",
                "ssid": "Tik-Tak-5G"
            }
        ],
        "optimal_channel_2g": 1,
        "optimal_channel_5g": 36,
        "nearby_networks_2g": 8,
        "nearby_networks_5g": 3,
        "interference_level_2g": "medium",
        "interference_level_5g": "low",
        "error_message": null,
        "started_at": "2024-01-15T10:30:00Z",
        "completed_at": "2024-01-15T10:35:00Z",
        "is_completed": true,
        "is_failed": false,
        "is_in_progress": false
    }
}
```

---

### 3. Update Scan Started (Device)
**Used by**: Device firmware to notify scan has started
```
POST /api/devices/{device_key}/{device_secret}/scan/{scan_id}/started
```

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{}
```

**Response:**
```json
{
    "message": "Scan status updated to started",
    "status": "started"
}
```

---

### 4. Update 2.4GHz Scan Results (Device)
**Used by**: Device firmware to submit 2.4GHz scan results
```
POST /api/devices/{device_key}/{device_secret}/scan/{scan_id}/2g-results
```

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
    "scan_results": [
        {
            "channel": 1,
            "signal": -77,
            "bssid": "64:FB:92:76:BE:7E",
            "ssid": "PPC1BE72-2.4G"
        },
        {
            "channel": 1,
            "signal": -64,
            "bssid": "64:FB:92:76:BE:7F",
            "ssid": "www.excitel.com"
        },
        {
            "channel": 2,
            "signal": -54,
            "bssid": "30:DE:4B:CC:34:52",
            "ssid": "GajjabKaSpeed"
        },
        {
            "channel": 6,
            "signal": -21,
            "bssid": "9C:A2:F4:E9:1F:42",
            "ssid": "Tik-Tak"
        },
        {
            "channel": 11,
            "signal": -57,
            "bssid": "8C:A3:99:09:AA:59",
            "ssid": "Bella502"
        }
    ],
    "nearby_networks": 8,
    "interference_level": "medium"
}
```

**Field Descriptions:**
- `scan_results`: Array of detected networks, each containing:
  - `channel`: Integer channel number (1-14 for 2.4GHz)
  - `signal`: Integer signal strength in dBm (negative values)
  - `bssid`: String MAC address of the access point
  - `ssid`: String network name (can be empty for hidden networks)
- `nearby_networks`: Integer count of detected networks (should match array length)
- `interference_level`: String enum: "low", "medium", "high"

**Response:**
```json
{
    "message": "2.4G scan results updated successfully",
    "status": "scanning_5g"
}
```

---

### 5. Update 5GHz Scan Results (Device)
**Used by**: Device firmware to submit 5GHz scan results and complete scan
```
POST /api/devices/{device_key}/{device_secret}/scan/{scan_id}/5g-results
```

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
    "scan_results": [
        {
            "channel": 36,
            "signal": -42,
            "bssid": "9E:A2:F4:E9:1F:43",
            "ssid": "Tik-Tak-5G"
        },
        {
            "channel": 40,
            "signal": -55,
            "bssid": "AC:15:A2:B4:C7:D8",
            "ssid": "HomeWiFi_5G"
        },
        {
            "channel": 149,
            "signal": -52,
            "bssid": "B2:C3:D4:E5:F6:A7",
            "ssid": "Office_5GHz"
        }
    ],
    "nearby_networks": 3,
    "interference_level": "low"
}
```

**Field Descriptions:**
- `scan_results`: Array of detected networks, each containing:
  - `channel`: Integer channel number (valid 5GHz channels)
  - `signal`: Integer signal strength in dBm (negative values)
  - `bssid`: String MAC address of the access point
  - `ssid`: String network name (can be empty for hidden networks)
- `nearby_networks`: Integer count of detected networks (should match array length)
- `interference_level`: String enum: "low", "medium", "high"

**Response:**
```json
{
    "message": "5G scan results updated successfully. Scan completed.",
    "status": "completed"
}
```

---

### 6. Mark Scan as Failed (Device)
**Used by**: Device firmware to report scan failure
```
POST /api/devices/{device_key}/{device_secret}/scan/{scan_id}/failed
```

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
    "error_message": "Hardware error during scan operation"
}
```

**Field Descriptions:**
- `error_message`: String describing the failure reason (optional)

**Response:**
```json
{
    "message": "Scan marked as failed",
    "status": "failed"
}
```

---

## Server Processing

### Network Data Processing
The server receives detailed network information for each detected access point and processes it to:

1. **Calculate Optimal Channels**: Determines the best channels by analyzing:
   - Signal strength of networks on each channel
   - Number of networks per channel (congestion)
   - Channel overlap and interference patterns

2. **Store Network Details**: All individual network information is preserved including:
   - BSSID (unique identifier for each access point)
   - SSID (network name)
   - Channel and signal strength

3. **Generate Recommendations**: Based on the scan results, provides:
   - Optimal channel recommendations for 2.4GHz and 5GHz
   - Interference level assessment
   - Network congestion analysis

### Validation Rules
- All networks in `scan_results` array must have valid channel numbers
- Signal strength must be negative integers (dBm format)
- BSSID must be valid MAC address format (XX:XX:XX:XX:XX:XX)
- SSID can be empty string for hidden networks
- `nearby_networks` count should match the length of `scan_results` array

---

## Data Structures

### Scan Status Values
- `initiated`: Scan request created, waiting for device to start
- `started`: Device has begun scanning process
- `scanning_2g`: 2.4GHz scan completed, processing 5GHz
- `scanning_5g`: Currently scanning 5GHz channels
- `completed`: Scan successfully completed
- `failed`: Scan failed due to error

### Progress Percentages
- `initiated`: 0%
- `started`: 20%
- `scanning_2g`: 50%
- `scanning_5g`: 80%
- `completed`: 100%
- `failed`: 0%

### Valid Channel Numbers

**2.4GHz Channels**: 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14

**5GHz Channels**: 36, 40, 44, 48, 52, 56, 60, 64, 100, 104, 108, 112, 116, 120, 124, 128, 132, 136, 140, 144, 149, 153, 157, 161, 165

### Signal Strength Format
- Values are in dBm (decibels relative to milliwatt)
- Negative values (e.g., -45 dBm)
- Higher values indicate stronger signals (e.g., -30 dBm is stronger than -60 dBm)

### Interference Levels
- `low`: Minimal interference detected
- `medium`: Moderate interference present
- `high`: High interference, may affect performance

## Error Handling

### HTTP Status Codes
- `200`: Success
- `401`: Unauthorized (invalid device credentials)
- `404`: Resource not found (scan not found, device not found)
- `422`: Validation error (invalid request data)
- `500`: Internal server error

### Common Error Responses
```json
{
    "error": "Invalid device credentials"
}
```

```json
{
    "error": "Scan not found"
}
```

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "scan_results": ["The scan results field is required."],
        "interference_level": ["The selected interference level is invalid."]
    }
}
```

## Implementation Notes for Firmware

### 1. Device Discovery of New Scans
The device should check for new scan requests during its regular heartbeat cycle:
```
GET /api/devices/{device_key}/{device_secret}/heartbeat
```

The heartbeat response includes a `scan_counter` field. If this value increases, the device should check for new scan requests.

### 2. Scan Execution Flow
1. Receive scan request via heartbeat
2. Call `POST /scan/{scan_id}/started` to notify scan start
3. Perform 2.4GHz channel scan
4. Call `POST /scan/{scan_id}/2g-results` with results
5. Perform 5GHz channel scan
6. Call `POST /scan/{scan_id}/5g-results` with results (automatically completes)
7. Handle any errors by calling `POST /scan/{scan_id}/failed`

### 3. Scan Data Collection
- Scan each channel for adequate time to get accurate readings
- Record detailed information for each detected network:
  - Channel number
  - Signal strength in dBm (negative values)
  - BSSID (MAC address of access point)
  - SSID (network name, empty for hidden networks)
- Count total nearby networks per frequency band
- Assess interference level based on network density and signal overlap
- Format data as array of network objects (not aggregated channel data)

### 4. Error Scenarios
- Hardware failure during scan
- Timeout during scan operation
- Invalid scan parameters
- Network connectivity issues

Always report failures using the `/failed` endpoint with descriptive error messages.

## Security Considerations
- All device endpoints require valid device credentials
- Device credentials should be securely stored on device
- Implement proper SSL/TLS for all communications
- Validate all input data before processing

## Testing
Use the provided endpoints to test the complete scan workflow:
1. Initiate scan via web interface
2. Simulate device responses using API testing tools
3. Verify scan status updates correctly
4. Test error scenarios and recovery 
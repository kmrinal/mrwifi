# Firmware API Documentation

This document describes the API endpoints for managing firmware files in the MrWifi system.

## Overview

The Firmware API allows users to:
- Upload tar.gz firmware files
- Manage firmware metadata (name, version, description)
- Enable/disable firmware
- Download firmware files
- Verify file integrity using MD5 checksums

## Authentication

All firmware endpoints require authentication using the `auth:api` middleware. Include the Bearer token in the Authorization header:

```
Authorization: Bearer your_jwt_token_here
```

## Endpoints

### 1. List All Firmware

**GET** `/api/firmware`

Returns a list of all firmware files.

**Response:**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Router Firmware v2.1",
            "model": "820AX",
            "file_name": "firmware-v2.1.tar.gz",
            "file_path": "firmware/1635789123_abc123_firmware-v2.1.tar.gz",
            "md5sum": "d41d8cd98f00b204e9800998ecf8427e",
            "file_size": 52428800,
            "is_enabled": true,
            "description": "Latest stable firmware with bug fixes",
            "version": "2.1.0",
            "created_at": "2025-05-29T07:30:27.000000Z",
            "updated_at": "2025-05-29T07:30:27.000000Z"
        }
    ]
}
```

### 2. Upload New Firmware

**POST** `/api/firmware`

Upload a new firmware file.

**Request Parameters:**
- `name` (required, string, max:255) - Firmware name
- `model` (optional, string/integer) - Device model: 1 (820AX), 2 (835AX), "820AX", or "835AX"
- `version` (optional, string, max:100) - Firmware version/release date
- `description` (optional, string, max:1000) - Firmware description
- `file` (required, file) - The tar.gz firmware file (max 100MB)
- `is_enabled` (optional, boolean) - Enable/disable firmware (default: true)

**Example using cURL:**
```bash
curl -X POST \
  -H "Authorization: Bearer your_jwt_token_here" \
  -F "name=Router Firmware v2.2" \
  -F "model=1" \
  -F "version=2.2.0" \
  -F "description=New firmware with enhanced security" \
  -F "file=@firmware-v2.2.tar.gz" \
  -F "is_enabled=true" \
  http://your-domain.com/api/firmware
```

**Response:**
```json
{
    "status": "success",
    "message": "Firmware uploaded successfully",
    "data": {
        "id": 2,
        "name": "Router Firmware v2.2",
        "model": "820AX",
        "file_name": "firmware-v2.2.tar.gz",
        "file_path": "firmware/1635789456_def456_firmware-v2.2.tar.gz",
        "md5sum": "098f6bcd4621d373cade4e832627b4f6",
        "file_size": 54525952,
        "is_enabled": true,
        "description": "New firmware with enhanced security",
        "version": "2.2.0",
        "created_at": "2025-05-29T08:15:42.000000Z",
        "updated_at": "2025-05-29T08:15:42.000000Z"
    }
}
```

### 3. Get Enabled Firmware Only

**GET** `/api/firmware/enabled`

Returns only enabled firmware files.

**Response:**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Router Firmware v2.1",
            "model": "820AX",
            "is_enabled": true,
            // ... other fields
        }
    ]
}
```

### 4. Get Available Device Models

**GET** `/api/firmware/models`

Returns the list of available device models.

**Response:**
```json
{
    "status": "success",
    "data": {
        "1": "820AX",
        "2": "835AX"
    }
}
```

### 5. Get Firmware by Device Model

**GET** `/api/firmware/model/{model}`

Returns firmware files for a specific device model.

**Parameters:**
- `model` (required, string/integer) - The device model to filter by: 1, 2, "820AX", or "835AX"

**Examples:** 
- `/api/firmware/model/1` (for 820AX)
- `/api/firmware/model/820AX` (for 820AX)
- `/api/firmware/model/2` (for 835AX)

**Response:**
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Router Firmware v2.1",
            "model": "820AX",
            "is_enabled": true,
            // ... other fields
        }
    ]
}
```

### 6. Get Specific Firmware

**GET** `/api/firmware/{id}`

Get details of a specific firmware.

**Response:**
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "name": "Router Firmware v2.1",
        // ... all firmware fields
    }
}
```

### 7. Update Firmware Metadata

**PUT** `/api/firmware/{id}`

Update firmware metadata (does not change the file).

**Request Parameters:**
- `name` (required, string, max:255)
- `model` (optional, string/integer) - Device model: 1 (820AX), 2 (835AX), "820AX", or "835AX"
- `version` (optional, string, max:100)
- `description` (optional, string, max:1000)
- `is_enabled` (optional, boolean)

**Response:**
```json
{
    "status": "success",
    "message": "Firmware updated successfully",
    "data": {
        // updated firmware object
    }
}
```

### 8. Delete Firmware

**DELETE** `/api/firmware/{id}`

Deletes the firmware record and associated file from storage.

**Response:**
```json
{
    "status": "success",
    "message": "Firmware deleted successfully"
}
```

### 9. Download Firmware

**GET** `/api/firmware/{id}/download`

Downloads the firmware file.

**Response:** Binary file download with appropriate headers.

### 10. Toggle Firmware Status

**POST** `/api/firmware/{id}/toggle-status`

Toggles the enabled/disabled status of firmware.

**Response:**
```json
{
    "status": "success",
    "message": "Firmware status updated successfully",
    "data": {
        "id": 1,
        "is_enabled": false,
        // ... other fields
    }
}
```

### 11. Verify Firmware Integrity

**POST** `/api/firmware/{id}/verify`

Verifies the file integrity by comparing stored MD5 with current file MD5.

**Response:**
```json
{
    "status": "success",
    "integrity": true,
    "stored_md5": "d41d8cd98f00b204e9800998ecf8427e",
    "current_md5": "d41d8cd98f00b204e9800998ecf8427e",
    "message": "File integrity verified"
}
```

## Error Responses

All endpoints return consistent error responses:

```json
{
    "status": "error",
    "message": "Error description",
    "errors": {
        // validation errors (if applicable)
    }
}
```

Common HTTP status codes:
- `200` - Success
- `201` - Created (for file uploads)
- `404` - Firmware not found
- `422` - Validation error
- `500` - Server error

## File Requirements

- **Accepted formats:** `.tar.gz`, `.tgz`, `.tar`
- **Maximum file size:** 100MB
- **File validation:** Files are validated for proper tar.gz format
- **Storage:** Files are stored in `storage/app/public/firmware/` directory
- **Naming:** Files are renamed with timestamp and random string to prevent conflicts

## Model and Status Constraints

- **Available Models:** Only 2 models are supported:
  - Model ID 1: "820AX"
  - Model ID 2: "835AX"
- **Model Input:** Can accept either numeric ID (1, 2) or string ("820AX", "835AX")
- **Status Options:** Only Enable (true) or Disable (false)

## Database Schema

The `firmware` table contains:
- `id` - Primary key
- `name` - Firmware name/title
- `model` - Device model this firmware is for
- `file_name` - Original uploaded filename
- `file_path` - Storage path relative to public disk
- `md5sum` - MD5 checksum (32 characters)
- `file_size` - File size in bytes
- `is_enabled` - Boolean flag for enable/disable
- `description` - Optional text description
- `version` - Optional version string
- `created_at` / `updated_at` - Timestamps
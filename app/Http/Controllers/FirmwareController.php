<?php

namespace App\Http\Controllers;

use App\Models\Firmware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Device;
use Illuminate\Support\Facades\Log;

class FirmwareController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware will be defined in routes files instead
    }

    /**
     * Display a listing of the firmware.
     */
    public function index()
    {
        $firmware = Firmware::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $firmware
        ]);
    }

    /**
     * Show the form for creating a new firmware.
     */
    public function create()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Use POST /firmware with file upload'
        ]);
    }

    /**
     * Store a newly created firmware in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'model' => 'nullable|in:1,2,820AX,835AX',
            'version' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:gz,tar,tar.gz|max:102400', // Max 100MB
            'is_enabled' => 'nullable|boolean',
            'default_model_firmware' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            
            // Validate file extension for tar.gz files
            if (!$this->isValidTarGzFile($originalName)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File must be a tar.gz archive'
                ], 422);
            }

            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '_' . $originalName;
            
            // Create firmware directory if it doesn't exist
            $firmwarePath = 'firmware';
            if (!Storage::disk('public')->exists($firmwarePath)) {
                Storage::disk('public')->makeDirectory($firmwarePath);
            }
            
            // Store the file
            $filePath = $file->storeAs($firmwarePath, $filename, 'public');
            
            // Get file info
            $fileSize = $file->getSize();
            $fullPath = Storage::disk('public')->path($filePath);
            $md5sum = md5_file($fullPath);

            // Convert model ID to model name if needed
            $model = $request->model;
            if (is_numeric($model)) {
                $model = Firmware::getModelById((int)$model);
            }

            // Create firmware record
            $firmware = Firmware::create([
                'name' => $request->name,
                'model' => $model,
                'file_name' => $originalName,
                'file_path' => $filePath,
                'md5sum' => $md5sum,
                'file_size' => $fileSize,
                'is_enabled' => $request->boolean('is_enabled', true),
                'description' => $request->description,
                'version' => $request->version,
                'default_model_firmware' => false,
            ]);

            // If this firmware is set as default, ensure it's the only default for this model
            if ($request->boolean('default_model_firmware', false)) {
                $firmware->setAsDefault();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Firmware uploaded successfully',
                'data' => $firmware
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to upload firmware: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getDeviceFirmware($device_key, $device_secret)
    {
       $device = Device::where('device_key', $device_key)->where('device_secret', $device_secret)->first();
       if (!$device) {
        return response()->json([
            'status' => 'error',
            'message' => 'Device not found'
        ], 404);
       }

       // Try to get the default firmware for the device model first
       $firmware = Firmware::getDefaultForModel($device->model);
       
       // If no default firmware found, get the latest enabled firmware for the model
       if (!$firmware) {
           $firmware = Firmware::forModel($device->model)->enabled()->orderBy('created_at', 'desc')->first();
       }
       
       // If still no firmware found, get the latest firmware for the model (even if disabled)
       if (!$firmware) {
           $firmware = Firmware::forModel($device->model)->orderBy('created_at', 'desc')->first();
       }
       
       if (!$firmware) {
        return response()->json([
            'status' => 'error',
            'message' => 'No firmware found for model: ' . $device->model
        ], 404);
       }

       // Return download path for the firmware
       $downloadPath = Storage::disk('public')->url($firmware->file_path);
       $firmware->download_path = $downloadPath;

       return response()->json([
        'status' => 'success',
        'data' => $firmware
       ]);
    }

    /**
     * Display the specified firmware.
     */
    public function show(Firmware $firmware)
    {
        return response()->json([
            'status' => 'success',
            'data' => $firmware
        ]);
    }

    /**
     * Show the form for editing the specified firmware.
     */
    public function edit(Firmware $firmware)
    {
        return response()->json([
            'status' => 'success',
            'data' => $firmware
        ]);
    }

    /**
     * Update the specified firmware in storage.
     */
    public function update(Request $request, Firmware $firmware)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'model' => 'nullable|in:1,2,820AX,835AX',
            'version' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'is_enabled' => 'nullable|boolean',
            'default_model_firmware' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Convert model ID to model name if needed
            $model = $request->model;
            if (is_numeric($model)) {
                $model = Firmware::getModelById((int)$model);
            }

            $firmware->update([
                'name' => $request->name,
                'model' => $model,
                'version' => $request->version,
                'description' => $request->description,
                'is_enabled' => $request->boolean('is_enabled', $firmware->is_enabled),
                'default_model_firmware' => $request->boolean('default_model_firmware', $firmware->default_model_firmware),
            ]);

            // If this firmware is set as default, ensure it's the only default for this model
            if ($firmware->default_model_firmware) {
                $firmware->setAsDefault();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Firmware updated successfully',
                'data' => $firmware->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update firmware: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified firmware from storage.
     */
    public function destroy(Firmware $firmware)
    {
        try {
            // Delete the file from storage
            if ($firmware->fileExists()) {
                Storage::disk('public')->delete($firmware->file_path);
            }

            // Delete the database record
            $firmware->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Firmware deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete firmware: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download the firmware file.
     */
    public function download(Firmware $firmware)
    {
        if (!$firmware->fileExists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found'
            ], 404);
        }

        try {
            return Storage::disk('public')->download($firmware->file_path, $firmware->file_name);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to download file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle the enabled status of firmware.
     */
    public function toggleStatus(Firmware $firmware)
    {
        try {
            $firmware->update([
                'is_enabled' => !$firmware->is_enabled
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Firmware status updated successfully',
                'data' => $firmware->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get only enabled firmware.
     */
    public function enabled()
    {
        $firmware = Firmware::enabled()->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $firmware
        ]);
    }

    /**
     * Get firmware for a specific device model.
     */
    public function byModel($model)
    {
        // Convert model ID to model name if needed
        if (is_numeric($model)) {
            $model = Firmware::getModelById((int)$model);
            if (!$model) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid model ID'
                ], 400);
            }
        }

        $firmware = Firmware::forModel($model)->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $firmware
        ]);
    }

    /**
     * Get available device models.
     */
    public function models()
    {
        return response()->json([
            'status' => 'success',
            'data' => Firmware::getAvailableModels()
        ]);
    }

    /**
     * Get default firmware for all models.
     */
    public function getDefaults()
    {
        try {
            $models = Firmware::getAvailableModels();
            $defaults = [];
            
            foreach ($models as $id => $modelName) {
                $defaultFirmware = Firmware::getDefaultForModel($modelName);
                $defaults[$modelName] = $defaultFirmware;
            }
            
            return response()->json([
                'status' => 'success',
                'data' => $defaults
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get default firmware: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify firmware file integrity.
     */
    public function verify(Firmware $firmware)
    {
        if (!$firmware->fileExists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found',
                'integrity' => false
            ], 404);
        }

        try {
            $currentMd5 = md5_file($firmware->full_file_path);
            $isValid = $currentMd5 === $firmware->md5sum;

            return response()->json([
                'status' => 'success',
                'integrity' => $isValid,
                'stored_md5' => $firmware->md5sum,
                'current_md5' => $currentMd5,
                'message' => $isValid ? 'File integrity verified' : 'File integrity check failed'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to verify file: ' . $e->getMessage(),
                'integrity' => false
            ], 500);
        }
    }

    /**
     * Set the specified firmware as the default for its model.
     */
    public function setDefault(Firmware $firmware)
    {
        try {
            $firmware->setAsDefault();
            return response()->json([
                'status' => 'success',
                'message' => 'Firmware set as default successfully',
                'data' => $firmware->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to set firmware as default: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if the file is a valid tar.gz file.
     */
    private function isValidTarGzFile($filename)
    {
        $validExtensions = ['.tar.gz', '.tgz', '.tar'];
        
        foreach ($validExtensions as $extension) {
            if (Str::endsWith(strtolower($filename), $extension)) {
                return true;
            }
        }
        
        return false;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Firmware extends Model
{
    use HasFactory;

    /**
     * Available device models
     */
    const MODEL_820AX = '820AX';
    const MODEL_835AX = '835AX';

    /**
     * Status constants
     */
    const STATUS_ENABLED = true;
    const STATUS_DISABLED = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'model',
        'file_name',
        'file_path',
        'md5sum',
        'file_size',
        'is_enabled',
        'description',
        'version',
        'default_model_firmware',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_enabled' => 'boolean',
        'file_size' => 'integer',
        'default_model_firmware' => 'boolean',
    ];

    /**
     * Get the formatted file size
     *
     * @return string
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if the file exists in storage
     *
     * @return bool
     */
    public function fileExists()
    {
        return Storage::disk('public')->exists($this->file_path);
    }

    /**
     * Get the full file path
     *
     * @return string
     */
    public function getFullFilePathAttribute()
    {
        return Storage::disk('public')->path($this->file_path);
    }

    /**
     * Get the download URL
     *
     * @return string
     */
    public function getDownloadUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Scope to get only enabled firmware
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Scope to get only disabled firmware
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisabled($query)
    {
        return $query->where('is_enabled', false);
    }

    /**
     * Scope to filter firmware by device model
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForModel($query, $model)
    {
        return $query->where('model', $model);
    }

    /**
     * Scope to get only default firmware
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefault($query)
    {
        return $query->where('default_model_firmware', true);
    }

    /**
     * Scope to get default firmware for a specific model
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefaultForModel($query, $model)
    {
        return $query->where('model', $model)->where('default_model_firmware', true);
    }

    /**
     * Get the default firmware for a specific model
     *
     * @param string $model
     * @return \App\Models\Firmware|null
     */
    public static function getDefaultForModel($model)
    {
        return static::defaultForModel($model)->first();
    }

    /**
     * Set this firmware as default for its model
     * This will unset any other default firmware for the same model
     *
     * @return bool
     */
    public function setAsDefault()
    {
        // First, unset any existing default firmware for this model
        static::where('model', $this->model)
            ->where('default_model_firmware', true)
            ->update(['default_model_firmware' => false]);

        // Then set this firmware as default
        return $this->update(['default_model_firmware' => true]);
    }

    /**
     * Get available models
     *
     * @return array
     */
    public static function getAvailableModels()
    {
        return [
            1 => self::MODEL_820AX,
            2 => self::MODEL_835AX,
        ];
    }

    /**
     * Get model by ID
     *
     * @param int $id
     * @return string|null
     */
    public static function getModelById($id)
    {
        $models = self::getAvailableModels();
        return $models[$id] ?? null;
    }

    /**
     * Get model ID by model name
     *
     * @param string $model
     * @return int|null
     */
    public static function getModelId($model)
    {
        $models = array_flip(self::getAvailableModels());
        return $models[$model] ?? null;
    }

    /**
     * Get status text
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        return $this->is_enabled ? 'Enable' : 'Disable';
    }
}

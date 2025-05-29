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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_enabled' => 'boolean',
        'file_size' => 'integer',
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

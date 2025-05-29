<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'is_enabled',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'is_default' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get the blocked domains for this category.
     */
    public function blockedDomains()
    {
        return $this->hasMany(BlockedDomain::class);
    }

    /**
     * Get the active blocked domains for this category.
     */
    public function activeBlockedDomains()
    {
        return $this->hasMany(BlockedDomain::class)->where('is_active', true);
    }

    /**
     * Get the count of domains in this category.
     */
    public function getDomainCountAttribute()
    {
        return $this->blockedDomains()->count();
    }

    /**
     * Get the count of active domains in this category.
     */
    public function getActiveDomainCountAttribute()
    {
        return $this->activeBlockedDomains()->count();
    }

    /**
     * Scope to get enabled categories.
     */
    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Scope to get categories ordered by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get the badge class for this category.
     */
    public function getBadgeClassAttribute()
    {
        $colorMap = [
            'danger' => 'badge-category-adult',
            'warning' => 'badge-category-gambling',
            'primary' => 'badge-category-malware',
            'info' => 'badge-category-social',
            'success' => 'badge-category-streaming',
            'secondary' => 'badge-category-custom',
        ];

        return $colorMap[$this->color] ?? 'badge-category-custom';
    }

    /**
     * Get the avatar class for this category.
     */
    public function getAvatarClassAttribute()
    {
        $colorMap = [
            'danger' => 'bg-light-danger',
            'warning' => 'bg-light-warning',
            'primary' => 'bg-light-primary',
            'info' => 'bg-light-info',
            'success' => 'bg-light-success',
            'secondary' => 'bg-light-secondary',
        ];

        return $colorMap[$this->color] ?? 'bg-light-secondary';
    }
}

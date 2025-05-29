<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BlockedDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'category_id',
        'notes',
        'block_subdomains',
        'is_active',
        'source',
        'metadata',
    ];

    protected $casts = [
        'block_subdomains' => 'boolean',
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($domain) {
            $domain->domain = self::normalizeDomain($domain->domain);
            self::validateDomain($domain->domain);
        });

        static::updating(function ($domain) {
            if ($domain->isDirty('domain')) {
                $domain->domain = self::normalizeDomain($domain->domain);
                self::validateDomain($domain->domain);
            }
        });
    }

    /**
     * Get the category that owns the blocked domain.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope to get active domains.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get domains by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope to search domains.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('domain', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
    }

    /**
     * Normalize domain name.
     */
    public static function normalizeDomain($domain)
    {
        $domain = strtolower(trim($domain));
        
        // Remove protocol if present
        $domain = preg_replace('/^https?:\/\//', '', $domain);
        
        // Remove www. prefix if present
        $domain = preg_replace('/^www\./', '', $domain);
        
        // Remove trailing slash
        $domain = rtrim($domain, '/');
        
        // Remove port if present
        $domain = preg_replace('/:\d+$/', '', $domain);
        
        return $domain;
    }

    /**
     * Validate domain format.
     */
    public static function validateDomain($domain)
    {
        $validator = Validator::make(['domain' => $domain], [
            'domain' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                // Basic domain validation
                if (!filter_var('http://' . $value, FILTER_VALIDATE_URL)) {
                    $fail('The domain format is invalid.');
                }
                
                // Check for valid characters
                if (!preg_match('/^[a-z0-9.-]+$/', $value)) {
                    $fail('The domain contains invalid characters.');
                }
                
                // Check for minimum length
                if (strlen($value) < 3) {
                    $fail('The domain is too short.');
                }
                
                // Check for valid TLD
                if (!preg_match('/\.[a-z]{2,}$/', $value)) {
                    $fail('The domain must have a valid top-level domain.');
                }
            }]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Check if this domain blocks a given URL.
     */
    public function blocks($url)
    {
        $domain = self::normalizeDomain($url);
        
        if ($this->block_subdomains) {
            return $domain === $this->domain || str_ends_with($domain, '.' . $this->domain);
        }
        
        return $domain === $this->domain;
    }

    /**
     * Get formatted domain display.
     */
    public function getFormattedDomainAttribute()
    {
        return $this->block_subdomains ? "*." . $this->domain : $this->domain;
    }

    /**
     * Bulk import domains.
     */
    public static function bulkImport(array $domains, $categoryId, $options = [])
    {
        $defaults = [
            'block_subdomains' => true,
            'is_active' => true,
            'source' => 'import',
            'overwrite' => false,
            'notes' => null,
        ];
        
        $options = array_merge($defaults, $options);
        $imported = 0;
        $errors = [];

        foreach ($domains as $domain) {
            try {
                $normalizedDomain = self::normalizeDomain($domain);
                
                if (empty($normalizedDomain)) {
                    $errors[] = "Empty domain skipped";
                    continue;
                }

                $existingDomain = self::where('domain', $normalizedDomain)
                                    ->where('category_id', $categoryId)
                                    ->first();

                if ($existingDomain && !$options['overwrite']) {
                    $errors[] = "Domain {$normalizedDomain} already exists";
                    continue;
                }

                if ($existingDomain && $options['overwrite']) {
                    $existingDomain->update([
                        'notes' => $options['notes'],
                        'block_subdomains' => $options['block_subdomains'],
                        'is_active' => $options['is_active'],
                        'source' => $options['source'],
                        'metadata' => [
                            'import_batch' => now()->timestamp,
                            'updated_by_import' => true,
                        ],
                    ]);
                } else {
                    self::create([
                        'domain' => $normalizedDomain,
                        'category_id' => $categoryId,
                        'notes' => $options['notes'],
                        'block_subdomains' => $options['block_subdomains'],
                        'is_active' => $options['is_active'],
                        'source' => $options['source'],
                        'metadata' => [
                            'import_batch' => now()->timestamp,
                        ],
                    ]);
                }

                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Error importing {$domain}: " . $e->getMessage();
            }
        }

        return [
            'imported' => $imported,
            'errors' => $errors,
        ];
    }
}

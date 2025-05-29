<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Adult Content',
                'slug' => 'adult-content',
                'description' => 'Domains containing adult or explicit content',
                'icon' => 'x-octagon',
                'color' => 'danger',
                'is_enabled' => true,
                'is_default' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Gambling',
                'slug' => 'gambling',
                'description' => 'Online gambling and betting websites',
                'icon' => 'dollar-sign',
                'color' => 'warning',
                'is_enabled' => true,
                'is_default' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Malware',
                'slug' => 'malware',
                'description' => 'Domains known to host malware or malicious content',
                'icon' => 'shield-off',
                'color' => 'primary',
                'is_enabled' => true,
                'is_default' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Social Media',
                'slug' => 'social-media',
                'description' => 'Social networking and media platforms',
                'icon' => 'users',
                'color' => 'info',
                'is_enabled' => false,
                'is_default' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Streaming',
                'slug' => 'streaming',
                'description' => 'Video and media streaming services',
                'icon' => 'film',
                'color' => 'success',
                'is_enabled' => false,
                'is_default' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Custom List',
                'slug' => 'custom-list',
                'description' => 'Custom domains added by administrators',
                'icon' => 'tag',
                'color' => 'secondary',
                'is_enabled' => true,
                'is_default' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }
    }
}

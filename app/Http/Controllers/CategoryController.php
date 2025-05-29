<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::withCount('blockedDomains');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            if ($request->status === 'enabled') {
                $query->where('is_enabled', true);
            } elseif ($request->status === 'disabled') {
                $query->where('is_enabled', false);
            }
        }

        $categories = $query->ordered()->get();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'categories' => $categories
            ]);
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'icon' => 'required|string|max:50',
            'color' => 'required|in:primary,secondary,success,danger,warning,info',
            'is_enabled' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'icon' => $request->icon,
                'color' => $request->color,
                'is_enabled' => $request->boolean('is_enabled', true),
                'is_default' => false,
                'sort_order' => $request->sort_order ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['blockedDomains' => function ($query) {
            $query->latest()->limit(10);
        }]);

        $category->loadCount('blockedDomains');

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'icon' => 'sometimes|string|max:50',
            'color' => 'sometimes|in:primary,secondary,success,danger,warning,info',
            'is_enabled' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $updateData = $request->only([
                'name', 'description', 'icon', 'color', 'is_enabled', 'sort_order'
            ]);

            // Update slug if name changed
            if ($request->filled('name') && $request->name !== $category->name) {
                $updateData['slug'] = Str::slug($request->name);
            }

            $category->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'category' => $category->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            if ($category->is_default) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete default category'
                ], 422);
            }

            if ($category->blockedDomains()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete category with blocked domains. Please move or delete the domains first.'
                ], 422);
            }

            $categoryName = $category->name;
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => "Category '{$categoryName}' has been deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle category status.
     */
    public function toggle(Category $category)
    {
        try {
            $category->update(['is_enabled' => !$category->is_enabled]);

            return response()->json([
                'success' => true,
                'message' => $category->is_enabled 
                    ? "Category '{$category->name}' enabled" 
                    : "Category '{$category->name}' disabled",
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reorder categories.
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:categories,id',
            'categories.*.sort_order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            foreach ($request->categories as $categoryData) {
                Category::where('id', $categoryData['id'])
                       ->update(['sort_order' => $categoryData['sort_order']]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Categories reordered successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder categories: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get category statistics.
     */
    public function stats(Category $category)
    {
        try {
            $stats = [
                'total_domains' => $category->blockedDomains()->count(),
                'active_domains' => $category->activeBlockedDomains()->count(),
                'inactive_domains' => $category->blockedDomains()->where('is_active', false)->count(),
                'manual_domains' => $category->blockedDomains()->where('source', 'manual')->count(),
                'imported_domains' => $category->blockedDomains()->where('source', 'import')->count(),
                'api_domains' => $category->blockedDomains()->where('source', 'api')->count(),
                'recent_additions' => $category->blockedDomains()
                    ->latest()
                    ->limit(5)
                    ->get(['domain', 'created_at']),
                'domains_by_source' => $category->blockedDomains()
                    ->selectRaw('source, COUNT(*) as count')
                    ->groupBy('source')
                    ->get(),
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get category statistics: ' . $e->getMessage()
            ], 500);
        }
    }
}

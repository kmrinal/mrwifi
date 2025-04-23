<?php

namespace App\Http\Controllers;

use App\Models\CaptivePortalDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CaptivePortalDesignController extends Controller
{
    /**
     * Display a listing of the captive portal designs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $designs = auth()->user()->captivePortalDesigns()->latest()->get();
        
        return response()->json([
            'success' => true,
            'data' => $designs
        ]);
    }

    public function get_all()
    {
        // Get all designs for the user or for admin user all design they own
        if (auth()->user()->role == 'admin') {
            $designs = CaptivePortalDesign::all();
        } else {
            $designs = auth()->user()->captivePortalDesigns()->latest()->get();
        }
        
        // Add the storage URL for logo paths
        $designs->transform(function ($design) {
            if ($design->location_logo_path) {
                $design->location_logo_url = asset('storage/' . $design->location_logo_path);
            }
            return $design;
        });
        
        return response()->json([
            'success' => true,
            'data' => $designs,
            'debug' => [
                'user_id' => auth()->user()->id,
                'user_role' => auth()->user()->role,
                'design_count' => $designs->count()
            ]
        ]);
    }
    
    /**
     * Store a newly created captive portal design.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        Log::info('Create method called');
        Log::info('Request method: ' . $request->method());
        Log::info('Request all data: ', $request->all());
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'theme_color' => 'required|string|max:7',
            'welcome_message' => 'required|string|max:255',
            'login_instructions' => 'nullable|string',
            'button_text' => 'required|string|max:100',
            'show_terms' => 'boolean',
            'terms_content' => 'nullable|string',
            'privacy_content' => 'nullable|string',
            'location_logo' => 'nullable|image|max:2048',
            'background_image' => 'nullable|image|max:5120',
        ]);
        
        // Handle file uploads
        if ($request->hasFile('location_logo')) {
            $logoPath = $request->file('location_logo')->store('captive-portals/logos', 'public');
            $validated['location_logo_path'] = $logoPath;
        }
        
        if ($request->hasFile('background_image')) {
            $bgPath = $request->file('background_image')->store('captive-portals/backgrounds', 'public');
            $validated['background_image_path'] = $bgPath;
        }
        
        $design = auth()->user()->captivePortalDesigns()->create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Captive portal design created successfully',
            'data' => $design
        ], 201);
    }
    
    /**
     * Display the specified captive portal design.
     *
     * @param  int  $captivePortalDesign
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($captivePortalDesign)
    {
        Log::info('Show method called with ID: ' . $captivePortalDesign);
        Log::info('Authenticated user: ' . auth()->user()->id . ' - ' . auth()->user()->name);
        
        $design = CaptivePortalDesign::find($captivePortalDesign);
        
        if (!$design) {
            return response()->json([
                'success' => false,
                'message' => 'Design not found',
                'debug' => [
                    'id_provided' => $captivePortalDesign
                ]
            ], 404);
        }
        
        // Check if the user owns this design or is an admin
        if (auth()->user()->id !== $design->user_id && auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
                'debug' => [
                    'user_id' => auth()->user()->id,
                    'design_user_id' => $design->user_id,
                    'user_role' => auth()->user()->role
                ]
            ], 403);
        }
        
        // Add storage URL if location logo exists
        if ($design->location_logo_path) {
            $design->location_logo_url = asset('storage/' . $design->location_logo_path);
        }
        
        return response()->json([
            'success' => true,
            'data' => $design
        ]);
    }
    
    /**
     * Update the specified captive portal design.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaptivePortalDesign  $captivePortalDesign
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $captivePortalDesign)
    {
        Log::info('Update method called with ID: ' . $captivePortalDesign);
        Log::info('Request method: ' . $request->method());
        Log::info('Original method from header: ' . $request->header('X-HTTP-Method-Override', 'none'));
        Log::info('Request has _method: ' . ($request->has('_method') ? $request->input('_method') : 'none'));
        Log::info('Request all data: ', $request->all());

        // Find the design
        $design = CaptivePortalDesign::find($captivePortalDesign);
        
        if (!$design) {
            return response()->json([
                'success' => false,
                'message' => 'Design not found',
                'debug' => [
                    'id_provided' => $captivePortalDesign
                ]
            ], 404);
        }
        
        // Check if the user owns this design or is an admin
        if (auth()->user()->id !== $design->user_id && auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
                'debug' => [
                    'user_id' => auth()->user()->id,
                    'design_user_id' => $design->user_id,
                    'user_role' => auth()->user()->role
                ]
            ], 403);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'theme_color' => 'required|string|max:7',
            'welcome_message' => 'required|string|max:255',
            'login_instructions' => 'nullable|string',
            'button_text' => 'required|string|max:100',
            'show_terms' => 'boolean',
            'terms_content' => 'nullable|string',
            'privacy_content' => 'nullable|string',
            'location_logo' => 'nullable|image|max:2048',
            'background_image' => 'nullable|image|max:5120',
        ]);

        Log::info('terms of service: ' . $validated['terms_content']);
        Log::info('privacy policy: ' . $validated['privacy_content']);
        
        // Handle file uploads
        if ($request->hasFile('location_logo')) {
            // Delete old file if exists
            if ($design->location_logo_path) {
                Storage::disk('public')->delete($design->location_logo_path);
            }
            
            $logoPath = $request->file('location_logo')->store('captive-portals/logos', 'public');
            $validated['location_logo_path'] = $logoPath;
        }
        
        if ($request->hasFile('background_image')) {
            // Delete old file if exists
            if ($design->background_image_path) {
                Storage::disk('public')->delete($design->background_image_path);
            }
            
            $bgPath = $request->file('background_image')->store('captive-portals/backgrounds', 'public');
            $validated['background_image_path'] = $bgPath;
        }
        
        Log::info('Validated data: ', $validated);
        $design->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Captive portal design updated successfully',
            'data' => $design
        ]);
    }
    
    /**
     * Duplicate the specified captive portal design.
     *
     * @param  \App\Models\CaptivePortalDesign  $design
     * @return \Illuminate\Http\JsonResponse
     */
    public function duplicate(CaptivePortalDesign $design)
    {
        // Check if the user owns this design or is an admin
        if (auth()->user()->id !== $design->user_id && auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
        
        $newDesign = $design->duplicate();
        
        return response()->json([
            'success' => true,
            'message' => 'Captive portal design duplicated successfully',
            'data' => $newDesign
        ], 201);
    }
    
    /**
     * Remove the specified captive portal design.
     *
     * @param  \App\Models\CaptivePortalDesign  $design
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CaptivePortalDesign $design)
    {
        // Check if the user owns this design or is an admin
        if (auth()->user()->id !== $design->user_id && auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
                'debug' => [
                    'user_id' => auth()->user()->id,
                    'design_user_id' => $design->user_id,
                    'user_role' => auth()->user()->role
                ]
            ], 403);
        }
        
        // Delete associated files
        if ($design->location_logo_path) {
            Storage::disk('public')->delete($design->location_logo_path);
        }
        
        if ($design->background_image_path) {
            Storage::disk('public')->delete($design->background_image_path);
        }
        
        $design->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Captive portal design deleted successfully'
        ]);
    }
}
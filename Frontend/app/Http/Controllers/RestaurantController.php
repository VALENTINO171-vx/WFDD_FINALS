<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8003');
    }

    /**
     * Show restaurant creation form
     */
    public function create()
    {
        return view('admin.edit');
    }

    /**
     * Store a newly created restaurant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required|string',
            'restaurant_description' => 'nullable|string',
            'restaurant_cuisine' => 'nullable|string',
            'restaurant_address' => 'required|string',
            'restaurant_phone' => 'nullable|string',
            'restaurant_image' => 'nullable|image'
        ]);

        try {
            $response = Http::post($this->apiBaseUrl . '/api/restaurants', $validated);
            
            if ($response->successful()) {
                return redirect('/admin')->with('success', 'Restaurant added successfully!');
            } else {
                return back()->with('error', 'Failed to add restaurant');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    /**
     * Show restaurant edit form
     */
    public function edit($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/api/restaurants/' . $id);
            
            if ($response->successful()) {
                $data = $response->json();
                $restaurant = $data['restaurant'] ?? null;
                
                if ($restaurant) {
                    return view('admin.edit', ['restaurant' => (object)$restaurant]);
                }
            }
            
            return redirect('/admin')->with('error', 'Restaurant not found');
        } catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Error fetching restaurant: ' . $e->getMessage());
        }
    }

    /**
     * Update restaurant
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required|string',
            'restaurant_description' => 'nullable|string',
            'restaurant_cuisine' => 'nullable|string',
            'restaurant_address' => 'required|string',
            'restaurant_phone' => 'nullable|string',
            'restaurant_image' => 'nullable|image'
        ]);

        try {
            $response = Http::put($this->apiBaseUrl . '/api/restaurants/' . $id, $validated);
            
            if ($response->successful()) {
                return redirect('/admin')->with('success', 'Restaurant updated successfully!');
            } else {
                return back()->with('error', 'Failed to update restaurant');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    /**
     * Show restaurant details
     */
    public function show($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/api/restaurants/' . $id);
            
            if ($response->successful()) {
                $data = $response->json();
                $restaurant = $data['restaurant'] ?? null;
                
                if ($restaurant) {
                    return view('admin.show', ['restaurant' => (object)$restaurant]);
                }
            }
            
            return redirect('/admin')->with('error', 'Restaurant not found');
        } catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Error fetching restaurant: ' . $e->getMessage());
        }
    }

    /**
     * Delete restaurant
     */
    public function destroy($id)
    {
        try {
            $response = Http::delete($this->apiBaseUrl . '/api/restaurants/' . $id);
            
            if ($response->successful()) {
                return redirect('/admin')->with('success', 'Restaurant deleted successfully!');
            } else {
                return back()->with('error', 'Failed to delete restaurant');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }
}


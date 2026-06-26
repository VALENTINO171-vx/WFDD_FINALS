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
     * Show restaurant details for admin users
     */
    public function show($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/api/restaurants/' . $id);
            
            if ($response->successful()) {
                $data = $response->json();
                $restaurant = $data['restaurant'] ?? null;
                
                if ($restaurant) {
                    $restaurant = json_decode(json_encode($restaurant));
                    return view('admin.show', ['restaurant' => $restaurant]);
                }
            }
            
            return redirect('/admin')->with('error', 'Restaurant not found');
        } catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Error fetching restaurant: ' . $e->getMessage());
        }
    }

    /**
     * Show restaurant details for frontend users
     */
    public function details($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/api/restaurants/' . $id);
            
            if ($response->successful()) {
                $data = $response->json();
                $restaurant = $data['restaurant'] ?? null;
                
                if ($restaurant) {
                    return view('restaurant.restaurant', ['restaurant' => $restaurant]);
                }
            }
            
            return redirect('/home')->with('error', 'Restaurant not found');
        } catch (\Exception $e) {
            return redirect('/home')->with('error', 'Error fetching restaurant: ' . $e->getMessage());
        }
    }

    /**
     * Submit a new restaurant review
     */
    public function submitReview(Request $request, $id)
    {
        $validated = $request->validate([
            'review_rating' => 'required|integer|min:1|max:5',
            'review_comment' => 'nullable|string|max:1000',
        ]);

        $userId = session('user_id');
        $userRole = strtolower(session('user_role') ?? '');
        if (!$userId) {
            return redirect('/login')->with('error', 'Please login first');
        }

        $payload = [
            'user_id' => $userId,
            'restaurant_id' => $id,
            'review_rating' => $validated['review_rating'],
            'review_comment' => $validated['review_comment'] ?? null,
            'user_role' => $userRole,
        ];

        try {
            $response = Http::post($this->apiBaseUrl . '/api/restaurants/' . $id . '/reviews', $payload);
            
            if ($response->successful()) {
                if ($request->boolean('admin') && $userRole === 'admin') {
                    return redirect()->route('restaurants.show', $id)->with('success', 'Review submitted successfully!');
                }

                return redirect()->route('restaurant.details', $id)->with('success', 'Review submitted successfully!');
            }

            $message = $response->json('message') ?? 'Failed to submit review';
            return back()->with('error', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    public function updateReview(Request $request, $restaurantId, $reviewId)
    {
        $validated = $request->validate([
            'review_rating' => 'required|integer|min:1|max:5',
            'review_comment' => 'nullable|string|max:1000',
        ]);

        $userId = session('user_id');
        $userRole = strtolower(session('user_role') ?? '');
        if (!$userId) {
            return redirect('/login')->with('error', 'Please login first');
        }

        $payload = [
            'user_id' => $userId,
            'user_role' => $userRole,
            'review_rating' => $validated['review_rating'],
            'review_comment' => $validated['review_comment'] ?? null,
        ];

        try {
            $response = Http::put($this->apiBaseUrl . '/api/reviews/' . $reviewId, $payload);
            
            if ($response->successful()) {
                if ($request->boolean('admin') && $userRole === 'admin') {
                    return redirect()->route('restaurants.show', $restaurantId)->with('success', 'Review updated successfully!');
                }

                return redirect()->route('restaurant.details', $restaurantId)->with('success', 'Review updated successfully!');
            }

            $message = $response->json('message') ?? 'Failed to update review';
            return back()->with('error', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    public function deleteReview(Request $request, $restaurantId, $reviewId)
    {
        $userId = session('user_id');
        $userRole = strtolower(session('user_role') ?? '');
        if (!$userId) {
            return redirect('/login')->with('error', 'Please login first');
        }

        try {
            $response = Http::delete($this->apiBaseUrl . '/api/reviews/' . $reviewId, [
                'user_id' => $userId,
                'user_role' => $userRole,
            ]);
            
            if ($response->successful()) {
                if ($request->boolean('admin') && $userRole === 'admin') {
                    return redirect()->route('restaurants.show', $restaurantId)->with('success', 'Review deleted successfully!');
                }

                return redirect()->route('restaurant.details', $restaurantId)->with('success', 'Review deleted successfully!');
            }

            $message = $response->json('message') ?? 'Failed to delete review';
            return back()->with('error', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    public function storeMenu(Request $request, $restaurantId)
    {
        $validated = $request->validate([
            'menu_item_name' => 'required|string',
            'menu_item_description' => 'nullable|string',
            'menu_item_price' => 'required|numeric|min:0',
            'menu_item_available' => 'nullable|boolean',
            'menu_item_category' => 'nullable|string',
        ]);

        try {
            $response = Http::post($this->apiBaseUrl . '/api/restaurants/' . $restaurantId . '/menus', [
                'menu_item_name' => $validated['menu_item_name'],
                'menu_item_description' => $validated['menu_item_description'] ?? null,
                'menu_item_price' => $validated['menu_item_price'],
                'menu_item_available' => $validated['menu_item_available'] ?? true,
                'menu_item_category' => $validated['menu_item_category'] ?? null,
            ]);

            if ($response->successful()) {
                return redirect()->route('restaurants.show', $restaurantId)->with('success', 'Menu item added successfully!');
            }

            return back()->with('error', 'Failed to add menu item');
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    public function updateMenu(Request $request, $restaurantId, $menuId)
    {
        $validated = $request->validate([
            'menu_item_name' => 'required|string',
            'menu_item_description' => 'nullable|string',
            'menu_item_price' => 'required|numeric|min:0',
            'menu_item_available' => 'nullable|boolean',
            'menu_item_category' => 'nullable|string',
        ]);

        try {
            $response = Http::put($this->apiBaseUrl . '/api/menus/' . $menuId, [
                'menu_item_name' => $validated['menu_item_name'],
                'menu_item_description' => $validated['menu_item_description'] ?? null,
                'menu_item_price' => $validated['menu_item_price'],
                'menu_item_available' => $validated['menu_item_available'] ?? true,
                'menu_item_category' => $validated['menu_item_category'] ?? null,
            ]);

            if ($response->successful()) {
                return redirect()->route('restaurants.show', $restaurantId)->with('success', 'Menu item updated successfully!');
            }

            return back()->with('error', 'Failed to update menu item');
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    public function destroyMenu(Request $request, $restaurantId, $menuId)
    {
        try {
            $response = Http::delete($this->apiBaseUrl . '/api/menus/' . $menuId);

            if ($response->successful()) {
                return redirect()->route('restaurants.show', $restaurantId)->with('success', 'Menu item deleted successfully!');
            }

            return back()->with('error', 'Failed to delete menu item');
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
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


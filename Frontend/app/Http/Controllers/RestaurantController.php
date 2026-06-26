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
        if (!$userId) {
            return redirect('/login')->with('error', 'Please login first');
        }

        $payload = [
            'user_id' => $userId,
            'restaurant_id' => $id,
            'review_rating' => $validated['review_rating'],
            'review_comment' => $validated['review_comment'] ?? null,
        ];

        try {
            $response = Http::post($this->apiBaseUrl . '/api/restaurants/' . $id . '/reviews', $payload);
            
            if ($response->successful()) {
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
        $userRole = session('user_role');
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
        $userRole = session('user_role');
        if (!$userId) {
            return redirect('/login')->with('error', 'Please login first');
        }

        try {
            $response = Http::delete($this->apiBaseUrl . '/api/reviews/' . $reviewId, [
                'user_id' => $userId,
                'user_role' => $userRole,
            ]);
            
            if ($response->successful()) {
                return redirect()->route('restaurant.details', $restaurantId)->with('success', 'Review deleted successfully!');
            }

            $message = $response->json('message') ?? 'Failed to delete review';
            return back()->with('error', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    /**
     * Submit a review for a restaurant
     */
    public function submitReview(Request $request, $id)
    {
        $validated = $request->validate([
            'review_comment' => 'nullable|string|max:1000',
            'review_rating' => 'required|integer|min:1|max:5',
        ]);

        $payload = [
            'user_id' => session('user_id'),
            'restaurant_id' => $id,
            'review_comment' => $validated['review_comment'] ?? null,
            'review_rating' => $validated['review_rating'],
        ];

        try {
            $response = Http::post($this->apiBaseUrl . '/api/restaurants/' . $id . '/reviews', $payload);

            $redirectRoute = $request->boolean('admin') ? 'restaurants.show' : 'restaurant.details';

            if ($response->successful()) {
                return redirect()->route($redirectRoute, $id)->with('success', 'Review submitted successfully!');
            }

            return redirect()->route($redirectRoute, $id)->with('error', 'Failed to submit review');
        } catch (\Exception $e) {
            return redirect()->route($redirectRoute ?? 'restaurant.details', $id)->with('error', 'Error connecting to backend API: ' . $e->getMessage());
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


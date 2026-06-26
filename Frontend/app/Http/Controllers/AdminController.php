<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8003');
    }

    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        try {
            $restaurantsResponse = Http::get($this->apiBaseUrl . '/api/restaurants');
            $restaurantsData = $restaurantsResponse->json();
            $restaurants = $restaurantsData['restaurants'] ?? [];

            $usersResponse = Http::get($this->apiBaseUrl . '/api/users');
            $usersData = $usersResponse->json();
            $users = $usersData['users'] ?? [];

            $reviewsResponse = Http::get($this->apiBaseUrl . '/api/reviews');
            $reviewsData = $reviewsResponse->json();
            $reviews = $reviewsData['reviews'] ?? [];

            return view('admin.baseadmin', [
                'restaurants' => $restaurants,
                'users' => $users,
                'reviews' => $reviews
            ]);
        } catch (\Exception $e) {
            return view('admin.baseadmin', [
                'restaurants' => [],
                'users' => [],
                'reviews' => [],
                'error' => 'Unable to connect to backend API'
            ]);
        }
    }

    /**
     * Show admin panel base view
     */
    public function index()
    {
        return $this->dashboard();
    }

    /**
     * Delete a review
     */
    public function deleteReview($id)
    {
        $apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8003');

        try {
            $response = Http::delete($apiBaseUrl . '/api/reviews/' . $id);
            
            if ($response->successful()) {
                return redirect('/admin')->with('success', 'Review deleted successfully!');
            } else {
                return back()->with('error', 'Failed to delete review');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API');
        }
    }
}

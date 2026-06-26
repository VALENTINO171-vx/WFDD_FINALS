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

            return view('admin.baseadmin', [
                'restaurants' => $restaurants
            ]);
        } catch (\Exception $e) {
            return view('admin.baseadmin', [
                'restaurants' => [],
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
}

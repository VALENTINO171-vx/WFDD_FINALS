<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\RestaurantModel;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getRestaurants()
    {
        $restaurants = RestaurantModel::all();
        return response()->json(['restaurants' => $restaurants], 200);
    }

    public function getRestaurant($id)
    {
        $restaurant = RestaurantModel::with(['menus', 'reviews.user'])->find($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        return response()->json(['restaurant' => $restaurant], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required|string',
            'restaurant_description' => 'nullable|string',
            'restaurant_cuisine' => 'nullable|string',
            'restaurant_address' => 'required|string',
            'restaurant_phone' => 'nullable|string',
            'restaurant_image' => 'nullable|string',
        ]);

        $restaurant = RestaurantModel::create($validated);

        return response()->json(['restaurant' => $restaurant], 201);
    }

    public function update(Request $request, $id)
    {
        $restaurant = RestaurantModel::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        $validated = $request->validate([
            'restaurant_name' => 'required|string',
            'restaurant_description' => 'nullable|string',
            'restaurant_cuisine' => 'nullable|string',
            'restaurant_address' => 'required|string',
            'restaurant_phone' => 'nullable|string',
            'restaurant_image' => 'nullable|string',
        ]);

        $restaurant->update($validated);

        return response()->json(['restaurant' => $restaurant], 200);
    }

    public function destroy($id)
    {
        $restaurant = RestaurantModel::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        $restaurant->delete();

        return response()->json(['message' => 'Restaurant deleted successfully'], 200);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $restaurants = RestaurantModel::where('restaurant_name', 'like', '%' . $query . '%')->get();

        return response()->json(['restaurants' => $restaurants], 200);
    }
}

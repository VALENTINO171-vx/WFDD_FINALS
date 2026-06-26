<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\RestaurantModel;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //
    public function getRestaurants(){
        $restaurant = RestaurantModel::all();
        return response()->json(['restaurants' => $restaurant],200);
    }

    public function getRestaurant($id){
        $restaurant = RestaurantModel::with(['menus','reviews.user'])->find($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        return response()->json(['restaurant' => $restaurant],200);
    }
}

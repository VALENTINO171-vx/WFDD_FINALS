<?php

namespace App\Http\Controllers;
use App\Models\RestaurantModel;

use Illuminate\Http\Request;

class RestaurantController
{
    public function getRestaurants(){
        $restaurant = RestaurantModel::all();
        return response()->json(['restaurants' => $restaurant],200);
    }
    public function getRestaurant($id){
        $restaurant = RestaurantModel::find($id);
        if(!$restaurant){
            return response()->json(['message' => 'Restaurant not found'],404);
        }
        return response()->json(['restaurant' => $restaurant],200);
    }
}

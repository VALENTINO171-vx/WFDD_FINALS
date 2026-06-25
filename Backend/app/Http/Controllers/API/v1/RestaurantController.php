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
        $restaurant = RestaurantModel::find($id);
        return response()->json(['restaurant' => $restaurant],200);
    }
}

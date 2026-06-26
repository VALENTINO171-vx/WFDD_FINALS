<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    //
    public function index($restaurant_name=null)
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Please login first');
        };

        if($restaurant_name){
            $data = Http::get('http://127.0.0.1:8003/api/restaurants/search/'.$restaurant_name);
            $restaurants = $data->json();
            if(isEmpty($restaurants)){
                return view('home', $restaurants);
            }
            
            return redirect('/home')->with('error', 'Restaurant not found');


        }

        
        $data = Http::get('http://127.0.0.1:8003/api/restaurants');
        $restaurants = $data->json();

        return view('home', $restaurants);
    }
}
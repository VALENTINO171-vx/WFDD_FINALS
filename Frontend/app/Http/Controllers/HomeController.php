<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = DB::table('restaurants');

        if (!empty($search)) {
            $query->where('restaurant_name', 'LIKE', "%{$search}%");
        }

        $restaurants = $query->get();

        return view('home', compact('restaurants'));
    }
}
=======
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Please login first');
        }

        $data = Http::get('http://127.0.0.1:8003/api/restaurants');
        $restaurants = $data->json();
        dd($restaurants);
        return view('home', compact('restaurants'));
    }
}
>>>>>>> 73e123b75e86758db3dd6b593e41126f5bd335c3

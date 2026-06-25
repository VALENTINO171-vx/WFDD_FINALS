<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
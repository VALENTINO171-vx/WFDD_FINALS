<?php

namespace App\Http\Controllers;
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

        return view('home', $restaurants);
    }
    public function search($search)
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Please login first');
        }
        $query = 'select * from restaurants where name like "%' . $search . '%"';
        //i want to get the search query from the url and pass it to the api with the input being the restaurant name
        $data = Http::get('http://127.0.0.1:8003/api/restaurants/search?query=' . $search);
        dd($data->json());
        $restaurants = $data->json();

        return view('home', compact('restaurants'));
    }
}
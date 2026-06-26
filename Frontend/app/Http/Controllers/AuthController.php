<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8003');
    }

    // Show login form
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'user_password' => 'required'
        ]);

        $data = Http::get($this->apiBaseUrl . '/api/users/'.$request->user_name);
        $users = $data->json();

        if ($users && Hash::check($request->user_password, $users['user']['user_password'])) {
            Session::put('user_id', $users['user']['user_id']);
            Session::put('user_name', $users['user']['user_name']);
            Session::put('user_role', $users['user']['user_role']);

            // Redirect admin users to admin panel
            if (strtolower($users['user']['user_role']) === 'admin') {
                return redirect('/admin')->with('success', 'Login successful! Welcome to Admin Panel');
            }

            return redirect('/home/')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}

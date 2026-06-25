<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
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

        $user = UserModel::where('user_name', $request->user_name)->first();

        if ($user && Hash::check($request->user_password, $user->user_password)) {
            Session::put('user_id', $user->user_id);
            Session::put('user_name', $user->user_name);
            Session::put('user_role', $user->user_role);
            
            return redirect('/home')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Show home/dashboard
    public function home()
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Please login first');
        }

        $user = UserModel::find(Session::get('user_id'));
        return view('home', ['user' => $user]);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}

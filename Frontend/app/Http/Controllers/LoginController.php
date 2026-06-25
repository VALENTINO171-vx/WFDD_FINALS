<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        $data = Http::get('http://127.0.0.1:8003/api/users');
        $users = $data->json();
        return view('login', ['users' => $users['users']]);
    }

    public function authenticateUser(Request $request){
        // Authentication logic here
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        // Authentication failed...
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}

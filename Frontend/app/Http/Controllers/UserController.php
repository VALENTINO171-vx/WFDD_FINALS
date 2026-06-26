<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // Check if user is authenticated
    protected function checkAuth()
    {
        if (!Session::has('user_id')) {
            return redirect('/login');
        }
    }

    // List all users
    public function index()
    {
        $this->checkAuth();
        $users = UserModel::all();
        return view('users.index', ['users' => $users]);
    }

    // Show create form
    public function create()
    {
        $this->checkAuth();
        return view('users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $this->checkAuth();
        
        $request->validate([
            'user_name' => 'required|unique:users',
            'user_email' => 'required|email|unique:users',
            'user_password' => 'required|min:6',
            'user_role' => 'required|in:user,admin'
        ]);

        UserModel::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_role' => $request->user_role
        ]);

        return redirect('/users')->with('success', 'User created successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $this->checkAuth();
        $user = UserModel::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    // Update user
    public function update(Request $request, $id)
    {
        $this->checkAuth();
        
        $user = UserModel::findOrFail($id);

        $request->validate([
            'user_name' => 'required|unique:users,user_name,' . $id . ',user_id',
            'user_email' => 'required|email|unique:users,user_email,' . $id . ',user_id',
            'user_role' => 'required|in:user,admin'
        ]);

        $data = [
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_role' => $request->user_role
        ];

        if ($request->filled('user_password')) {
            $data['user_password'] = Hash::make($request->user_password);
        }

        $user->update($data);

        return redirect('/users')->with('success', 'User updated successfully');
    }

    // Delete user
    public function destroy($id)
    {
        $this->checkAuth();
        
        // Prevent deleting self
        if (Session::get('user_id') == $id) {
            return back()->with('error', 'Cannot delete your own account');
        }

        UserModel::findOrFail($id)->delete();
        return redirect('/users')->with('success', 'User deleted successfully');
    }

    // Show user details
    public function show($id)
    {
        $this->checkAuth();
        $user = UserModel::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Toggle user blacklist status (Admin API)
     */
    public function toggleBlacklist($id)
    {
        $apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8003');

        try {
            $response = Http::post($apiBaseUrl . '/api/users/' . $id . '/toggle-blacklist');
            
            if ($response->successful()) {
                return redirect('/admin')->with('success', 'User blacklist status updated!');
            } else {
                return back()->with('error', 'Failed to update user blacklist status');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }

    /**
     * Delete user (Admin API)
     */
    public function destroyAdmin($id)
    {
        $apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8003');

        try {
            $response = Http::delete($apiBaseUrl . '/api/users/' . $id);
            
            if ($response->successful()) {
                return redirect('/admin')->with('success', 'User deleted successfully!');
            } else {
                return back()->with('error', 'Failed to delete user');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to backend API: ' . $e->getMessage());
        }
    }
}

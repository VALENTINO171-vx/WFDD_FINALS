<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function getUsers(){
        $users = UserModel::all()->toArray();
        
        foreach($users as $user){
            echo($user['user_name'] ?? 'N/A');
            echo('<br>');
        }
        
        return view('login', ['users' => $users]);
    }
}

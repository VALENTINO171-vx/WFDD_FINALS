<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function getUsers(){
        $data = Http::get('http://127.0.0.1:8003/api/users');
        dd($data->json());
        foreach($data['users'] as $user){
            echo "User ID: ".$user['user_id']."<br>";
            echo "User Name: ".$user['user_name']."<br>";
            echo "User Email: ".$user['user_email']."<br>";
            echo "User Role: ".$user['user_role']."<br><br>";
        }
    }
}

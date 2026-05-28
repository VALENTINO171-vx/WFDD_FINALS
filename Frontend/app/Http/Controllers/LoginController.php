<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function getUsers(){
        $data = Http::get('http://127.0.0.1:8003/api/users');
        $users = $data->json();

        for($i = 0; $i < count($users['users']); $i++){
            echo($users['users'][$i]['user_name']);
        }
        echo('<br>');
        return view('login', ['users' => $users['users']]);
    }
}

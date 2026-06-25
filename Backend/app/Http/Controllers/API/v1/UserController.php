<?php

namespace App\Http\Controllers\API\v1;
use App\Models\UserModel;

use Illuminate\Http\Request;

class UserController
{
    //
    public function getUsers(){
        $user = UserModel::all();
        
        return response()->json(['users' => $user],200);
    }
    public function getUser(string $user_name){
        $user = UserModel::where('user_name', $user_name)->first();
        return response()->json(['user' => $user],200);
    }
}

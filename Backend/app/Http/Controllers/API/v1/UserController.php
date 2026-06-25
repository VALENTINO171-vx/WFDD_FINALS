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
    public function getUser($id){
        $user = UserModel::find($id);
        if(!$user){
            return response()->json(['message' => 'User not found'],404);
        }
        return response()->json(['user' => $user],200);
    }
}

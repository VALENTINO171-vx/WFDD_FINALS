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

    public function toggleBlacklist($id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->blacklist = !$user->blacklist;
        $user->save();

        return response()->json(['user' => $user, 'message' => 'Blacklist status updated'], 200);
    }
}

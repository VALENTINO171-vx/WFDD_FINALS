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
}

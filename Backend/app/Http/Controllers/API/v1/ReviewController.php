<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;

class ReviewController
{
    //
    public function getReview(){
        $reviews=ReviewModel::all();
        return response()->json(['reviews'=>$reviews],200);
    }
}

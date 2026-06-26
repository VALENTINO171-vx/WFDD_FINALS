<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,user_id',
            'restaurant_id' => 'required|integer|exists:restaurants,restaurant_id',
            'review_comment' => 'nullable|string|max:1000',
            'review_rating' => 'required|integer|min:1|max:5',
        ]);

        $review = ReviewModel::create([
            'user_id' => $validated['user_id'],
            'restaurant_id' => $validated['restaurant_id'],
            'review_comment' => $validated['review_comment'] ?? null,
            'review_rating' => $validated['review_rating'],
        ]);

        return response()->json(['review' => $review], 201);
    }
}

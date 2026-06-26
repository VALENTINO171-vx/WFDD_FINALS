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

    public function update(Request $request, $id)
    {
        $review = ReviewModel::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $validated = $request->validate([
            'review_comment' => 'nullable|string|max:1000',
            'review_rating' => 'required|integer|min:1|max:5',
            'user_id' => 'nullable|integer|exists:users,user_id',
            'user_role' => 'nullable|string',
        ]);

        $userId = $validated['user_id'] ?? null;
        $userRole = strtolower($validated['user_role'] ?? '');

        if ($userId && $review->user_id !== $userId && $userRole !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $review->update([
            'review_comment' => $validated['review_comment'] ?? null,
            'review_rating' => $validated['review_rating'],
        ]);

        return response()->json(['review' => $review], 200);
    }

    public function destroy(Request $request, $id)
    {
        $review = ReviewModel::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'nullable|integer|exists:users,user_id',
            'user_role' => 'nullable|string',
        ]);

        $userId = $validated['user_id'] ?? null;
        $userRole = strtolower($validated['user_role'] ?? '');

        if ($userId && $review->user_id !== $userId && $userRole !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}

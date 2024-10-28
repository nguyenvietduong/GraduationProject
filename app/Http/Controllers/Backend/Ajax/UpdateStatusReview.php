<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class UpdateStatusReview extends Controller
{
    public function getNewReviewCount()
    {
        $newReviewCount = Review::where('status', 'pending')->count();
        return response()->json(['newReviewCount' => $newReviewCount]);
    }

    public function updateStatus(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:reviews,id',
            'status' => 'required|string',
        ]);

        // Find the review by ID
        $review = Review::find($request->id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Update the status
        $review->status = $request->status;
        $review->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateStatusCategory extends Controller
{
    public function updateStatus(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:users,id',
            'status' => 'required|string',
        ]);

        // Find the user by ID
        $category = Category::find($request->id);

        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        // Update the status
        $category->status = $request->status;
        $category->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

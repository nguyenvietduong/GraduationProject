<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog; // Assuming you're using the User model

class UpdateStatusBlog extends Controller
{
    public function updateStatus(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:blogs,id',
            'status' => 'required|string',
        ]);

        // Find the blog by ID
        $blog = Blog::find($request->id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Update the status
        $blog->status = $request->status;
        $blog->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

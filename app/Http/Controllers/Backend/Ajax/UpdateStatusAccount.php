<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you're using the User model

class UpdateStatusAccount extends Controller
{
    public function updateStatus(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:users,id',
            'status' => 'required|string',
        ]);

        // Find the user by ID
        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the status
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

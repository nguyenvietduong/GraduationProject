<?php

namespace App\Http\Controllers\Backend\Account\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu; // Assuming you're using the menu model

class UpdateStatusMenu extends Controller
{
    public function updateStatus(Request $request)
    {
        // Validate input
        $request->validate([
            'status' => 'required|string',
        ]);

        // Find the menu by ID
        $menu = Menu::find($request->id);

        if (!$menu) {
            return response()->json(['message' => 'menu not found'], 404);
        }

        // Update the status
        $menu->status = $request->status;
        $menu->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Invoice_item;
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

        $hasInvalidStatus = Invoice_item::where('menu_id', $request->id)
            ->whereRaw('JSON_EXTRACT(status_menu, "$.\"1\"") != "0"')
            ->exists();

        if ($hasInvalidStatus) {
            return response()->json([
                'message' => 'Không thể cập nhật'
            ], 403);
        }

        if (!$menu) {
            return response()->json(['message' => 'menu not found'], 404);
        }

        // Update the status
        $menu->status = $request->status;
        $menu->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

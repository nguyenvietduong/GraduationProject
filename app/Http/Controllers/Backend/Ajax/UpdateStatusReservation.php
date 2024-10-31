<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Mail\ReservationCancellationMail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationConfirmed;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Support\Facades\Mail;

class UpdateStatusReservation extends Controller
{
    public function updateStatus(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:reservations,id',
            'status' => 'required|string',
        ]);

        // Find the reservation by ID
        $reservation = Reservation::find($request->id);

        if (!$reservation) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the status
        $reservation->status = $request->status;
        $reservation->save();

        if ($reservation->status == 'confirmed') {
            // Send confirmation email
            Mail::to($reservation->email)->send(new ReservationConfirmed($reservation));
        } else if ($reservation->status == 'canceled') {
            Mail::to($reservation->email)->send(new ReservationCancellationMail($reservation));
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $reservation
        ]);
    }

    public function getAvailableTables(Request $request)
    {
        $guests = $request->input('guests');

        // Lọc các bàn có trạng thái 'available' và có sức chứa >= số người yêu cầu
        $availableTables = Table::where('status', 'available')
            ->where('capacity', '>=', $guests) // Fixed this line
            ->get(['id', 'name', 'capacity', 'description']);

        return response()->json(['tables' => $availableTables]);
    }

    public function getAvailableMenus(Request $request)
    {
        $guests = $request->input('guests');

        // Retrieve all active menus
        $availableMenus = Menu::where('status', 'active')->get();

        foreach ($availableMenus as $menu => $item) {
            $availableMenus[$menu]['image'] = checkFile($item->image_url);
        }

        return response()->json(['menus' => $availableMenus]);
    }
}

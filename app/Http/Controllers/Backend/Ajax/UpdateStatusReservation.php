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
        $data = $request->all();
        // dd($data);
        // Find the reservation by ID
        $reservation = Reservation::find($data['id']);

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

    public function updateTableStatus(Request $request)
    {
        // dd(123123);
        $data = $request->all();
        $reservation = Reservation::find($data['reservation_id']);

        if (!$reservation) {
            dd("Reservation with ID {$data['reservation_id']} not found.");
        }

        $table = Table::find($data['table_id']);

        if (!$table) {
            dd("Table with ID {$data['table_id']} not found.");
        }


        $reservation->table_id = $request['table_id'];
        $table->status = 'occupied';

        $reservation->save();
        $table->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function getAvailableTables(Request $request)
    {
        $availableTables = Table::get(['id', 'name', 'capacity', 'status', 'description']);

        return response()->json(['tables' => $availableTables]);
    }

    public function getAvailableMenus(Request $request)
    {
        $guests = $request->input('guests');

        // Retrieve all active menus
        $availableMenus = Menu::where('status', 'active')->get();

        return response()->json(['menus' => $availableMenus]);
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationCancelledMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CancelOverdueReservations extends Command
{
    protected $signature = 'reservations:cancel-overdue';
    protected $description = 'Cancel overdue reservations if the customer does not arrive within 30 minutes after the reservation time';

    public function handle()
    {
        $now = Carbon::now()->setTime(12, 31, 00); // Thay đổi thành 12h00 để kiểm tra

        $overdueTime = $now->subMinutes(30); // Cộng thêm 30 phút

        $overdueReservations = Reservation::where('reservation_time', '<', $overdueTime) // Thời gian đặt chỗ phải nhỏ hơn thời gian hiện tại
            ->where('status', '=', 'confirmed')
            ->get();

        // Log::info('Overdue Reservations:', $overdueReservations->toArray()); // Ghi log biến ra file log

        foreach ($overdueReservations as $reservation) {
            // Cancel the overdue reservation
            $reservation->update(['status' => 'canceled']);

            // Update the associated table status to 'available'
            if ($reservation->table) {
                $reservation->table->update(['status' => 'available']);
            }

            // Log::info( $reservation->email); // Ghi log biến ra file log
            // Send cancellation email to the user
            Mail::to($reservation->email)->send(new ReservationCancelledMail($reservation));
        }

        $this->info("Checked and cancelled overdue reservations and updated table status.");
    }
}

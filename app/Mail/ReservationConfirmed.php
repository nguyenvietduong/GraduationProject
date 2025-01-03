<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject($this->reservation->code . ' ' . 'Reservation Confirmed')
                    ->view('emails.reservation_confirmed')
                    ->with([
                        'reservation' => $this->reservation,
                    ]);
    }
}

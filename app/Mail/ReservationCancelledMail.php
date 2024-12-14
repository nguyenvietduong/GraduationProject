<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->reservation->code . ' ' . 'Reservation Canceled')
                    ->view('emails.reservation_canceled')
                    ->with([
                        'reservation_time' => $this->reservation->reservation_time,
                        'userName' => $this->reservation->name,
                    ]);
    }
}

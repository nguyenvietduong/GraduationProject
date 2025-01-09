<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ReservationVerificationMail extends Mailable
{
    public $confirmationUrl;

    public function __construct($confirmationUrl)
    {
        $this->confirmationUrl = $confirmationUrl;
    }

    public function build()
    {
        return $this->view('emails.reservation_verification')
                    ->subject('Xác nhận đặt bàn')
                    ->with([
                        'confirmationUrl' => $this->confirmationUrl,
                    ]);
    }
}

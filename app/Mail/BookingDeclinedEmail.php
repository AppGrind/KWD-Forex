<?php

namespace App\Mail;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingDeclinedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking, $reason;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $reason)
    {
        //
        $this->booking = $booking;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking.declined');
    }
}

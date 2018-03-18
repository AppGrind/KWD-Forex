<?php

namespace App\Mail;

use App\Booking;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingCreatedAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $booking, $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, User $user)
    {
        $this->booking = $booking;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin.booking.created');
    }
}

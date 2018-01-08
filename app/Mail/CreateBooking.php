<?php

namespace App\Mail;

use App\User;
use App\Booking;
use App\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $booking, $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Booking $booking, Event $event)
    {
        //
        $this->user = $user;
        $this->booking = $booking;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking.create');
    }
}

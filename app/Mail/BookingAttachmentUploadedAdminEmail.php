<?php

namespace App\Mail;

use App\Booking;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingAttachmentUploadedAdminEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $admin, $booking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $admin, Booking $booking)
    {
        //
        $this->admin = $admin;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin.booking.upload');
    }
}

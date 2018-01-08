<?php

namespace App\Jobs;

use App\Booking;
use App\Mail\BookingDeclinedEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendBookingDeclinedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $booking, $reason;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $reason)
    {
        //
        $this->reason = $reason;
        $this->booking = $booking;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->booking->user->email)->send(new BookingDeclinedEmail($this->booking, $this->reason));
    }
}

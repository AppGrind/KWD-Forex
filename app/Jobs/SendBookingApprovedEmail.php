<?php

namespace App\Jobs;

use App\Booking;
use App\Mail\BookingApprovedEmail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendBookingApprovedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user, $booking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Booking $booking)
    {
        //
        $this->user = $user;
        $this->booking = $booking;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new BookingApprovedEmail($this->user, $this->booking));
    }
}

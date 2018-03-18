<?php

namespace App\Jobs;

use App\Booking;
use App\Mail\BookingCreatedAdmin;
use App\User;
use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBookingCreatedAdminEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $booking, $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, User $user)
    {
        $this->booking = $booking;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = config('app.infomail');
        Mail::to($email)->send(new BookingCreatedAdmin($this->booking, $this->user));
    }
}

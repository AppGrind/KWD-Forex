<?php

namespace App\Jobs;

use App\Mail\CreateBooking;

use App\User;
use App\Booking;
use App\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendBookingCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user, $booking, $event;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->user->email)->send(new CreateBooking($this->user, $this->booking, $this ->event));
    }
}

<?php

namespace App\Jobs;

use App\Booking;
use App\Mail\BookingAttachmentUploadedAdminEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\User;
use Storage;


class SendAttachmentUploadedAdminEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Execute the job.
     *
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin->email)->attach(Storage::url('booking/'.$this->booking->img_path .'/'.$this->booking->payment_img) )->send(new BookingAttachmentUploadedAdminEmail($this->admin, $this->booking));
    }
}

<?php

namespace App\Notifications;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyBookingApproved extends Notification
{
    use Queueable;
    public $booking;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        //
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'Message',
            'sender' => config('app.name'),
            'subject'  => 'Booking #' . $this->booking->reference . ' was approved',
            'message'=>'Your booking was approved. For Booking and Event details, please refer to email that was sent to you.'
        ];
    }
}

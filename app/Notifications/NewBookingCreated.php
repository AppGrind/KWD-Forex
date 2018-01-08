<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingCreated extends Notification
{
    use Queueable;
    public $booking, $event;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking, $event)
    {
        $this->booking = $booking;
        $this->event = $event;
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
            'type' => 'Notification',
            'sender' => config('app.name'),
            'subject'  => 'New Booking Created!',
            'message'=>'You\'ve successfully booked a seat for the ' . $this->event->name . '. Reference #' . $this->booking->reference . '.'
        ];
    }
}

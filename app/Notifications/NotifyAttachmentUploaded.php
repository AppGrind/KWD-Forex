<?php

namespace App\Notifications;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyAttachmentUploaded extends Notification
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
            'type' => 'Notification',
            'sender' => config('app.name'),
            'subject'  => 'Uploaded an attachment for Booking #' . $this->booking->reference,
            'message'=>'You\'ve uploaded an attachment as proof of payment for booking #' .$this->booking->reference . ', your booking will be approved once the attachment has been verified.'
        ];
    }
}

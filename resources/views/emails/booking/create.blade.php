@component('mail::message')
#Thank you, {{ $user->fullname }}.
Your booking was successful. The next step is to make a payment of **R{{ $booking->event->item->price }}** to the below banking details, and upload your proof of payment by clicking the button below:
<br>
@component('mail::panel')
    BOOKING REFERENCE: {{ $booking->reference }}
@endcomponent

##Booking Details:
<ul>
    <li><strong>Reference:</strong>  {{ $booking->reference }} </li>
    <li><strong>Date:</strong>  {{ $booking->created_at->toFormattedDateString() }} </li>
    <li><strong>Event:</strong>  {{ $booking->event->name }} </li>
    <li><strong>Event Dates:</strong> <em>From: </em>{{ $booking->event->start_date->toFormattedDateString() }}, <em>To: </em>{{ $booking->event->end_date->toFormattedDateString() }}</li>
</ul>
##Banking Details

<ul>
    <li><strong>Bank:</strong></li>
    <li><strong>Account #:</strong></li>
    <li><strong>Branch Code:</strong></li>
    <li><strong>Reference:</strong> {{ $booking->reference }} </li>
    <li><strong>Amount:</strong> R{{ $booking->event->item->price }} </li>
</ul>
@component('mail::button', ['url' => route('bookings.show', $booking->id)])
Complete Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

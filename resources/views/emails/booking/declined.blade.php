@component('mail::message')
# Booking Declined!


Hi {{ $booking->user->fullname }},
<p>Unfortunately booking #<strong>{{ $booking->reference }}</strong> was declined with reason.</p>

##Reason:
@component('mail::panel')
<em>{{ $reason }}</em>
@endcomponent

@component('mail::button', ['url' => route('bookings.show', $booking->id)])
Booking Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

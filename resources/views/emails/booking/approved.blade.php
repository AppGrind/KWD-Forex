@component('mail::message')
# Booking Approved

Hi {{ $booking->user->fullname }},
<p>Booking #<strong>{{ $booking->reference }}</strong> has been approved!</p>

@component('mail::button', ['url' => route('bookings.show', $booking->id)])
Booking Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

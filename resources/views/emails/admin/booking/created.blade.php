@component('mail::message')
# New Booking Ref {{ $booking->reference }}

<p>A new booking with a reference no. {{ $booking->reference }} has been created by {{ $user->fullname }}.</p>
<p>No further action by Admin is required at this point, unless instructed by {{ $user->fullname }}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

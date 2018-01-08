@component('mail::message')
# An attachment was uploaded

<p>Hi {{ $admin->fullname }}</p>
<p>Please find attached a file uploaded by {{ $booking->user->fullname }} ({{ $booking->user->email }}) as proof of payment for booking <a href="{{ route('bookings.show', $booking->id) }}">#{{ $booking->reference }}</a>.</p>

## What' next?
<ol>
    <li>Verify the authenticity of the attachment</li>
    <li>Check if the payment has reflected in the company bank account</li>
    <li>Click the Booking Reference No. above (#{{ $booking->reference }})</li>
    <li>Login if required to and click the thumbs up button to approve OR thumbs down button to decline (requires reason) the booking.</li>
</ol>

Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy')
    You are receiving this email because you have an administrator role on the system
@endcomponent

@endcomponent
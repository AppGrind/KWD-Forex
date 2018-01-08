@component('mail::message')
# Attachment Uploaded Successfully

You've successfully uploaded an attachment as proof of payment for booking #{{ $booking->reference }}

@component('mail::button', ['url' => Storage::url('booking/'.$booking->img_path .'/'.$booking->payment_img) ])
Download Attachment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

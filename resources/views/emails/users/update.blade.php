@component('mail::message')
# Profile Updated

Hi {{ $user->fullname }}
<p>Your profile was updated. If this was not done by you please contact {{ config('app.name') }}</p>

@component('mail::button', ['url' => route('users.show', $user->id)])
View Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

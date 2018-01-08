@component('mail::message')
# GET ACTIVATED

First things first, before you can get started you need to activate your account. <br>
Click the Activate Account button to below activate your account. Copy the activation code below and paste it on the verification screen.

@component('mail::panel')
ACTIVATION CODE: **{{ $user->code }}**
@endcomponent

@component('mail::button', ['url' => route('verification')])
Activate Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@extends('layouts.mail')

@section('content')
    <h1 style="Margin:0;Margin-bottom:10px;color:inherit;font-family:Helvetica,Arial,sans-serif;font-size:34px;font-weight:300;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">Hi, {{ $to }}</h1>
    <p class="lead" style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:300;line-height:1.6;margin:0;margin-bottom:10px;padding:0;text-align:left">
        {{ $name }} said:</p>
    <p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:300;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
        {{ $bodymessage }}
    </p>
    <br>
    <p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:300;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
        You can reach them using the following contact details: <br>
        Email: {{ $mail }}<br>
        Phone: {{ $phone }}
    </p>
@endsection
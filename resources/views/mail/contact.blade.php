@component('mail::message')

<h1>New contact submission from: {{ config('app.name') }}</h1>

<p><b>Name:</b> {{ $name }}</p>
<p><b>Email:</b> {{ $email }}</p>
<p><b>Message:</b></p>
<p>{{ $message }}</p>

@endcomponent

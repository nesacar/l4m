@component('mail::message')
# Hvala na registraciji

Klikom na dugme ispod potvrđujete registraciju. <br>

@component('mail::button', ['url' => 'profile/' . $user->customer->verification . '/confirmation'])
Potvrdni link
@endcomponent

Hvala,<br>
{{ config('app.name') }}
@endcomponent

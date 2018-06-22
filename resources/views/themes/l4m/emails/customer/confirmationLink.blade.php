@component('mail::message')
# Hvala na registraciji

Klikom na dugme ispod potvrđujete registraciju. <br>

@component('mail::button', ['url' => url('profile/' . $customer->activation . '/confirmation')])
Potvrdni link
@endcomponent

Hvala,<br>
{{ config('app.name') }}
@endcomponent

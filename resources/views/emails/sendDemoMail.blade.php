@component('mail::message')
# {{ $maildata['title'] }}
Para reiniciar su contraseña, presione el boton reiniciar contraseña.
@component('mail::button', ['url' => $maildata['url']])
Reiniciar contraseña
@endcomponent
Gracias,<br>
{{ config('app.name') }}
Del Municipio de Berisso.
@endcomponent
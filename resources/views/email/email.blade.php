<h1>Cambiar contraseña</h1>
<p>
    Has recibido este mensaje porque has solicitado cambiar la contraseña de <strong>Recibos de sueldo Berisso</strong>.
</p>
<p>
    Para cambiar la contraseña,  haz <a href="{{ route('clave', $token) }}" type="button" class="btn btn-success btn-lg">CLIC AQUÍ</a> o copia y pega el siguiente enlace en el navegador:
</p>
@component('mail.html.button', ['url' => config('app.url')])
        Submit Response
@endcomponent
<p>
    {{ route('clave', $token) }}
</p>
<p>
    Gracias por usar la aplicacion.
    !Que tenga buen dias!
</p>
<p>
    <strong>Municipalidad de Berisso</strong>
</p>
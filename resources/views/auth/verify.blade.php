@extends('template/template')

@section('css')

            <link href="{{ asset('/assets/bootstrap-datepicker-1.7.1/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>

@endsection
@section('content')
<br>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su dirección de correo electrónico') }}</div>

                <div class="card-body">
                    {{ __('Antes de continuar, verifique su correo electrónico para obtener un enlace de verificación.') }}
                    {{ __(' Si no recibiste el correo electrónico') }},
                    <form class="d-inline" method="Get" action="{{route('inicio.olvidocontraseña')}}">
                        {{-- @csrf --}}
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Haga click aqui para solicitarlo nuevamente') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection

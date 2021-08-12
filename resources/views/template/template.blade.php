<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Mosconi</title>
    <link href="{{ asset('/assets/bootstrap-4.5.3/css/bootstrap.min.css') }}" rel="stylesheet"> 
 
        <!--datables CSS básico-->
    <link href="{{ asset('/assets/DataTables-1.10.25/css/bootstrap.css') }}" rel="stylesheet">
      <!--datables estilo bootstrap 4 CSS-->   
    <link href="{{ asset('/assets/DataTables-1.10.25/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/DataTables-1.10.25/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/fontawesome-5.15.3/css/all.css') }}" rel="stylesheet"> 
    <link href="{{ asset('/assets/DataTables-1.10.25/jquery.timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/toastr/toastr.min.css') }}" rel="stylesheet">
    <!-- <link href='{{ asset("css/sweetalert.css") }}' rel="stylesheet"> -->


    @yield('css')


</head>
<body>

<div id="app">
    
    <header>
        <a class="navbar-brand" href="#">
            <img id='logoBerisso' src="{{asset('css/css_imgs/img/berisso.png')}}" alt="LogoBerisso">
        </a>
        <div id="redes">
            <a href="https://es-es.facebook.com/municipiodeberisso">
                <img src="{{asset('css/css_imgs/img/icon-facebook.png')}}" alt="Facebook">
            </a>
            <a href="https://twitter.com/munideberisso">
                <img src="{{asset('css/css_imgs/img/icon-twitter.png')}}" alt="Twitter">
            </a>
            <a href="https://www.instagram.com/municipiodeberisso/">
                <img src="{{asset('css/css_imgs/img/icon-instagram.png')}}" alt="Instagram">
            </a>
            <a href="https://www.youtube.com/user/prensaberisso">
                <img src="{{asset('css/css_imgs/img/icon-youtube.png')}}" alt="Youtube">
            </a>

        </div>
    </header>
    <nav class="navbar navbar-expand-md shadow-sm navbar-custom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="line"></span>
                <span class="line"></span> 
                <span class="line" style="margin-bottom: 0;"></span>
              </button>
  
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('inicio.index') }}">Inicio</a>
                  </li>
                  <li class="nav-item" style="min-width: 85px;">
                    <a class="nav-link" href="{{ route('nuevoTurno.index') }}">Nuevo turno</a>
                  </li>
                  <li class="nav-item" style="min-width: 85px;">
                    <a class="nav-link" href="{{ route('cancelarTurno.cancelar') }}">Cancelar turno</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://berisso.gob.ar">Municipalidad</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://berisso.gob.ar/noticias/">Noticias</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('cancelarTurno.emma') }}">turnook</a>
                  </li> --}}
                </ul>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ (($usuario)) ?? 'Menu' }}<span class="caret"></span>
                    </a>
                    <div  class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                           
                            {{-- <hr> --}}
                            @if (!$esEmp)
                              <a class="dropdown-item" href="{{ route('turnosadmin.index') }}">Iniciar sesión</a>
                            @endif
                               
                            @if ($esEmp)
                            {{-- <hr> --}}
                              <a class="dropdown-item" href="{{ route('turnosadmin.turnosasignados') }}">
                                  {{ __('Ver Turno') }}
                              </a>
                              <a class="dropdown-item" href="{{ route('turnosadmin.generarturnos') }}">
                                  {{ __('Generar Turno') }}
                              </a>
                              <a class="dropdown-item" href="{{ route('turnosadmin.generarferiados') }}">
                                  {{ __('Generar Feriado') }}
                              </a>
                              <hr>
                           @endif
                        <a class="dropdown-item" href="{{ route('turnosadmin.cerrarsesion') }}">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

  
@yield('content')


<!-- Footer -->
<footer class="footer">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <a style="color:#1d1e1f;" href="http://berisso.gob.ar">
      Municipalidad de Berisso
    </a>
  </div>
  <!-- Copyright -->

</footer>

  {{-- <script src="{{asset('assets/jquery/jquery-2.2.3.min.js')}}"></script> --}}
  <script src="{{asset('assets/DataTables-1.10.25/js/jquery-3.5.1.js')}}"></script>
  {{-- <script src="{{asset('assets/DataTables-1.10.25/jquery/jquery-3.3.1.min.js')}}"></script> --}}
  <script src="{{asset('assets/DataTables-1.10.25/popper/popper.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap-4.5.3/js/bootstrap.min.js')}}"></script>



  <script src="{{asset('assets/DataTables-1.10.25/datatables.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/Buttons-1.7.1/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/DataTables-1.10.25/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/responsive.bootstrap4.min.js')}}"></script>

  <script src="{{asset('assets/DataTables-1.10.25/JSZip-2.5.0/jszip.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/Buttons-1.7.1/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/DataTables-1.10.25/jquery.timepicker.min.js')}}"></script>


  <script src="{{ asset('assets/fontawesome-5.15.3/js/all.js') }}"></script>


  @yield('js')
</body>
</html>

@extends('template/template')

@section('css')

            {{-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'> --}}
            {{-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> --}}
            <link href="{{ asset('/assets/bootstrap-datepicker-1.7.1/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>

@endsection

@section('content')


    <article class="container col-12 mx-auto p-1"> 

          <form action="{{route('empleado.buscarPorMes')}}" novalidate method="post" class="needs-validation" novalidate>
            {{ csrf_field() }}
              <div class="container"> 
                <div class="row">
                  <div class="col-sm-3 col-md-3 my-0 fs-3">
                    <label class="formItem" for="fecha_turno"> <b>Fecha Desde</b></label>
                    <input class="form-control" data-date-format="yyyy/mm" id="fecha_desde" name="fecha_desde" required>
                  </div>
                  <div class="col-sm-3 col-md-3 my-0 fs-3">
                    <label class="formItem" for="fecha_hasta"> <b>Fecha Hasta</b></label>
                    <input class="form-control" data-date-format="yyyy/mm" id="fecha_hasta" name="fecha_hasta" required>
                  </div>
                  <div class="col-sm-3 col-md-3 my-3 p-0">
                    <label class="formItem" for="buscar"> <b></b></label>
                    <button type="submit" class="form-control btn btn-primary" id="buscar" name="buscar">Buscar</button>
                  </div>
                </div>
              </div>
              </form>


        <div class="row">
          @foreach ($datos as $dato)
          <div class="col-sm-3  p-1">
              <div class="card">
                
                <div class="card-header"  style="background-color: #3f4348; color:beige">{{ $dato->nombre }} {{ $dato->apellido }}</div>
                <div class="card-body">
                  <h5 class="card-title">{{ $dato->mes_nom }} {{ $dato->anio }}</h5>
                  <p class="card-text">
                    datos
                  </p>
                  <a href="{{route('empleado.mostrarPDF')}}" class="btn btn-info"><i class="fas fa-eye"></i> VER</a>
                  <a href="{{route('empleado.descargarPDF')}}" class="btn btn-success"><i class="fas fa-download"></i> DESCARGAR</a>
                  
                </div>
              </div>
          </div>
          @endforeach
        </div>

    </article>



@endsection

@section('js')
<script src="{{ asset('/assets/bootstrap-datepicker-1.7.1/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>
{{-- <script src="{{ asset('/assets/formvalidation/0.6.2-dev/js/formValidation.min.js') }}"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}


<script>

</script>
<script>
	$('#fecha_hasta').datepicker({
		uiLibrary: 'bootstrap4',
    format: "mm/yyyy",
    startView: "year", 
    minViewMode: "months",
		locale: 'es',
		language: 'es',
		autoclose: true,
		todayHighlight: true,
		// startDate: sumarDias(new Date()),
	});
	$('#fecha_hasta').datepicker("setDate", new Date());

	function sumarDias(fecha){
			fecha.setDate(fecha.getDate());
			return fecha;
		}

	
</script>
<script>
	$('#fecha_desde').datepicker({
		uiLibrary: 'bootstrap4',
    format: "mm/yyyy",
    startView: "year", 
    minViewMode: "months",
		locale: 'es',
		language: 'es',
		autoclose: true,
		todayHighlight: true,
		// startDate: sumarDias(new Date()),
	});
	$('#fecha_desde').datepicker("setDate", new Date());

	function sumarDias(fecha){
			fecha.setDate(fecha.getDate());
			return fecha;
		}

	
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
  </script>
@endsection
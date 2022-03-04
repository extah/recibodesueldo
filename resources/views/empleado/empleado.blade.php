@extends('template/template')

@section('css')

            <link href="{{ asset('/assets/bootstrap-datepicker-1.7.1/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>

@endsection

@section('content')



    <article class="container col-12 mx-auto p-0"> 
            <form action="{{route('empleado.buscarPorMes')}}" novalidate method="post" class="needs-validation" novalidate>
              {{ csrf_field() }}
              <div class="container"> 
                <div class="row">
                  <div class="col-sm-3 col-md-3 my-0 fs-3">
                    <label class="formItem" for="fecha_turno"> <b>Año desde</b></label>
                    <input class="form-control" data-date-format="yyyy" id="fecha_desde" name="fecha_desde" required>
                  </div>
                  <div class="col-sm-3 col-md-3 my-0 fs-3">
                    <label class="formItem" for="fecha_hasta"> <b>Año hasta</b></label>
                    <input class="form-control" data-date-format="yyyy" id="fecha_hasta" name="fecha_hasta" required>
                  </div>
                    <div class="d-grid col-sm-2 col-md-2 my-3 p-3">
                      <button type="submit" class="btn btn-lg btn-primary" id="buscar" name="buscar">Buscar</button>
                    </div>
                </div>
              </div>
            </form>
        <hr>

        <div class="row">
            @foreach ($datos as $dato)
              <div class="col-sm-3  p-1">
                  <div class="card">
                    
                    <div class="card-header"  style="background-color: #3f4348; color:beige">{{ $dato->mes_nom }} {{ $dato->anio }}</div>
                    <div class="card-body">
                      <h4 class="card-text">

                        @if ($dato->tipo == "N")
                            Sueldo mensual
                            
                        @elseif ($dato->tipo == "A")
                            Ayuda escolar
                            
                        @elseif ($dato->tipo == "J")
                            Liq. adicional
                            
                        @elseif ($dato->tipo == "S")
                            S.A.C
                           
                        @elseif ($dato->tipo == "X")
                            Horas extras
                        @endif
                        
                      </h4>
                      <h6> <b>{{ $dato->nombre }} {{ $dato->apellido }}</b></h6>
                      <br>
                      <a target="_blank" rel="noopener noreferrer" href="{{url('empleado/mostrar',['tipo' => $dato->tipo,'mes' => $dato->mes,'anio' => $dato->anio])}}" class="btn btn-info"><i class="fas fa-eye"></i> VER</a>
                      <a href="{{url('empleado/descargar',['tipo' => $dato->tipo,'mes' => $dato->mes,'anio' => $dato->anio])}}" class="btn btn-success"><i class="fas fa-download"></i> DESCARGAR</a>
                      
                    </div>
                  </div>
              </div>
            @endforeach
        </div>
        @if ($no_hay_datos)
            <br>
            <br>
            <div class="d-flex justify-content-center">
                  <h1 style="color:#111166a8">No posee recibos de sueldo</h1>
            </div>      
            <br>
            <br>
            <br>
            <br>
        @endif 

    </article>



@endsection

@section('js')
<script src="{{ asset('/assets/bootstrap-datepicker-1.7.1/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>

<script>

</script>
<script>
	$('#fecha_hasta').datepicker({
		uiLibrary: 'bootstrap4',
    format: "yyyy",
    startView: "year", 
    minViewMode: "years",
    // minViewMode: "months",
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
    format: "yyyy",
    startView: "year", 
    minViewMode: "years",
    // minViewMode: "months",
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

<script>
    @if ($status_ok)
            toastr.success("{{ $nombre }}", ' {{  $message }} ', {
                // "progressBar": true,
                "closeButton": true,
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "timeOut": "20000",
            });   
    @endif 
</script>

@endsection
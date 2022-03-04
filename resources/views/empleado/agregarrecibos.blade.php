@extends('template/template')

@section('css')

            <link href="{{ asset('/assets/bootstrap-datepicker-1.7.1/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>

@endsection

@section('content')


<br>
<article class="container col-12 mx-auto p-1"> 
    <div class="d-flex justify-content-center">

        <h1>Carga de datos para recibos de sueldo</h1>
 
     </div>
     <hr>
    <form method="POST" action="{{ route('empleado.insertar_datos_recibo') }}" enctype="multipart/form-data">
        @csrf
    
        <div class="row g-3 justify-content-center">

            <div class="col-md-6">
                <label for="archivo" class="form-label"><b>SELECCIONAR UN ARCHIVO CON FORMATO .CSV</b></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" id="archivo" name="archivo" accept=".csv, .xlsx">
                  <label class="input-group-text" for="archivo">Subir</label>
                </div>
            </div>

            <div class="d-grid gap-2 col-md-8 mx-auto">
                <button id="boton_guardar" type="submit" class="btn btn-primary btn-lg" ><b>Guardar</b></button>
              </div>

        </div>    
    
    </form>

</article>
<br>
<br>
<br>



@endsection

@section('js')
<script src="{{ asset('/assets/bootstrap-datepicker-1.7.1/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>

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
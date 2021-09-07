<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  

  {{-- <div id ="tabla" class="container" style="display: none"> --}}
    <div id ="tabla" class="container" >
    <table id="tablaturnos" class="table table-striped dt-responsive nowrap" style="width:100%">
      <meta name="csrf-token_feriado" content="{{ csrf_token() }}">  
      <thead>
            <tr>
                <th>ESPECIALIDAD</th>
                <th>NOMBRE</th>
                <th>DIAS Y HORARIOS DE ATENCION</th>
                <th>PAMI</th>
                <th>OBRAS SOCIALES</th>
                <th>CONSULTA PARTICULAR</th>
                <th>OTROS</th>
            </tr>
        </thead>
        <!-- <tbody>

        </tbody> -->
    </table>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: rgb(31, 121, 199)">
          <h5 class="modal-title" id="exampleModalLabel" >Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
            <form id="formTurnos">    
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="modal-body">
                
                  <select name="select_especialidades" id="select_especialidades" class="form-control" required>
                                    <option value="">-Seleccioná una especialidad-</option>
                                    @foreach($especialidades as $especialidad)
                                      <option value="{{ $especialidad->id }}" offset="1">{{ $especialidad->nombre }}</option>
                                    
                                    @endforeach
                                  </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Buscar</button>
                </div>
          </form> 


      </div>
    </div>
  </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    {{-- <script>
        var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
    </script> --}}

    <script>
        $(document).ready(function() {
            tablaturnos = $('#tablaturnos').DataTable(
        {

        // "dom": '<"dt-buttons"Bf><"clear">lirtp',
        // "ajax":{            
        //                 "headers": { 'X-CSRF-TOKEN': $('meta[name="csrf-token_entrada"]').attr('content') },    
        //                 "url": "{{route('turnosadmin.turnosasignadosdatatable')}}", 
        //                 "method": 'post', //usamos el metodo POST
        //                 "data":{
        //                     // '_token': $('input[name=_token]').val(),
        //                     opcion:opcion}, //enviamos opcion 1 para que haga un SELECT
        //                 "dataSrc":""
        //             },
        // "ajax": "{{route('turnosadmin.turnosasignadosdatatable')}}",
        "columns": [
                        { data: "fecha" },
                        { data: "hora" },
                        { data: "Nro" },
                        { data: "libre" },
                        { data: "Apyn" },
                        { data: "doc" },
                        { data: "tram" },
                        { data: "telefono" },
                        { data: "email" },
                        
                        // { data: "Apellido" },
                    ],
        "autoWidth": true,
         "order": [[ 0, "asc" ]],
         "paging":   true,
         "ordering": true,
         "responsive":true,
         "info":     false,
         "dom": 'Bfrtilp',
        //  "data": dataSet,

        //  "buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
         "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sSearch":         "Buscar:",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        }
                    },

            "buttons":[
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fas fa-file-excel"></i> EXCEL ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger'
                },
                {
                    extend:    'print',
                    text:      '<i class="fa fa-print"></i> IMPRIMIR',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info'
                },
             ]                 
        });
        //  var fila;
        $('#formTurnos').submit(function(e){                         
                e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
                select_especialidades = $.trim($('#select_especialidades').val());    
                // fecha_hasta = $.trim($('#fecha_hasta').val());
                alert("hola");

                $('#tablaturnos').DataTable().clear().draw();
                // $('#tablaturnos').DataTable().destroy();
 
                $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{route('turnosadmin.turnosasignadosdatatable')}}",
                type: "POST",
                datatype:"json",    
                data:  {
                    '_token': $('input[name=_token]').val(),
                    opcion:opcion, fecha_desde:fecha_desde, fecha_hasta:fecha_hasta}, 

                success: function(data) {
                    // console.log(data);

                    var text = data;
                    var data = JSON.parse(text);

                    tablaturnos.rows.add(data).draw();

                    // swal("Se genero el feriado con Exito!", "", "success"); 
                },


                });
		        
            $('#tabla').modal('show');											     			
        });
    });        
    </script>
  </body>
</html>
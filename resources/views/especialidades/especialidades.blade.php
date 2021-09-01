@extends('template/template')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/especialidades.css') }}">
@endsection

@section('content')

    <section class="mx-0 px-0">
        <article class="mx-auto px-0">
            <div class="row mx-0 px-0">
                <img class="img-fluid px-0" src={{ asset("images/img/banner-especialidades.png")}} alt="Imagen de portada de Especialidades">
                <div class="d-flex flex-column m-0 p-0">
                    <div class="__titulo-seccion-especialidades col-12 col-sm-12 col-md-6 col-lg-4 d-block d-flex justify-content-center justify-content-sm-center justify-content-md-end justify-content-lg-end my-1">
                        <h5  class="__titulo fs-5 text-uppercase text-white pl-4 py-1 my-auto">Especialidades</h5>
                    </div>
                </div>
            </div>
        </article>

        <article class="container col-12 mx-auto p-0">
                    <div class="col-8 d-flex flex-row justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-start mx-auto p-0">
                        <h6 class="__subtitulo d-flex d-inline-block text-center text-sm-center text-md-center text-lg-start pl-lg-3">Encuentre la espacialidad o el médico que necesita</h6>
                    </div>
                    <div class="col-8 d-flex flex-column flex-sm-column flex-md-row flex-lg-row justify-content-center justify-content-sm-center justify-content-md-between justify-content-between mx-auto p-0">
                        <div class="dropdown my-2 mx-auto mx-sm-auto mx-md-auto mx-lg-0 py-2">
                            <!-- <button class="btn btn-block btn-outline-white border-bottom dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              Búsqueda por especialidad...
                            </button>
                            <ul class="dropdown-menu col-12" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul> -->
                            <!-- <label class="formItem" for="select_especialidades"> <b>Seleccione la especialidad</b></label> -->
                            <select name="select_especialidades" id="select_especialidades" class="form-control" required>
                              <option value="">-Seleccioná una especialidad-</option>
                              @foreach($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}" offset="1">{{ $especialidad->nombre }}</option>
                              
                              @endforeach
                            </select>
                          </div>
    
                          <div class="dropdown my-2 mx-auto mx-sm-auto mx-md-auto mx-lg-0 py-2">
                            <!-- <button class="btn btn-block btn-outline-white border-bottom dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                              Búsqueda por médico...
                            </button>
                            <ul class="dropdown-menu col-12" aria-labelledby="dropdownMenuButton2">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul> -->
                            
                            <select name="select_medicos" id="select_medicos" class="form-control" required>
                              <option value="">-Seleccioná un medico/a-</option>
                              @foreach($medicos as $medico)
                                  <option value="{{ $medico->id }}" offset="1">{{ $medico->nombre}} {{ $medico->apellido}} </option>
                              @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-12 d-flex mx-auto my-4">
                        <div class="container col-8 __botones-servicios mx-auto px-0 d-flex flex-column flex-sm-column flex-md-row flex-lg-row ">
                            <a class="col-12 col-sm-12 col-md-4 col-lg-4 nav-link d-flex d-inline-block px-1 m-0" href="#"><img class="img-fluid px-0" src="images/botones/portal-paciente-grande.jpg" alt="Portal del paciente"></a>
                            <a class="col-12 col-sm-12 col-md-4 col-lg-4 nav-link d-flex d-inline-block px-1 m-0" href="#"><img class="img-fluid px-0" src="images/botones/guardia-web-grande.jpg" alt="Guardia web"></a>
                            <a class="col-12 col-sm-12 col-md-4 col-lg-4 nav-link d-flex d-inline-block px-1 m-0" href="#"><img class="img-fluid px-0" src="images/botones/guardia-pediatrica-grande.jpg" alt="Guardia pediátrica"></a>
                        </div>
                    </div>
        </article>

    </section>

@endsection

@section('js')
    
@endsection
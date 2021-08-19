@extends('template/template')

@section('css')

@endsection

@section('content')

<main class="mx-0 px-0">
    <div class="__content mx-auto px-0">
      <div class="row mx-0 px-0">
        <img class="img-fluid px-0" src="images/img/imagen_manos.png" alt="Imagen de portada">
        <div class="__botones-portada-home mx-0 px-0 d-flex flex-column flex-sm-column flex-md-row flex-lg-row">
          <a class="col-12 col-sm-12 col-md-4 col-lg-4 nav-link d-flex d-inline-block p-0 m-0" href="#"><img class="img-fluid px-0" src="images/botones/portal-paciente-grande.jpg" alt="Portal del paciente"></a>
          <a class="col-12 col-sm-12 col-md-4 col-lg-4 nav-link d-flex d-inline-block p-0 m-0" href="#"><img class="img-fluid px-0" src="images/botones/guardia-web-grande.jpg" alt="Guardia web"></a>
          <a class="col-12 col-sm-12 col-md-4 col-lg-4 nav-link d-flex d-inline-block p-0 m-0" href="#"><img class="img-fluid px-0" src="images/botones/guardia-pediatrica-grande.jpg" alt="Guardia pediátrica"></a>
        </div>
        <div class="col-12 __noticia-portada-home bg-white d-flex flex-column flex-sm-column flex-md-column flex-lg-row mx-0 px-0">

          <div class="__noticia col-12 col-sm-12 col-md-12 col-lg-8 d-flex flex-column flex-sm-column flex-md-row flex-lg-row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 __img-noticia d-flex">
              <img class="img-fluid d-flex p-2" src="images/noticia-vanuna.jpg" alt="vacuna">
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 __descripcion-noticia justify-content-center align-self-center p-2">
              <h4 class="col-12 d-block d-flex mt-auto">Lorem ipsum dolor sit.</h4>
              <p class="col-12 d-flex">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, modi. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi, rerum, molestias asperiores eum nisi commodi vitae quaerat, corrupti ratione illum incidunt dolorum! Numquam, illo ab velit blanditiis eligendi repudiandae qui!
              </p>
            </div>
          </div>

          <div class="col-12 col-sm-12 col-md-12 col-lg-4 __btn-farmacia-comollegar d-flex flex-column flex-sm-row flex-md-row flex-lg-column justify-content-center justify-content-md-around justify-content-lg-evenly align-items-center mx-0 px-0">
            <a class="nav-link d-flex d-inline-block p-1 m-1" href="#"><img src="images/botones/farmacia-off.jpg" onMouseOver="this.src='images/botones/farmacia-on.jpg'"onMouseOut="this.src='images/botones/farmacia-off.jpg'" width="220" height="70" class="d-flex" loading="lazy" alt="farmacia"></a>
            <a class="nav-link d-flex d-inline-block p-1 m-1" href="#"><img src="images/botones/como-llegar-off.jpg" onMouseOver="this.src='images/botones/como-llegar-on.jpg'"onMouseOut="this.src='images/botones/como-llegar-off.jpg'" width="220" height="70" class="d-flex" loading="lazy" alt="Como llegar"></a>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@section('js')
    
@endsection
@extends('template/template')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cooperativa.css') }}"> 
@endsection

@section('content')

    <section class="mx-0 px-0">
        <article class="mx-auto px-0">
            <div class="row mx-0 px-0">
                <img class="img-fluid px-0" src={{ asset("images/img/banner-cooperativa.png")}} alt="Imagen de portada de Cooperativa">
            </div>
        </article>

        <article class="container col-12 mx-auto p-0">
                    <div class="__textos-cooperativa col-11 col-sm-11 col-md-10 col-lg-8 d-flex flex-column mx-auto p-4 my-0">
                        <h1 class="fs-5 fw-bolder py-3">FORTALECIENDO LA UNIDAD DE LOS COMPAÑEROS PARA SOSTENER NUESTRA ORGANIZACIÓN COOPERATIVA</h1>
                        <p class="lh-base d-flex mx-auto">Desde el inicio de la gestión de la Cooperativa de Trabajo de la Salud en el año 2007 asumimos el compromiso de recuperar y fortalecer la fuente laboral de más de 50 familias de la CLINICA MOSCONI SA, y esa misma propuesta es la que seguimos buscando consolidar en la actualidad.</p>
                        <p class="lh-base d-flex mx-auto">Fueron comienzos difíciles, pues a la falta de experiencia que se tenía con respecto al tema cooperativas, se sumaba la incertidumbre económica, pero desde el principio de la conformación teníamos la seguridad que el camino elegido era el correcto. Cuando el trabajador decide ser parte de un proceso de cambio, difícilmente se equivoca y la realidad nos muestra que en plena convocatoria de quiebra nosotros decidimos tomar el compromiso de manejar nuestro propio destino, nuestro futuro como trabajador.</p>
                        <p class="lh-base d-flex mx-auto fst-italic">Así comenzamos a ser cooperativistas aprendiendo sobre la marcha las consignas básicas de ser solidarios, igualitarios, tolerantes, respetuosos y por sobre todas las cosas “ser humanos”. </p>
                        <p class="lh-base d-flex mx-auto">Comprendiendo que necesitábamos encontrar apoyo que nos permitiera sostenernos, comenzamos a peregrinar por los distintos organismos del Estado y de a poco comenzamos a ver que la situación podía cambiar. </p>
                        <p class="lh-base">La primera señal la tuvimos el 17 de abril del 2007 en el juzgado Nº 4 a cargo del Juez que entendía en la quiebra, Dr. Alberto Rezzonico, cuando en una decisión histórica nos comunicó que había resuelto <span class="fw-bolder">adjudicarnos el manejo administrativo de la CLINICA MOSCONI a partir del 1 de junio de 2007</span>.</p>
                    </div>
        </article>

    </section>

@endsection

@section('js')
    
@endsection
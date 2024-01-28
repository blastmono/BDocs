@extends('layouts.tabler')
@section('ubicacion','Tablero de anuncios')
@section('content')
@foreach($anuncios as $anuncio)
<div class="col-md-6 col-lg-3">
    <a href="#" class="card card-link card-link-pop">
        <div class="card-header">{{$anuncio->titulo}}</div>
        <div class="card-body">{{$anuncio->detalles}}</div>
    </a>
</div>
@endforeach


@endsection
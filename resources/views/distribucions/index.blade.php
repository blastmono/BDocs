@extends('layouts.base')

@section('ubicacion','Despacho de Documento - Paso 1')
@section('content')
{{$distribuciones}}
@foreach($distribuciones as $distribucion)
 {{$distribucion->documento->objeto}}
  {{$distribucion->organizacion->nombre}}
@endforeach
@endsection
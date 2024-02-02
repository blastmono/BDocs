@extends('layouts.tabler')
@section('ubicacion','Despacho de Documento')
@section('css_extras')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-6  offset-3">
    <div class="card">
        <div class="card-header">Seleccione Destinatarios para Despachar</div>
        <div class="card-body">
            @if(count($documentos)>0)
            <form method="POST" action="{{ route('distribuciones.store') }}" class="from-group">
                @csrf
                <!-- Documento a enviar -->
                <div>
                    <x-input-label for="documento_id" :value="__('Documento')" />
                    <select id="documento_id" class="form-control js-basic-sel2" name="documento_id" :value="old('documento_id')">
                    @foreach ($documentos as $documento)
                        <option value="{{ $documento->id }}">{{$documento->codigo}}/{{$documento->num_doc}} - {{$documento->fecha_doc}} - {{$documento->objeto}}</option>
                    @endforeach
                    </select>
                </div>
                <!--Destino -->
                <div>
                    <x-input-label for="organizacion_id" :value="__('Destino')" />
                    <select id="organizacion_id" class="form-control js-basic-sel2" name="organizacion_id[]" :value="old('organizacion_id')" multiple>
                    @foreach ($organizaciones as $organizacion)
                        <option value="{{ $organizacion->id }}">{{$organizacion->sigla}} - {{$organizacion->nombre}}</option>
                    @endforeach
                    </select>
                </div>

                <!--Grado -->
                <div>
                    <x-input-label for="estado_id" :value="__('Estado')" />
                    <select id="estado_id" class="form-control js-basic-sel2" name="estado_id" :value="old('estado_id')">
                    @foreach ($estados as $estado)
                        <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                    @endforeach
                    </select>
                </div>

                <!-- user destino -->
                <div>
                    <x-input-label for="user_id" :value="__('Organizacion Dependiente')" />
                    <select id="user_id" class="form-control js-basic-sel2" name="user_id" :value="old('user_id')">
                    @foreach ($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->grado}}. {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}} {{$usuario->nombres}}</option>
                    @endforeach
                    </select>
                </div>
            
                <div class="flex items-center justify-end mt-4">
            
                <button class="btn btn-info">Agregar</button>
                </div>
                
            </form>
            @else
            <div class="alert alert-warning">No Existen documentos para Despachar, Favor verificar en Registratura.</div>
            @endif
        </div>
    </div>
</div>
   
@endsection


@section('script_extras')
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-basic-sel2').select2({
            placeholder: "Seleccione una opcion...",
            maximumSelectionLength: <?= json_encode($documento->ejemplares) ?>
        });
    });
</script>

@endsection
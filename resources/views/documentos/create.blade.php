@extends('layouts.tabler')
@section('css_extras')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="col-12">
    <form method="POST" action="{{ route('documentos.store') }}" class="from-group" enctype="multipart/form-data">
@csrf
    <input type='hidden' value={{Auth()->user()->rut}} name="rut_user" id="rut_user" />
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="tipo_tramite_id">Prefijo</label>
                <select class="form-select js-basic-sel2" aria-label="Default select example" id="tipo_tramite_id" name="tipo_tramite_id">
                    <option selected>Seleccione Opcion</option>
                    @foreach ($tipoTra as $tramite)
                        <option value="{{$tramite->id}}">{{$tramite->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="inputPassword4">Tipo de Documento</label>
                <select class="form-select js-basic-sel2" aria-label="Default select example" id="tipo_documento_id" name="tipo_documento_id">
                    @foreach ($tipoDoc as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="clasificacion">Clafisicacion</label>
                <select class="form-select js-basic-sel2" aria-label="Default select example" id="clasificacion" name="clasificacion">
                    <option selected>Seleccione Opcion</option>
                    <option value="PUBLICO">PUBLICO</option>
                    <option value="RESERVADO">RESERVADO</option>
                    <option value="SECRETO">SECRETO</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="fecha_doc">Fecha Documento</label>
                <input type="date" class="form-control" id="fecha_doc" name="fecha_doc">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="inputPassword4">Emisor</label>
                <div>
                    <input type="text" class="form-control" value="{{Auth()->user()->Organizacion->sigla}} - {{Auth()->user()->Organizacion->nombre}}" id="emisor" name="emisor" disabled>
                    <input type="hidden" id="organizacion_id" name="organizacion_id" value={{Auth()->user()->Organizacion->id}}/>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fecha_doc">Ejemplares</label>
                        <input type="text" class="form-control" id="ejemplares" name="ejemplares">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="fecha_doc">Hojas</label>
                        <input type="text" class="form-control" id="hojas" name="hojas">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="inputPassword4">Materia</label>
                <div>
                    <label for="materia_id" :value="__('Materia')" />
                    <select id="materia_id" class="form-control js-basic-sel2" name="materia_id" :value="old('materia_id')">
                    @foreach ($materias as $materia)
                        <option value="{{$materia['id']}}">{{$materia['codigo']}} - {{$materia['descripcion']}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="num_doc">Numero Documento</label>
                <input type="text" class="form-control" id="num_doc" name="num_doc">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="objeto">Objeto</label>
                <input type="text" class="form-control" id="objeto" name="objeto">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="inputPassword4">Firmante</label>
                <div>
                    <select id="user_id" class="form-control js-basic-sel2" name="firmante" :value="old('firmante')">
                    @foreach ($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->grado}}. {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}} {{$usuario->nombres}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="col-4">
                    <div class="form-label">Impreso</div>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="papel" id="papel">
                        <span class="form-check-label">Impreso (Papel)</span>
                    </label>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                    <label for="file" class="form-label">Carga Archivo</label>
                    <input class="form-control" type="file" id="file" name="file">
                </div>
        </div>
    </div>
  <button type="submit" class="btn btn-info mt-2">Agregar</button>
</form>
    
</div>
        </div>
    </div>
</div>

@endsection   
@section('script_extras')
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        $('.js-basic-sel2').select2();
    });
</script>

@endsection
@extends('layouts.tabler')
@section('css_extras')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('ubicacion','Registro de Documento en KARDEX')
@section('content')
<form method="POST" action="{{ route('kardex.store') }}" class="from-group" enctype="multipart/form-data">
@csrf
    <input type='hidden' value={{Auth()->user()->rut}} name="rut_user" id="rut_user" />
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="inputEmail4">Tramite Documento</label>
                <select class="form-select js-basic-sel2" aria-label="Default select example" id="direccion" name="direccion">
                    <option selected>Seleccione Opcion</option>
                    <option value="1">Recepcion</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="inputPassword4">Tipo de Documento</label>
                <select class="form-select js-basic-sel2" aria-label="Default select example" id="tipo_doc" name="tipo_doc">
                    <option selected>Seleccione Opcion</option>
                    <option value="MEMO">MEMO</option>
                    <option value="OFICIO">OFICIO</option>
                    <option value="RESOLUCION">RESOLUCION</option>
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
                    <label for="organizacion_id" :value="__('Materia')" />
                    <select id="organizacion_id" class="form-control js-basic-sel2" name="organizacion_id" :value="old('organizacion_id')">
                    @foreach ($organizaciones as $organizacion)
                        <option value="{{$organizacion->id}}">{{$organizacion->sigla}} - {{$organizacion->nombre}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="destino">Receptor</label>
                <select id="destino" class="form-control js-basic-sel2" name="destino" :value="old('destino')">
                    @foreach ($organizaciones as $organizacion)
                        <option value="{{$organizacion->id}}">{{$organizacion->sigla}} - {{$organizacion->nombre}}</option>
                    @endforeach
                    </select>
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
                <label for="inputPassword4">Originador</label>
                <div>
                    <select id="originador" class="form-control js-basic-sel2" name="originador" :value="old('originador')">
                    @foreach ($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->grado}}. {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}} {{$usuario->nombres}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="plazo">Plazo</label>
                        <input class="form-control" type='date' placeholder="Select a date" id="plazo" name="plazo">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label">Cumplimiento de Plazo</div>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="cumplido" id="cumplido">
                        <span class="form-check-label">Cumplimiento</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="inputPassword4">Estado</label>
                        <div>
                            <select id="estado_id" class="form-control js-basic-sel2" name="estado_id" :value="old('estado_id')">
                            @foreach ($estados as $estado)
                                <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label">Copia Informativa</div>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="copia" id="copia">
                        <span class="form-check-label">Copia Informativa</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="archivador">Archivador</label>
                        <input class="form-control"  placeholder="Ingese Archivador" id="archivador" name="archivador">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-label">Impreso</div>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="papel" id="papel">
                        <span class="form-check-label">Impreso (Papel)</span>
                    </label>
                </div>
                <div class="col-4">
                    <div class="form-label">Entregado</div>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="papel" id="papel">
                        <span class="form-check-label">Entregado</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                    <label for="filex" class="form-label">Carga Archivo</label>
                    <input class="form-control" type="file" id="filex" name="filex">
                </div>
        </div>
    </div>
  <button type="submit" class="btn btn-info mt-2">Agregar</button>
</form>
@endsection

@section('script_extras')
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-basic-sel2').select2();
    });
</script>

@endsection
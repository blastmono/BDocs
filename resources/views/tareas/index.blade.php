@extends('layouts.tabler')
@section('ubicacion','Tareas Registradas')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success">Mis Tareas</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>Nº</td>
                        <td>Estado</td>
                        <td>Documento</td>
                        <td>Plazo</td>
                        <td>Tarea</td>
                        <td>Detalle</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas as $tarea)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@if($tarea->completada==1)
                            <input class="form-check-input" type="checkbox" checked="" disabled>
                            @else
                            <input class="form-check-input" type="checkbox" disabled>
                            @endif
                        </td>
                        <td>{{$tarea->documento->materia->codigo}}/{{$tarea->documento->num_doc}}</td>
                        <td>{{$tarea->plazo}}</td>
                        <td>{{$tarea->tarea}}</td>
                        <td>{{$tarea->detalle}}</td>
                        <td >
                            <form action="{{ route('tareas.cumple', $tarea->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Cumple</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- Tareas Asignadas -->
    <div class="card">
        <div class="card-header bg-info">Tareas Asignadas</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <td>Nº</td>
                        <td>Estado</td>
                        <td>Documento</td>
                        <td>Plazo</td>
                        <td>Tarea</td>
                        <td>Detalle</td>
                        <td>Responsable</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas_asignadas as $tarea_a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@if($tarea_a->completada==1)
                            <input class="form-check-input" type="checkbox" checked="" disabled>
                            @else
                            <input class="form-check-input" type="checkbox" disabled>
                            @endif
                        </td>
                        <td>{{$tarea_a->documento->materia->codigo}}/{{$tarea->documento->num_doc}}</td>
                        <td>{{$tarea_a->plazo}}</td>
                        <td>{{$tarea_a->tarea}}</td>
                        <td>{{$tarea_a->detalle}}</td>
                        <td>{{$tarea_a->user->grado}}.{{$tarea_a->user->apellidoPaterno}} {{$tarea_a->user->apellidoMaterno}} {{$tarea_a->user->nombres}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection
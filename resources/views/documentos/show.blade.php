@extends('layouts.tabler')
@section('ubicacion','Visor Documental')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header {{$fondo_clasificacion}}">
              <h3 class="card-title text-white">{{$documento['clasificacion']}}</h3>
            </div> 
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table">
                <tr>
                  <td>
                    Fecha Documento:
                  </td>
                  <td>
                    <h3><span class="badge bg-green text-green-fg">{{$documento['fecha_doc']}}</span></h3>
                  </td>
                </tr>
                <tr>
                  <td>
                    Numero de Documento:
                  </td>
                  <td>
                    [{{$materia['codigo']}} / {{$documento['num_doc']}}]
                  </td>
                </tr>
                <tr>
                  <td>
                    Tipo Documento:
                  </td>
                  <td>
                    {{ $documento->tipo_documento->nombre}}
                  </td>
                </tr>
                <tr>
                  <td>
                    Objeto:
                  </td>
                  <td>
                    {{$documento['objeto']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    Origen:
                  </td>
                  <td>
                    {{$organizacion['nombre']}}
                  </td>
                </tr>
                <tr>
                  <td>
                    Registro Documental:
                  </td>
                  <td>
                    <span class="mailbox-read-time float-right"><span class="badge badge-success">{{$documento['created_at']}}</span></span></h6>
                  </td>
                </tr>
              </table>
              <!-- /.mailbox-read-info -->

              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
              <iframe width="100%" height="500" src="{{ asset(env('MINIO_URL')).'/'.$documento->rutaArchivo}}" frameborder="0"></iframe>
              <a href="{{ asset(env('MINIO_URL')).'/'.$documento->rutaArchivo}}" target="_blank">{{$documento->rutaArchivo}}</a>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card">
              <div class="card-header">Distribucion</div>
              <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Destino</th>
                            <th>Estado Actual</th>
                            <th>Ultima Actualizacion</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($distribucion as $dist)
                        <tr>
                          <td >{{ $dist->organizacion->sigla }}</td>
                          @if($dist->estado->id == '5')
                          <td ><span class="badge bg-lime text-lime-fg">{{ $dist->estado->nombre }}</span></td>
                          @else
                          <td ><span class="badge bg-yellow text-yellow-fg">{{ $dist->estado->nombre }}</span></td>
                          @endif
                          <td >{{ $dist->estado->updated_at }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            <div class="card mt-2">
              <div class="card-header">Tareas</div>
              <div class="card-body">
                <livewire:tareas.muestra-tareas documento="{{$documento['id']}}" />
                <livewire:tareas.crear-tarea docu="{{$documento['id']}}" />
              </div>
            </div>
        </div>
      </div>
        <!-- /.col -->
      </div>
    </section>
@endsection
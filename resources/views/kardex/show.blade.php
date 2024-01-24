@extends('layouts.tabler')
@section('ubicacion','Detalles Documento')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-7">
          <div class="card card-primary card-outline">
            <div class="card-header {{$fondo_clasificacion}}>
              <h3 class="card-title ">{{$documento['Clasificacion']}}</h3>
            </div> 
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>{{$materia['codigo']}} / {{$documento['num_doc']}} -  {{$documento['objeto']}}</h5>
                <h6>Origen: {{$documento['organizacion_id']}} 
                <span class="mailbox-read-time float-right">{{$documento['fecha_doc']}}</span></h6>
                <h6></h6>
                <h4>
                Documento Ingresado:<span class="mailbox-read-time float-right"><span class="badge bg-green text-green-fg">{{$documento['created_at']}}</span></h4>

              </div> 
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" title="Print">
                  <i class="fas fa-print"></i>
                </button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">

              @if (file_exists(public_path('uploads').'/'.$documento['rutaArchivo']))
                <iframe width="100%" height="500" src="{{asset('uploads/kardex/'. $documento->ruta_digital)}}" frameborder="0"></iframe>
              @else
                <div class="alert alet-warning">No hay Archivo para mostrar.</div>
              @endif
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-5">
            <!-- Main node for this component -->
<div class="timeline">
  <!-- Timeline time label -->
  <div class="time-label">
    <span class="bg-green">23 Aug. 2019</span>
  </div>
  <div>
  <!-- Before each timeline item corresponds to one icon on the left scale -->
    <i class="fas fa-envelope bg-blue"></i>
    <!-- Timeline item -->
    <div class="timeline-item">
    <!-- Time -->
      <span class="time"><i class="fas fa-clock"></i> 12:05</span>
      <!-- Header. Optional -->
      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
      <!-- Body -->
      <div class="timeline-body">
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
        weebly ning heekya handango imeem plugg dopplr jibjab, movity
        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
        quora plaxo ideeli hulu weebly balihoo...
      </div>
      <!-- Placement of additional controls. Optional -->
      <div class="timeline-footer">
        <a class="btn btn-primary btn-sm">Read more</a>
        <a class="btn btn-danger btn-sm">Delete</a>
      </div>
    </div>
  </div>
  <!-- The last icon means the story is complete -->
  <div>
    <i class="fas fa-clock bg-gray"></i>
  </div>
</div>
        </div>
      </div>
        <!-- /.col -->
      </div>
    </section>
@endsection
@extends('layouts.tabler')
@section('ubicacion','Bandeja de Entrada')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"></h3>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="table">
          <table class="table table-striped table-bordered">
            <thead>
                <tr>
                  <th>dIST</th>
                  <th>Fecha Doc</th>
                  <th>Origen</th>
                  <th>Num doc</th>
                  <th>Objeto</th>
                  <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($distribucion as $dist)
                <tr>
                  <td>{{ $dist->id }}</td>
                  <td>{{ $dist->documento->fecha_doc }}</td>
                  <td>{{ $dist->organizacion->sigla }}</td>
                  <td ><a href="{{ route('documentos.show',[$dist->documento_id,$dist->id]) }}" class="btn btn-sm btn-info">{{ $dist->documento->materia->codigo }} / {{ $dist->documento->num_doc }}</a></td>
                  <td>{{ $dist->documento->objeto }}</td>
                  <td>{{ $dist->estado->nombre }}</td>
                </tr>
                @empty
                         <td colspan="6">
                        <div class="alert alert-success">No hay documentos recibidos.</div>
                        </td>

                @endforelse
            </tbody>
        </table>
        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer p-0">
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle">
            <i class="far fa-square"></i>
          </button>
          <!-- /.btn-group -->
          <button type="button" class="btn btn-default btn-sm">
            <i class="fas fa-sync-alt"></i>
          </button>
          <div class="float-right">
            1-50/200
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-chevron-left"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
            <!-- /.btn-group -->
          </div>
          <!-- /.float-right -->
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
@endsection
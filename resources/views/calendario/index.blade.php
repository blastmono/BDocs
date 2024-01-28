@extends('layouts.tabler')
@section('css_extras')
    <style>
      .header-col{
        background: #E3E9E5;
        color:#536170;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
      }
      .box-day{
        border:1px solid #E3E9E5;
        height:150px;
      }
      .box-dayoff{
        border:1px solid #E3E9E5;
        height:150px;
        background-color: #ccd1ce;
      }

    </style>
@endsection
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="row header-calendar">

        <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
          <a  href="{{ asset('/Calendar/event/') }}/<?= $data['last']; ?>" style="margin:10px;">
            <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
          </a>
          <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
          <a  href="{{ asset('/Calendar/event/') }}/<?= $data['next']; ?>" style="margin:10px;">
            <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
          </a>
        </div>

      </div>
      <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miercoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sabado</div>
        <div class="col header-col">Domingo</div>
      </div>
      <!-- inicio de semana -->
      @foreach ($data['calendar'] as $weekdata)
        <div class="row">
          <!-- ciclo de dia por semana -->
          @foreach  ($weekdata['datos'] as $dayweek)

          @if  ($dayweek['mes']==$mes)
            <div class="col box-day">
              {{ $dayweek['dia']  }}
              <!-- evento -->
              @foreach  ($dayweek['evento'] as $event)
                  <a class="badge badge-primary" href="{{ route('documentos.show',$event->documento_id) }}/{{ $event->id }}">
                    {{ $event->tarea }}
                  </a>
              @endforeach
            </div>
          @else
          <div class="col box-dayoff">
          </div>
          @endif
          @endforeach
        </div>
      @endforeach
    </div>
  </div>
</div>
      

<!-- /container -->
@endsection
  
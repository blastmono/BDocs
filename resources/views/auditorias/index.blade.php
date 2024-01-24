@extends('layouts.tabler')

@section('ubicacion','Registro de eventos.')
@section('content')
<div class="alert alert-warning">Los registros solo tiene permiso para <strong>VISUALIZAR</strong></div>
<table id="example1" class="table table-bordered table-hover">
<thead>
            <tr>
                <th>Usuario</th>
                <th>Actividad</th>
                <th>Hora / Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($auditorias as $auditoria)
                <tr>
                    <td> {{ $auditoria->user_id }} </td>
                    <td> {{ $auditoria->actividad }} </td>
                    <td> {{ $auditoria->created_at }} </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="9" class="border px-4 py-2"><div class="alert alert-warning">No hay Documentos para mostrar.</div></td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection

@section('script_extras')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection         
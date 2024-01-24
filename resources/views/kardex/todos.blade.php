@extends('layouts.tabler')
@section('ubicacion','Toda el Kardex')
@section('content')
{{dd($kardexs)}}
<div class="alert alert-info">Se Entiende que todo documento registrado tiene como destino la organizacion a la cual pertenece.</div>
<table id="example1" class="table table-sm table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>Fecha Registro</th>
                <th>Fecha Doc</th>
                <th>Tipo Documento</th>
                <th>Clasificacion</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Numero Documento</th>
                <th>Objeto</th>
                <th>Plazo</th>
                <th>Originador</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($kardexs as $kardex)
                <tr>
                    <td >{{ $kardex->created_at }}</td>
                    <td >{{ $kardex->documento->fecha_doc }}</td>
                   
                    
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="11" class="border px-4 py-2"><div class="alert alert-warning">No hay Documentos registrados.</div></td>
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
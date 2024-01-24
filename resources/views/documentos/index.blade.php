@extends('layouts.tabler')

@section('ubicacion','Despacho Documental')
@section('content')
<table id="example1" class="table table-sm table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Clasificacion</th>
                <th>Fecha Doc</th>
                <th>Objeto</th>
                <th>Origen</th>

                <th>Ejemplares</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documentos as $documento)
                <tr>
                    <td>{{ $documento->codigo }} / {{ $documento->num_doc }}</td>
                    <td >{{ $documento->clasificacion }}</td>
                    <td >{{ $documento->fecha_doc }}</td>
                    <td >{{ $documento->objeto }}</td>
                    <td >{{ $documento->sigla }}</td>
                    <td >{{ $documento->ejemplares }}</td>
                    <td> 
                        <a href="{{ route('distribuciones.create', [$documento->id]) }}" class="btn btn-sm btn-info">Despachar</a>
                        <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="9" class="border px-4 py-2"><div class="alert alert-warning">No hay Documentos para Despachar.</div></td>
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
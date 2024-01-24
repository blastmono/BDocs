@extends('layouts.tabler')
@section('ubicacion','Listado Instituciones')
@section('content')
<div class="col-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Imagen') }}</th>
                <th>{{ __('Sigla') }}</th>
                <th>{{ __('Nombre') }}</th>
                <th>{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($instituciones as $institucion)
                <tr>
                    <td>
                        <div class="image">
                            <img src="{{ asset('img/'.$institucion->imagen) }}" class="img-circle elevation-2" height="50" width="50">
                        </div>
                    </td>
                    <td>{{ $institucion->sigla }}</td>
                    <td >{{ $institucion->nombre }}</td>
                    <td>
                        <a href="{{ route('institucion.show', $institucion) }}" class="btn btn-sm btn-info">Detalle</a>
                        <a href="{{ route('institucion.edit', $institucion) }}" class="btn btn-sm btn-warning btm-sm">Editar</a>
                        <form action="{{ route('institucion.destroy', $institucion) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="3" class="border px-4 py-2"><div class="alert alert-warning">No hay Instituciones para mostrar.</div></td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection

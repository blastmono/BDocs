@extends('layouts.tabler')

@section('content')
    <table class="table table-sm table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>{{ __('Sigla') }}</th>
                <th>{{ __('Nombre') }}</th>
                <th>{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($organizaciones as $organizacion)
                <tr>
                    <td>{{ $organizacion->sigla }}</td>
                    <td>{{ $organizacion->nombre }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="{{ route('organizacion.show', $organizacion) }}" class="btn btn-sm btn-info">Detalles</a>
                    <a href="{{ route('organizacion.edit', $organizacion) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('organizacion.destroy', $organizacion) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                    </div>
                        
                        
                        
                    </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="3" class="border px-4 py-2"><div class="alert alert-warning">No hay Organizaciones para mostrar.</div></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection


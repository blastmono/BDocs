@extends('layouts.tabler')
@section('ubicacion', 'Estados Documentales')
@section('content')
<table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Nombre') }}</th>
                <th>{{ __('Descripcion') }}</th>
                <th>{{ __('Activo') }}</th>
                <th>{{ __('Fecha Creacion') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estados as $estado)
                <tr>
                    <td>{{ $estado->nombre }}</td>
                    <td >{{ $estado->descripcion }}</td>
                    <td >{{ $estado->activo }}</td>
                    <td >{{ $estado->created_at }}</td>
                    <td>
                        <a href="{{ route('estados.show', $estado) }}" class="btn btn-sm btn-info">Detalle</a>
                        <a href="{{ route('estados.edit', $estado) }}" class="btn btn-sm btn-warning btm-sm">Editar</a>
                        <form action="{{ route('estados.destroy', $estado) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="4" class="border px-4 py-2"><div class="alert alert-warning">No hay Estados para mostrar.</div></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
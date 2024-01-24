@extends('layouts.tabler')
@section('content')
<div class="">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ __('Codigo') }}</th>
                <th>{{ __('Descripcion') }}</th>
                <th>{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse ($materias as $materia)
                <tr>
                    <td>{{ $materia->codigo }}</td>
                    <td >{{ $materia->descripcion }}</td>
                    <td>
                        <a href="{{ route('materias.show', $materia) }}" class="btn btn-info btn-sm">Detalle</a>
                        <a href="{{ route('materias.edit', $materia) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('materias.destroy', $materia) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="3" class="border px-4 py-2"><div class="alert alert-warning">No hay Organizaciones para mostrar.</div></td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
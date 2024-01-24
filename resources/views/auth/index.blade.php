@extends('layouts.tabler')
@section('ubicacion','Listado de Usuarios')
@section('boton')
@can('create-user')
<div class="btn-list">
                  <a href="{{ route('users.create') }}" class="btn btn-success d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Nuevo Usuario
                  </a>
                </div>
                @endcan
@endsection
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Rut') }}</th>
                <th>{{ __('Grado') }}</th>
                <th>{{ __('Apellido Paterno') }}</th>
                <th>{{ __('Apellido Materno') }}</th>
                <th>{{ __('Rol') }}</th>
                <th>{{ __('Creacion') }}</th>
                <th>{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->rut }}</td>
                    <td>{{ $usuario->grado }}</td>
                    <td>{{ $usuario->apellidoPaterno }}</td>
                    <td>{{ $usuario->apellidoMaterno }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>{{ $usuario->created_at }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="{{ route('profile.edit', $usuario) }}" class="btn btn-sm btn-info">Detalles</a>
                    <a href="{{ route('profile.edit', $usuario) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('profile.destroy', $usuario) }}" method="POST">
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

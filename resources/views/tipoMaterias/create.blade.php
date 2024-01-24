@extends('layouts.base')
@section('ubicacion','Nueva Categoria Materias')
@section('content')
<div class="col-8  offset-1">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form method="POST" action="{{ route('tipoMaterias.store') }}" class="from-group">
                @csrf
                <!-- Rut -->
                <div>
                    <x-input-label for="codigo" :value="__('Codigo')" />
                    <x-text-input id="codigo" class="form-control" type="number" name="codigo" :value="old('codigo')" required autofocus autocomplete="codigo" />
                    <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                </div>
                <!--Grado -->
                <div>
                    <x-input-label for="descripcion" :value="__('Descripcion')" />
                    <x-text-input id="descripcion" class="form-control" type="text" name="descripcion" :value="old('descripcion')" required autofocus autocomplete="descripcion" />
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>
            
                <div class="flex items-center justify-end mt-4">
            
                    <x-primary-button class="btn btn-info">
                        {{ __('Agregar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    
</div>
    
@endsection
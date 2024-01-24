@extends('layouts.tabler')

@section('titulo',$titulo)

@section('ubicacion',$ubicacion)

@section('content')
<div class="col-8  offset-1">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form method="POST" action="{{ route('institucion.store') }}" class="from-group">
                @csrf
                <!-- Rut -->
                <div>
                    <x-input-label for="sigla" :value="__('Sigla')" />
                    <x-text-input id="sigla" class="form-control" type="text" name="sigla" :value="old('sigla')" required autofocus autocomplete="sigla" />
                    <x-input-error :messages="$errors->get('sigla')" class="mt-2" />
                </div>
                <!--Grado -->
                <div>
                    <x-input-label for="nombre" :value="__('Nombre')" />
                    <x-text-input id="nombre" class="form-control" type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="nombre" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
            
                <div>
                    <x-input-label for="imagen" :value="__('Imagen')" />
                    <x-text-input id="imagen" class="form-control" type="text" name="imagen" :value="old('imagen')" required autofocus autocomplete="imagen" />
                    <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
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
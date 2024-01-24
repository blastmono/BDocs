@extends('layouts.tabler')

@section('ubicacion','Nuevo Estado')
@section('content')
<div class="col-8 offset-1">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form method="POST" action="{{ route('estados.store') }}" class="from-group">
                @csrf
                <input type="hidden" value={{ Auth::user()->id }} name="user_id" id="user_id" />
                <!--Nombre -->
                <div>
                    <x-input-label for="nombre" :value="__('Nombre')" />
                    <x-text-input id="nombre" class="form-control" type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="nombre" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>

                <!-- Descripcion -->
                <div>
                    <x-input-label for="descripcion" :value="__('Descripcion')" />
                    <x-text-input id="descripcion" class="form-control" type="text" name="descripcion" :value="old('descripcion')" required autofocus autocomplete="descripcion" />
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>

                <!-- Activo -->
                <div>
                    <x-input-label for="activo" :value="__('Activo')" />
                    <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo" :value="old('activo')" required autocomplete="activo" checked>
                    <x-input-error :messages="$errors->get('activo')" class="mt-2" />
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

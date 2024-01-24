@extends('layouts.tabler')

@section('titulo',$titulo)


@section('content')
<div class="col-8  offset-1">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form method="POST" action="{{ route('organizacion.store') }}" class="from-group">
                @csrf
                <!-- Sigla -->
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

                <!--Grado -->
                <div>
                    <x-input-label for="organizacion_id" :value="__('Organizacion Dependiente')" />
                    <select id="organizacion_id" class="form-control" name="organizacion_id" :value="old('organizacion_id')">
                    @foreach ($organizaciones as $organizacion)
                        <option value="{{$organizacion['id']}}">{{$organizacion['sigla']}} - {{$organizacion['nombre']}}</option>
                    @endforeach
                    </select>
                </div>
            
                <div class="flex items-center justify-end mt-4">
            
                <button class="btn btn-info">Agregar</button>
                </div>
                
            </form>
        </div>
    </div>
    
</div>
    
@endsection
@extends('layouts.tabler')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">{{ $organizacion->sigla }}</h1>
                <p class="text-gray-700 mb-4">
                    {{ __('Nombre') }}: {{ $organizacion->nombre }}
                </p>
                <p class="text-gray-700 mb-4">{{ $organizacion->nombre }}</p>
                <p class="text-gray-700 mb-4">{{ $organizacion }}</p>
            </div>
            <h1>{{$superior['nombre']}}</h1>
        </div>
    </div>

@endsection
@extends('layouts.tabler')
@section('extra_css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
@endsection
@section('content')
<div class="col-6">
    <form method="POST" action="{{ route('users.store') }}" class="from-group">
        @csrf
        <!-- Rut -->
        <div>
            <x-input-label for="rut" :value="__('Rut')" />
            <input id="rut" class="form-control" type="text" name="rut" :value="old('rut')" required autofocus autocomplete="rut"/>
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>
        <!--Grado -->
        <div>
            <x-input-label for="grado" :value="__('Grado')" />
            <x-text-input id="grado" class="form-control" type="text" name="grado" :value="old('grado')" required autofocus autocomplete="grado" />
            <x-input-error :messages="$errors->get('grado')" class="mt-2" />
        </div>

        <!-- Nombres -->
        <div>
            <x-input-label for="nombres" :value="__('Nombres')" />
            <x-text-input id="nombres" class="form-control" type="text" name="nombres" :value="old('nombres')" required autofocus autocomplete="nombres" />
            <x-input-error :messages="$errors->get('nombres')" class="mt-2" />
        </div>
        <!-- Apellido Paterno-->
        <div>
            <x-input-label for="apellidoPaterno" :value="__('Apellido Paterno')" />
            <x-text-input id="apellidoPaterno" class="form-control" type="text" name="apellidoPaterno" :value="old('apellidoPaterno')" required autofocus autocomplete="apellidoPaterno" />
            <x-input-error :messages="$errors->get('apellidoPaterno')" class="mt-2" />
        </div>
        <!-- Apellido Materno--> 
        <div>
            <x-input-label for="apellidoMaterno" :value="__('Apellido Materno')" />
            <x-text-input id="apellidoMaterno" class="form-control" type="text" name="apellidoMaterno" :value="old('apellidoMaterno')" required autofocus autocomplete="apellidoMaterno" />
            <x-input-error :messages="$errors->get('apellidoMaterno')" class="mt-2" />
        </div>

        <!-- Institucion -->
        <div>
            <x-input-label for="institucion_id" :value="__('Institucion')" />
            <select id="institucion_id" class="form-control select2bs4" name="institucion_id" :value="old('institucion_id')">
                @foreach ($instituciones as $institucion)
                    <option value="{{$institucion['id']}}">{{$institucion['sigla']}} - {{$institucion['nombre']}}</option>
                @endforeach
            </select>
        </div>

        <!-- Organizacion -->
        <div>
            <x-input-label for="institucion_id" :value="__('Institucion')" />
            <select id="organizacion_id" class="form-control select2bs4" name="organizacion_id" :value="old('organizacion_id')">
                @foreach ($organizaciones as $organizacion)
                    <option value="{{$organizacion['id']}}">{{$organizacion['sigla']}} - {{$organizacion['nombre']}}</option>
                @endforeach
            </select>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                        <div class="col-md-6">           
                            <select class="form-select @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles" name="roles[]">
                                @forelse ($roles as $role)

                                    @if ($role!='Super Admin')
                                        <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                        {{ $role }}
                                        </option>
                                    @else
                                        @if (Auth::user()->hasRole('Super Admin'))   
                                            <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                            {{ $role }}
                                            </option>
                                        @endif
                                    @endif

                                @empty

                                @endforelse
                            </select>
                            @if ($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                    </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-primary">
                {{ __('Registrar') }}
            </button>
        </div>
    </form>
</div>

@endsection

@section('extra_scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    }
    )
</script>

@endsection
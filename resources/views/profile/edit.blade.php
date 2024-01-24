@extends('layouts.tabler')
@section('ubicacion','Perfil de Usuario')
@section('css_extras')
<style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
@endsection
@section('content')
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                  <div class="card-body">
                    <h4 class="subheader">Configuracion de Usuario</h4>
                    <div class="list-group list-group-transparent">
                      <a href="./settings.html" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">My Notifications</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Connected Apps</a>
                      <a href="./settings-plan.html" class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Billing & Invoices</a>
                    </div>
                    <h4 class="subheader mt-4">Experience</h4>
                    <div class="list-group list-group-transparent">
                      <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column">
                  <div class="card-body">
                    <h2 class="mb-4">Mi Cuenta</h2>
                    <h3 class="card-title">Detalle del Perfil</h3>
                    <div class="row align-items-center">
                      <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                      </div>
                      <div class="col-auto"><a href="#" class="btn">
                          Change avatar
                        </a></div>
                      <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                          Delete avatar
                        </a></div>
                    </div>
                    <h3 class="card-title mt-4">Business Profile</h3>
                    <div class="row g-3">
                      <div class="col-md">
                        <div class="form-label">Nombre</div>
                        <input type="text" class="form-control" value="{{ Auth::user()->nombres }}" disabled>
                      </div>
                      <div class="col-md">
                        <div class="form-label">Apellido Paterno</div>
                        <input type="text" class="form-control" value="{{ Auth::user()->apellidoPaterno }}" disabled>
                      </div>
                      <div class="col-md">
                        <div class="form-label">Apellido Materno</div>
                        <input type="text" class="form-control" value="{{ Auth::user()->apellidoMaterno }}" disabled>
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Email</h3>
                    <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
                    <div>
                      <div class="row g-2">
                        <div class="col-auto">
                          <input type="text" class="form-control w-auto" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="col-auto"><a href="#" class="btn">
                            Change
                          </a></div>
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Contraseña</h3>
                    <p class="card-subtitle">Puedes cambiar la contraseña desde este apartado</p>
                    <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Cambiar Contraseña
                    </button>
                    </div>
                    <h3 class="card-title mt-4">2FA</h3>
                    <p class="card-subtitle">Puedes habilitar el 2FA, o desactivarlo (Pronto sera obligatorio mantenerlo activo)</p>
                    <div>
                      
                      <label class="form-check form-switch form-switch-lg">
                        @if($activado2fa == "0")
                        <input class="form-check-input" type="checkbox">
                        @else
                        <input class="form-check-input" type="checkbox" checked>
                        @endif
                        <span class="form-check-label form-check-label-on">2FA Activado</span>
                        <span class="form-check-label form-check-label-off">2FA Desactivado</span>
                      </label>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <a href="#" class="btn btn-primary">
                        Submit
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!-- Modal -->
<div class="modal modal-blur fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambio de Contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <form method="post" action="{{ route('password.update') }}" class="form-group">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" />
            <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Nueva Contraseña')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary mt-2" >{{ __('Actualizar') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Actualizada.') }}</p>
            @endif
        </div>
    </form>
          </div>
      </div>
    </div>
  </div>
</div>
      </div>
@endsection
@section('script_extras')
<script src="{{ asset('js/demo.js?1684106062') }}"></script>
@endsection



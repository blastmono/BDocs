<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Docs - Plataforma de Registro Documental</title>
    <!-- CSS files -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/tabler.min.css?1684106062') }}" rel="stylesheet">
    @livewireStyles
    @yield('css_extras')
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    
  </head>
  <body class="layout-fluid">
    <div class="page">
      <!-- Navbar -->
      @include('layouts.tabler.header')
      <!-- Menu superior-->
      @include('layouts.tabler.menu')
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Ubicacion
                </div>
                <h2 class="page-title">
                  @yield('ubicacion','Pagina Principal')
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                
                @yield('boton')
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        
        <div class="page-body">
          <div class="container-xl">

            @yield('content')
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="#" target="_blank" class="link-secondary" rel="noopener">Ayuda</a></li>
                  <li class="list-inline-item"><a href="#" class="link-secondary">Licenciamiento</a></li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2024
                    <a href="." class="link-secondary">Marco Miranda Morales</a>.
                    Todos los derechos reservador.
                  </li>
                  <li class="list-inline-item">
                      v0.5-beta1
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
    <script src="//{{request()->getHost()}}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/tabler.min.js?1684106062') }}"></script>
    @vite(['resources/js/app.js'])
    <!-- Tabler Core -->
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script_extras')
    
    <script>
      window.laravelEchoPort = '{{ env("LARAVEL_ECHO_PORT")}}';
      document.addEventListener('DOMContentLoaded',function(){
        var userId = '{{ Auth::user()->id }}';
        const organizacionId = '{{ Auth::user()->organizacion_id }}';
        const muestraRegistro = document.getElementById('miNotification');

            window.Echo.channel('canal-Notificaciones')
            .listen('.MessageEvent', (data)=>{
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "success",
                title: data.title + " "+data.message
              });
            });
             window.Echo.private('notificacion.' +userId)
              .listen('.MessageEvent', (data)=>{
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "success",
                title: data.title + " "+data.message
              });
            });
            window.Echo.private('notificacion.organizacion.' +organizacionId)
              .listen('.MessageEvent', (data)=>{
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "success",
                title: data.title + " "+data.message
              });
            });
      });
    </script>
  </body>
</html>
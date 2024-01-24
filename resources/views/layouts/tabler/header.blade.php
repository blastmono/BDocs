<header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="{{asset('img/logo_emco.png')}}" alt="AdminLTE Logo" width="32" height="32" class="brand-image img-circle elevation-3" style="opacity: .8">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                
                <div class="d-none d-xl-block ps-2">
                  <div>{{Auth()->user()->grado}}. {{Auth()->user()->apellidoPaterno}} {{Auth()->user()->apellidoMaterno}} {{Auth()->user()->nombres}}</div>
                  <div class="mt-1 small text-muted">{{Auth()->user()->Organizacion->sigla}} - {{Auth()->user()->Organizacion->nombre}}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="#" class="dropdown-item">Status</a>
                <a href="{{route('profile.edit')}}" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="{{route('profile.edit')}}" class="dropdown-item">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                      <i class="fas fa-window-close"></i></i> Salir
                    </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>
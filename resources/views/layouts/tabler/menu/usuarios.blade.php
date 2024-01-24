<div class="dropend">
    <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
        Usuarios
    </a>
    <div class="dropdown-menu">
        <a href="{{ route('users.create') }}" class="dropdown-item">
        Nuevo Usuario
        </a>
        <a href="{{ route('users.index') }}" class="dropdown-item">
            Listar Usuarios
        </a>
    </div>
</div>
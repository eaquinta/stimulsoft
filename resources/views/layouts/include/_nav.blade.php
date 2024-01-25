<nav class="navbar navbar-expand-lg navbar-dark bg-dark autohide">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel8') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        General
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @can('personas.index')
                            <li><a class="dropdown-item {{(request()->route()->getName() == 'personas.index') ? 'active' : ''}}" href="{{ route('personas.index')}}"><i class="fa fa-users"></i>&nbsp;Personas</a></li>
                        @endcan
                        @can('roles.index')
                            <li><a class="dropdown-item {{(request()->route()->getName() == 'roles.index') ? 'active' : ''}}" href="{{ route('roles.index')}}"><i class="fa fa-users"></i>&nbsp;Roles</a></li>
                        @endcan
                        @can('permissions.index')
                            <li><a class="dropdown-item {{(request()->route()->getName() == 'permissions.index') ? 'active' : ''}}" href="{{ route('permissions.index')}}"><i class="fa fa-users"></i>&nbsp;Permisos</a></li>
                        @endcan
                        @can('users.index')
                            <li><a class="dropdown-item {{(request()->route()->getName() == 'users.index') ? 'active' : ''}}" href="{{ route('users.index')}}"><i class="fa fa-users"></i>&nbsp;Usuarios</a></li>
                        @endcan
                    </ul>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }} </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('change_password') }}"><i class="fas fa-key"></i> Cambio de Contraseña</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="far fa-address-card"></i> {{__('Profile')}}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

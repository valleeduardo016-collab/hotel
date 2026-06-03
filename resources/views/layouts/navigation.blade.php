<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand fw-bold text-uppercase" style="letter-spacing: 0.1em;">
            HotelSys
        </a>

        <div class="collapse navbar-collapse">
            {{-- MENÚ PARA USUARIOS LOGUEADOS --}}
            @auth
            <ul class="navbar-nav me-auto">
                {{-- SUPER ADMIN --}}
                @if(auth()->user()->role === 'super_admin')
                    <li class="nav-item"><a href="{{ route('superadmin.dashboard') }}" class="nav-link text-uppercase fw-bold small">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('superadmin.hotels.index') }}" class="nav-link text-uppercase fw-bold small">Hoteles</a></li>
                    <li class="nav-item"><a href="{{ route('superadmin.users.index') }}" class="nav-link text-uppercase fw-bold small">Usuarios</a></li>
                @endif

                {{-- ADMIN HOTEL --}}
                @if(auth()->user()->role === 'admin_hotel')
                    <li class="nav-item"><a href="{{ route('admin.hotel.dashboard') }}" class="nav-link text-uppercase fw-bold small">Mi Hotel</a></li>
                    <li class="nav-item"><a href="{{ route('admin.rooms.index') }}" class="nav-link text-uppercase fw-bold small">Mis Habitaciones</a></li>
                    <li class="nav-item"><a href="{{ route('admin.reservations.index') }}" class="nav-link text-uppercase fw-bold small">Mis Reservas</a></li>
                @endif

                {{-- USER (CLIENTES) --}}
                @if(auth()->user()->role === 'user')
                    <li class="nav-item"><a href="{{ route('hotels.index') }}" class="nav-link text-uppercase fw-bold small">Hoteles</a></li>
                    <li class="nav-item"><a href="{{ route('reservations.index') }}" class="nav-link text-uppercase fw-bold small">Mis Reservas</a></li>
                @endif
            </ul>
            @endauth

            {{-- ZONA DE LOGIN / LOGOUT --}}
            <div class="d-flex align-items-center ms-auto">
                @auth
                    <span class="text-white small me-3">{{ auth()->user()->email }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm text-uppercase fw-bold small">Salir</button>
                    </form>
                @else
                    {{-- SI NO ESTÁ LOGUEADO --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm text-uppercase fw-bold small">
                        Iniciar Sesión
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
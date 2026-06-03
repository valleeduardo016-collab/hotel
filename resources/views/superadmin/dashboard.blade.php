@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="mb-5">
        <h1 class="display-5 fw-bold text-dark">Panel Super Admin</h1>
        <p class="text-muted">
            Bienvenido, <strong>{{ auth()->user()->name }}</strong> 
            <small class="text-secondary">({{ auth()->user()->email }})</small>
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="{{ route('superadmin.hotels.index') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm rounded-0 p-4 hover-effect">
                    <div class="card-body">
                        <h2 class="h4 fw-bold text-dark mb-2">🏨 Hoteles</h2>
                        <p class="text-muted m-0">Administrar hoteles del sistema</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('superadmin.users.index') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm rounded-0 p-4 hover-effect">
                    <div class="card-body">
                        <h2 class="h4 fw-bold text-dark mb-2">👤 Usuarios</h2>
                        <p class="text-muted m-0">Administrar usuarios y roles</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>

<style>
    .hover-effect { transition: transform 0.2s, background-color 0.2s; }
    .hover-effect:hover { transform: translateY(-5px); background-color: #f8f9fa; }
</style>
@endsection
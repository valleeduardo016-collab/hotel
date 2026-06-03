@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card rounded-0 shadow-sm border-dark">
                <div class="card-header bg-dark text-white rounded-0 text-uppercase fw-bold text-center">Iniciar Sesión</div>
                <div class="card-body p-4">
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control rounded-0" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control rounded-0" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark rounded-0">Ingresar</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}" class="text-decoration-none text-dark small">¿No tienes cuenta? Regístrate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
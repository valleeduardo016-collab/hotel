@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow-sm border-0 rounded-0 bg-white">
                <div class="card-body p-4">
                    
                    <h2 class="h4 fw-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.5px;">
                        Nuevo Usuario
                    </h2>
                    <p class="text-muted small mb-4">Ingresa las credenciales para registrar el alta en el sistema.</p>
                    
                    <form method="POST" action="{{ route('superadmin.users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Nombre Completo</label>
                            <input type="text" name="name" class="form-control rounded-0" required placeholder="Ej. Juan Pérez">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control rounded-0" required placeholder="nombre@bdhotel.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Contraseña de Acceso</label>
                            <input type="password" name="password" class="form-control rounded-0" required placeholder="••••••••">
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Asignar Rol</label>
                            <select name="role" class="form-select rounded-0" required>
                                <option value="user">Usuario / Cliente</option>
                                <option value="admin_hotel">Admin Hotel</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark rounded-0 py-2 fw-bold text-uppercase" style="letter-spacing: 0.5px;">
                                Guardar Registro
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
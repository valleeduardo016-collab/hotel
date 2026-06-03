@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Hotel</h1>

    <form method="POST"
          action="{{ route('superadmin.hotels.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nombre del hotel</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label>Correo electrónico del hotel</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Administrador del hotel</label>
            <select name="admin_id" class="form-control" required>
                <option value="">-- Selecciona un admin --</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">
                        {{ $admin->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen del hotel</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('superadmin.hotels.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>
@endsection
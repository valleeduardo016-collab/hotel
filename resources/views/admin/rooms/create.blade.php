@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Habitación - {{ $hotel->name }}</h1>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        method="POST" 
        action="{{ route('admin.rooms.store') }}" 
        enctype="multipart/form-data"
    >
        @csrf

        <div class="mb-3">
            <label>Tipo de habitación</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Disponibilidad</label>
            <select name="available" class="form-control" required>
                <option value="1">Disponible</option>
                <option value="0">No disponible</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>

        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>
@endsection
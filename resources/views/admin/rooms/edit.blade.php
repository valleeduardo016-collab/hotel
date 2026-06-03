@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Habitación</h2>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
        ← Volver
    </a>

    @if($room->image)
        <div class="mb-3">
            <label>Imagen actual</label><br>
            <img src="{{ asset('storage/'.$room->image) }}"
                 width="180"
                 class="img-thumbnail">
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.rooms.update', $room) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tipo</label>
            <input class="form-control" name="type" value="{{ $room->type }}">
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input class="form-control" name="price" value="{{ $room->price }}">
        </div>

        <div class="mb-3">
            <label>Disponible</label>
            <select name="available" class="form-control">
                <option value="1" {{ $room->available ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$room->available ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nueva imagen (opcional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
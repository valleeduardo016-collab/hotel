@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reservar habitación</h2>

    <p><strong>Hotel:</strong> {{ $room->hotel->name }}</p>
    <p><strong>Habitación:</strong> {{ $room->type }}</p>
    <p><strong>Precio por noche:</strong> ${{ $room->price }}</p>

    <form method="POST" action="{{ route('reservations.store', $room) }}">
        @csrf

        <label>Entrada</label>
        <input type="date" name="check_in" class="form-control mb-2" required>

        <label>Salida</label>
        <input type="date" name="check_out" class="form-control mb-3" required>

        <button class="btn btn-success">Reservar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
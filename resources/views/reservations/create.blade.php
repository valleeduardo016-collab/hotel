@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reservar habitación</h2>

    <form method="POST" action="{{ route('reservations.store', $room) }}">
        @csrf

        <label>Entrada</label>
        <input type="date" name="check_in" class="form-control mb-2" required>

        <label>Salida</label>
        <input type="date" name="check_out" class="form-control mb-2" required>

        <button class="btn btn-success">Reservar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
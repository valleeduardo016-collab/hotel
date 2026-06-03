@extends('layouts.app')

@section('content')
<div class="container">

    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
        ← Volver a hoteles
    </a>

    <div class="row mb-4">
        <div class="col-md-6">
            @if($hotel->image)
                <img src="{{ asset('storage/'.$hotel->image) }}"
                     class="img-fluid rounded shadow"
                     style="width:100%; height:300px; object-fit:cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center"
                     style="height:300px;">
                    <span class="text-muted">Sin imagen</span>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <h2>{{ $hotel->name }}</h2>
            <p>📍 {{ $hotel->address }}</p>
            <p>📞 {{ $hotel->telefono ?? 'No disponible' }}</p>
            <p>✉️ {{ $hotel->email ?? 'No disponible' }}</p>
        </div>
    </div>

    <hr>

    <h3 class="mb-3">🛏 Habitaciones disponibles</h3>

    <div class="row">
        @forelse($hotel->rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">

                    @if($room->image)
                        <img src="{{ asset('storage/'.$room->image) }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:180px;">
                            <span class="text-muted">Sin imagen</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $room->type }}</h5>
                        <p class="card-text">
                            💲 {{ $room->price }} por noche <br>
                            Estado:
                            <strong>
                                {{ $room->available ? 'Disponible' : 'Ocupada' }}
                            </strong>
                        </p>
                    </div>

                    <div class="card-footer text-center bg-white">
                        @auth
                            @if($room->available)
                                <a href="{{ route('reservations.create', $room) }}"
                                   class="btn btn-success btn-sm">
                                    Reservar
                                </a>
                            @else
                                <span class="text-danger">No disponible</span>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="btn btn-outline-primary btn-sm">
                                Inicia sesión para reservar
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        @empty
            <p>No hay habitaciones registradas.</p>
        @endforelse
    </div>

</div>
@endsection
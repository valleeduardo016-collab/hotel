@extends('layouts.app')

@section('content')
<div class="container py-4">

    <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm mb-3 rounded-0">
        ← Volver
    </a>

    <h1 class="mb-4 fw-bold text-uppercase">🛏️ Habitaciones - {{ $hotel->name }}</h1>

    <a href="{{ route('admin.rooms.create', $hotel) }}"
       class="btn btn-dark mb-4 rounded-0 px-4">
        + Crear Habitación
    </a>

    @if(session('success'))
        <div class="alert alert-dark rounded-0">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card h-100 rounded-0 shadow-sm border-dark">

                    {{-- IMAGEN --}}
                    @if($room->image)
                        <img src="{{ asset('storage/'.$room->image) }}"
                             class="card-img-top rounded-0"
                             style="height:200px; object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-0"
                             style="height:200px;">
                            <span class="text-muted">Sin imagen</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $room->type }}</h5>
                        <p class="card-text text-secondary">
                            💲 {{ number_format($room->price, 2) }}
                        </p>

                        <span class="badge {{ $room->available ? 'bg-dark' : 'bg-secondary' }} rounded-0">
                            {{ $room->available ? 'Disponible' : 'No disponible' }}
                        </span>
                    </div>

                    <div class="card-footer bg-white border-top border-dark text-center py-3">
                        <a href="{{ route('admin.rooms.edit', $room) }}"
                           class="btn btn-dark btn-sm rounded-0 me-2">
                            Editar
                        </a>

                        <form action="{{ route('admin.rooms.destroy', $room) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta habitación?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark btn-sm rounded-0">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
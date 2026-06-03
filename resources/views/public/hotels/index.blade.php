@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🏨 Hoteles disponibles</h1>

    <div class="row">
        @forelse($hotels as $hotel)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">

                    @if($hotel->image)
                        <img src="{{ asset('storage/'.$hotel->image) }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:200px;">
                            <span class="text-muted">Sin imagen</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <p class="card-text">
                            📍 {{ $hotel->address }}
                        </p>
                    </div>

                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('hotels.show', $hotel) }}"
                           class="btn btn-primary btn-sm">
                            Ver hotel
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay hoteles disponibles.</p>
        @endforelse
    </div>
</div>
@endsection
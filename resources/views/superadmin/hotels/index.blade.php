@extends('layouts.app')

@section('content')
<div class="container py-4">

    <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm mb-3 rounded-0">
        ← Volver
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase">🏨 Hoteles</h2>
        <a href="{{ route('superadmin.hotels.create') }}" class="btn btn-dark rounded-0 px-4">
            + Crear Hotel
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-dark rounded-0">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($hotels as $hotel)
            <div class="col-md-4 mb-4">
                <div class="card h-100 rounded-0 shadow-sm border-dark">

                    @if($hotel->image)
                        <img src="{{ asset('storage/'.$hotel->image) }}" class="card-img-top rounded-0" style="height:200px; object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-0" style="height:200px;">
                            <span class="text-muted">Sin imagen</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title fw-bold text-uppercase">{{ $hotel->name }}</h5>
                        <p class="card-text small text-secondary">
                            📍 {{ $hotel->address }} <br>
                            📞 {{ $hotel->telefono ?? 'N/A' }} <br>
                            ✉️ {{ $hotel->email ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="card-footer bg-white border-top border-dark text-center py-3">
                        <a href="{{ route('superadmin.hotels.edit', $hotel) }}" 
                           class="btn btn-dark btn-sm rounded-0 me-2">
                            Editar
                        </a>

                        <form action="{{ route('superadmin.hotels.destroy', $hotel) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este hotel?')">
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
@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Editar Hotel</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Imagen actual --}}
    @if($hotel->image)
        <div class="mb-3">
            <label>Imagen actual</label><br>
            <img src="{{ asset('storage/'.$hotel->image) }}"
                 class="img-fluid rounded"
                 style="max-width: 250px;">
        </div>
    @endif

    <form action="{{ route('superadmin.hotels.update', $hotel) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input class="form-control mb-2" name="name" value="{{ $hotel->name }}">
        <input class="form-control mb-2" name="address" value="{{ $hotel->address }}">
        <input class="form-control mb-2" name="telefono" value="{{ $hotel->telefono }}">
        <input class="form-control mb-2" name="email" value="{{ $hotel->email }}">

        <div class="mb-3">
            <label>Nueva imagen (opcional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('superadmin.hotels.index') }}" class="btn btn-secondary">
            Volver
        </a>
    </form>
</div>
@endsection
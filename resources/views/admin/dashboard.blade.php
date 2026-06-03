@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-4">Panel Admin Hotel</h1>

    <p class="text-gray-600 mb-6">
        Bienvenido {{ auth()->user()->name }}
        <span class="text-sm text-gray-400">
            ({{ auth()->user()->email }})
        </span>
    </p>

    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-2">🏨 Mi Hotel</h2>

        <p><strong>Nombre:</strong> {{ $hotel->name }}</p>
        <p><strong>Dirección:</strong> {{ $hotel->address }}</p>
        <p><strong>Teléfono:</strong> {{ $hotel->telefono }}</p>
        <p><strong>Email:</strong> {{ $hotel->email }}</p>
    </div>

    <div class="flex gap-4">
        <a href="{{ route('admin.rooms.index') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Habitaciones
        </a>

        <a href="{{ route('admin.reservations.index') }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Reservas
        </a>
    </div>

</div>
@endsection
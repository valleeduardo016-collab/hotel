@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-uppercase">Gestión de Reservas</h2>

    <table class="table table-hover border">
        <thead class="table-dark">
            <tr>
                <th>Usuario</th>
                <th>Habitación</th>
                <th>Fechas</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
            <tr class="align-middle">
                <td>{{ $r->user->name }}</td>
                <td>{{ $r->room->type }}</td>
                <td>{{ $r->check_in }} → {{ $r->check_out }}</td>
                <td>
                    <span class="badge {{ $r->status === 'pending' ? 'bg-warning text-dark' : 'bg-success' }} rounded-0">
                        {{ ucfirst($r->status) }}
                    </span>
                </td>
                <td>
                    @if($r->status === 'pending')
                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('admin.reservations.approve', $r) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-dark btn-sm rounded-0">Aprobar</button>
                            </form>
                            <form method="POST" action="{{ route('admin.reservations.reject', $r) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-outline-dark btn-sm rounded-0">Rechazar</button>
                            </form>
                        </div>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
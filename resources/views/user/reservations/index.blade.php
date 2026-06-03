@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-uppercase">Mis Reservas</h2>

    <div class="table-responsive">
        <table class="table table-hover border">
            <thead class="table-dark">
                <tr>
                    <th>Hotel</th>
                    <th>Habitación</th>
                    <th>Fechas</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $r)
                <tr class="align-middle">
                    <td>{{ $r->room->hotel->name }}</td>
                    <td>{{ $r->room->type }}</td>
                    <td>{{ $r->check_in }} → {{ $r->check_out }}</td>
                    <td>${{ number_format($r->total_price, 2) }}</td>
                    <td>
                        @if($r->status === 'pending')
                            <span class="badge bg-warning text-dark rounded-0">
                                ⏳ En espera
                            </span>
                        @elseif($r->status === 'approved' || $r->status === 'activa')
                            <span class="badge bg-success rounded-0">
                                ✅ Aprobada
                            </span>
                        @elseif($r->status === 'cancelada')
                            <span class="badge bg-secondary rounded-0">
                                🚫 Cancelada
                            </span>
                        @else
                            <span class="badge bg-danger rounded-0">
                                ❌ {{ ucfirst($r->status) }}
                            </span>
                        @endif
                    </td>
                    <td>
                        {{-- Solo permitimos cancelar si no ha sido cancelada ya --}}
                        @if($r->status !== 'cancelada')
                            <form method="POST" 
                                  action="{{ route('reservations.cancel', $r) }}"
                                  onsubmit="return confirm('¿Seguro que deseas cancelar esta reserva?')">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-dark btn-sm rounded-0">
                                    Cancelar
                                </button>
                            </form>
                        @else
                            <span class="text-muted small">N/A</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
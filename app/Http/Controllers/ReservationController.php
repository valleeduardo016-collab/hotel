<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Listar reservas (Para Clientes)
    public function index()
    {
        $reservations = auth()->user()
            ->reservations()
            ->with('room.hotel')
            ->get();

        return view('user.reservations.index', compact('reservations'));
    }

    // LISTAR RESERVAS (Para Admin del Hotel)
    public function adminIndex()
    {
        $hotel = auth()->user()->hotel;

        if (!$hotel) {
            abort(403, 'No tienes un hotel asignado.');
        }

        $reservations = Reservation::whereHas('room', function ($q) use ($hotel) {
            $q->where('hotel_id', $hotel->id);
        })->with('user', 'room')->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create(Room $room)
    {
        return view('user.reservations.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        // VALIDAR DISPONIBILIDAD DE LA HABITACIÓN
        $exists = Reservation::where('room_id', $room->id)
            ->whereNotIn('status', ['cancelada', 'rechazada'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('check_in', '<=', $request->check_in)
                            ->where('check_out', '>=', $request->check_out);
                      });
            })
            ->exists();

        if ($exists) {
            return back()->with('error', 'La habitación no está disponible en esas fechas');
        }

        $days = Carbon::parse($request->check_in)->diffInDays($request->check_out);

        Reservation::create([
            'user_id'     => auth()->id(),
            'room_id'     => $room->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'total_price' => $days * $room->price,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reserva solicitada correctamente. Queda en espera de aprobación.');
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if ($reservation->status === 'cancelada') {
            return back()->with('error', 'Esta reserva ya fue cancelada anteriormente.');
        }

        $reservation->update([
            'status' => 'cancelada'
        ]);

        return back()->with('success', 'Reserva cancelada correctamente');
    }

    // ✅ NUEVO: APROBAR RESERVA
    public function approve(Reservation $reservation)
    {
        $reservation->update(['status' => 'approved']);
        return back()->with('success', 'Reserva aprobada');
    }

    // ✅ NUEVO: RECHAZAR RESERVA
    public function reject(Reservation $reservation)
    {
        $reservation->update(['status' => 'rejected']);
        return back()->with('success', 'Reserva rechazada');
    }
}
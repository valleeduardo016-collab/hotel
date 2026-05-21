<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   // Listar reservas
    
    public function index()
    {
        $reservations = auth()->user()
            ->reservations()
            ->with('room.hotel')
            ->get();

        return view('user.reservations.index', compact('reservations'));
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
            ->where('status', '!=', 'cancelada')
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

        //  Calcular días
        $days = \Carbon\Carbon::parse($request->check_in)
            ->diffInDays($request->check_out);

        // Crear reserva
        Reservation::create([
            'user_id'     => auth()->id(),
            'room_id'     => $room->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'total_price' => $days * $room->price,
            'status'      => 'activa',
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reserva creada correctamente');
    }
    public function cancel(Reservation $reservation)
{
    // Solo el dueño puede cancelar
    if ($reservation->user_id !== auth()->id()) {
        abort(403);
    }

    // Solo si está activa
    if ($reservation->status !== 'activa') {
        return back()->with('error', 'Esta reserva ya no se puede cancelar');
    }

    $reservation->update([
        'status' => 'cancelada'
    ]);

    return back()->with('success', 'Reserva cancelada correctamente');
}
}
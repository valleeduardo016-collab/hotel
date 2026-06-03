<?php

namespace App\Http\Controllers\AdminHotel;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $hotel = auth()->user()->hotel;

        if (!$hotel) {
            abort(403, 'No tienes hotel asignado');
        }

        $rooms = $hotel->rooms;

        return view('admin.rooms.index', compact('rooms', 'hotel'));
    }

    public function create()
    {
        $hotel = auth()->user()->hotel;

        if (!$hotel) {
            abort(403, 'No tienes hotel asignado');
        }

        return view('admin.rooms.create', compact('hotel'));
    }

    public function store(Request $request)
    {
        $hotel = auth()->user()->hotel;

        if (!$hotel) {
            abort(403, 'No tienes hotel asignado');
        }

        $request->validate([
            'type'      => 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
            'available' => 'required|boolean',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'hotel_id'  => $hotel->id,
            'type'      => $request->type,
            'price'     => $request->price,
            'available' => $request->available,
        ];

        // ✅ GUARDAR IMAGEN CORRECTAMENTE
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Habitación creada correctamente');
    }

    public function edit(Room $room)
    {
        if ($room->hotel_id !== auth()->user()->hotel->id) {
            abort(403);
        }

        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        if ($room->hotel_id !== auth()->user()->hotel->id) {
            abort(403);
        }

        $data = $request->validate([
            'type'      => 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
            'available' => 'required|boolean',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }

            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Habitación actualizada');
    }

    public function destroy(Room $room)
    {
        if ($room->hotel_id !== auth()->user()->hotel->id) {
            abort(403);
        }

        if ($room->image && Storage::disk('public')->exists($room->image)) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Habitación eliminada');
    }
}
<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR HOTELES
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $hotels = Hotel::with('admin')->get();

        return view('superadmin.hotels.index', compact('hotels'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO CREAR HOTEL
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        // Solo admins de hotel
        $admins = User::where('role', 'admin_hotel')->get();

        return view('superadmin.hotels.create', compact('admins'));
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR HOTEL
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'required|string|max:255',
            'telefono'  => 'nullable|string|max:50',
            'email'     => 'nullable|email',
            'admin_id'  => 'required|exists:users,id',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Guardar imagen si existe
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create($data);

        return redirect()
            ->route('superadmin.hotels.index')
            ->with('success', 'Hotel creado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULARIO EDITAR HOTEL
    |--------------------------------------------------------------------------
    */
    public function edit(Hotel $hotel)
    {
        $admins = User::where('role', 'admin_hotel')->get();

        return view('superadmin.hotels.edit', compact('hotel', 'admins'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR HOTEL
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'required|string|max:255',
            'telefono'  => 'nullable|string|max:50',
            'email'     => 'nullable|email',
            'admin_id'  => 'required|exists:users,id',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Reemplazar imagen si se sube otra
        if ($request->hasFile('image')) {

            if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
                Storage::disk('public')->delete($hotel->image);
            }

            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($data);

        return redirect()
            ->route('superadmin.hotels.index')
            ->with('success', 'Hotel actualizado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR HOTEL
    |--------------------------------------------------------------------------
    */
    public function destroy(Hotel $hotel)
    {
        if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
            Storage::disk('public')->delete($hotel->image);
        }

        $hotel->delete();

        return redirect()
            ->route('superadmin.hotels.index')
            ->with('success', 'Hotel eliminado');
    }
}
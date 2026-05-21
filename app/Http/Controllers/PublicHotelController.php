<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

class PublicHotelController extends Controller
{
    // Página principal: lista de hoteles
    public function index()
    {
        $hotels = Hotel::with('rooms')->get();
        return view('public.hotels.index', compact('hotels'));
    }

    // Vista pública de un hotel
    public function show(Hotel $hotel)
    {
        $hotel->load('rooms');
        return view('public.hotels.show', compact('hotel'));
    }
}
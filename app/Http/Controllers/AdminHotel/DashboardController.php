<?php

namespace App\Http\Controllers\AdminHotel;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
{
    $hotel = auth()->user()->hotel;

    if (!$hotel) {
        abort(403, 'No tienes hotel asignado');
    }

    return view('admin.dashboard', compact('hotel'));
}
}
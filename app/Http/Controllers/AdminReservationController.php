<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'room'])->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }
}

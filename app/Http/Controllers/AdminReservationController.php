<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;



class AdminReservationController extends Controller
{
    
    public function index()
    {
        $reservations = Reservation::with(['user', 'room'])->latest()->get();
        return view('admin.reservation.index', compact('reservations'));
    }
    public function profile()
    {
        return view('admin.index');
    }

}

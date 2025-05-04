<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        $roomId = $request->room_id;
        $room = Room::findOrFail($roomId);
        return view('reservations.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $exists = Reservation::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($query2) use ($request) {
                          $query2->where('check_in', '<=', $request->check_in)
                                 ->where('check_out', '>=', $request->check_out);
                      });
            })->exists();

        if ($exists) {
            return back()->withErrors(['room_id' => 'Kamar sudah dipesan pada tanggal tersebut.']);
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dilakukan.');
    }

    public function edit(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);
        $rooms = Room::where('is_available', true)->get();
        return view('reservations.edit', compact('reservation', 'room'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorizeReservation($reservation);

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $exists = Reservation::where('room_id', $request->room_id)
            ->where('id', '!=', $reservation->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($query2) use ($request) {
                          $query2->where('check_in', '<=', $request->check_in)
                                 ->where('check_out', '>=', $request->check_out);
                      });
            })->exists();

        if ($exists) {
            return back()->withErrors(['room_id' => 'Kamar sudah dipesan pada tanggal tersebut.']);
        }

        $reservation->update([
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dibatalkan.');
    }

    private function authorizeReservation($reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }
    }
}

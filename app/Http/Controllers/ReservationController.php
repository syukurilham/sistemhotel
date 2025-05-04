<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservationHistory;
use App\Models\User;

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
            'status' => 'aktif', // tambahkan ini
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dilakukan.');
    }

    public function edit(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);
        $rooms = Room::where('is_available', true)->get();
        return view('reservations.edit', compact('reservation', 'rooms'));
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

    public function checkout($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        // Hanya admin yang bisa melakukan check-out
        if (auth()->user()->is_admin) {
            // Pindahkan reservasi ke riwayat (misalnya menambahkan ke kolom riwayat di database, atau menandainya)
            $reservation->update([
                'status' => 'checked_out',  // Pastikan ada kolom status atau flag lainnya
                'checked_out_at' => now(),  // Tambahkan timestamp ketika check-out
            ]);

            // Simpan data ke riwayat pengguna (bisa dilakukan dengan relasi atau menyimpan di tabel terpisah)
            $reservation->user->reservationsHistory()->save($reservation);  // Pastikan ada relasi reservationsHistory() di User model

            // Hapus dari daftar reservasi aktif
            $reservation->delete();

            return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil di-checkout.');
        }

        return abort(403, 'Akses ditolak');
    }

    
}

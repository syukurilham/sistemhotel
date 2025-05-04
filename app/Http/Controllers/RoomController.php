<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Room::query();
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $query->where('is_available', true); // Jangan ditaruh langsung di $rooms

        $rooms = $query->latest()->get(); // Tambahkan sort juga jika perlu

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'room_number' => 'required|string|max:10|unique:rooms,room_number',
        'type' => 'required|string',
        'price' => 'required|numeric',
        'is_available' => 'required|boolean',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('room_images', 'public');
    }

    \App\Models\Room::create([
        'room_number' => $request->room_number,
        'type' => $request->type,
        'price' => $request->price,
        'is_available' => $request->is_available,
        'description' => $request->description,
        'image_url' => $imagePath ? '/storage/' . $imagePath : null,
    ]);

    return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id); // tambahkan ini

        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'type' => 'required|in:Standard,Deluxe,Suite',
            'price' => 'required|integer',
        ]);

        $room->update([
            'room_number' => $request->room_number,
            'type' => ucfirst(strtolower($request->type)),
            'price' => $request->price,
            'is_available' => $request->has('is_available') ? $request->is_available : $room->is_available,
        ]);
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }
}

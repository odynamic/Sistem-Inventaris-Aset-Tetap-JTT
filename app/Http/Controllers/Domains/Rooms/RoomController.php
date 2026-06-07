<?php

namespace App\Http\Controllers\Domains\Rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Rooms\Room;
use App\Domains\Units\Unit;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $unit_id  = $request->input('unit_id');

        $query = Room::with('unit')->orderBy('id', 'desc');

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($unit_id) {
            $query->where('unit_id', $unit_id);
        }

        return view('admin.rooms.index', [
            'rooms'   => $query->paginate(10)->withQueryString(),
            'units'   => Unit::all(),
            'unit_id' => $unit_id,
            'search'  => $search
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'name'    => 'required'
        ]);

        Room::create([
            'unit_id' => $request->unit_id,
            'name'    => $request->name
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'unit_id' => 'required',
            'name'    => 'required'
        ]);

        $room->update([
            'unit_id' => $request->unit_id,
            'name'    => $request->name
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->assets()->count() > 0) {
            return redirect()->route('admin.rooms.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena masih memiliki aset.');
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}

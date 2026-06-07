<?php

namespace App\Http\Controllers\Domains\Assets;

use App\Http\Controllers\Controller;
use App\Domains\Assets\Asset;
use App\Domains\Rooms\Room;
use App\Domains\Units\Unit;
use Illuminate\Http\Request;
use App\Traits\RecordsActivity;

class AssetController extends Controller
{

    use RecordsActivity;
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $unit_id  = $request->input('unit_id');
        $room_id  = $request->input('room_id');

        $query = Asset::with('room.unit')->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%");
            });
        }

        if ($unit_id) {
            $query->whereHas('room.unit', fn($q) => $q->where('id', $unit_id));
        }

        if ($room_id) {
            $query->where('room_id', $room_id);
        }

        return view('admin.assets.index', [
            'assets'  => $query->paginate(10)->withQueryString(),
            'units'   => Unit::all(),
            'rooms'   => Room::all(),
            'search'  => $search,
            'unit_id' => $unit_id,
            'room_id' => $room_id
        ]);
    }


    public function create()
    {
        $units = Unit::all();

        // Rooms: isi ruangan dari unit pertama (jika ada)
        $rooms = collect();
        if ($units->isNotEmpty()) {
            $rooms = Room::where('unit_id', $units->first()->id)->get();
        }

        $this->recordActivity(
    action: 'Menambahkan Aset',
    module: 'Aset',
    description: 'Admin menambahkan aset baru'
);


        return view('admin.assets.create', [
            'units' => $units,
            'rooms' => $rooms
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'unit_id'        => 'required|exists:units,id',
            'room_id'        => 'required|exists:rooms,id',
            'name'           => 'required',
            'quantity'       => 'required|numeric',
            'unit'           => 'required',
            'condition'      => 'required',
            'acquired_year'  => 'required|numeric',
        ]);

        $unit = Unit::findOrFail($request->unit_id);
        $room = Room::findOrFail($request->room_id);

        $roomName = preg_replace('/^Ruang\s+/i', '', $room->name);
        $parts = explode(' ', trim($roomName));
        $short = strtoupper(substr($parts[0], 0, 2));

        $last = Asset::where('unit_id', $unit->id)
            ->where('room_id', $room->id)
            ->orderBy('id', 'DESC')
            ->first();

        $next = 1;
        if ($last && preg_match('/(\d{3})$/', $last->code, $match)) {
            $next = intval($match[1]) + 1;
        }

        $running = str_pad($next, 3, '0', STR_PAD_LEFT);
        $finalCode = "{$unit->name}-{$short}-{$running}";

        Asset::create([
            'unit_id'        => $unit->id,
            'room_id'        => $room->id,
            'code'           => $finalCode,
            'name'           => $request->name,
            'quantity'       => $request->quantity,
            'unit'           => $request->unit,
            'condition'      => $request->condition,
            'acquired_year'  => $request->acquired_year,
        ]);

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }


    public function edit(Asset $asset)
    {

         $this->recordActivity(
    action: 'Memperbarui Aset',
    module: 'Aset',
    description: 'Admin memperbarui aset'
);
        return view('admin.assets.edit', [
            'asset' => $asset,
            'units' => Unit::all(),
            'rooms' => Room::where('unit_id', $asset->unit_id)->get()
        ]);
    }


    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'unit_id'        => 'required',
            'room_id'        => 'required',
            'name'           => 'required',
            'quantity'       => 'required|numeric',
            'unit'           => 'required',
            'condition'      => 'required',
            'acquired_year'  => 'required|numeric',
        ]);

        $asset->update([
            'unit_id'        => $request->unit_id,
            'room_id'        => $request->room_id,
            'name'           => $request->name,
            'quantity'       => $request->quantity,
            'unit'           => $request->unit,
            'condition'      => $request->condition,
            'acquired_year'  => $request->acquired_year,
        ]);

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil diperbarui.');
    }


    public function destroy(Asset $asset)
    {
        $asset->delete();

         $this->recordActivity(
    action: 'Menghapus Aset',
    module: 'Aset',
    description: 'Admin menghapus aset'
);
        return back()->with('success', 'Aset berhasil dihapus.');
    }


    public function getRooms($unit_id)
    {
        return response()->json(Room::where('unit_id', $unit_id)->get());
    }


    public function getNextCode($unit_id, $room_id)
    {
        $last = Asset::where('unit_id', $unit_id)
            ->where('room_id', $room_id)
            ->orderBy('id', 'DESC')
            ->first();

        $next = 1;

        if ($last && preg_match('/(\d{3})$/', $last->code, $m)) {
            $next = intval($m[1]) + 1;
        }

        return response()->json([
            'next_code' => str_pad($next, 3, '0', STR_PAD_LEFT)
        ]);
    }
}

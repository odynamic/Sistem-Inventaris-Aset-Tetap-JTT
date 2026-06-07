<?php

namespace App\Http\Controllers\Domains\Assets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Assets\Asset;
use App\Domains\Rooms\Room;

class UserAssetController extends Controller
{
    /**
     * User — melihat daftar aset pada unit kerjanya sendiri.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $unitId = $user->unit_id;

        if (!$unitId) {
            return back()->with('danger', 'Unit kerja pengguna belum diatur.');
        }

        // FILTERS
        $search     = $request->search;
        $roomId     = $request->room_id;
        $condition  = $request->condition;

        $query = Asset::with(['room'])
            ->where('unit_id', $unitId)
            ->orderBy('name');

        if ($roomId) {
            $query->where('room_id', $roomId);
        }

        if ($condition) {
            $query->where('condition', $condition);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%");
            });
        }

        $assets = $query->paginate(12)->withQueryString();
        $rooms  = Room::where('unit_id', $unitId)->get();

        return view('user.assets.index', [
            'assets'    => $assets,
            'rooms'     => $rooms,
            'search'    => $search,
            'room_id'   => $roomId,
            'condition' => $condition,
        ]);
    }
}

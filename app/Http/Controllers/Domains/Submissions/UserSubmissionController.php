<?php

namespace App\Http\Controllers\Domains\Submissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Submissions\Submission;
use App\Domains\Assets\Asset;
use App\Domains\Rooms\Room;
use App\Traits\RecordsActivity;

class UserSubmissionController extends Controller
{
    use RecordsActivity;

    public function index(Request $req)
    {
        $rooms = Room::where('unit_id', Auth::user()->unit_id)
            ->orderBy('name')
            ->get();

        $query = Submission::where('user_id', Auth::id());

        if ($req->status) $query->where('status', $req->status);
        if ($req->type) $query->where('type', $req->type);
        if ($req->room_id) $query->where('room_id', $req->room_id);

        $submissions = $query->latest()->paginate(15);

        return view('user.submissions.index', compact('submissions', 'rooms'));
    }

    public function create()
    {
        $rooms = Room::where('unit_id', Auth::user()->unit_id)
            ->orderBy('name')->get();

        return view('user.submissions.create', compact('rooms'));
    }

    public function show($id)
    {
        $sub = Submission::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.submissions.show', compact('sub'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'type' => 'required|in:penambahan,perubahan,penghapusan',
        ]);

        $photo = $req->hasFile('photo')
            ? $req->file('photo')->store('submissions', 'public')
            : null;

        $data = [
            'user_id' => Auth::id(),
            'type' => $req->type,
            'status' => 'pending',
            'photo' => $photo,
        ];

        /* ========== TIPE PENAMBAHAN ========== */
        if ($req->type === 'penambahan') {
            $req->validate([
                'add_room_id' => 'required|exists:rooms,id', 
                'add_name' => 'required|string',
                'add_quantity' => 'required|integer|min:1',
                'add_unit' => 'nullable|string',
                'add_condition' => 'nullable|string',
                'add_acquired_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            ]);

            $data += [
                // 🔥 PERBAIKAN FINAL: Memastikan add_unit_id dan add_room_id terisi dari Request/Auth
                'add_unit_id' => Auth::user()->unit_id, 
                'add_room_id' => $req->add_room_id, 
                'add_name' => $req->add_name,
                'add_quantity' => $req->add_quantity,
                'add_unit' => $req->add_unit,
                'add_condition' => $req->add_condition ?: 'Baik',
                'add_acquired_year' => $req->add_acquired_year,
            ];
        }

        /* ========== TIPE PERUBAHAN ========== */
        if ($req->type === 'perubahan') {
            $req->validate([
                'room_id' => 'required|exists:rooms,id',
                'asset_id' => 'required|exists:assets,id',
                'new_quantity' => 'nullable|integer|min:0',
                'new_condition' => 'nullable|string',
                'description' => 'required',
            ]);

            $asset = Asset::findOrFail($req->asset_id);

            $data += [
                'room_id' => $req->room_id,
                'asset_id' => $req->asset_id,
                'new_quantity' => $req->new_quantity,
                'new_condition' => $req->new_condition,
                'old_quantity' => $asset->quantity,
                'old_condition' => $asset->condition,
                'description' => $req->description,
            ];
        }

        /* ========== TIPE PENGHAPUSAN ========== */
        if ($req->type === 'penghapusan') {
            $req->validate([
                'room_id' => 'required|exists:rooms,id',
                'asset_id' => 'required|exists:assets,id',
                'description' => 'required|string',
            ]);

            $asset = Asset::findOrFail($req->asset_id);

            $data += [
                'room_id' => $req->room_id,
                'asset_id' => $req->asset_id,
                'old_quantity' => $asset->quantity,
                'old_condition' => $asset->condition,
                'description' => $req->description,
            ];
        }

        // 🔥 SAVE SUBMISSION
        $submission = Submission::create($data);

        // 🔥 RECORD ACTIVITY
        $this->recordActivity(
            'Mengirim Pengajuan',
            'Pengajuan',
            'Pengajuan dengan ID ' . $submission->id . ' berhasil dikirim.'
        );

        // 🔥 REDIRECT
        return redirect()->route('user.submissions.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function cancel($id)
{
    // 1. Ambil pengajuan berdasarkan ID dan pastikan milik user yang login
    $submission = Submission::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // 2. Cek status: Hanya yang 'pending' yang boleh dibatalkan
    if ($submission->status !== 'pending') {
        return redirect()->back()->with('error', 'Pengajuan hanya dapat dibatalkan jika statusnya masih Menunggu Persetujuan (Pending).');
    }

    // 3. Update status menjadi 'cancelled' (atau 'dibatalkan')
    $submission->update([
        'status' => 'cancelled', 
        // Anda bisa menambahkan kolom lain seperti 'cancelled_at' jika ada di model/DB
    ]);

    // 4. Catat Aktivitas
    $this->recordActivity(
        'Membatalkan Pengajuan',
        'Pengajuan',
        'Pengajuan dengan ID ' . $submission->id . ' berhasil dibatalkan oleh user.'
    );

    // 5. Redirect
    return redirect()->route('user.submissions.index')
        ->with('success', 'Pengajuan berhasil dibatalkan.');
}

    public function getUserRooms()
    {
        return Room::where('unit_id', Auth::user()->unit_id)
            ->orderBy('name')->get();
    }

    public function getAssets($room_id)
    {
        return Asset::where('room_id', $room_id)
            ->orderBy('name')->get();
    }

    public function getAssetDetail($id)
    {
        return Asset::select('id', 'name', 'quantity', 'condition')->find($id);
    }
}
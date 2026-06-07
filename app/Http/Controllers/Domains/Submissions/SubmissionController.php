<?php

namespace App\Http\Controllers\Domains\Submissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Domains\Submissions\Submission;
use App\Domains\Assets\Asset; 
use App\Domains\Units\Unit;
use App\Domains\Rooms\Room;
use App\Traits\RecordsActivity;

class SubmissionController extends Controller
{
    use RecordsActivity;
    
    /** ===============================
     * ADMIN: LIST + FILTER + SEARCH
     *================================*/
    public function index(Request $req)
    {
        $units = Unit::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();

        $query = Submission::with(['user', 'room', 'addRoom']); 

        if ($req->status) {
            $query->where('status', $req->status);
        }

        if ($req->type) {
            $query->where('type', $req->type);
        }

        if ($req->unit_id) {
            $query->where(function ($q) use ($req) {
                $q->whereHas('addRoom', fn($r) => $r->where('unit_id', $req->unit_id))
                  ->orWhereHas('room', fn($r) => $r->where('unit_id', $req->unit_id));
            });
        }

        if ($req->room_id) {
            $query->where(function ($q) use ($req) {
                $q->where('room_id', $req->room_id)
                  ->orWhere('add_room_id', $req->room_id);
            });
        }

        if ($req->search) {
            $s = $req->search;
            $query->where(function ($q) use ($s) {
                $q->where('description', 'like', "%$s%")
                  ->orWhere('add_name', 'like', "%$s%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%$s%"))
                  ->orWhereHas('asset', fn($a) => $a->withTrashed()->where('name', 'like', "%$s%"));
            });
        }

        $submissions = $query->latest()->paginate(20)->appends($req->query());

        return view('admin.submissions.index', compact('submissions', 'units', 'rooms'));
    }

    /** ===============================
     * ADMIN: DETAIL
     *================================*/
    public function show($id)
    {
        $sub = Submission::with(['user', 'room', 'addRoom'])
            ->findOrFail($id);

        return view('admin.submissions.show', compact('sub'));
    }

    /** ======================================
     * ADMIN: VERIFIKASI (LOGIKA APPROVE/REJECT)
     *======================================*/
    public function verify(Request $req, $id)
    {
        $req->validate([
            'action' => 'required|in:approve,reject',
            'admin_note' => 'nullable|string',
        ]);

        if ($req->action === 'reject' && empty($req->admin_note)) {
            return back()->withErrors(['admin_note' => 'Catatan admin wajib diisi saat menolak pengajuan.']);
        }

        $sub = Submission::findOrFail($id);

        if ($sub->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses.');
        }

        DB::transaction(function () use ($req, $sub, $id) {

            if ($req->action === 'reject') {
                $sub->update([
                    'status' => 'rejected',
                    'admin_note' => $req->admin_note
                ]);
                return; 
            }

            // --- APPROVE LOGIC ---
            if ($sub->type === 'penambahan') {
                if (empty($sub->add_room_id)) {
                    throw new \Exception("Gagal: Ruangan Penambahan tidak ditentukan.");
                }

                $room = Room::findOrFail($sub->add_room_id); 
                $final_unit_id = $room->unit_id; 
                if (empty($final_unit_id)) {
                    throw new \Exception("Gagal: Unit ID tidak dapat ditentukan. Pastikan Ruangan memiliki Unit yang valid.");
                }

                $assetCode = strtoupper('A-' . uniqid()); 
                
                $newAsset = Asset::create([
                    'unit_id'       => $final_unit_id,
                    'room_id'       => $sub->add_room_id,
                    'code'          => $assetCode, 
                    'name'          => $sub->add_name,
                    'quantity'      => $sub->add_quantity,
                    'unit'          => $sub->add_unit,
                    'condition'     => $sub->add_condition ?? 'Baik',
                    'acquired_year' => $sub->add_acquired_year,
                ]);
                
                $sub->asset_id = $newAsset->id;

            } elseif ($sub->type === 'perubahan') {

                $asset = Asset::findOrFail($sub->asset_id);
                
                $updateData = [
                    'quantity'  => $sub->new_quantity ?? $asset->quantity,
                    'condition' => $sub->new_condition ?? $asset->condition,
                ];

                if ($sub->room_id) { 
                    $room = Room::findOrFail($sub->room_id);
                    $updateData['room_id'] = $sub->room_id;
                    $updateData['unit_id'] = $room->unit_id;
                }
                
                if ($sub->new_name) { 
                    $updateData['name'] = $sub->new_name;
                }
                
                $asset->update($updateData);

            } elseif ($sub->type === 'penghapusan') {
                optional(Asset::find($sub->asset_id))->delete();
            }
            
            // UPDATE STATUS FINAL
            $sub->update([
                'status' => 'approved',
                'admin_note' => $req->admin_note
            ]);

            // CATAT AKTIVITAS
            $this->recordActivity(
                action: 'Memverifikasi Pengajuan',
                module: 'Pengajuan',
                description: "Admin menyetujui pengajuan ID $id (Tipe: $sub->type)"
            );
        });

        return redirect()
            ->route('admin.submissions.index')
            ->with('success', 'Pengajuan berhasil diverifikasi.');
    }
}

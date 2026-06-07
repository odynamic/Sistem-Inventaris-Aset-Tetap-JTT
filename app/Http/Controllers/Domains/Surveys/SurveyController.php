<?php

namespace App\Http\Controllers\Domains\Surveys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Surveys\Survey;
use App\Domains\Surveys\SurveyItem;
use App\Domains\Assets\Asset;
use App\Domains\Units\Unit;
use App\Domains\Rooms\Room;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Traits\RecordsActivity;

class SurveyController extends Controller
{
    use RecordsActivity;

    // =========================================================
    // INDEX — auto expired + filter
    // =========================================================
    public function index(Request $request)
    {
        // Auto expired
        Survey::whereIn('status', ['dijadwalkan', 'menunggu_validasi'])
            ->whereDate('scheduled_date', '<', today())
            ->update(['status' => 'expired']);

        $query = Survey::with(['unit', 'room']);

        if ($request->filled('unit_id'))       $query->where('unit_id', $request->unit_id);
        if ($request->filled('room_id'))       $query->where('room_id', $request->room_id);
        if ($request->filled('survey_method')) $query->where('survey_method', $request->survey_method);
        if ($request->filled('status'))        $query->where('status', $request->status);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('unit', fn($x) => $x->where('full_name', 'like', "%$search%"))
                  ->orWhereHas('room', fn($x) => $x->where('name', 'like', "%$search%"));
            });
        }

        $surveys = $query->latest()->paginate(10)->withQueryString();

        return view('admin.surveys.index', [
            'surveys' => $surveys,
            'units'   => Unit::all(),
            'rooms'   => Room::all()
        ]);
    }

    // =========================================================
    // CREATE
    // =========================================================
    public function create()
    {
        return view('admin.surveys.create', [
            'units' => Unit::all(),
            'rooms' => [] // diisi via AJAX setelah pilih unit
        ]);
    }

// =========================================================
// STORE (Auto-generate survey items)
// =========================================================
public function store(Request $request)
{
    $validated = $request->validate([
        'unit_id'        => 'required|exists:units,id',
        'room_id'        => 'required|exists:rooms,id',
        'scheduled_date' => 'required|date',
        'survey_method'  => 'required|in:admin,user',
    ]);

    $survey = Survey::create([
        'unit_id'        => $validated['unit_id'],
        'room_id'        => $validated['room_id'],
        'scheduled_date' => $validated['scheduled_date'],
        'survey_method'  => $validated['survey_method'],
        'status'         => 'dijadwalkan',
    ]);

    // Generate survey items: coba ambil asset berdasarkan room_id terlebih dahulu
    $assets = Asset::where('room_id', $validated['room_id'])->get();

    // fallback: kalau tidak ada asset untuk room tersebut,
    // ambil asset berdasarkan unit (jika aset di DB hanya punya unit_id)
    if ($assets->count() == 0) {
        $assets = Asset::where('unit_id', $validated['unit_id'])->get();
    }

    // jika masih kosong, biarkan (tidak crash), tapi ini menandakan data asset perlu dicek
    foreach ($assets as $asset) {
        SurveyItem::create([
            'survey_id' => $survey->id,
            'asset_id'  => $asset->id,
            'condition' => null,
            'existence' => null,
            'notes'     => null,
            'photo'     => null,
        ]);
    }

    $this->recordActivity(
        action: 'Membuat Jadwal Survei',
        module: 'Survei',
        description: "Admin membuat survei untuk unit {$validated['unit_id']}"
    );

    return redirect()->route('admin.surveys.index')
        ->with('success','Jadwal survey berhasil dibuat.');
}

    // =========================================================
    // SHOW
    // =========================================================
    public function show(Survey $survey)
    {
        if (now()->gt(Carbon::parse($survey->scheduled_date)) &&
            $survey->status !== 'expired') {
            $survey->update(['status' => 'expired']);
        }

        $survey->load(['unit', 'room', 'items.asset', 'performer']);

        return view('admin.surveys.show', compact('survey'));
    }

    // =========================================================
    // EDIT
    // =========================================================
    public function edit(Survey $survey)
    {
        return view('admin.surveys.create', [
            'survey' => $survey,
            'units'  => Unit::all(),
            'rooms'  => Room::where('unit_id', $survey->unit_id)->get(),
        ]);
    }

    // =========================================================
    // UPDATE
    // =========================================================
    public function update(Request $request, Survey $survey)
    {
        $validated = $request->validate([
            'scheduled_date' => 'required|date',
            'survey_method'  => 'required|in:admin,user',
        ]);

        $survey->update($validated);

        return redirect()->route('admin.surveys.index')
            ->with('success', 'Jadwal survey diperbarui.');
    }

    // =========================================================
    // DELETE
    // =========================================================
    public function destroy(Survey $survey)
    {
        $survey->delete();

        return back()->with('success', 'Survey berhasil dihapus.');
    }

// =========================================================
// ADMIN FILL FORM
// =========================================================
public function fillForm(Survey $survey)
{
    // Auto-expire check
    if (now()->gt(Carbon::parse($survey->scheduled_date))) {
        $survey->update(['status'=>'expired']);
    }

    if ($survey->status === 'expired') {
        return redirect()->route('admin.surveys.show',$survey)
            ->with('danger','Survey sudah kedaluwarsa.');
    }

    if ($survey->survey_method !== 'admin') abort(403);

    // Jika items belum ada (survey lama atau gagal generate), generate otomatis
    if ($survey->items()->count() == 0) {
        // Try by room_id first
        $assets = Asset::where('room_id', $survey->room_id)->get();

        // Fallback by unit_id if none
        if ($assets->count() == 0) {
            $assets = Asset::where('unit_id', $survey->unit_id)->get();
        }

        foreach ($assets as $asset) {
            SurveyItem::create([
                'survey_id' => $survey->id,
                'asset_id'  => $asset->id,
                'condition' => null,
                'existence' => null,
                'notes'     => null,
                'photo'     => null,
            ]);
        }
    }

    // reload relasi supaya blade dapat items.asset
    $survey->load(['items.asset', 'unit', 'room']);

    return view('admin.surveys.fill', compact('survey'));
}

    // =========================================================
    // ADMIN — FILL STORE
    // =========================================================
    public function fillStore(Request $request, Survey $survey)
    {
        if (now()->gt(Carbon::parse($survey->scheduled_date))) {
            $survey->update(['status' => 'expired']);
        }

        if ($survey->status === 'expired') {
            return back()->with('danger', 'Survey sudah kedaluwarsa.');
        }

        foreach ($survey->items as $item) {
            $id = $item->id;

            $item->condition = $request->input("items.$id.condition");
            $item->existence = $request->input("items.$id.existence");
            $item->notes     = $request->input("items.$id.notes");

            // Upload Foto
            if ($request->hasFile("photos.$id")) {
                $path = $request->file("photos.$id")->store('survey_items', 'public');

                if ($item->photo) {
                    Storage::disk('public')->delete($item->photo);
                }

                $item->photo = $path;
            }

            $item->save();
        }

        $survey->update([
            'status'       => 'selesai',
            'performed_by' => auth()->id(),
        ]);

        return redirect()->route('admin.surveys.show', $survey)
            ->with('success', 'Survey selesai.');
    }

    // =========================================================
    // APPROVE — user method only
    // =========================================================
    public function approve(Survey $survey)
    {
        if ($survey->survey_method !== 'user') abort(403);
        if ($survey->status === 'expired')
            return back()->with('danger', 'Survey kedaluwarsa.');

        $survey->update(['status' => 'selesai']);

        $this->recordActivity(
            action: 'Menyetujui Survei',
            module: 'Survei',
            description: "Admin menyetujui survei ID {$survey->id}"
        );

        return back()->with('success', 'Survey disetujui.');
    }

    // =========================================================
    // REJECT — user method only
    // =========================================================
    public function reject(Survey $survey)
    {
        if ($survey->survey_method !== 'user') abort(403);
        if ($survey->status === 'expired')
            return back()->with('danger', 'Survey kedaluwarsa.');

        $survey->update(['status' => 'ditolak']);

        $this->recordActivity(
            action: 'Menolak Survei',
            module: 'Survei',
            description: "Admin menolak survei ID {$survey->id}"
        );

        return back()->with('success', 'Survey ditolak.');
    }
}

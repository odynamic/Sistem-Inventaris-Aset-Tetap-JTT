<?php

namespace App\Http\Controllers\Domains\Surveys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Surveys\Survey;
use App\Domains\Surveys\SurveyItem;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Domains\Rooms\Room;

use App\Traits\RecordsActivity;

class UserSurveyController extends Controller
{

    use RecordsActivity;
    // =========================================================
    // INDEX = SURVEY YANG MASIH AKTIF
    // =========================================================
    public function index(Request $request)
{
    $user = auth()->user();

    // Auto expired
    Survey::where('unit_id', $user->unit_id)
        ->whereIn('status', ['dijadwalkan', 'menunggu_validasi'])
        ->whereDate('scheduled_date', '<', now()->toDateString())
        ->update(['status' => 'expired']);

    // Query survey aktif
    $query = Survey::with(['room'])
        ->where('unit_id', $user->unit_id)
        ->whereIn('status', ['dijadwalkan', 'menunggu_validasi']);

    // Filter ruangan
    if ($request->filled('room_id')) {
        $query->where('room_id', $request->room_id);
    }

    // Filter metode
    if ($request->filled('survey_method')) {
        $query->where('survey_method', $request->survey_method);
    }

    // Filter range tanggal
    if ($request->filled('date_start')) {
        $query->whereDate('scheduled_date', '>=', $request->date_start);
    }
    if ($request->filled('date_end')) {
        $query->whereDate('scheduled_date', '<=', $request->date_end);
    }

    // Filter pencarian nama ruangan
    if ($request->filled('search')) {
        $query->whereHas('room', fn($q) =>
            $q->where('name', 'like', "%{$request->search}%")
        );
    }

    $surveys = $query->latest()->paginate(10)->withQueryString();

    // Ambil semua ruangan user unit untuk dropdown filter
    $rooms = \App\Domains\Rooms\Room::where('unit_id', $user->unit_id)->get();

    return view('user.surveys.index', compact('surveys','rooms'));
}


    // =========================================================
    // HISTORY = SURVEY YANG SUDAH SELESAI / EXPIRED / DITOLAK
    // =========================================================
public function history(Request $request)
{
    $user = auth()->user();

    $query = Survey::with('room')
        ->where('unit_id', $user->unit_id)
        ->whereIn('status', ['selesai', 'ditolak', 'expired']);

    // filter berdasarkan room
    if ($request->filled('room_id')) {
        $query->where('room_id', $request->room_id);
    }

    // filter search nama ruangan
    if ($request->filled('search')) {
        $query->whereHas('room', fn($q) =>
            $q->where('name', 'like', "%{$request->search}%")
        );
    }

    // filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $surveys = $query->latest()->paginate(10)->withQueryString();

    // ambil semua ruangan untuk filter dropdown
    $rooms = Room::all();

    return view('user.surveys.history', compact('surveys', 'rooms'));
}




    // =========================================================
    // SHOW
    // =========================================================
    public function show(Survey $survey)
    {
        $this->authorizeSurvey($survey);

        if (now()->gt(Carbon::parse($survey->scheduled_date))
            && $survey->status !== 'expired')
        {
            $survey->update(['status' => 'expired']);
        }

        $survey->load(['room', 'items.asset', 'performer']);

        return view('user.surveys.show', compact('survey'));
    }



    // =========================================================
    // FILL FORM
    // =========================================================
    public function fillForm(Survey $survey)
    {
        $this->authorizeSurvey($survey);

        if ($survey->survey_method !== 'user') abort(403);

        if ($survey->status !== 'dijadwalkan') {
            return redirect()->route('user.surveys.show', $survey)
                ->with('danger', 'Survey tidak dapat diisi.');
        }

        if (now()->gt(Carbon::parse($survey->scheduled_date))) {
            $survey->update(['status' => 'expired']);
            return redirect()->route('user.surveys.show', $survey)
                ->with('danger', 'Survey kedaluwarsa.');
        }

        $survey->load(['items.asset']);
        return view('user.surveys.fill', compact('survey'));
    }



    // =========================================================
    // FILL STORE
    // =========================================================
    public function fillStore(Request $request, Survey $survey)
    {
        $this->authorizeSurvey($survey);

        if ($survey->survey_method !== 'user') abort(403);
        if ($survey->status !== 'dijadwalkan') {
            return back()->with('danger', 'Survey tidak dapat diisi.');
        }

        if (now()->gt(Carbon::parse($survey->scheduled_date))) {
            $survey->update(['status' => 'expired']);
            return back()->with('danger', 'Survey kedaluwarsa.');
        }

        foreach ($survey->items as $item) {
            $id = $item->id;

            $item->condition = $request->input("items.$id.condition");
            $item->existence = $request->input("items.$id.existence");
            $item->notes     = $request->input("items.$id.notes");

            if ($request->hasFile("photos.$id")) {
                $path = $request->file("photos.$id")
                    ->store('survey_items','public');

                if ($item->photo) Storage::disk('public')->delete($item->photo);
                $item->photo = $path;
            }

            $item->save();
        }

        // After user submits: waiting validation
        $survey->update([
            'status'       => 'menunggu_validasi',
            'performed_by' => auth()->id(),
        ]);

        // Notify admin
        foreach (\App\Models\User::where('role','admin')->get() as $admin) {
            $admin->notify(new \App\Notifications\NewSurveySubmittedNotification($survey));
        }


$this->recordActivity(
    action: 'Mengisi Survei',
    module: 'Survei',
    description: "User mengisi survei ID {$survey->id}"
);


        return redirect()->route('user.surveys.index')
            ->with('success','Survey berhasil dikirim & menunggu validasi admin.');
    }



    // =========================================================
    // AUTHORIZATION
    // =========================================================
    private function authorizeSurvey(Survey $survey)
    {
        if ($survey->unit_id !== auth()->user()->unit_id) {
            abort(403, 'Tidak boleh akses survey unit lain.');
        }
    }
}

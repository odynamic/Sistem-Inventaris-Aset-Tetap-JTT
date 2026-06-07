<?php

namespace App\Http\Controllers\Domains\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// MODELS
use App\Domains\Assets\Asset;
use App\Domains\Surveys\Survey;
use App\Domains\Submissions\Submission;
use App\Domains\Units\Unit;
use App\Domains\Rooms\Room;
use App\Models\User;

// EXPORTS
use App\Exports\AssetsExport;
use App\Exports\SurveysExport;
use App\Exports\SubmissionsExport;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    /* ============================================================
     * 1. LAPORAN ASET
     * ============================================================ */
public function assets(Request $request)
{
    $units = Unit::orderBy('name')->get();

    // Jika pilih unit → rooms otomatis difilter
    $rooms = Room::when(
        $request->unit_id,
        fn($q) => $q->where('unit_id', $request->unit_id)
    )->orderBy('name')->get();

    $query = Asset::with(['unit', 'room']);

    // FILTER UNIT
    if ($request->filled('unit_id')) {
        $query->where(function($q) use ($request) {
            $q->where('unit_id', $request->unit_id)
              ->orWhereHas('room', fn($room) =>
                    $room->where('unit_id', $request->unit_id)
              );
        });
    }

    // FILTER RUMAHAN
    if ($request->filled('room_id')) {
        $query->where('room_id', $request->room_id);
    }

    // FILTER LAINNYA
    if ($request->filled('condition'))
        $query->where('condition', $request->condition);

    if ($request->filled('acquired_year'))
        $query->where('acquired_year', $request->acquired_year);

    if ($request->filled('start_year'))
        $query->where('acquired_year', '>=', $request->start_year);

    if ($request->filled('end_year'))
        $query->where('acquired_year', '<=', $request->end_year);

    $data = $query->get();
    $filters = $request->all();

    // EXPORT PDF
    if ($request->export === 'pdf') {
        $pdf = Pdf::loadView('admin.reports.pdf.assets', [
            'data' => $data,
            'filters' => $filters
        ]);
        return $pdf->download('laporan_aset.pdf');
    }

    // EXPORT EXCEL
    if ($request->export === 'excel') {
        return Excel::download(new AssetsExport($filters), 'laporan_aset.xlsx');
    }

    return view('admin.reports.assets', [
        'units' => $units,
        'rooms' => $rooms,   // sudah difilter otomatis
        'data'  => $data
    ]);
}



    /* ============================================================
     * 2. LAPORAN SURVEY
     * ============================================================ */
    public function surveys(Request $request)
    {
        $units = Unit::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        $query = Survey::with(['unit', 'room', 'performer']);

        if ($request->filled('unit_id'))       $query->where('unit_id', $request->unit_id);
        if ($request->filled('room_id'))       $query->where('room_id', $request->room_id);
        if ($request->filled('start_date'))    $query->whereDate('scheduled_date', '>=', $request->start_date);
        if ($request->filled('end_date'))      $query->whereDate('scheduled_date', '<=', $request->end_date);
        if ($request->filled('performed_by'))  $query->where('performed_by', $request->performed_by);

        $data = $query->get();
        $filters = $request->all();

        if ($request->export === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.pdf.surveys', [
                'data' => $data,
                'filters' => $filters
            ]);
            return $pdf->download('laporan_survey.pdf');
        }

        if ($request->export === 'excel') {
            return Excel::download(new SurveysExport($filters), 'laporan_survey.xlsx');
        }

        return view('admin.reports.surveys', [
            'units' => $units,
            'rooms' => $rooms,
            'users' => $users,
            'data'  => $data
        ]);
    }


    /* ============================================================
     * 3. LAPORAN PENGAJUAN ASET
     * ============================================================ */
    public function submissions(Request $request)
    {
        $units = Unit::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        $query = Submission::with([
            'user',
            'asset.unit',
            'asset.room',
            'addUnit',
            'addRoom'
        ]);

        if ($request->filled('user_id'))  $query->where('user_id', $request->user_id);
        if ($request->filled('type'))      $query->where('type', $request->type);
        if ($request->filled('status'))    $query->where('status', $request->status);

        if ($request->filled('unit_id')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('asset', fn($a) => $a->where('unit_id', $request->unit_id))
                  ->orWhere('add_unit_id', $request->unit_id);
            });
        }

        if ($request->filled('room_id')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('asset', fn($a) => $a->where('room_id', $request->room_id))
                  ->orWhere('add_room_id', $request->room_id);
            });
        }

        $data = $query->get();
        $filters = $request->all();

        if ($request->export === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.pdf.submissions', [
                'data' => $data,
                'filters' => $filters
            ]);
            return $pdf->download('laporan_pengajuan.pdf');
        }

        if ($request->export === 'excel') {
            return Excel::download(new SubmissionsExport($filters), 'laporan_pengajuan.xlsx');
        }

        return view('admin.reports.submissions', [
            'units' => $units,
            'rooms' => $rooms,
            'users' => $users,
            'data'  => $data
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Assets\Asset;
use App\Domains\Rooms\Room;
use App\Domains\Units\Unit;
use App\Domains\Submissions\Submission;
use App\Domains\Surveys\Survey;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // ======================================================
    // ADMIN DASHBOARD
    // ======================================================
    public function admin()
    {
        $last30 = now()->subDays(30); // 1 bulan terakhir

        // --------------------
        // COUNTERS
        // --------------------
        $totalAssets = Asset::count() ?: 0;
        $totalRooms  = Room::count() ?: 0;
        $totalUnits  = Unit::count() ?: 0;

        // Survey & Pengajuan → 1 bulan terakhir
        $totalSubmissions = Submission::where('created_at', '>=', $last30)->count() ?: 0;
        $totalSurveys     = Survey::where('created_at', '>=', $last30)->count() ?: 0;

        // Pending & Scheduled → 1 bulan terakhir
        $pengajuanPending = Submission::where('created_at', '>=', $last30)
                            ->where('status', 'pending')
                            ->count() ?: 0;

        $surveyScheduled = Survey::where('created_at', '>=', $last30)
                            ->where('status', 'dijadwalkan')
                            ->count() ?: 0;

        // --------------------
        // CHART: Kondisi Aset (SEMUA)
        // --------------------
        $chartCondition = Asset::select('condition', DB::raw('COUNT(*) as total'))
            ->groupBy('condition')
            ->pluck('total', 'condition')
            ->toArray();

        $assetsBaik   = $chartCondition['Baik']   ?? 0;
        $assetsRusak  = $chartCondition['Rusak']  ?? 0;
        $assetsHilang = $chartCondition['Hilang'] ?? 0;

        // --------------------
        // CHART: Aset per Unit (SEMUA)
        // --------------------
        $asetPerUnit = DB::table('assets')
            ->join('units', 'assets.unit_id', '=', 'units.id')
            ->select('units.name', DB::raw('COUNT(assets.id) as total'))
            ->groupBy('units.name')
            ->orderBy('total', 'desc')
            ->get();

        // --------------------
        // CHART: Pengajuan 12 Bulan Terakhir
        // --------------------
        $chartSubmissions = Submission::selectRaw("MONTH(created_at) as bulan, COUNT(*) as total")
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $months = [];
        $submissionsSeries = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $bulanKey = (int)$date->format('n');
            $months[] = $date->format('M Y');
            $submissionsSeries[] = $chartSubmissions[$bulanKey] ?? 0;
        }

        // --------------------
        // CHART: Survey per Status (1 BULAN TERAKHIR)
        // --------------------
        $chartSurveyStatus = Survey::where('created_at', '>=', $last30)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // --------------------
        // ACTIVITY LOG (5 terbaru)
        // --------------------
        $recentActivities = ActivityLog::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAssets', 'totalRooms', 'totalUnits',
            'totalSubmissions', 'totalSurveys',
            'pengajuanPending', 'surveyScheduled',
            'assetsBaik', 'assetsRusak', 'assetsHilang',
            'asetPerUnit', 'months', 'submissionsSeries', 'chartSurveyStatus',
            'recentActivities'
        ));
    }

// ======================================================
// USER DASHBOARD FINAL
// ======================================================
public function user()
{
    $user = auth()->user();
    $unitId = $user->unit_id;
    $last30 = now()->subDays(30); // 1 bulan terakhir

    // =====================================================
    // COUNTERS (untuk 4 card di atas)
    // =====================================================
    $totalAssets = Asset::where('unit_id', $unitId)->count() ?: 0;

    $totalSubmissions = Submission::where('user_id', $user->id)
                        ->where('created_at', '>=', $last30)
                        ->count() ?: 0;

    $totalSurveys = Survey::where('unit_id', $unitId)
                    ->where('created_at', '>=', $last30)
                    ->count() ?: 0;

    $surveyAktif = Survey::where('unit_id', $unitId)
        ->where('created_at', '>=', $last30)
        ->whereIn('status', ['dijadwalkan', 'menunggu_validasi'])
        ->count() ?: 0;

    // Tambahan jumlah ruangan
    $totalRooms = Room::where('unit_id', $unitId)->count() ?: 0;


    // =====================================================
    // CHART 1: KONDISI ASET (Pie Chart)
    // =====================================================
    $chartCondition = Asset::where('unit_id', $unitId)
        ->select('condition', DB::raw('COUNT(*) as total'))
        ->groupBy('condition')
        ->pluck('total', 'condition')
        ->toArray();

    $assetsBaikUser   = $chartCondition['Baik']   ?? 0;
    $assetsRusakUser  = $chartCondition['Rusak']  ?? 0;
    $assetsHilangUser = $chartCondition['Hilang'] ?? 0;


    // =====================================================
    // CHART 2: STATUS SURVEI (Bar Chart)
    // =====================================================
    $chartSurveyStatus = Survey::where('unit_id', $unitId)
        ->where('created_at', '>=', $last30)
        ->select('status', DB::raw('COUNT(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status')
        ->toArray();

    // Normalisasi biar tetap muncul meskipun 0
    $chartSurveyStatus = [
        'dijadwalkan' => $chartSurveyStatus['dijadwalkan'] ?? 0,
        'selesai'     => $chartSurveyStatus['selesai'] ?? 0,
        'menunggu_validasi' => $chartSurveyStatus['menunggu_validasi'] ?? 0,
    ];


    // =====================================================
    // CHART 3: PENGAJUAN USER (Line Chart)
    // =====================================================
    $chartSubmissionStatus = Submission::where('user_id', $user->id)
        ->where('created_at', '>=', $last30)
        ->select('status', DB::raw('COUNT(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status')
        ->toArray();

    // Normalisasi
    $chartSubmissionStatus = [
        'pending'   => $chartSubmissionStatus['pending'] ?? 0,
        'approved'    => $chartSubmissionStatus['approved'] ?? 0,
        'rejected'   => $chartSubmissionStatus['rejected'] ?? 0,
        'dibatalkan'   => $chartSubmissionStatus['dibatalkan'] ?? 0,
    ];


    // =====================================================
    // ACTIVITY LOG (opsional kalau mau dipakai)
    // =====================================================
    $activities = ActivityLog::where('user_id', $user->id)
        ->orderBy('created_at', 'DESC')
        ->take(8)
        ->get();


    // =====================================================
    // RETURN KE BLADE
    // =====================================================
    return view('user.dashboard', compact(
        'totalAssets',
        'totalSubmissions',
        'totalSurveys',
        'surveyAktif',
        'totalRooms',

        // chart aset
        'assetsBaikUser',
        'assetsRusakUser',
        'assetsHilangUser',

        // chart survei
        'chartSurveyStatus',

        // chart pengajuan
        'chartSubmissionStatus',

        // log
        'activities'
    ));
}
}
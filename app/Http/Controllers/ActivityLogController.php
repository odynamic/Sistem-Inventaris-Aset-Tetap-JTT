<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog; // pastikan model ada
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    // Tampilkan daftar activity log (admin)
    public function index(Request $request)
    {
        // Ambil daftar user untuk filter dropdown (optional)
        $users = User::orderBy('name')->get();

        $query = ActivityLog::query()->with('user');

        // FILTER: user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // FILTER: module (exact match)
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // FILTER: action (partial match)
        if ($request->filled('action')) {
            $query->where('action', 'like', '%' . $request->action . '%');
        }

        // FILTER: search di description / ip / user_agent
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('description', 'like', "%{$s}%")
                  ->orWhere('ip', 'like', "%{$s}%")
                  ->orWhere('user_agent', 'like', "%{$s}%");
            });
        }

        // FILTER: tanggal (from / to) — inclusive
        if ($request->filled('date_from')) {
            try {
                $from = Carbon::parse($request->date_from)->startOfDay();
                $query->where('created_at', '>=', $from);
            } catch (\Exception $e) {}
        }
        if ($request->filled('date_to')) {
            try {
                $to = Carbon::parse($request->date_to)->endOfDay();
                $query->where('created_at', '<=', $to);
            } catch (\Exception $e) {}
        }

    // AMBIL SEMUA TANPA PAGINATE
    $logs = $query->orderBy('id', 'desc')->get();
    
    return view('admin.activity.index', compact('logs', 'users'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\Saving;
use App\Models\User;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function index(): View
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);

        $totalLogs = ActivityLog::count();
        $totalUsers = User::count();
        $totalLoans = Loan::count();
        $totalSavings = Saving::count();

        $logsPerDay = ActivityLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $topActions = ActivityLog::selectRaw('action, COUNT(*) as count')
            ->groupBy('action')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return view('admin.monitoring.index', compact(
            'logs', 'totalLogs', 'totalUsers', 'totalLoans', 'totalSavings',
            'logsPerDay', 'topActions'
        ));
    }
}

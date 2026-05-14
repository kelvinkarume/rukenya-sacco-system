<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;
use App\Models\LoanPayment;
use Carbon\Carbon;

class AdminDashboardController extends AdminController
{
    public function __construct()
    {
        $this->shareNotifications();
    }
    public function index()
    {
        // =====================
        // CORE METRICS
        // =====================
        $totalMembers = User::where('role', 'member')->count();

        $totalSavings = Saving::sum('amount');

        $totalLoans = Loan::whereIn('status', ['approved', 'active', 'completed'])
    ->sum('amount');
        $outstandingLoans = Loan::whereIn('status', ['active', 'approved'])
            ->sum('balance');

        $totalRepayments = LoanPayment::sum('amount');

        $profit = Loan::where('status', 'completed')
    ->get()
    ->sum(function ($loan) {

        $rate = $loan->interest_rate ?? 12;

        return ($loan->amount * $rate) / 100;
    });

        // =====================
        // QUICK STATS (FIXED TYPES)
        // =====================
        $recentMembers = User::where('role', 'member')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        $pendingLoans = Loan::where('status', 'pending')->count();

        $topSavers = Saving::select('user_id')
            ->groupBy('user_id')
            ->get()
            ->count();

        // =====================
        // PIE CHART (LOANS STATUS)
        // =====================
        $loanStats = [
            Loan::where('status', 'active')->count(),
            Loan::where('status', 'pending')->count(),
            Loan::where('status', 'rejected')->count(),
            Loan::where('status', 'completed')->count(),
        ];

        // =====================
        // BAR CHART (FINANCIALS)
        // =====================
        $financialData = [
            $totalSavings,
            $totalLoans,
            $totalRepayments,
            $profit
        ];

        // =====================
        // LINE CHART (6 MONTHS)
        // =====================
        $monthlyRepayments = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $monthlyRepayments[] = LoanPayment::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
        }

        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalSavings',
            'totalLoans',
            'outstandingLoans',
            'totalRepayments',
            'profit',
            'recentMembers',
            'pendingLoans',
            'topSavers',
            'loanStats',
            'financialData',
            'monthlyRepayments',
            'months'
        ));
    }
}
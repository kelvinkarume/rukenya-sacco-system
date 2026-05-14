<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\Loan;
use App\Models\LoanPayment;

class ReportController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // SAVINGS
        $totalSavings = Saving::where('user_id', $userId)->sum('amount');

        // LOANS
        $loans = Loan::where('user_id', $userId)
            ->with('payments')
            ->latest()
            ->get();

        // TOTAL LOAN PRINCIPAL (ONLY APPROVED LOANS)
        $totalLoanPrincipal = $loans->where('status', 'approved')->sum('amount');

        // OUTSTANDING (ONLY APPROVED LOANS)
        $outstandingLoans = $loans->where('status', 'approved')->sum('balance');

        // TOTAL PAID (FROM PAYMENTS TABLE - ONLY FOR APPROVED LOANS)
        $totalPaidLoans = LoanPayment::where('user_id', $userId)
            ->whereHas('loan', function($query) {
                $query->where('status', 'approved');
            })
            ->sum('amount');

        // NET POSITION (ONLY CONSIDER APPROVED LOANS)
        $balance = $totalSavings - $outstandingLoans;

        return view('reports', compact(
            'totalSavings',
            'totalLoanPrincipal',
            'totalPaidLoans',
            'outstandingLoans',
            'balance',
            'loans'
        ));
    }
}
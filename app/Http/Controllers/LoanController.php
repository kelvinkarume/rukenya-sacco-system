<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\LoanPayment;

class LoanController extends Controller
{
    /**
     * MAIN LOANS PAGE
     */
    public function index()
    {
        $loans = Loan::where('user_id', auth()->id())
            ->with('payments')
            ->latest()
            ->get();

        $total = Loan::where('user_id', auth()->id())
            ->whereIn('status', ['approved', 'active', 'completed'])
            ->sum('balance');

        return view('loans', compact('loans', 'total'));
    }

    /**
     * LOAN HISTORY (FINTECH SAFE VERSION)
     */
    public function loanHistory(Request $request)
{
    $query = Loan::where('user_id', auth()->id())
        ->with('payments');

    /**
     * DATE RANGE FILTER (FIXED)
     */
    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('created_at', [
            $request->from . ' 00:00:00',
            $request->to . ' 23:59:59'
        ]);
    }

    /**
     * MONTH FILTER (SAFE)
     */
    if ($request->filled('month')) {
        $query->whereMonth('created_at', $request->month);
    }

    /**
     * YEAR FILTER (SAFE)
     */
    if ($request->filled('year')) {
        $query->whereYear('created_at', $request->year);
    }

    $loans = $query->latest()->get();

    /**
     * STATS (UNCHANGED BUT SAFE)
     */
    $allLoans = Loan::where('user_id', auth()->id())
        ->with('payments')
        ->get();

    $stats = [
        'approved' => $allLoans->where('status', 'approved')->count(),
        'rejected' => $allLoans->where('status', 'rejected')->count(),
        'pending'  => $allLoans->where('status', 'pending')->count(),
        'completed' => $allLoans->filter(function ($loan) {
            $paid = $loan->payments->sum('amount');
            $total = $loan->amount + ($loan->interest ?? ($loan->amount * 0.12));
            return $paid >= $total;
        })->count(),
    ];

    return view('history', compact('loans', 'stats'));
}

    /**
     * STORE LOAN
     */
    public function store(Request $request)
{
    $request->validate([
        'loan_type' => 'required|in:personal,business,emergency',
        'amount' => 'required|numeric|min:1',
        'term_months' => 'required|integer|min:1',
    ]);

    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | TOTAL SAVINGS
    |--------------------------------------------------------------------------
    */
    $totalSavings = $user->savings()->sum('amount');

    /*
    |--------------------------------------------------------------------------
    | MAXIMUM LOAN LIMIT (3X SAVINGS)
    |--------------------------------------------------------------------------
    */
    $maxLoanLimit = $totalSavings * 3;

    /*
    |--------------------------------------------------------------------------
    | CURRENT ACTIVE/PENDING/APPROVED LOANS
    |--------------------------------------------------------------------------
    */
    $currentLoans = Loan::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'approved', 'active'])
        ->sum('amount');

    /*
    |--------------------------------------------------------------------------
    | NEW REQUESTED LOAN
    |--------------------------------------------------------------------------
    */
    $requestedAmount = $request->amount;

    /*
    |--------------------------------------------------------------------------
    | TOTAL AFTER APPLYING
    |--------------------------------------------------------------------------
    */
    $newTotalLoans = $currentLoans + $requestedAmount;

    /*
    |--------------------------------------------------------------------------
    | REMAINING ELIGIBLE AMOUNT
    |--------------------------------------------------------------------------
    */
    $eligibleAmount = $maxLoanLimit - $currentLoans;

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */
    if ($newTotalLoans > $maxLoanLimit) {

        // prevent negative
        $eligibleAmount = max($eligibleAmount, 0);

        return back()->with(
            'error',
            'You are not eligible for that amount. Your maximum eligible loan is KES ' .
            number_format($eligibleAmount)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LOAN CALCULATIONS
    |--------------------------------------------------------------------------
    */
    $amount = $requestedAmount;

    $interest = $amount * 0.12;

    $totalPayable = $amount + $interest;

    $monthly = $totalPayable / $request->term_months;

    /*
    |--------------------------------------------------------------------------
    | STORE LOAN
    |--------------------------------------------------------------------------
    */
    Loan::create([
        'user_id' => $user->id,
        'loan_type' => $request->loan_type,
        'amount' => $amount,
        'balance' => $totalPayable,
        'term_months' => $request->term_months,
        'monthly_installment' => $monthly,
        'status' => 'pending',
    ]);

    return back()->with(
        'success',
        'Loan submitted successfully.'
    );
}
    /**
     * PAY LOAN
     */
    public function pay(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $loan = Loan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!in_array($loan->status, ['active', 'approved'])) {
            return back()->with('error', 'Loan must be active to pay.');
        }

        $newBalance = $loan->balance - $request->amount;

        if ($newBalance < 0) {
            return back()->with('error', 'Overpayment not allowed.');
        }

        $loan->balance = $newBalance;

        // AUTO STATUS UPDATE (FINTECH LOGIC)
        if ($newBalance <= 0) {
            $loan->status = 'completed';
            $loan->balance = 0;
        } else {
            $loan->status = 'active';
        }

        $loan->save();

        LoanPayment::create([
            'loan_id' => $loan->id,
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'balance_after' => $newBalance,
        ]);

        return back()->with('success', 'Payment successful.');
    }
}
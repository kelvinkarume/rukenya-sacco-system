<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanPayment;

class AdminPaymentController extends AdminController
{
    public function __construct()
    {
        $this->shareNotifications();
    }
    // 1. ALL PAYMENTS
    public function index()
{
    $members = \App\Models\User::with(['loans.payments'])
        ->get()
        ->map(function ($user) {

            $loans = $user->loans;

            $totalLoan = $loans->sum('amount');
            $totalPaid = $loans->flatMap->payments->sum('amount');

            $balance = $totalLoan - $totalPaid;

            // STATUS LOGIC
            if ($balance <= 0 && $totalLoan > 0) {
                $status = 'Fully Paid';
            } elseif ($totalPaid > 0) {
                $status = 'Partial';
            } else {
                $status = 'No Payments';
            }

            return [
                'user_id' => $user->id,
                'name' => $user->name,
                'total_loans' => $totalLoan,
                'total_paid' => $totalPaid,
                'balance' => max($balance, 0),
                'status' => $status,
                'last_payment' => optional(
                    $loans->flatMap->payments->sortByDesc('created_at')->first()
                )->created_at,
            ];
        })
        ->filter(fn($m) => $m['total_loans'] > 0)
        ->values();

    return view('admin.payments.index', compact('members'));
}

    // 2. OVERDUE LOANS
   public function overdue()
{
    $members = \App\Models\User::all()->map(function ($user) {

        $loans = \App\Models\Loan::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'active']) // Only approved/active loans
            ->where('balance', '>', 0)
            ->get();

        $totalBalance = $loans->sum('balance');

        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'loans_count' => $loans->count(),
            'total_balance' => $totalBalance,
        ];
    })
    ->filter(fn($m) => $m['total_balance'] > 0)
    ->values();

    $totalOverdue = $members->sum('total_balance');

    return view('admin.payments.overdue', compact('members', 'totalOverdue'));
}

    // 3. TOTAL PROFIT (INTEREST ONLY)
    public function profit()
{
    $profit = Loan::with('payments')
        ->whereIn('status', ['active', 'completed'])
        ->get()
        ->sum(function ($loan) {

            $totalPaid = $loan->payments->sum('amount');

            // interest earned = what user paid minus principal
            return max($totalPaid - $loan->amount, 0);
        });

    return view('admin.payments.profit', compact('profit'));
}
}
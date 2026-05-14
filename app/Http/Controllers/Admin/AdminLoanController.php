<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Notification;
use App\Models\User;

class AdminLoanController extends AdminController
{
    public function __construct()
    {
        $this->shareNotifications();
    }
    // 1. LOAN APPLICATIONS (PENDING)
    public function applications()
    {
        $loans = Loan::where('status', 'pending')
            ->with('user')
            ->latest()
            ->get();

        return view('admin.loans.applications', compact('loans'));
    }

    // 2. ACTIVE LOANS
    public function active()
{
    $loans = Loan::with('user')
        ->where('status', 'approved')
        ->where('balance', '>', 0)
        ->latest()
        ->get();

    $totalActive = $loans->sum('balance');

    return view('admin.loans.active', compact('loans', 'totalActive'));
}

    // 3. APPROVE LOAN (STEP 1: APPROVED, NOT ACTIVE YET)
    public function approve($id)
    {
        $loan = Loan::findOrFail($id);

        $loan->status = 'approved'; // IMPORTANT CHANGE
        $loan->approved_at = now(); // optional tracking

        $loan->save();
          Notification::create([
    'user_id' => $loan->user_id,
    'title' => 'Loan Approved',
    'message' => 'Your loan of KES ' . $loan->amount . ' has been approved.',
    'type' => 'loan_approved'
]);

        return back()->with('success', 'Loan approved successfully. Ready for disbursement.');
    }

    public function memberLoans($id)
{
    $member = User::findOrFail($id);

    // ONLY ACTIVE / APPROVED LOANS
    $loans = Loan::where('user_id', $id)
                ->where('status', 'approved')
                ->latest()
                ->get();

    return view('admin.loans.member_loans', compact('member', 'loans'));
}

    // 4. DISBURSE LOAN (NEW STEP - REAL SACCO FLOW)
    public function disburse($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'approved') {
            return back()->with('error', 'Loan must be approved first.');
        }

        $loan->status = 'active';
        $loan->disbursed_at = now(); // optional tracking
        $loan->save();

         Notification::create([
        'user_id' => $loan->user_id,
        'title' => 'Loan Disbursed',
        'message' => 'Your loan of KES ' . $loan->amount . ' has been disbursed successfully.',
        'type' => 'loan_disbursed'
    ]);

        return back()->with('success', 'Loan disbursed and activated successfully.');
    }

    // 5. REJECT LOAN
    public function reject($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->status = 'rejected';
        $loan->save();

        Notification::create([
    'user_id' => $loan->user_id,
    'title' => 'Loan Rejected',
    'message' => 'Your loan application has been rejected.',
    'type' => 'loan_rejected'
]);

        return back()->with('error', 'Loan rejected');
    }

    
    // 6. REPAYMENTS
    public function repayments()
{
    $members = \App\Models\User::with(['loans.payments'])
        ->get()
        ->map(function ($user) {

            $payments = $user->loans->flatMap->payments;

            return [
                'name' => $user->name,
                'user_id' => $user->id,
                'total_paid' => $payments->sum('amount'),
                'repayment_count' => $payments->count(),
                'last_payment' => optional($payments->sortByDesc('created_at')->first())->created_at,
            ];
        })
        ->filter(fn($u) => $u['repayment_count'] > 0); // only members with payments

    return view('admin.loans.repayments', compact('members'));
}
public function repaymentDetails($userId)
{
    $payments = \App\Models\LoanPayment::with('loan')
        ->where('user_id', $userId)
        ->latest()
        ->get();

    return view('admin.loans.repayment-details', compact('payments'));
}
}
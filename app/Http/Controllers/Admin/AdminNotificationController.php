<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\Saving;
use Illuminate\Http\Request;

class AdminNotificationController extends AdminController
{
    public function __construct()
    {
        $this->shareNotifications();
    }

    public function index()
    {
        // Get pending loans
        $pendingLoans = Loan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Get pending withdrawals
        $pendingWithdrawals = Saving::with('user')
            ->where('transaction_type', 'withdrawal')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Combine into one collection with type indicator
        $notifications = collect();

        foreach ($pendingLoans as $loan) {
            $notifications->push([
                'id' => $loan->id,
                'type' => 'loan',
                'title' => 'Loan Application',
                'user_name' => $loan->user->name,
                'amount' => $loan->amount,
                'date' => $loan->created_at,
            ]);
        }

        foreach ($pendingWithdrawals as $withdrawal) {
            $notifications->push([
                'id' => $withdrawal->id,
                'type' => 'withdrawal',
                'title' => 'Savings Withdrawal',
                'user_name' => $withdrawal->user->name,
                'amount' => $withdrawal->amount,
                'date' => $withdrawal->created_at,
            ]);
        }

        $notifications = $notifications->sortByDesc('date')->values();

        return view('admin.notifications.index', compact('notifications', 'pendingLoans', 'pendingWithdrawals'));
    }

    public function approveLoan($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'approved']);
        return back()->with('success', 'Loan application approved');
    }

    public function rejectLoan($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'rejected']);
        return back()->with('success', 'Loan application rejected');
    }

    public function approveWithdrawal($id)
    {
        $withdrawal = Saving::findOrFail($id);
        $withdrawal->update(['status' => 'approved']);
        return back()->with('success', 'Withdrawal approved');
    }

    public function rejectWithdrawal($id)
    {
        $withdrawal = Saving::findOrFail($id);
        $withdrawal->update(['status' => 'rejected']);
        return back()->with('success', 'Withdrawal rejected');
    }
}

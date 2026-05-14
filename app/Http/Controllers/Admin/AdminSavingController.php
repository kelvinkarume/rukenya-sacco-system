<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSavingController extends AdminController
{
    public function __construct()
    {
        $this->shareNotifications();
    }
    // ALL MEMBERS SUMMARY (ONE ROW PER MEMBER)
    public function index()
    {
        $members = User::where('role', 'member')
            ->with(['savings'])
            ->get()
            ->map(function ($user) {

                $totalSavings = $user->savings->sum('amount');
                $depositsCount = $user->savings->count();
                $lastDeposit = $user->savings->sortByDesc('created_at')->first();

                $user->total_savings = $totalSavings;
                $user->deposits_count = $depositsCount;
                $user->last_deposit = $lastDeposit ? $lastDeposit->created_at : null;

                return $user;
            });

        return view('admin.savings.index', compact('members'));
    }

    // SINGLE MEMBER SAVINGS HISTORY
    public function show($id)
    {
        $member = User::with('savings')->findOrFail($id);

        return view('admin.savings.show', compact('member'));
    }

    // VIEW PENDING WITHDRAWAL REQUESTS
    public function withdrawals()
    {
        $withdrawals = Saving::where('transaction_type', 'withdrawal')
            ->where('status', 'pending')
            ->with('user')
            ->latest()
            ->get();

        return view('admin.savings.withdrawals', compact('withdrawals'));
    }

    // APPROVE WITHDRAWAL REQUEST
    public function approveWithdrawal($id)
    {
        $withdrawal = Saving::findOrFail($id);

        // Only approve pending withdrawals
        if ($withdrawal->status !== 'pending') {
            return back()->withErrors('This withdrawal request cannot be approved.');
        }

        // Update withdrawal status
        $withdrawal->update([
            'status' => 'approved',
            'description' => ($withdrawal->description ?? '') . ' | Approved on ' . now()->format('d M Y'),
        ]);

        return back()->with('success', 'Withdrawal request approved! Member: ' . $withdrawal->user->name);
    }

    // REJECT WITHDRAWAL REQUEST
    public function rejectWithdrawal($id)
    {
        $withdrawal = Saving::findOrFail($id);

        // Only reject pending withdrawals
        if ($withdrawal->status !== 'pending') {
            return back()->withErrors('This withdrawal request cannot be rejected.');
        }

        // Update withdrawal status
        $withdrawal->update([
            'status' => 'rejected',
            'description' => ($withdrawal->description ?? '') . ' | Rejected on ' . now()->format('d M Y'),
        ]);

        return back()->with('success', 'Withdrawal request rejected! Member: ' . $withdrawal->user->name);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    // SHOW SAVINGS PAGE
    public function index()
    {
        $savings = Saving::where('user_id', auth()->id())
            ->latest()
            ->get();

        // Calculate total based on approved/completed transactions only
        $total = Saving::where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'approved'])
            ->sum('amount');

        return view('savings', compact('savings', 'total'));
    }

    // SHOW DEPOSIT FORM
    public function create()
    {
        return view('savings.create');
    }

    // STORE DEPOSIT
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Saving::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'transaction_type' => 'deposit',
            'status' => 'completed',
        ]);

        return redirect()->route('member.savings')
            ->with('success', 'Deposit successful!');
    }

    // SHOW WITHDRAW FORM
    public function withdrawForm()
    {
        $totalSavings = Saving::where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'approved'])
            ->sum('amount');

        return view('savings.withdraw', compact('totalSavings'));
    }

    // PROCESS WITHDRAWAL
    public function processWithdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        $totalSavings = Saving::where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'approved'])
            ->sum('amount');

        // Check if member has enough savings
        if ($request->amount > $totalSavings) {
            return back()->withErrors(['amount' => 'Insufficient savings balance. You have KES ' . number_format($totalSavings)]);
        }

        // Create withdrawal record (negative amount to track withdrawal)
        Saving::create([
            'user_id' => Auth::id(),
            'amount' => -$request->amount,
            'transaction_type' => 'withdrawal',
            'status' => 'pending',
            'description' => 'Withdrawal request submitted on ' . now()->format('d M Y'),
        ]);

        return redirect()->route('member.savings')
            ->with('success', 'Withdrawal request of KES ' . number_format($request->amount) . ' has been submitted for approval. You will be notified once it is processed.');
    }
}
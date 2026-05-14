<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Saving;

class AdminController extends Controller
{
    protected function getNotifications()
    {
        // Get pending loans with user data
        $pendingLoans = Loan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        // Get pending withdrawals with user data
        $pendingWithdrawals = Saving::with('user')
            ->where('transaction_type', 'withdrawal')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        return compact('pendingLoans', 'pendingWithdrawals');
    }

    protected function shareNotifications()
    {
        $notifications = $this->getNotifications();
        view()->share($notifications);
    }
}
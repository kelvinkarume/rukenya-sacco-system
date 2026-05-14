<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class AdminReportController extends AdminController
{
    public function __construct()
    {
        $this->shareNotifications();
    }
    public function loans(Request $request)
    {
        $month = $request->get('month', 'all');
        $query = Loan::whereIn('status', ['approved', 'active', 'completed']); // Include completed loans

        if ($month != 'all') {
            $query->whereMonth('created_at', $month)->whereYear('created_at', now()->year);
        }

        $loans = $query->get();

        // Chart data: loans per month (approved/active/completed)
        $chartData = Loan::whereIn('status', ['approved', 'active', 'completed'])
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $chartData[$i] ?? 0;
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('admin.reports.loans_pdf', compact('loans', 'month'));
            return $pdf->download('loans_report.pdf');
        } elseif ($request->get('export') == 'csv') {
            return $this->exportCsv($loans, ['id', 'user_id', 'amount', 'status', 'created_at'], 'loans_report.csv');
        }

        return view('admin.reports.loans', compact('loans', 'month', 'labels', 'data'));
    }

    public function repayments(Request $request)
    {
        $month = $request->get('month', 'all');
        $query = LoanPayment::with('loan')->whereHas('loan', function ($q) {
            $q->whereIn('status', ['approved', 'active', 'completed']); // Include completed loans
        });

        if ($month != 'all') {
            $query->whereMonth('created_at', $month)->whereYear('created_at', now()->year);
        }

        $repayments = $query->get();

        // Chart data: repayments per month (only for approved/active/completed loans)
        $chartData = LoanPayment::with('loan')
            ->whereHas('loan', function ($q) {
                $q->whereIn('status', ['approved', 'active', 'completed']);
            })
            ->selectRaw('MONTH(loan_payments.created_at) as month, SUM(loan_payments.amount) as total')
            ->whereYear('loan_payments.created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $chartData[$i] ?? 0;
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('admin.reports.repayments_pdf', compact('repayments', 'month'));
            return $pdf->download('repayments_report.pdf');
        } elseif ($request->get('export') == 'csv') {
            return $this->exportCsv($repayments, ['id', 'loan_id', 'amount', 'created_at'], 'repayments_report.csv');
        }

        return view('admin.reports.repayments', compact('repayments', 'month', 'labels', 'data'));
    }

    public function savings(Request $request)
    {
        $month = $request->get('month', 'all');
        $query = Saving::query();

        if ($month != 'all') {
            $query->whereMonth('created_at', $month)->whereYear('created_at', now()->year);
        }

        $savings = $query->get();

        // Chart data: savings per month
        $chartData = Saving::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $chartData[$i] ?? 0;
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('admin.reports.savings_pdf', compact('savings', 'month'));
            return $pdf->download('savings_report.pdf');
        } elseif ($request->get('export') == 'csv') {
            return $this->exportCsv($savings, ['id', 'user_id', 'amount', 'created_at'], 'savings_report.csv');
        }

        return view('admin.reports.savings', compact('savings', 'month', 'labels', 'data'));
    }

    public function overdue(Request $request)
    {
        $month = $request->get('month', 'all');

        $users = User::with(['loans' => function ($query) use ($month) {
            $query->whereIn('status', ['approved', 'active']) // Only approved/active loans
                ->where('balance', '>', 0);

            if ($month != 'all') {
                $query->whereMonth('created_at', $month)->whereYear('created_at', now()->year);
            }
        }])->get();

        $overdueMembers = $users->map(function ($user) {
            $loans = $user->loans;
            return [
                'user_id' => $user->id,
                'name' => $user->name,
                'loans_count' => $loans->count(),
                'total_balance' => $loans->sum('balance'),
            ];
        })->filter(fn ($member) => $member['total_balance'] > 0)
            ->values();

        // Chart data: overdue loans per month (only approved/active)
        $chartData = Loan::whereIn('status', ['approved', 'active'])
            ->where('balance', '>', 0)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $chartData[$i] ?? 0;
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('admin.reports.overdue_pdf', compact('overdueMembers', 'month'));
            return $pdf->download('overdue_report.pdf');
        } elseif ($request->get('export') == 'csv') {
            return $this->exportCsv($overdueMembers, ['user_id', 'name', 'loans_count', 'total_balance'], 'overdue_report.csv');
        }

        return view('admin.reports.overdue', compact('overdueMembers', 'month', 'labels', 'data'));
    }

    public function profit(Request $request)
    {
        $month = $request->get('month', 'all');

        // Get loans with their payments
        $loansQuery = Loan::with('payments')->whereIn('status', ['approved', 'active', 'completed']);

        if ($month != 'all') {
            $loansQuery->whereMonth('created_at', $month)->whereYear('created_at', now()->year);
        }

        $loans = $loansQuery->get();

        // Calculate profit: total payments received - total principal lent
        $totalProfit = 0;
        $monthlyProfits = [];

        foreach ($loans as $loan) {
            $totalPaid = $loan->payments->sum('amount');
            $principal = $loan->amount;
            $profit = $totalPaid - $principal;

            // Only count profit if loan has been paid (avoid negative profit for new loans)
            if ($totalPaid > 0) {
                $totalProfit += max(0, $profit); // Ensure no negative profit

                $monthKey = $loan->created_at->format('n'); // 1-12
                if (!isset($monthlyProfits[$monthKey])) {
                    $monthlyProfits[$monthKey] = 0;
                }
                $monthlyProfits[$monthKey] += max(0, $profit);
            }
        }

        // Chart data: profit per month
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyProfits[$i] ?? 0;
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('admin.reports.profit_pdf', compact('totalProfit', 'month'));
            return $pdf->download('profit_report.pdf');
        } elseif ($request->get('export') == 'csv') {
            $dataCsv = [['Total Profit', $totalProfit]];
            return $this->exportCsv($dataCsv, ['Description', 'Amount'], 'profit_report.csv');
        }

        return view('admin.reports.profit', compact('totalProfit', 'month', 'labels', 'data'));
    }

    public function savingsWithdrawals(Request $request)
    {
        $month = $request->get('month', 'all');
        $query = \App\Models\Saving::where('transaction_type', 'withdrawal')
            ->where('status', 'approved'); // Only approved withdrawals

        if ($month != 'all') {
            $query->whereMonth('created_at', $month)->whereYear('created_at', now()->year);
        }

        $withdrawals = $query->with('user')->get();

        // Chart data: withdrawals per month (only approved)
        $chartData = \App\Models\Saving::where('transaction_type', 'withdrawal')
            ->where('status', 'approved')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $chartData[$i] ?? 0;
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('admin.reports.savings_withdrawals_pdf', compact('withdrawals', 'month'));
            return $pdf->download('savings_withdrawals_report.pdf');
        } elseif ($request->get('export') == 'csv') {
            return $this->exportCsv($withdrawals, ['id', 'user_id', 'amount', 'status', 'created_at'], 'savings_withdrawals_report.csv');
        }

        return view('admin.reports.savings-withdrawals', compact('withdrawals', 'month', 'labels', 'data'));
    }

    private function exportCsv($data, $headers, $filename)
    {
        $handle = fopen('php://temp', 'w+');
        fputcsv($handle, $headers);
        foreach ($data as $row) {
            $csvRow = [];
            foreach ($headers as $header) {
                $csvRow[] = $row->{$header} ?? '';
            }
            fputcsv($handle, $csvRow);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);
        return response($csv)->header('Content-Type', 'text/csv')->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
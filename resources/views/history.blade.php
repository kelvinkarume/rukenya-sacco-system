@extends('layouts.app')

@section('title', 'Loan History')

@section('content')
<div class="p-4 md:p-6 space-y-6">

    <!-- Title -->
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
        Loan History Overview
    </h2>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <input type="date" name="from" value="{{ request('from') }}"
                   class="border rounded-lg p-2 dark:bg-gray-900 dark:text-white">

            <input type="date" name="to" value="{{ request('to') }}"
                   class="border rounded-lg p-2 dark:bg-gray-900 dark:text-white">

            <select name="month" class="border rounded-lg p-2 dark:bg-gray-900 dark:text-white">
                <option value="">Month</option>
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ date('F', mktime(0,0,0,$m,1)) }}
                    </option>
                @endfor
            </select>

            <select name="year" class="border rounded-lg p-2 dark:bg-gray-900 dark:text-white">
                <option value="">Year</option>
                @for($y = 2020; $y <= date('Y'); $y++)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>

            <button class="bg-blue-600 text-white rounded-lg px-4 py-2">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="p-3">Loan Type</th>
                    <th class="p-3">Principal</th>
                    <th class="p-3">Interest</th>
                    <th class="p-3">Repaid</th>
                    <th class="p-3">Balance</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Date</th>
                </tr>
            </thead>

            <tbody class="text-gray-700 dark:text-gray-300">
                @forelse($loans as $loan)

                @php
                    // FINTECH CALCULATION
                    $principal = $loan->amount;
                    $interest = ($loan->interest ?? ($loan->amount * 0.12));

                    // TOTAL OBLIGATION (IMPORTANT FIX)
                    $totalBalance = $principal + $interest;

                    $repaid = $loan->payments->sum('amount') ?? 0;

                    $remaining = $totalBalance - $repaid;
                    if ($remaining < 0) $remaining = 0;

                    // STATUS LOGIC
                    $status = $loan->status;
                    if ($remaining <= 0) {
                        $status = 'completed';
                    }
                @endphp

                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                    <!-- Loan Type -->
                    <td class="p-3">{{ $loan->loan_type ?? 'N/A' }}</td>

                    <!-- Principal -->
                    <td class="p-3 font-medium">
                        KES {{ number_format($principal, 2) }}
                    </td>

                    <!-- Interest -->
                    <td class="p-3 text-blue-600">
                        KES {{ number_format($interest, 2) }}
                    </td>

                    <!-- Repaid -->
                    <td class="p-3 text-green-600">
                        KES {{ number_format($repaid, 2) }}
                    </td>

                    <!-- Balance (TOTAL OBLIGATION REMAINING) -->
                    <td class="p-3 text-red-600 font-semibold">
                        KES {{ number_format($remaining, 2) }}
                    </td>

                    <!-- Status -->
                    <td class="p-3">
                        @if($status == 'approved')
                            <span class="text-green-600">Approved</span>
                        @elseif($status == 'rejected')
                            <span class="text-red-600">Rejected</span>
                        @elseif($status == 'completed')
                            <span class="text-blue-600">Completed</span>
                        @else
                            <span class="text-yellow-600">Pending</span>
                        @endif
                    </td>

                    <!-- Date -->
                    <td class="p-3">
                        {{ $loan->created_at->format('d M Y') }}
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center p-4 text-gray-500">
                        No loan records found
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- Graph Section -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">
            Loan Distribution
        </h3>

        <canvas id="loanChart"></canvas>
    </div>

</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('loanChart');

    const loanData = {
        labels: ['Approved', 'Rejected', 'Pending', 'Completed'],
        datasets: [{
            label: 'Loans',
            data: [
                {{ $stats['approved'] ?? 0 }},
                {{ $stats['rejected'] ?? 0 }},
                {{ $stats['pending'] ?? 0 }},
                {{ $stats['completed'] ?? 0 }}
            ]
        }]
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: loanData,
    });
</script>

@endsection
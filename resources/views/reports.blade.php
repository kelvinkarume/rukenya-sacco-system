@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">My Financial Report</h2>
        <p class="text-gray-500 text-sm">
            Overview of your SACCO account performance
        </p>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="p-5 bg-white shadow rounded">
            <p class="text-gray-500">Total Savings</p>
            <p class="text-2xl font-bold text-green-600">
                KES {{ number_format($totalSavings ?? 0) }}
            </p>
        </div>

        <div class="p-5 bg-white shadow rounded">
            <p class="text-gray-500">Loan Borrowed</p>
            <p class="text-2xl font-bold text-blue-600">
                KES {{ number_format($totalLoanPrincipal ?? 0) }}
            </p>
        </div>

        <div class="p-5 bg-white shadow rounded">
            <p class="text-gray-500">Outstanding Loans</p>
            <p class="text-2xl font-bold text-red-500">
                KES {{ number_format($outstandingLoans ?? 0) }}
            </p>
        </div>

        <div class="p-5 bg-white shadow rounded">
            <p class="text-gray-500">Net Balance</p>
            <p class="text-2xl font-bold {{ ($balance ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                KES {{ number_format($balance ?? 0) }}
            </p>
        </div>

    </div>

    <!-- LOAN HISTORY (IMPROVED SACCO STATEMENT STYLE) -->
    <div class="mt-8 bg-white shadow rounded p-6">

        <h3 class="text-lg font-bold mb-6">Loan History Statement</h3>

        @forelse($loans as $loan)

            @php
                $paid = $loan->payments->sum('amount');
                $balance = $loan->balance;
                $status = $loan->status == 'rejected' ? 'REJECTED' :
                         ($balance <= 0 ? 'PAID' : 'ACTIVE');
            @endphp

            <div class="border rounded-lg p-5 mb-6 bg-gray-50">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-4">

                    <div>
                        <h4 class="font-bold text-gray-800">
                            Loan #{{ $loan->id }}
                        </h4>
                        <p class="text-sm text-gray-500">
                            Issued: {{ $loan->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded text-sm font-semibold
                        {{ $status == 'REJECTED'
                            ? 'bg-red-100 text-red-700'
                            : ($status == 'PAID'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-600') }}">

                        {{ $status }}

                    </span>

                </div>

                <!-- MAIN DETAILS -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm mb-4">

                    <div>
                        <p class="text-gray-500">Principal</p>
                        <p class="font-semibold text-gray-800">
                            KES {{ number_format($loan->amount) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Total Paid</p>
                        <p class="font-semibold text-green-600">
                            KES {{ number_format($paid) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Balance (Incl. Interest)</p>
                        <p class="font-semibold text-red-600">
                            KES {{ number_format($balance) }}
                        </p>
                    </div>

                </div>

                <!-- PAYMENTS SECTION -->
                <div class="border-t pt-3">

                    <p class="font-semibold text-gray-700 mb-2">Payment History</p>

                    @forelse($loan->payments as $payment)
                        <div class="flex justify-between text-sm text-gray-600 py-1">
                            <span>
                                {{ $payment->created_at->format('d M Y') }}
                            </span>
                            <span class="font-medium">
                                KES {{ number_format($payment->amount) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">
                            No payments recorded yet
                        </p>
                    @endforelse

                </div>

            </div>

        @empty
            <p class="text-gray-500">No loan history found.</p>
        @endforelse

    </div>

</div>
@endsection
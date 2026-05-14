@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6" x-data="{ openLoan: false }">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">

        <h2 class="text-2xl font-bold text-gray-800">
            My Loans
        </h2>
        <!-- SUCCESS MESSAGE -->
@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<!-- ERROR MESSAGE -->
@if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
        {{ session('error') }}
    </div>
@endif

<!-- VALIDATION ERRORS -->
@if($errors->any())
    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $totalSavings = auth()->user()->availableSavings();
    $eligibleLoan = $totalSavings * 3;
@endphp

<div class="mb-4 bg-blue-50 border border-blue-200 rounded-2xl p-4">

    <p class="text-sm text-gray-600">
        Total Savings
    </p>

    <h3 class="text-xl font-bold text-green-600">
        KES {{ number_format($totalSavings) }}
    </h3>

    <p class="text-sm text-gray-600 mt-2">
        Maximum Eligible Loan (3× Savings)
    </p>

    <h3 class="text-xl font-bold text-blue-600">
        KES {{ number_format($eligibleLoan) }}
    </h3>

</div>
        <button
            @click="openLoan = true"
            class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600 w-full md:w-auto">
            + Apply Loan
        </button>

    </div>

    <!-- SUMMARY (ONLY ACTIVE LOANS COUNT) -->
    <div class="mb-6 bg-white shadow rounded p-4 border-l-4 border-sky-400">
        <p class="text-gray-500">Active Loan Portfolio</p>
        <p class="text-2xl font-bold text-gray-800">
            KES {{ number_format($total ?? 0) }}
        </p>
    </div>

    <!-- LOANS LIST -->
    <div class="space-y-4">

        @forelse($loans as $loan)

            <div class="p-5 bg-white shadow rounded flex flex-col md:flex-row justify-between gap-4">

                <!-- LEFT SIDE -->
                <div class="w-full md:w-2/3 space-y-1">

                    <!-- LOAN TYPE -->
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                        {{ ucwords($loan->loan_type) }} Loan
                    </span>

                    <p class="font-bold text-gray-800 text-lg">
                        Principal: KES {{ number_format($loan->amount) }}
                    </p>

                    <p class="text-sm text-gray-600">
                        Balance: KES {{ number_format($loan->balance) }}
                    </p>

                    <p class="text-sm text-sky-600">
                        Monthly Installment: KES {{ number_format($loan->monthly_installment, 2) }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Applied: {{ $loan->created_at->format('d M Y') }}
                    </p>

                    <!-- PAYMENT SECTION -->
                    <div class="mt-3">

                        {{-- ONLY ACTIVE LOANS CAN BE PAID --}}
                        @if($loan->status === 'active' || $loan->status === 'approved')

                            @if($loan->balance > 0)

                                <form method="POST"
                                      action="{{ route('member.loans.pay', $loan->id) }}"
                                      class="flex gap-2">

                                    @csrf

                                    <input type="number"
                                           name="amount"
                                           class="border p-2 rounded w-40"
                                           placeholder="Amount"
                                           required>

                                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Pay
                                    </button>

                                </form>

                            @else
                                <span class="text-green-600 font-bold"> Completed</span>
                            @endif

                        @elseif($loan->status === 'pending')

                            <span class="text-yellow-600 font-semibold">
                                 Pending Approval
                            </span>

                        @elseif($loan->status === 'rejected')

                            <span class="text-red-600 font-semibold">
                                 Rejected (Not Eligible for Payment)
                            </span>

                        @elseif($loan->status === 'completed')

                            <span class="text-green-600 font-bold">
                                 Fully Paid
                            </span>

                        @endif

                    </div>

                </div>

                <!-- STATUS BADGE -->
                <div class="flex items-start md:justify-end">

                    @if($loan->status === 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                            Pending
                        </span>

                    @elseif($loan->status === 'approved' || $loan->status === 'active')
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                            Active
                        </span>

                    @elseif($loan->status === 'completed')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                            Completed
                        </span>

                    @elseif($loan->status === 'rejected')
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                            Rejected
                        </span>
                    @endif

                </div>

            </div>

        @empty

            <div class="bg-white p-6 text-center text-gray-500 shadow rounded">
                No loans found. Start by applying.
            </div>

        @endforelse

    </div>
    <!-- MODAL -->
    <div x-show="openLoan"
         x-transition
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">

        <!-- MODAL BOX -->
        <div class="bg-white text-gray-800 w-full max-w-lg rounded-3xl shadow-2xl p-6 relative"
             @click.away="openLoan = false">

            <!-- CLOSE BUTTON -->
            <button
                @click="openLoan = false"
                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-xl">
                <i class="fas fa-times"></i>
            </button>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold mb-6 text-sky-700">
                Apply for Loan
            </h2>

            <form method="POST" action="{{ route('member.loans.store') }}">
                @csrf

                <!-- LOAN TYPE -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Loan Type
                    </label>

                    <select
                        name="loan_type"
                        class="w-full border border-gray-300 bg-white text-gray-800 rounded-2xl p-3 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                        required
                    >
                        <option value="">Select Loan Type</option>
                        <option value="personal">Personal Loan</option>
                        <option value="business">Business Loan</option>
                        <option value="emergency">Emergency Loan</option>
                    </select>
                </div>

                <!-- AMOUNT -->
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Loan Amount
                    </label>

                    <input
                        type="number"
                        name="amount"
                        placeholder="Enter amount"
                        class="w-full border border-gray-300 bg-white text-gray-800 rounded-2xl p-3 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                        required
                    >
                </div>

                <!-- TERM -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Repayment Period (Months)
                    </label>

                    <input
                        type="number"
                        name="term_months"
                        placeholder="e.g 12"
                        class="w-full border border-gray-300 bg-white text-gray-800 rounded-2xl p-3 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                        required
                    >
                </div>

                <!-- BUTTONS -->
                <div class="flex justify-end gap-3">

                    <button
                        type="button"
                        @click="openLoan = false"
                        class="px-5 py-3 rounded-2xl bg-gray-200 hover:bg-gray-300 transition font-medium"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-3 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-semibold shadow-lg transition"
                    >
                        Submit Loan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection
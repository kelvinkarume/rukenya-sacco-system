@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HERO WELCOME SECTION -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg shadow">

        <h1 class="text-2xl font-bold">
            Welcome to Rukenya SACCO 
        </h1>

        <p class="mt-2 text-sm opacity-90">
            Your trusted financial partner for savings, loans, and financial growth.
        </p>

        <div class="mt-4 flex gap-3">
            <a href="{{ route('member.savings') }}"
               class="bg-white text-blue-600 px-4 py-2 rounded font-semibold hover:bg-gray-100">
                Start Saving
            </a>

            <a href="{{ route('member.loans') }}"
               class="bg-blue-800 px-4 py-2 rounded font-semibold hover:bg-blue-900">
                Apply Loan
            </a>
        </div>

    </div>

    <!-- QUICK STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white p-5 rounded shadow">
            <p class="text-gray-500 text-sm">Savings Growth</p>
            <h2 class="text-xl font-bold text-green-600">Build Wealth</h2>
            <p class="text-sm text-gray-500 mt-2">
                Save consistently and earn financial stability over time.
            </p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <p class="text-gray-500 text-sm">Loan Access</p>
            <h2 class="text-xl font-bold text-blue-600">Fast & Reliable</h2>
            <p class="text-sm text-gray-500 mt-2">
                Access affordable loans with 12% transparent interest.
            </p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <p class="text-gray-500 text-sm">Financial Control</p>
            <h2 class="text-xl font-bold text-purple-600">Stay In Control</h2>
            <p class="text-sm text-gray-500 mt-2">
                Track savings, loans, and repayments in real time.
            </p>
        </div>

    </div>

    <!-- SACCO BENEFITS SECTION -->
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-lg font-bold mb-4">
            Why Join Rukenya SACCO?
        </h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700">

            <div class="flex gap-2">
                <span></span>
                <p>Secure savings with transparent tracking system</p>
            </div>

            <div class="flex gap-2">
                <span></span>
                <p>Affordable loans with low interest rates (12%)</p>
            </div>

            <div class="flex gap-2">
                <span></span>
                <p>Instant loan tracking and repayment history</p>
            </div>

            <div class="flex gap-2">
                <span></span>
                <p>Professional financial reports and statements</p>
            </div>

            <div class="flex gap-2">
                <span></span>
                <p>Member-focused financial growth system</p>
            </div>

            <div class="flex gap-2">
                <span></span>
                <p>Reliable and transparent SACCO management</p>
            </div>

        </div>

    </div>

    <!-- GUIDELINES SECTION -->
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-lg font-bold mb-4">
            How to Use Your SACCO Account
        </h2>

        <ol class="list-decimal ml-5 space-y-2 text-sm text-gray-700">

            <li>
                Start by making your first savings deposit in the <b>Savings</b> section.
            </li>

            <li>
                Apply for a loan once you have active savings history.
            </li>

            <li>
                Repay loans gradually using the repayment section.
            </li>

            <li>
                Check your financial reports to track progress weekly/monthly.
            </li>

            <li>
                Maintain consistent savings to increase loan eligibility.
            </li>

        </ol>

    </div>

    <!-- CALL TO ACTION -->
    <div class="bg-gray-900 text-white p-6 rounded shadow text-center">

        <h2 class="text-lg font-bold">
            Start Your Financial Journey Today
        </h2>

        <p class="text-sm opacity-80 mt-2">
            Save consistently, borrow responsibly, and grow financially with Rukenya SACCO.
        </p>

        <div class="mt-4 flex justify-center gap-3">

            <a href="{{ route('member.savings') }}"
               class="bg-green-500 px-4 py-2 rounded font-semibold hover:bg-green-600">
                Save Now
            </a>

            <a href="{{ route('member.loans') }}"
               class="bg-blue-500 px-4 py-2 rounded font-semibold hover:bg-blue-600">
                Get Loan
            </a>

        </div>

    </div>

</div>
@endsection
{{-- resources/views/savings/withdraw.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-8">
    <div class="max-w-2xl mx-auto px-4">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Withdraw Savings</h2>
            <p class="text-gray-600">Request to withdraw your savings</p>
        </div>

        <!-- Current Balance Card -->
        <div class="bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-2xl shadow-lg p-6 mb-6 text-white">
            <p class="text-sm font-medium opacity-90">Available Savings Balance</p>
            <h3 class="text-4xl font-bold mt-2">KES {{ number_format($totalSavings) }}</h3>
            <p class="text-xs opacity-75 mt-2">Total balance available for withdrawal</p>
        </div>

        <!-- Withdrawal Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('savings.withdraw.store') }}" class="space-y-6">
                @csrf

                <!-- Amount Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Withdrawal Amount (KES)
                    </label>
                    <input type="number" 
                           name="amount"
                           step="0.01"
                           min="100"
                           max="{{ $totalSavings }}"
                           placeholder="Enter amount to withdraw"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500 transition"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Minimum withdrawal: KES 100</p>
                    
                    @error('amount')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-900 mb-3">Withdrawal Terms & Conditions</h4>
                    <ul class="space-y-2 text-sm text-blue-800">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 font-bold">•</span>
                            <span>Minimum withdrawal amount is KES 100</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 font-bold">•</span>
                            <span>Withdrawal requests are processed within 1-2 business days</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 font-bold">•</span>
                            <span>Funds will be transferred to your registered bank account</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 font-bold">•</span>
                            <span>Ensure you have sufficient balance to cover withdrawal</span>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('member.savings') }}"
                       class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-semibold rounded-lg hover:shadow-lg transition">
                        Request Withdrawal
                    </button>
                </div>

            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-amber-50 border-l-4 border-amber-500 rounded p-4">
            <p class="text-sm text-gray-700">
                <span class="font-semibold">Note:</span> Your withdrawal request will be reviewed and processed by the SACCO management within 1-2 business days. You will receive a notification once the withdrawal has been completed.
            </p>
        </div>

    </div>
</div>
@endsection

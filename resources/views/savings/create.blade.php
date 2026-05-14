{{-- resources/views/savings/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-8">
    <div class="max-w-xl mx-auto px-4">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Make a Deposit</h2>
            <p class="text-gray-600">Add funds to your savings account</p>
        </div>

        <!-- Deposit Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('savings.store') }}" class="space-y-6">
                @csrf

                <!-- Amount Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deposit Amount (KES)
                    </label>
                    <input type="number" 
                           name="amount"
                           step="0.01"
                           min="1"
                           placeholder="Enter amount to deposit"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500 transition"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Minimum deposit: KES 1</p>
                    
                    @error('amount')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-green-50 border-l-4 border-green-500 rounded p-4">
                    <p class="text-sm text-gray-700">
                        <span class="font-semibold">Secure Deposit:</span> Your deposit is safe with us and will be credited to your savings account immediately.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('member.savings') }}"
                       class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-semibold rounded-lg hover:shadow-lg transition">
                        Deposit Now
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
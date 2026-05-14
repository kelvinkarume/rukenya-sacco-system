@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Member Details: {{ $member->name }}</h2>

<div class="space-y-6">

    <!-- MEMBER INFO -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><strong>Name:</strong> {{ $member->name }}</p>
            <p><strong>Email:</strong> {{ $member->email }}</p>
            <p><strong>Phone:</strong> {{ $member->phone_number ?? 'N/A' }}</p>
            <p><strong>Home Place:</strong> {{ $member->home_place ?? 'N/A' }}</p>
            <p><strong>Role:</strong> {{ $member->role }}</p>
            <p><strong>Status:</strong> <span class="px-2 py-1 rounded text-xs font-semibold {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">{{ ucfirst($member->status ?? 'inactive') }}</span></p>
        </div>
    </div>

    <!-- LOANS -->
    <div class="bg-white p-6 rounded shadow overflow-x-auto">
        <h3 class="text-lg font-semibold mb-4">Loans</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $loan->id }}</td>
                        <td class="p-3">{{ number_format($loan->amount, 2) }}</td>
                        <td class="p-3">{{ $loan->status }}</td>
                        <td class="p-3">{{ $loan->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">No loans found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- SAVINGS -->
    <div class="bg-white p-6 rounded shadow overflow-x-auto">
        <h3 class="text-lg font-semibold mb-4">Savings</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($savings as $saving)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $saving->id }}</td>
                        <td class="p-3">{{ number_format($saving->amount, 2) }}</td>
                        <td class="p-3">{{ $saving->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-3 text-center text-gray-500">No savings found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- LOAN PAYMENTS -->
    <div class="bg-white p-6 rounded shadow overflow-x-auto">
        <h3 class="text-lg font-semibold mb-4">Loan Payments</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Loan ID</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loanPayments as $payment)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $payment->id }}</td>
                        <td class="p-3">{{ $payment->loan_id }}</td>
                        <td class="p-3">{{ number_format($payment->amount, 2) }}</td>
                        <td class="p-3">{{ $payment->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">No loan payments found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
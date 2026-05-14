@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-xl font-bold">
            Members Loan Payments Summary
        </h2>

    </div>

    <table class="w-full text-sm">

        <thead>
            <tr class="bg-gray-100">

                <th class="p-3 text-left">Member</th>
                <th class="p-3 text-left">Total Loans</th>
                <th class="p-3 text-left">Total Paid</th>
                <th class="p-3 text-left">Balance</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Last Payment</th>
                <th class="p-3 text-center">Action</th>

            </tr>
        </thead>

        <tbody>

            @forelse($members as $member)

                <tr class="border-b hover:bg-gray-50">

                    <!-- NAME -->
                    <td class="p-3 font-semibold">
                        {{ $member['name'] }}
                    </td>

                    <!-- TOTAL LOANS -->
                    <td class="p-3 text-blue-600">
                        KES {{ number_format($member['total_loans']) }}
                    </td>

                    <!-- TOTAL PAID -->
                    <td class="p-3 text-green-600">
                        KES {{ number_format($member['total_paid']) }}
                    </td>

                    <!-- BALANCE -->
                    <td class="p-3 text-red-600">
                        KES {{ number_format($member['balance']) }}
                    </td>

                    <!-- STATUS -->
                    <td class="p-3">
                        @if($member['status'] == 'Fully Paid')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
                                Fully Paid
                            </span>
                        @elseif($member['status'] == 'Partial')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">
                                Partial
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-semibold">
                                No Payments
                            </span>
                        @endif
                    </td>

                    <!-- LAST PAYMENT -->
                    <td class="p-3 text-gray-500">
                        {{ $member['last_payment']
                            ? \Carbon\Carbon::parse($member['last_payment'])->format('d M Y')
                            : 'N/A' }}
                    </td>

                    <!-- ACTION -->
                    <td class="p-3 text-center">

                        <a href="{{ route('admin.loans.repayments.details', $member['user_id']) }}"
                           class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">

                            View

                        </a>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        No payment records found
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-6">Loan Repayments Summary</h2>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead>
                <tr class="bg-gray-100 text-left border-b">
                    <th class="p-3">Member</th>
                    <th class="p-3">Total Paid</th>
                    <th class="p-3">Repayment Count</th>
                    <th class="p-3">Last Payment</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($members as $member)

                    <tr class="border-b hover:bg-gray-50">

                        <!-- MEMBER -->
                        <td class="p-3 font-medium text-gray-800">
                            {{ $member['name'] }}
                        </td>

                        <!-- TOTAL PAID -->
                        <td class="p-3 text-green-600 font-semibold">
                            KES {{ number_format($member['total_paid']) }}
                        </td>

                        <!-- COUNT -->
                        <td class="p-3 text-blue-600">
                            {{ $member['repayment_count'] }} times
                        </td>

                        <!-- LAST PAYMENT -->
                        <td class="p-3 text-gray-500">
                            {{ $member['last_payment'] ? \Carbon\Carbon::parse($member['last_payment'])->format('d M Y') : '-' }}
                        </td>

                        <!-- ACTION -->
                        <td class="p-3">
                            <a href="{{ route('admin.loans.repayments.details', $member['user_id']) }}"
                               class="text-sky-600 hover:underline">
                                View Details
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No repayments found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
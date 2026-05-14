@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- HEADER + TOTAL -->
    <div class="bg-white p-6 rounded shadow flex flex-col md:flex-row justify-between items-center">

        <h2 class="text-xl font-bold text-red-600">
            Overdue Loans
        </h2>

        <div class="text-center mt-4 md:mt-0">
            <p class="text-gray-500 text-sm">Total Overdue</p>
            <p class="text-3xl font-bold text-red-600">
                KES {{ number_format($totalOverdue) }}
            </p>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white p-6 rounded shadow">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3">Member</th>
                        <th class="p-3">Loans Count</th>
                        <th class="p-3">Total Overdue</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($members as $member)

                        <tr class="border-b hover:bg-gray-50">

                            <!-- MEMBER -->
                            <td class="p-3 font-medium text-gray-800">
                                {{ $member['name'] }}
                            </td>

                            <!-- COUNT -->
                            <td class="p-3 text-purple-600 font-semibold">
                                {{ $member['loans_count'] }}
                            </td>

                            <!-- BALANCE -->
                            <td class="p-3 text-red-600 font-bold">
                                KES {{ number_format($member['total_balance']) }}
                            </td>

                            <!-- ACTION -->
                            <td class="p-3 text-center">

                                <a href="{{ route('admin.loans.repayments.details', $member['user_id']) }}"
                                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">

                                    View

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                No overdue loans
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
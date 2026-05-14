@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <!-- HEADER -->
    <div class="mb-6">

        <h2 class="text-xl font-bold">
            Active Loans
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Members with currently active loans.
        </p>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead>

                <tr class="bg-gray-100 border-b">

                    <th class="p-3 text-left">
                        #
                    </th>

                    <th class="p-3 text-left">
                        Member Name
                    </th>

                    <th class="p-3 text-left">
                        Active Loans
                    </th>

                    <th class="p-3 text-left">
                        Total Balance
                    </th>

                    <th class="p-3 text-center">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @php
                    $activeLoans = $loans->where('status', 'approved')->groupBy('user_id');
                @endphp

                @forelse($activeLoans as $userId => $memberLoans)

                    @php
                        $member = $memberLoans->first()->user;
                        $totalBalance = $memberLoans->sum('balance');
                    @endphp

                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- NUMBER -->
                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>

                        <!-- MEMBER NAME -->
                        <td class="p-3 font-semibold text-gray-800">
                            {{ $member->name }}
                        </td>

                        <!-- TOTAL ACTIVE LOANS -->
                        <td class="p-3 text-blue-600 font-semibold">
                            {{ $memberLoans->count() }}
                        </td>

                        <!-- TOTAL BALANCE -->
                        <td class="p-3 text-red-600 font-semibold">
                            KES {{ number_format($totalBalance) }}
                        </td>

                        <!-- VIEW BUTTON -->
                        <td class="p-3 text-center">

                            <a href="{{ route('admin.loans.member', $member->id) }}"
                               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">

                                View Loans

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No active loans found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
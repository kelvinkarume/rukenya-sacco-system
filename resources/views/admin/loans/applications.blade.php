@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Loan Applications
        </h2>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full border-collapse">

            <!-- TABLE HEAD -->
            <thead>
                <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase">
                    <th class="p-3">Member</th>
                    <th class="p-3">Loan Type</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Date</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <!-- TABLE BODY -->
            <tbody>

                @forelse($loans as $loan)

                    <tr class="border-b hover:bg-gray-50">

                        <!-- MEMBER -->
                        <td class="p-3 font-semibold text-gray-800">
                            {{ $loan->user->name }}
                        </td>

                        <!-- LOAN TYPE -->
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm bg-purple-100 text-purple-700">
                                {{ ucfirst($loan->loan_type) }} Loan
                            </span>
                        </td>

                        <!-- AMOUNT -->
                        <td class="p-3 font-semibold text-gray-700">
                            KES {{ number_format($loan->amount) }}
                        </td>

                        <!-- STATUS -->
                        <td class="p-3">

                            @if($loan->status === 'pending')
                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>

                            @elseif($loan->status === 'approved')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                    Approved
                                </span>

                            @elseif($loan->status === 'active')
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                                    Active
                                </span>

                            @elseif($loan->status === 'rejected')
                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                                    Rejected
                                </span>

                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                    Unknown
                                </span>
                            @endif

                        </td>

                        <!-- DATE -->
                        <td class="p-3 text-sm text-gray-500">
                            {{ $loan->created_at->format('d M Y') }}
                        </td>

                        <!-- ACTIONS -->
                        <td class="p-3">

                            <div class="flex justify-center gap-2">

                                @if($loan->status === 'pending')

                                    <form method="POST" action="{{ route('admin.loans.approve', $loan->id) }}">
                                        @csrf
                                        <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                            Approve
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.loans.reject', $loan->id) }}">
                                        @csrf
                                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                            Reject
                                        </button>
                                    </form>

                                @endif

                                @if($loan->status === 'approved')

                                    <form method="POST" action="{{ route('admin.loans.disburse', $loan->id) }}">
                                        @csrf
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Disburse
                                        </button>
                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-500">
                            No loan applications found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-6">
        {{ $member->name }} Active Loans
    </h2>

    <table class="w-full text-sm">

        <thead>

            <tr class="bg-gray-100 border-b">

                <th class="p-3 text-left">
                    Loan ID
                </th>

                <th class="p-3 text-left">
                    Loan Amount
                </th>

                <th class="p-3 text-left">
                    Balance
                </th>

                <th class="p-3 text-left">
                    Status
                </th>

                <th class="p-3 text-left">
                    Date
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($loans as $loan)

                <tr class="border-b">

                    <td class="p-3">
                        #{{ $loan->id }}
                    </td>

                    <td class="p-3 text-green-600 font-semibold">
                        KES {{ number_format($loan->amount) }}
                    </td>

                    <td class="p-3 text-red-600 font-semibold">
                        KES {{ number_format($loan->balance) }}
                    </td>

                    <td class="p-3">

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ ucfirst($loan->status) }}
                        </span>

                    </td>

                    <td class="p-3 text-gray-500">
                        {{ $loan->created_at->format('d M Y') }}
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

@endsection
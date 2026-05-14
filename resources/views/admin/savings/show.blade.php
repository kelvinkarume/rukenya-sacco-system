@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    {{ $member->name }} Savings History
</h2>

<div class="bg-white p-6 rounded shadow">

    <!-- SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="p-4 bg-gray-50 rounded">
            <p class="text-gray-500 text-sm">Total Savings</p>
            <p class="text-xl font-bold text-green-600">
                KES {{ number_format($member->savings->sum('amount')) }}
            </p>
        </div>

        <div class="p-4 bg-gray-50 rounded">
            <p class="text-gray-500 text-sm">Number of Deposits</p>
            <p class="text-xl font-bold text-blue-600">
                {{ $member->savings->count() }}
            </p>
        </div>

        <div class="p-4 bg-gray-50 rounded">
            <p class="text-gray-500 text-sm">Last Deposit</p>
            <p class="text-xl font-bold text-gray-700">
                {{ optional($member->savings->sortByDesc('created_at')->first())->created_at?->format('d M Y') ?? 'N/A' }}
            </p>
        </div>

    </div>

    <!-- TABLE -->
    <table class="w-full text-sm border">

        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-left">Amount</th>
            </tr>
        </thead>

        <tbody>

            @forelse($member->savings as $saving)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $saving->created_at->format('d M Y H:i') }}
                    </td>

                    <td class="p-3 text-green-600 font-semibold">
                        KES {{ number_format($saving->amount) }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-3 text-center text-gray-500">
                        No savings found
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection
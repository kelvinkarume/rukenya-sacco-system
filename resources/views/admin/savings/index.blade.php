@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Savings Overview</h2>

<div class="bg-white p-6 rounded shadow overflow-x-auto">

    <table class="w-full text-sm">

        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3 text-left">Member</th>
                <th class="p-3 text-left">Total Savings</th>
                <th class="p-3 text-left">Deposits</th>
                <th class="p-3 text-left">Last Deposit</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($members as $member)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">{{ $member->name }}</td>

                    <td class="p-3 text-green-600 font-bold">
                        KES {{ number_format($member->total_savings) }}
                    </td>

                    <td class="p-3">
                        {{ $member->deposits_count }}
                    </td>

                    <td class="p-3">
                        {{ $member->last_deposit ? $member->last_deposit->format('d M Y') : 'N/A' }}
                    </td>

                    <td class="p-3">
                        <a href="{{ route('admin.savings.show', $member->id) }}"
                           class="text-blue-600 hover:underline">
                            View Details
                        </a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">
                        No savings data found
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
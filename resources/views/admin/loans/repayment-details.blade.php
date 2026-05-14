@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-6">Repayment Details</h2>

    <table class="w-full text-sm">

        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3">Loan ID</th>
                <th class="p-3">Amount</th>
                <th class="p-3">Balance After</th>
                <th class="p-3">Date</th>
            </tr>
        </thead>

        <tbody>

            @forelse($payments as $payment)

                <tr class="border-b">
                    <td class="p-3">#{{ $payment->loan_id }}</td>
                    <td class="p-3 text-green-600">
                        KES {{ number_format($payment->amount) }}
                    </td>
                    <td class="p-3 text-blue-600">
                        KES {{ number_format($payment->balance_after) }}
                    </td>
                    <td class="p-3 text-gray-500">
                        {{ $payment->created_at->format('d M Y') }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        No repayment records found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
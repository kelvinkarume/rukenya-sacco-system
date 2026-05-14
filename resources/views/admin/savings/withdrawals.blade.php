@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Withdrawal Requests</h2>

<!-- Alert Messages -->
@if ($message = Session::get('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- Withdrawal Requests Table -->
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b bg-gray-100">
                <th class="p-4 text-left font-semibold">Member Name</th>
                <th class="p-4 text-left font-semibold">Email</th>
                <th class="p-4 text-left font-semibold">Amount (KES)</th>
                <th class="p-4 text-left font-semibold">Requested Date</th>
                <th class="p-4 text-left font-semibold">Status</th>
                <th class="p-4 text-left font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($withdrawals as $withdrawal)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-semibold">{{ $withdrawal->user->name }}</td>
                    <td class="p-4">{{ $withdrawal->user->email }}</td>
                    <td class="p-4 text-orange-600 font-bold">KES {{ number_format(abs($withdrawal->amount), 2) }}</td>
                    <td class="p-4 text-gray-600">{{ $withdrawal->created_at->format('d M Y - H:i') }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                            Pending
                        </span>
                    </td>
                    <td class="p-4 flex gap-2">
                        <!-- Approve Button -->
                        <form action="{{ route('admin.savings.withdrawals.approve', $withdrawal->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition"
                                    onclick="return confirm('Approve withdrawal for {{ $withdrawal->user->name }}?')">
                                <i class="fas fa-check"></i> Approve
                            </button>
                        </form>

                        <!-- Reject Button -->
                        <form action="{{ route('admin.savings.withdrawals.reject', $withdrawal->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 transition"
                                    onclick="return confirm('Reject withdrawal for {{ $withdrawal->user->name }}?')">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        <i class="fas fa-inbox text-3xl mb-2 block text-gray-300"></i>
                        No pending withdrawal requests
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

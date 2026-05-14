@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TITLE -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Pending Actions
        </h1>

        <p class="text-gray-500 text-sm">
            Manage pending loan applications and withdrawal requests
        </p>
    </div>



    <!-- ALERTS -->
    @if(session('success'))
        <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="p-4 bg-blue-100 rounded">
            <p class="text-gray-700 font-semibold">Pending Loans</p>
            <p class="text-3xl font-bold text-blue-600">{{ $pendingLoans->count() }}</p>
        </div>
        <div class="p-4 bg-orange-100 rounded">
            <p class="text-gray-700 font-semibold">Pending Withdrawals</p>
            <p class="text-3xl font-bold text-orange-600">{{ $pendingWithdrawals->count() }}</p>
        </div>
    </div>

    <!-- PENDING LOANS -->
    @if($pendingLoans->count() > 0)
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-hand-holding-dollar text-blue-500 mr-2"></i>
                Pending Loan Applications
            </h2>

            <div class="space-y-4">
                @foreach($pendingLoans as $loan)
                    <div class="p-4 border rounded-lg bg-gray-50 flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">
                                {{ $loan->user->name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Loan Amount: <span class="font-bold text-blue-600">KES {{ number_format($loan->amount) }}</span>
                            </p>
                            <p class="text-xs text-gray-400">
                                Applied: {{ $loan->created_at->format('d M Y H:i') }}
                            </p>
                            @if($loan->loan_type)
                                <p class="text-xs text-gray-500">
                                    Type: {{ ucfirst($loan->loan_type) }}
                                </p>
                            @endif
                        </div>

                        <div class="flex space-x-2">
                            <form method="POST" action="{{ route('admin.notifications.approve-loan', $loan->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">
                                    <i class="fas fa-check mr-1"></i> Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.notifications.reject-loan', $loan->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition" onclick="return confirm('Reject this loan application?')">
                                    <i class="fas fa-times mr-1"></i> Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="p-6 bg-green-50 border border-green-200 rounded text-center text-green-700">
            <i class="fas fa-check-circle text-2xl mb-2"></i>
            <p>No pending loan applications</p>
        </div>
    @endif

    <!-- PENDING WITHDRAWALS -->
    @if($pendingWithdrawals->count() > 0)
        <div class="bg-white p-6 rounded shadow mt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-money-bill-wave text-orange-500 mr-2"></i>
                Pending Savings Withdrawals
            </h2>

            <div class="space-y-4">
                @foreach($pendingWithdrawals as $withdrawal)
                    <div class="p-4 border rounded-lg bg-gray-50 flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">
                                {{ $withdrawal->user->name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Withdrawal Amount: <span class="font-bold text-orange-600">KES {{ number_format($withdrawal->amount) }}</span>
                            </p>
                            <p class="text-xs text-gray-400">
                                Requested: {{ $withdrawal->created_at->format('d M Y H:i') }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Member Balance: KES {{ number_format($withdrawal->user->availableSavings() ?? 0) }}
                            </p>
                        </div>

                        <div class="flex space-x-2">
                            <form method="POST" action="{{ route('admin.notifications.approve-withdrawal', $withdrawal->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">
                                    <i class="fas fa-check mr-1"></i> Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.notifications.reject-withdrawal', $withdrawal->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition" onclick="return confirm('Reject this withdrawal request?')">
                                    <i class="fas fa-times mr-1"></i> Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="p-6 bg-green-50 border border-green-200 rounded text-center text-green-700 mt-6">
            <i class="fas fa-check-circle text-2xl mb-2"></i>
            <p>No pending withdrawal requests</p>
        </div>
    @endif

    <!-- ALL CLEAR -->
    @if($pendingLoans->count() === 0 && $pendingWithdrawals->count() === 0)
        <div class="p-8 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded text-center mt-6">
            <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
            <h3 class="text-xl font-bold text-green-700 mb-2">All Caught Up!</h3>
            <p class="text-gray-600">No pending actions at this time</p>
        </div>
    @endif

</div>

@endsection
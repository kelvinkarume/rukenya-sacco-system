@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">My Savings</h2>
            <p class="text-gray-500 text-sm">Track your contributions and deposits</p>
        </div>

    
       <div class="flex gap-3">
           <a href="{{ route('savings.create') }}"
              class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 flex items-center gap-2">
               <i class="fas fa-plus"></i> Deposit
           </a>
           <a href="{{ route('savings.withdraw') }}"
              class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 flex items-center gap-2">
               <i class="fas fa-arrow-up"></i> Withdraw
           </a>
       </div>

    </div>

    <!-- Total Savings Card -->
    <div class="mb-6 bg-white shadow rounded p-5">
        <p class="text-gray-500">Total Savings</p>
        <p class="text-2xl font-bold text-green-600">
            KES {{ number_format($total ?? 0) }}
        </p>
    </div>

    <!-- Savings List -->
    <div class="space-y-3">

        @forelse($savings as $saving)

            @if($saving->transaction_type === 'withdrawal' && $saving->status === 'pending')
                <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded flex justify-between items-center">

                    <!-- Left side -->
                    <div>
                        <p class="font-bold text-yellow-700">
                            <i class="fas fa-hourglass-half"></i> Withdrawal Pending Approval
                        </p>
                        <p class="text-sm text-gray-600">
                            Amount: KES {{ number_format(abs($saving->amount)) }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Requested: {{ $saving->created_at->format('d M Y - H:i') }}
                        </p>
                        <p class="text-xs text-gray-400">{{ $saving->description }}</p>
                    </div>

                    <!-- Right side badge -->
                    <div>
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap">
                            <i class="fas fa-clock"></i> Awaiting Approval
                        </span>
                    </div>

                </div>
            @else
                <div class="p-4 bg-white shadow rounded flex justify-between items-center">

                    <!-- Left side -->
                    <div>
                        <p class="font-bold text-gray-800">
                            <span class="{{ $saving->amount > 0 ? 'text-green-600' : 'text-orange-600' }}">
                                {{ $saving->amount > 0 ? '+' : '' }}KES {{ number_format(abs($saving->amount)) }}
                            </span>
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $saving->created_at->format('d M Y - H:i') }}
                        </p>
                        @if($saving->description && $saving->transaction_type !== 'withdrawal')
                            <p class="text-xs text-gray-400">{{ $saving->description }}</p>
                        @endif
                    </div>

                    <!-- Right side badge -->
                    <div>
                        @if($saving->amount > 0)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                Deposit
                            </span>
                        @else
                            <div class="space-y-2">
                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Withdrawal
                                </span>
                                @if($saving->status === 'pending')
                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Pending Approval
                                    </span>
                                @elseif($saving->status === 'approved')
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Approved
                                    </span>
                                @elseif($saving->status === 'rejected')
                                    <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Rejected
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>

                </div>
            @endif

        @empty

            <div class="bg-white shadow rounded p-6 text-center text-gray-500">
                No savings recorded yet. Start by making a deposit.
            </div>

        @endforelse

    </div>

</div>
@endsection
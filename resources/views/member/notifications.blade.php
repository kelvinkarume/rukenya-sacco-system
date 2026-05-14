@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- TITLE -->
    <div>
        <h1 class="text-2xl font-bold text-white">
            Notifications
        </h1>

        <p class="text-slate-400 text-sm">
            All SACCO notifications and updates
        </p>
    </div>

    <!-- NOTIFICATIONS -->
    <div class="space-y-4">

       @foreach($notifications as $notification)

<div class="p-4 mb-3 rounded-xl shadow bg-white flex justify-between items-center">

    <div>
        <h3 class="font-bold">{{ $notification->title }}</h3>
        <p class="text-sm text-gray-600">{{ $notification->message }}</p>
    </div>

    @if(!$notification->is_read)
        <a href="{{ route('member.notifications.read', $notification->id) }}"
           class="text-sm text-blue-600 hover:underline">
            Mark as read
        </a>
    @else
        <span class="text-green-500 text-sm font-semibold">
            Read
        </span>
    @endif

</div>

@endforeach

    </div>

</div>

@endsection
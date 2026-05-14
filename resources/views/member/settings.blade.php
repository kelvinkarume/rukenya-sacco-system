@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <!-- PROFILE CARD -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-4">Profile Settings</h2>

        <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="flex items-center gap-4 mb-4">

                <img src="{{ auth()->user()->profile_image 
                    ? asset('uploads/'.auth()->user()->profile_image) 
                    : 'https://ui-avatars.com/api/?name='.auth()->user()->name }}"
                    class="w-16 h-16 rounded-full border">

                <input type="file" name="profile_image">
            </div>

            <input type="text" name="name"
                   value="{{ auth()->user()->name }}"
                   class="w-full border p-3 rounded mb-3">

            <input type="text" name="phone"
                   value="{{ auth()->user()->phone }}"
                   class="w-full border p-3 rounded mb-3">

            <button class="bg-emerald-600 text-white px-5 py-2 rounded">
                Update Profile
            </button>

        </form>
    </div>

    <!-- PASSWORD -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-4">Change Password</h2>

        <form method="POST" action="{{ route('member.password.change') }}">
            @csrf

            <input type="password" name="current_password"
                   placeholder="Current Password"
                   class="w-full border p-3 rounded mb-3">

            <input type="password" name="new_password"
                   placeholder="New Password"
                   class="w-full border p-3 rounded mb-3">

            <input type="password" name="new_password_confirmation"
                   placeholder="Confirm Password"
                   class="w-full border p-3 rounded mb-3">

            <button class="bg-blue-600 text-white px-5 py-2 rounded">
                Change Password
            </button>

        </form>
    </div>

    <!-- NOTIFICATIONS -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-4">Notification Preferences</h2>

        <form method="POST" action="#">
            @csrf

            <label class="flex items-center gap-2">
                <input type="checkbox" checked>
                Email Notifications
            </label>

            <label class="flex items-center gap-2 mt-2">
                <input type="checkbox" checked>
                SMS Notifications
            </label>

            <button class="mt-4 bg-purple-600 text-white px-5 py-2 rounded">
                Save Preferences
            </button>

        </form>

    </div>

    <!-- ACTIVITY LOG -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-4">Activity Log</h2>

        @foreach(\App\Models\ActivityLog::where('user_id', auth()->id())->latest()->get() as $log)

            <div class="border-b py-2 text-sm">
                <p class="font-semibold">{{ $log->action }}</p>
                <p class="text-gray-500">{{ $log->created_at }}</p>
            </div>

        @endforeach

    </div>

</div>

@endsection
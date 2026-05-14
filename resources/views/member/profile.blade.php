@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    @php
        $user = auth()->user();
    @endphp

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            My Profile
        </h2>
        <p class="text-sm text-gray-500">
            Manage your account information
        </p>
    </div>

    <!-- PROFILE CARD -->
    <div class="bg-white shadow rounded-xl p-6 flex flex-col md:flex-row gap-6">

        <!-- IMAGE -->
        <div class="flex flex-col items-center">

            <img
                src="{{ $user->profile_image 
                    ? asset('uploads/' . $user->profile_image)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                class="w-28 h-28 rounded-full border"
            >

            <p class="mt-2 text-sm font-semibold text-gray-800">
                {{ $user->name }}
            </p>

            <p class="text-xs text-gray-500">
                SACCO Member
            </p>
        </div>

        <!-- FORM -->
        <div class="flex-1">

            <form method="POST"
                  action="{{ route('member.profile.update') }}"
                  enctype="multipart/form-data"
                  class="space-y-4">

                @csrf

                <!-- NAME -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Full Name</label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full border p-2 rounded focus:ring focus:border-emerald-500"
                           required>
                </div>

                <!-- PHONE -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Phone</label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $user->phone) }}"
                           class="w-full border p-2 rounded focus:ring focus:border-emerald-500">
                </div>

                <!-- IMAGE -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Profile Image</label>

                    <input type="file"
                           name="profile_image"
                           class="w-full border p-2 rounded">
                </div>

                <!-- BUTTON -->
                <button class="bg-emerald-600 text-white px-5 py-2 rounded hover:bg-emerald-700 transition">
                    Update Profile
                </button>

            </form>

        </div>

    </div>

</div>
@endsection
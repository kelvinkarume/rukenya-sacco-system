@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">All Members</h2>

<div class="bg-white p-6 rounded shadow overflow-x-auto">

    <table class="w-full text-sm">

        <thead>
            <tr class="border-b bg-gray-100">
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Phone</th>
                <th class="p-3 text-left">Home Place</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($members as $member)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">{{ $member->name }}</td>
                    <td class="p-3">{{ $member->email }}</td>
                    <td class="p-3">{{ $member->phone_number ?? 'N/A' }}</td>
                    <td class="p-3">{{ $member->home_place ?? 'N/A' }}</td>

                    <!-- STATUS -->
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            {{ $member->status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-600' }}">
                            {{ ucfirst($member->status ?? 'inactive') }}
                        </span>
                    </td>

                    <!-- ACTION -->
                    <td class="p-3 flex gap-2 items-center">

                        <!-- VIEW -->
                        <a href="{{ route('admin.members.show', $member->id) }}"
                           class="text-blue-600 hover:underline text-sm">
                            View
                        </a>
<form action="{{ route('admin.members.toggle', $member->id) }}" method="POST">
    @csrf

    <button type="submit"
        class="px-3 py-1 rounded text-white text-xs
        {{ $member->status === 'active'
            ? 'bg-red-500 hover:bg-red-600'
            : 'bg-green-500 hover:bg-green-600' }}">

        {{ $member->status === 'active' ? 'Deactivate' : 'Activate' }}

    </button>
</form>

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-3 text-center text-gray-500">
                        No members found
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
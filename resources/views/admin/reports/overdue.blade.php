@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TITLE -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Overdue Reports
        </h1>
        <p class="text-gray-500 text-sm">
            Detailed report of overdue loans.
        </p>
    </div>

    <!-- FILTERS AND EXPORT -->
    <div class="bg-white p-4 rounded shadow">
        <form method="GET" class="flex flex-wrap gap-4 items-center">
            <div>
                <label class="block text-sm font-medium text-gray-700">Month</label>
                <select name="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="all" {{ $month == 'all' ? 'selected' : '' }}>All Months</option>
                    <option value="1" {{ $month == '1' ? 'selected' : '' }}>January</option>
                    <option value="2" {{ $month == '2' ? 'selected' : '' }}>February</option>
                    <option value="3" {{ $month == '3' ? 'selected' : '' }}>March</option>
                    <option value="4" {{ $month == '4' ? 'selected' : '' }}>April</option>
                    <option value="5" {{ $month == '5' ? 'selected' : '' }}>May</option>
                    <option value="6" {{ $month == '6' ? 'selected' : '' }}>June</option>
                    <option value="7" {{ $month == '7' ? 'selected' : '' }}>July</option>
                    <option value="8" {{ $month == '8' ? 'selected' : '' }}>August</option>
                    <option value="9" {{ $month == '9' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ $month == '10' ? 'selected' : '' }}>October</option>
                    <option value="11" {{ $month == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ $month == '12' ? 'selected' : '' }}>December</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="bg-red-500 text-white px-4 py-2 rounded">Export PDF</a>
                <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="bg-green-500 text-white px-4 py-2 rounded">Export CSV</a>
            </div>
        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-1/3 text-left">Member Name</th>
                    <th class="px-4 py-2 w-1/4 text-left">Loans Count</th>
                    <th class="px-4 py-2 w-1/4 text-left">Total Overdue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($overdueMembers as $member)
                <tr>
                    <td class="px-4 py-2 text-left">{{ $member['name'] }}</td>
                    <td class="px-4 py-2 text-left">{{ $member['loans_count'] }}</td>
                    <td class="px-4 py-2 text-left text-red-600 font-semibold">KES {{ number_format($member['total_balance']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- CHART -->
    <div class="bg-white p-4 rounded shadow">
        <canvas id="overdueChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('overdueChart').getContext('2d');
    const overdueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Overdue Loans',
                data: @json($data),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
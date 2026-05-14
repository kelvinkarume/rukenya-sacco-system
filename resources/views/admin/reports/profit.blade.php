@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- TITLE -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Profit Reports
        </h1>
        <p class="text-gray-500 text-sm">
            Detailed report of total profits.
        </p>
    </div>

    <!-- SUMMARY -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold">Total Profit: KES {{ number_format($totalProfit) }}</h3>
    </div>

    <!-- CHART -->
    <div class="bg-white p-4 rounded shadow">
        <canvas id="profitChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('profitChart').getContext('2d');
    const profitChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Profit Distribution',
                data: @json($data),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(199, 199, 199, 0.2)',
                    'rgba(83, 102, 255, 0.2)',
                    'rgba(255, 99, 255, 0.2)',
                    'rgba(99, 255, 132, 0.2)',
                    'rgba(255, 132, 99, 0.2)',
                    'rgba(132, 99, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(199, 199, 199, 1)',
                    'rgba(83, 102, 255, 1)',
                    'rgba(255, 99, 255, 1)',
                    'rgba(99, 255, 132, 1)',
                    'rgba(255, 132, 99, 1)',
                    'rgba(132, 99, 255, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>

@endsection
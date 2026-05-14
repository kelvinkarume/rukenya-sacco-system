@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- ===================== -->
    <!-- TITLE -->
    <!-- ===================== -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Rukenya Financial Overview & System Intelligence
        </h1>
        <p class="text-gray-500 text-sm">
            
        </p>
    </div>

    <!-- ===================== -->
    <!-- TOP CARDS -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">

        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-gray-500 text-sm">Members</p>
            <h2 class="text-xl font-bold text-blue-600">{{ $totalMembers }}</h2>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-gray-500 text-sm">Savings</p>
            <h2 class="text-xl font-bold text-green-600">
                KES {{ number_format($totalSavings) }}
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-gray-500 text-sm">Loans Issued</p>
            <h2 class="text-xl font-bold text-purple-600">
                KES {{ number_format($totalLoans) }}
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-gray-500 text-sm">Outstanding</p>
            <h2 class="text-xl font-bold text-red-500">
                KES {{ number_format($outstandingLoans) }}
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-gray-500 text-sm">Repayments</p>
            <h2 class="text-xl font-bold text-indigo-600">
                KES {{ number_format($totalRepayments) }}
            </h2>
        </div>

        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-gray-500 text-sm">Profit</p>
            <h2 class="text-xl font-bold text-yellow-600">
                KES {{ number_format($profit) }}
            </h2>
        </div>

    </div>

    <!-- ===================== -->
    <!-- QUICK STATS -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-bold text-gray-700 mb-2">Recent Members (7 Days)</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $recentMembers }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-bold text-gray-700 mb-2">Pending Loans</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $pendingLoans }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="font-bold text-gray-700 mb-2">Top Savers</h3>
            <p class="text-3xl font-bold text-green-600">{{ $topSavers }}</p>
        </div>

    </div>

    <!-- ===================== -->
    <!-- CHARTS SECTION -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- PIE CHART -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold text-gray-700 mb-3">Loan Portfolio Distribution</h3>
            <canvas id="loanPieChart" height="250"></canvas>
        </div>

        <!-- BAR CHART -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold text-gray-700 mb-3">Financial Overview</h3>
            <canvas id="financialBarChart" height="250"></canvas>
        </div>

        <!-- LINE CHART -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold text-gray-700 mb-3">Monthly Repayments Trend</h3>
            <canvas id="repaymentLineChart" height="250"></canvas>
        </div>

    </div>

    <!-- ===================== -->
    <!-- INSIGHT BOX -->
    <!-- ===================== -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded shadow">

        <h2 class="text-lg font-bold mb-2">SACCO Insight Engine</h2>

        <p class="text-sm opacity-90">
            Profit is generated from loan interest (12%). A healthy SACCO should maintain:
        </p>

        <ul class="mt-3 text-sm list-disc ml-5 space-y-1">
            <li>Low default loan rate</li>
            <li>High savings-to-loan ratio</li>
            <li>Consistent member deposits</li>
        </ul>

    </div>

</div>

<!-- ===================== -->
<!-- CHART JS -->
<!-- ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ================= PIE CHART =================
    new Chart(document.getElementById('loanPieChart'), {
        type: 'pie',
        data: {
            labels: ['Active', 'Pending', 'Rejected', 'Completed'],
            datasets: [{
                data: [
                    {{ $loanStats[0] }},
                    {{ $loanStats[1] }},
                    {{ $loanStats[2] }},
                    {{ $loanStats[3] }}
                ],
                backgroundColor: ['#3B82F6', '#FACC15', '#EF4444', '#22C55E']
            }]
        }
    });

    // ================= BAR CHART =================
    new Chart(document.getElementById('financialBarChart'), {
        type: 'bar',
        data: {
            labels: ['Savings', 'Loans', 'Repayments', 'Profit'],
            datasets: [{
                label: 'KES',
                data: @json($financialData),
                backgroundColor: ['#22C55E', '#8B5CF6', '#6366F1', '#F59E0B']
            }]
        }
    });

    // ================= LINE CHART =================
    new Chart(document.getElementById('repaymentLineChart'), {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Repayments',
                data: @json($monthlyRepayments),
                borderColor: '#3B82F6',
                fill: false,
                tension: 0.4
            }]
        }
    });

});
</script>

@endsection
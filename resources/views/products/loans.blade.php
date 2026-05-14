<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Products - Rukenya SACCO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<div class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-sky-500">Rukenya SACCO</h1>

    <a href="{{ route('home') }}" class="text-sky-500 hover:underline">
        ← Back Home
    </a>
</div>

<!-- HEADER -->
<div class="bg-sky-500 text-white text-center py-12">
    <h2 class="text-4xl font-bold">Loan Products</h2>
    <p class="mt-2 text-lg">
        Empowering members with smart, fast and affordable financial solutions
    </p>
</div>

<!-- INTRO -->
<div class="p-10 text-center max-w-3xl mx-auto">
    <h3 class="text-2xl font-bold text-gray-800 mb-3">
        Choose the Right Loan for Your Financial Journey
    </h3>

    <p class="text-gray-600">
        At Rukenya SACCO, we believe financial empowerment starts with access to the right credit.
        Our loan products are designed to support your personal growth, business expansion, and emergency needs
        with flexible repayment plans and low interest rates.
    </p>
</div>

<!-- LOAN CARDS -->
<div class="px-10 pb-16 grid md:grid-cols-3 gap-6">

    <!-- PERSONAL LOAN -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-sky-400">

        <h3 class="text-lg font-bold text-sky-500 mb-3">
            Personal Loan
        </h3>

        <p class="text-gray-600 text-sm mb-3">
            Designed to support your everyday financial needs such as school fees, rent, medical bills,
            or personal development goals.
        </p>

        <ul class="text-sm text-gray-600 space-y-2">
            <li> Fast approval process</li>
            <li> Flexible repayment plans</li>
            <li> Low interest rates for members</li>
        </ul>

        <p class="mt-4 text-xs text-gray-500">
            Ideal for members seeking financial stability and personal growth without stress.
        </p>
    </div>

    <!-- BUSINESS LOAN -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-sky-400">

        <h3 class="text-lg font-bold text-sky-500 mb-3">
            Business Loan
        </h3>

        <p class="text-gray-600 text-sm mb-3">
            Fuel your business ambitions with capital for stock, expansion, equipment, or startup funding.
        </p>

        <ul class="text-sm text-gray-600 space-y-2">
            <li> High loan limits for SMEs</li>
            <li> Business growth support</li>
            <li> Structured repayment terms</li>
        </ul>

        <p class="mt-4 text-xs text-gray-500">
            Perfect for entrepreneurs looking to scale and increase income sustainably.
        </p>
    </div>

    <!-- EMERGENCY LOAN -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-sky-400">

        <h3 class="text-lg font-bold text-sky-500 mb-3">
            Emergency Loan
        </h3>

        <p class="text-gray-600 text-sm mb-3">
            Quick financial support for urgent situations such as hospital bills, accidents, or unexpected expenses.
        </p>

        <ul class="text-sm text-gray-600 space-y-2">
            <li> Instant processing</li>
            <li> Minimal requirements</li>
            <li> Disbursed within short time</li>
        </ul>

        <p class="mt-4 text-xs text-gray-500">
            Ensures members are financially protected during emergencies.
        </p>
    </div>

</div>

</body>
</html>
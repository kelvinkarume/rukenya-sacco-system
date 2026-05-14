<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Savings Products - Rukenya SACCO</title>

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
    <h2 class="text-4xl font-bold">Savings Products</h2>
    <p class="mt-2 text-lg">
        Build wealth step by step with secure and rewarding savings solutions
    </p>
</div>

<!-- INTRO -->
<div class="p-10 text-center max-w-3xl mx-auto">
    <h3 class="text-2xl font-bold text-gray-800 mb-3">
        Start Small. Grow Big. Secure Your Financial Future.
    </h3>

    <p class="text-gray-600">
        Saving is the foundation of financial freedom. At Rukenya SACCO, we empower members to cultivate disciplined savings habits,
        earn competitive returns, and achieve long-term financial stability through structured savings products.
    </p>
</div>

<!-- SAVINGS PRODUCTS -->
<div class="px-10 pb-16 grid md:grid-cols-3 gap-6">

    <!-- REGULAR SAVINGS -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-sky-400">

        <h3 class="text-lg font-bold text-sky-500 mb-3">
            Regular Savings
        </h3>

        <p class="text-gray-600 text-sm mb-3">
            A flexible savings account designed for daily financial discipline. Deposit anytime and withdraw when needed
            while still growing your financial base.
        </p>

        <ul class="text-sm text-gray-600 space-y-2">
            <li> Flexible deposits anytime</li>
            <li> Easy withdrawals when needed</li>
            <li> Encourages financial discipline</li>
        </ul>

        <p class="mt-4 text-xs text-gray-500">
            Perfect for members building a consistent savings habit.
        </p>
    </div>

    <!-- FIXED DEPOSIT -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-sky-400">

        <h3 class="text-lg font-bold text-sky-500 mb-3">
            Fixed Deposit
        </h3>

        <p class="text-gray-600 text-sm mb-3">
            Lock your funds for a fixed period and enjoy higher, guaranteed returns.
            Ideal for members looking to grow wealth safely and predictably.
        </p>

        <ul class="text-sm text-gray-600 space-y-2">
            <li> Higher interest rates</li>
            <li> Safe and guaranteed returns</li>
            <li> Ideal for long-term planning</li>
        </ul>

        <p class="mt-4 text-xs text-gray-500">
            Best for members focusing on long-term wealth creation.
        </p>
    </div>

    <!-- TARGET SAVINGS -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-sky-400">

        <h3 class="text-lg font-bold text-sky-500 mb-3">
            Target Savings
        </h3>

        <p class="text-gray-600 text-sm mb-3">
            Save with a purpose. Whether it's school fees, land purchase, or business investment,
            this plan helps you achieve your financial goals step by step.
        </p>

        <ul class="text-sm text-gray-600 space-y-2">
            <li> Goal-based savings tracking</li>
            <li> Motivates financial discipline</li>
            <li> Supports life milestones</li>
        </ul>

        <p class="mt-4 text-xs text-gray-500">
            Ideal for members working towards specific financial goals.
        </p>
    </div>

</div>

</body>
</html>
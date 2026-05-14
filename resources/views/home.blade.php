<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rukenya SACCO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<div class="bg-white shadow fixed w-full z-50">

    <div class="flex justify-between items-center px-6 py-4">

        <a href="{{ route('home') }}" class="text-xl font-bold text-sky-500">
            RUKENYA SACCO
        </a>

        <div class="hidden md:flex gap-6 items-center">

            <a href="{{ route('home') }}" class="text-sky-500 font-semibold">Home</a>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-sky-500">
                    Products
                </button>

                <div x-show="open" @click.away="open=false"
                     class="absolute bg-white shadow rounded mt-2 w-48">

                     <a href="{{ route('products.savings') }}"
           @click="open = false"
           class="block px-4 py-2 hover:bg-gray-100">
            Savings Products
        </a>

        <a href="{{ route('products.loans') }}"
           @click="open = false"
           class="block px-4 py-2 hover:bg-gray-100">
            Loan Products
        </a>
                </div>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-sky-500">
                    About Us
                </button>

                <div x-show="open" @click.away="open=false"
                     class="absolute bg-white shadow rounded mt-2 w-56">

                    <a href="{{ route('about.who-we-are') }}"
           class="block px-4 py-2 hover:bg-gray-100">
            Who We Are
        </a>

        <a href="{{ route('about.our-journey') }}"
           class="block px-4 py-2 hover:bg-gray-100">
            Our Journey
        </a>

        <a href="{{ route('about.board') }}"
           class="block px-4 py-2 hover:bg-gray-100">
            Board of Directors
        </a>

        <a href="{{ route('about.management') }}"
           class="block px-4 py-2 hover:bg-gray-100">
            Management Team
        </a>

        <a href="{{ route('about.members') }}"
           class="block px-4 py-2 hover:bg-gray-100">
            Members
        </a>

                </div>
            </div>

        </div>

        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">Sign Up</a>
        </div>

    </div>
</div>

<!-- ================= HERO ================= -->
<div class="pt-20 bg-gradient-to-r from-sky-500 to-blue-600 text-white">

    <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">

        <div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Grow Your Money with <br> Rukenya SACCO
            </h1>

            <p class="text-lg mb-6 text-blue-100">
                Smart savings. Affordable loans. Real financial growth.
                Join a SACCO that puts members first and empowers your future.
            </p>

            <div class="flex gap-4">
                <a href="{{ route('register') }}"
                   class="bg-white text-blue-600 px-6 py-3 rounded font-semibold hover:bg-gray-100">
                    Get Started
                </a>

                <a href="#services"
                   class="border border-white px-6 py-3 rounded hover:bg-white hover:text-blue-600">
                    Learn More
                </a>
            </div>
        </div>

        <!-- IMAGE -->
        <div>
            <img src="/images/sacco.png" class="rounded-xl shadow-lg">
        </div>

    </div>

</div>

<!-- ================= STATS ================= -->
<div class="bg-white py-10 shadow">

    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 text-center">

        <div>
            <h2 class="text-2xl font-bold text-sky-500">1,200+</h2>
            <p class="text-gray-500">Members</p>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-green-500">KES 12M+</h2>
            <p class="text-gray-500">Total Savings</p>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-purple-500">KES 8M+</h2>
            <p class="text-gray-500">Loans Issued</p>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-yellow-500">KES 2M+</h2>
            <p class="text-gray-500">Interest Earned</p>
        </div>

    </div>

</div>

<!-- ================= ABOUT ================= -->
<div class="py-16 px-6 text-center bg-gray-100">

    <h2 class="text-3xl font-bold text-sky-500 mb-4">
        About Rukenya SACCO
    </h2>

    <p class="max-w-3xl mx-auto text-gray-600 leading-relaxed">
        Rukenya SACCO is a member-driven financial institution dedicated to improving
        financial well-being through structured savings, affordable credit facilities,
        and long-term wealth creation. Our mission is to empower individuals and
        communities with accessible financial solutions that drive sustainable growth.
    </p>

</div>

<!-- ================= SERVICES ================= -->
<div id="services" class="py-16 px-6 bg-white">

    <h2 class="text-3xl font-bold text-center text-sky-500 mb-10">
        Our Services
    </h2>

    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8">

        <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-bold text-sky-500 mb-2">Open Account</h3>
            <p class="text-gray-600">
                Register as a member and start building your financial future today.
            </p>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-bold text-sky-500 mb-2">Savings Plans</h3>
            <p class="text-gray-600">
                Flexible saving options designed to grow your money securely.
            </p>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-bold text-sky-500 mb-2">Loan Services</h3>
            <p class="text-gray-600">
                Access fast and affordable loans tailored to your needs.
            </p>
        </div>

    </div>

</div>

<!-- ================= CTA ================= -->
<div class="bg-sky-500 text-white py-16 text-center">

    <h2 class="text-3xl font-bold mb-4">
        Ready to Transform Your Financial Future?
    </h2>

    <p class="mb-6 text-blue-100">
        Join Rukenya SACCO today and take control of your financial journey.
    </p>

    <a href="{{ route('register') }}"
       class="bg-white text-sky-600 px-6 py-3 rounded font-semibold hover:bg-gray-100">
        Join Now
    </a>

</div>

<!-- ================= FOOTER ================= -->
<div class="bg-gray-900 text-white text-center py-6 text-sm">
    © {{ date('Y') }} Rukenya SACCO. All rights reserved.
</div>

</body>
</html>
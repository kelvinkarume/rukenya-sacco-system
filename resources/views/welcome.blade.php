<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RUKENYA SACCO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<div class="bg-white shadow fixed w-full z-50">

    <div class="flex justify-between items-center px-6 py-4">

        <h1 class="text-xl font-bold text-sky-500">
            RUKENYA SACCO
        </h1>

        <div class="hidden md:flex gap-6 items-center">

            <a href="{{ route('home') }}" class="hover:text-sky-500">
              Home
              </a>

            <!-- PRODUCTS -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-sky-500">
                    Products 
                </button>

               
    </button>

    <div x-show="open"
         x-transition
         @click.outside="open = false"
         class="absolute bg-white shadow rounded mt-2 w-48 z-50">

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

           <!-- ABOUT -->
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

            <a href="{{ route('login') }}"
               class="px-4 py-2 border rounded hover:bg-gray-100">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                Sign Up
            </a>

        </div>

    </div>
</div>

<!-- ================= HERO SLIDER ================= -->
<div x-data="{
    images: [
        '/images/board.png',
        '/images/sacco.png',
        '/images/money.png',
        '/images/coins.png'
    ],
    current: 0
}"
x-init="setInterval(() => current = (current + 1) % images.length, 8000)"
class="pt-20">

    <div class="relative h-[80vh] overflow-hidden">

        <template x-for="(image, index) in images" :key="index">

            <div
                x-show="current === index"
                class="absolute inset-0 bg-cover bg-center"
                :style="'background-image: url(' + image + ')'">

                <!-- LIGHT OVERLAY -->
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>

                <!-- TEXT -->
                <div class="relative z-10 flex flex-col justify-center items-center h-full text-white text-center px-4">

                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        Join Rukenya SACCO and grow your financial future
                    </h2>

                    <p class="max-w-xl text-lg">
                        Save smarter, access affordable loans, and build wealth with us.
                    </p>

                </div>

            </div>

        </template>

    </div>

</div>

<!-- ================= WELCOME SECTION ================= -->
<div class="p-10 bg-white text-center">

    <h2 class="text-3xl font-bold text-sky-500 mb-4">
        Welcome to Rukenya SACCO
    </h2>

    <p class="max-w-2xl mx-auto text-gray-600">
        Rukenya SACCO empowers members through smart savings, accessible loans, and financial growth opportunities designed for long-term stability.
    </p>

</div>

<!-- ================= SERVICES ================= -->
<div class="p-10 bg-gray-100">

    <h2 class="text-2xl font-bold text-center text-sky-500 mb-8">
        Key Services
    </h2>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded shadow text-center border-t-4 border-sky-400">
            <h3 class="font-bold text-lg mb-2 text-sky-500">Open Account</h3>
            <p class="text-gray-600 text-sm">
                Join SACCO and start your financial journey.
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center border-t-4 border-sky-400">
            <h3 class="font-bold text-lg mb-2 text-sky-500">Save With Us</h3>
            <p class="text-gray-600 text-sm">
                Secure savings with growth opportunities.
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center border-t-4 border-sky-400">
            <h3 class="font-bold text-lg mb-2 text-sky-500">Get Loan</h3>
            <p class="text-gray-600 text-sm">
                Quick and affordable loans anytime.
            </p>
        </div>

    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukenya SACCO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/alpinejs" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* This prevents Alpine components from flickering on page load */
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-100 overflow-x-hidden">

<div
    x-data="{
        menuOpen: false,
        loanOpen: false, 
        savingsOpen: false,
        reportsOpen: false,
        profileOpen: false
    }"
    class="min-h-screen flex"
>

    <div
        x-show="menuOpen"
        x-transition.opacity
        @click="menuOpen = false"
        x-cloak
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <aside
        class="fixed lg:fixed top-0 left-0 h-screen overflow-y-auto w-72 bg-gradient-to-b from-amber-700 via-yellow-700 to-orange-800 border-slate-800 shadow-2xl z-50 transform transition-all duration-300"
        :class="menuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >

        <div class="px-6 py-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-400 to-cyan-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-building-columns text-xl text-white"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg tracking-wide">
                        Rukenya SACCO
                    </h1>
                    <p class="text-xs text-emerald-500">
                        Smart Fintech Banking
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5">
            <div class="bg-white border border-slate-200 rounded-3xl p-4 shadow-xl">
                <div class="flex items-center gap-3">
                    <img
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0f172a&color=fff"
                        class="w-14 h-14 rounded-2xl border-2 border-emerald-500"
                    >
                    <div>
                        <h3 class="font-semibold text-sm text-slate-800">
                            Welcome {{ auth()->user()->name }}
                        </h3>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4">
                    <div class="bg-slate-100 rounded-2xl p-3">
                        <p class="text-xs text-slate-500">Savings</p>
                        <h3 class="font-bold text-emerald-500">
                            KES {{ number_format(auth()->user()->availableSavings() ?? 0) }}
                        </h3>
                    </div>
                    <div class="bg-slate-100 rounded-2xl p-3">
    <p class="text-xs text-slate-500">
        Loans
    </p>

    <h3 class="font-bold text-cyan-500">
        KES {{ number_format(
            auth()->user()->loans()
                ->whereIn('status', ['approved', 'active'])
                ->sum('balance')
        ) }}
    </h3>
</div>
                </div>
            </div>
        </div>

        <div class="px-4 pb-10 space-y-2">
            <p class="text-xs uppercase text-emerald-600 px-3 mb-2 tracking-widest text-left font-semibold">
                Main Menu
            </p>

            <a href="{{ route('member.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-gradient-to-r from-emerald-500 to-cyan-500 text-white shadow-lg hover:scale-[1.02] transition-all duration-300">
                <i class="fas fa-gauge"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <div>
                <button
                    @click="savingsOpen = !savingsOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800 transition-all duration-300 group"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <span class="font-medium">Savings</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                       :class="savingsOpen ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="savingsOpen" x-cloak x-transition class="ml-5 mt-2 space-y-2 border-l border-slate-700 pl-4">
                    <a href="{{ route('member.savings') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Save Money</a>
                    <a href="{{ route('member.savings') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Total Savings</a>
                    <a href="{{ route('savings.withdraw') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Withdraw Savings</a>
                </div>
            </div>

            <div>
                <button
                    @click="loanOpen = !loanOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800 transition-all duration-300"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fas fa-hand-holding-dollar"></i>
                        </div>
                        <span class="font-medium">Loans</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                       :class="loanOpen ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="loanOpen" x-cloak x-transition class="ml-5 mt-2 space-y-2 border-l border-slate-700 pl-4">
                    <a href="{{ route('member.loans') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Apply Loan</a>
                    <a href="{{ route('member.loans') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Repay Loan</a>
                    <a href="{{ route('member.loans.history') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Loan History</a>
                    <a href="#" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Guarantors</a>
                </div>
            </div>

            <div>
                <button
                    @click="reportsOpen = !reportsOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800 transition-all duration-300"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center text-purple-400">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="font-medium">Reports</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                       :class="reportsOpen ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="reportsOpen" x-cloak x-transition class="ml-5 mt-2 space-y-2 border-l border-slate-700 pl-4">
                    <a href="{{ route('member.reports') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Weekly Report</a>
                    <a href="{{ route('member.reports') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Monthly Report</a>
                    <a href="{{ route('member.reports') }}" class="block py-2 px-3 rounded-xl hover:bg-slate-800 text-sm text-slate-300 transition">Annual Report</a>
                </div>
            </div>

            <p class="text-xs uppercase text-emerald-600 px-3 mt-6 mb-2 tracking-widest text-left">Others</p>

            <a href="{{ route('member.notifications') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition-all">
                <div class="w-10 h-10 rounded-xl bg-yellow-500/20 flex items-center justify-center text-yellow-400">
                    <i class="fas fa-bell"></i>
                </div>
                <span>Notifications</span>
            </a>

            <a href="{{ route('member.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition-all">
                <div class="w-10 h-10 rounded-xl bg-pink-500/20 flex items-center justify-center text-pink-400">
                    <i class="fas fa-user"></i>
                </div>
                <span>My Profile</span>
            </a>

            <a href="{{ route('member.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition-all">
                <div class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center text-orange-400">
                    <i class="fas fa-gear"></i>
                </div>
                <span>Settings</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button class="w-full bg-gradient-to-r from-red-500 to-rose-600 hover:opacity-90 py-3 rounded-2xl font-semibold shadow-lg transition-all duration-300 text-white">
                    <i class="fas fa-right-from-bracket mr-2"></i>
                    Logout
                </button>
            </form>

        </div>
    </aside>

    <div class="flex-1 flex flex-col lg:ml-72">

        <header class="h-20 bg-purple-600 border-b border-purple-700 flex items-center justify-between px-6 sticky top-0 z-30 shadow-lg">
            <div class="flex items-center gap-4">
                <button @click="menuOpen = true" class="lg:hidden text-2xl text-white hover:text-purple-200 transition">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h2 class="text-xl font-bold text-white tracking-wide">Rukenya Smart Banking</h2>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center bg-white/20 backdrop-blur-md rounded-2xl px-4 h-11 w-72 border border-white/20">
                    <i class="fas fa-search text-white/80 mr-3"></i>
                    <input type="text" placeholder="Search..." class="bg-transparent outline-none w-full text-sm text-white placeholder-white/70">
                </div>

                <a href="{{ route('member.notifications') }}"
                   class="relative w-11 h-11 rounded-2xl bg-white/20 hover:bg-white/30 transition flex items-center justify-center border border-white/20">
                    <i class="fas fa-bell text-white text-lg"></i>
                    @if(auth()->user()->notifications()->where('is_read', false)->count() > 0)
                        <span class="absolute top-2 right-2 w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold">
                            {{ auth()->user()->notifications()->where('is_read', false)->count() }}
                        </span>
                    @endif
                </a>
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
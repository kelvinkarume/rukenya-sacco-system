<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Rukenya SACCO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 overflow-x-hidden">

<div x-data="{
    menuOpen: false,
    memberOpen: false,
    savingsOpen: false,
    loanOpen: false,
    paymentOpen: false,
    reportOpen: false,
    settingsOpen: false
}" class="min-h-screen flex">

    <!-- OVERLAY -->
    <div x-show="menuOpen"
         x-transition.opacity
         @click="menuOpen = false"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <!-- SIDEBAR -->
    <aside
        class="fixed lg:fixed top-0 left-0 h-screen overflow-y-auto w-72 bg-gradient-to-b from-amber-700 via-yellow-700 to-orange-800 shadow-2xl z-50 transform transition-all duration-300"
        :class="menuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >

        <!-- LOGO -->
        <div class="px-6 py-6 border-b border-slate-800">

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-400 to-cyan-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-shield text-xl text-white"></i>
                </div>

                <div>
                    <h1 class="font-bold text-lg tracking-wide">
                        Admin Panel
                    </h1>

                    <p class="text-xs text-emerald-200">
                        Rukenya SACCO
                    </p>
                </div>

            </div>

        </div>

        <!-- NAVIGATION -->
        <div class="px-4 py-6 space-y-2">

            <p class="text-xs uppercase text-emerald-100 px-3 mb-2 tracking-widest font-semibold">
                Main Menu
            </p>

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-gradient-to-r from-emerald-500 to-cyan-500 text-white shadow-lg hover:scale-[1.02] transition-all duration-300">

                <i class="fas fa-gauge"></i>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>

            <!-- MEMBERS -->
            <div>

                <button
                    @click="memberOpen = !memberOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
                >

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center text-blue-200">
                            <i class="fas fa-users"></i>
                        </div>

                        <span class="font-medium">
                            Members
                        </span>

                    </div>

                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-300"
                        :class="memberOpen ? 'rotate-180' : ''"
                    ></i>

                </button>

                <div
                    x-show="memberOpen"
                    x-transition
                    class="ml-5 mt-2 space-y-2 border-l border-slate-300/30 pl-4"
                >

                    <a href="{{ route('admin.members') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        View Members
                    </a>

                    <a href="{{ route('admin.members') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Activate / Deactivate
                    </a>

                    <a href="{{ route('admin.members') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Member Details
                    </a>

                </div>

            </div>

            <!-- SAVINGS -->
            <div>

                <button
                    @click="savingsOpen = !savingsOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
                >

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-200">
                            <i class="fas fa-piggy-bank"></i>
                        </div>

                        <span class="font-medium">
                            Savings
                        </span>

                    </div>

                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-300"
                        :class="savingsOpen ? 'rotate-180' : ''"
                    ></i>

                </button>

                <div
                    x-show="savingsOpen"
                    x-transition
                    class="ml-5 mt-2 space-y-2 border-l border-slate-300/30 pl-4"
                >

                    <a href="{{ route('admin.savings') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        All Deposits
                    </a>

                    <a href="{{ route('admin.savings.withdrawals') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Withdrawals
                    </a>

                </div>

            </div>

            <!-- LOANS -->
            <div>

                <button
                    @click="loanOpen = !loanOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
                >

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center text-cyan-200">
                            <i class="fas fa-hand-holding-dollar"></i>
                        </div>

                        <span class="font-medium">
                            Loans
                        </span>

                    </div>

                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-300"
                        :class="loanOpen ? 'rotate-180' : ''"
                    ></i>

                </button>

                <div
                    x-show="loanOpen"
                    x-transition
                    class="ml-5 mt-2 space-y-2 border-l border-slate-300/30 pl-4"
                >

                    <a href="{{ route('admin.loans.applications') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Loan Applications
                    </a>

                    <a href="{{ route('admin.loans.active') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Active Loans
                    </a>

                    <a href="{{ route('admin.loans.repayments') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Repayment History
                    </a>

                </div>

            </div>

            <!-- PAYMENTS -->
            <div>

                <button
                    @click="paymentOpen = !paymentOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
                >

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-yellow-500/20 flex items-center justify-center text-yellow-200">
                            <i class="fas fa-money-bill"></i>
                        </div>

                        <span class="font-medium">
                            Payments
                        </span>

                    </div>

                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-300"
                        :class="paymentOpen ? 'rotate-180' : ''"
                    ></i>

                </button>

                <div
                    x-show="paymentOpen"
                    x-transition
                    class="ml-5 mt-2 space-y-2 border-l border-slate-300/30 pl-4"
                >

                    <a href="{{ route('admin.payments') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        All Payments
                    </a>

                    <a href="{{ route('admin.payments.overdue') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Overdue Loans
                    </a>

                    <a href="{{ route('admin.payments.profit') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Total Profits
                    </a>

                </div>

            </div>

            <!-- REPORTS -->
            <div>

                <button
                    @click="reportOpen = !reportOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
                >

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center text-purple-200">
                            <i class="fas fa-chart-line"></i>
                        </div>

                        <span class="font-medium">
                            Reports
                        </span>

                    </div>

                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-300"
                        :class="reportOpen ? 'rotate-180' : ''"
                    ></i>

                </button>

                <div
                    x-show="reportOpen"
                    x-transition
                    class="ml-5 mt-2 space-y-2 border-l border-slate-300/30 pl-4"
                >

                    <a href="{{ route('admin.reports.loans') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        <i class="fas fa-hand-holding-dollar mr-2"></i> Loan Reports
                    </a>

                    <a href="{{ route('admin.reports.repayments') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        <i class="fas fa-money-check mr-2"></i> Repayments Reports
                    </a>

                    <a href="{{ route('admin.reports.savings') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        <i class="fas fa-piggy-bank mr-2"></i> Savings Report
                    </a>

                    <a href="{{ route('admin.reports.overdue') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Overdue Reports
                    </a>

                    <a href="{{ route('admin.reports.profit') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        <i class="fas fa-chart-line mr-2"></i> Profit Reports
                    </a>

                    <a href="{{ route('admin.reports.savings-withdrawals') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        <i class="fas fa-money-bill-wave mr-2"></i> Savings Withdrawals Reports
                    </a>

                </div>

            </div>

            <!-- SETTINGS -->
            <div>

                <button
                    @click="settingsOpen = !settingsOpen"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
                >

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center text-orange-200">
                            <i class="fas fa-gear"></i>
                        </div>

                        <span class="font-medium">
                            Settings
                        </span>

                    </div>

                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-300"
                        :class="settingsOpen ? 'rotate-180' : ''"
                    ></i>

                </button>

                <div
                    x-show="settingsOpen"
                    x-transition
                    class="ml-5 mt-2 space-y-2 border-l border-slate-300/30 pl-4"
                >

                    <a href="{{ route('admin.settings') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        SACCO Info
                    </a>

                    <a href="{{ route('admin.settings') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Interest Rate
                    </a>

                    <a href="{{ route('admin.settings') }}"
                       class="block py-2 px-3 rounded-xl hover:bg-slate-800/40 text-sm text-white transition">
                        Loan Rules
                    </a>

                </div>

            </div>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf

                <button
                    class="w-full bg-gradient-to-r from-red-500 to-rose-600 hover:opacity-90 py-3 rounded-2xl font-semibold shadow-lg transition-all duration-300"
                >
                    <i class="fas fa-right-from-bracket mr-2"></i>
                    Logout
                </button>

            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col lg:ml-72">

        <!-- TOP NAVBAR -->
        <header class="h-20 bg-blue-700 border-b border-blue-800 flex items-center justify-between px-6 sticky top-0 z-30 shadow-lg">
            <!-- MENU BUTTON LEFT -->
            <div class="flex items-center">
                <button
                    @click="menuOpen = true"
                    class="lg:hidden text-2xl text-white mr-4 hover:text-blue-200 transition"
                >
                    <i class="fas fa-bars"></i>
                </button>

               <h2 class="text-xl font-bold text-white tracking-wide">
                    Rukenya SACCO
                </h2>
            </div>

            <!-- NOTIFICATIONS RIGHT -->
            <div class="flex items-center space-x-4" x-data="{
                notificationOpen: false,
                pendingLoans: @json($pendingLoans ?? []),
                pendingWithdrawals: @json($pendingWithdrawals ?? [])
            }">

                <!-- NOTIFICATION BELL -->
                <div class="relative">
                    <button
                        @click="notificationOpen = !notificationOpen"
                        class="relative p-2 text-white hover:text-blue-200 transition rounded-lg hover:bg-blue-600"
                    >
                        <i class="fas fa-bell text-xl"></i>

                        <!-- NOTIFICATION COUNT BADGE -->
                        <span
                            x-show="pendingLoans.length + pendingWithdrawals.length > 0"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold"
                            x-text="pendingLoans.length + pendingWithdrawals.length"
                        ></span>
                    </button>

                    <!-- NOTIFICATION DROPDOWN -->
                    <div
                        x-show="notificationOpen"
                        @click.away="notificationOpen = false"
                        x-transition
                        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border z-50 max-h-96 overflow-y-auto"
                    >

                        <!-- HEADER -->
                        <div class="px-4 py-3 border-b bg-gray-50 rounded-t-lg">
                            <h3 class="font-semibold text-gray-800">Pending Actions</h3>
                        </div>

                        <!-- NO NOTIFICATIONS -->
                        <div
                            x-show="pendingLoans.length === 0 && pendingWithdrawals.length === 0"
                            class="px-4 py-6 text-center text-gray-500"
                        >
                            <i class="fas fa-check-circle text-2xl mb-2"></i>
                            <p>No pending actions</p>
                        </div>

                        <!-- PENDING LOANS -->
                        <template x-for="loan in pendingLoans" :key="loan.id">
                            <div class="px-4 py-3 border-b hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">
                                            <i class="fas fa-hand-holding-dollar text-blue-500 mr-2"></i>
                                            Loan Application
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span x-text="loan.user.name"></span> - KES <span x-text="loan.amount.toLocaleString()"></span>
                                        </p>
                                        <p class="text-xs text-gray-400" x-text="new Date(loan.created_at).toLocaleDateString()"></p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form method="POST" action="{{ route('admin.loans.approve', '') }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="loan_id" :value="loan.id">
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.loans.reject', '') }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="loan_id" :value="loan.id">
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- PENDING WITHDRAWALS -->
                        <template x-for="withdrawal in pendingWithdrawals" :key="withdrawal.id">
                            <div class="px-4 py-3 border-b hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">
                                            <i class="fas fa-money-bill-wave text-orange-500 mr-2"></i>
                                            Savings Withdrawal
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span x-text="withdrawal.user.name"></span> - KES <span x-text="withdrawal.amount.toLocaleString()"></span>
                                        </p>
                                        <p class="text-xs text-gray-400" x-text="new Date(withdrawal.created_at).toLocaleDateString()"></p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form method="POST" action="{{ route('admin.savings.approve-withdrawal', '') }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="saving_id" :value="withdrawal.id">
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.savings.reject-withdrawal', '') }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="saving_id" :value="withdrawal.id">
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>

                <!-- USER MENU -->
                <div class="flex items-center space-x-2">
                    <span class="text-white text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-blue-200 transition text-sm">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="p-6 w-full">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>